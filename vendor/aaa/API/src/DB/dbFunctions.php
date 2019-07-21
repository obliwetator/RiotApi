<?php

namespace API\dbCall;

use API\LeagueAPI\LeagueAPI;
use Hamcrest\Type\IsArray;
use function GuzzleHttp\json_encode;

use API\LeagueAPI\Objects;

class dbCall
{

	public $conn;

	private function openCon(string $dbRegion)
	{
		$db_server = "localhost";
		$db_user = "root";
		$db_pass = "";
		$db_database = "lol_database_" . $dbRegion;

		$conn = new \mysqli($db_server, $db_user, $db_pass, $db_database) or die("Connect failed: %s\n" . $conn->error);

		$this->conn = $conn;

		return $conn;
	}
	private function closeCon($conn)
	{
		$conn->close();
	}

	private function makeDbCallGet(string $region, string $query)
	{
		$this->openCon($region);
		$queryResult = $this->conn->query($query);
		if ($queryResult == true) {

			if ($queryResult->num_rows > 1) {
				for ($i = 0; $i < $queryResult->num_rows; $i++) {
					$resultAssoc[$i] = $queryResult->fetch_assoc();
				}
			} elseif ($queryResult->num_rows == 0) {
				$this->closeCon($this->conn);

				return null;
			} else {
				$resultAssoc = $queryResult->fetch_assoc();
			}
		} else {
			eh("something went wrong with the SQL query GET. " . $this->conn->error);
		}
		$this->closeCon($this->conn);

		return $resultAssoc;
	}

	private function makeDbCallGetMulti(string $region, string $query)
	{
		$this->openCon($region);

		$matches = [];
		$row = "";
		$x = 0;
		if ($this->conn->multi_query($query)) {
			do {
				$conn = $this->conn;
				/* store first result set */
				if ($result = $this->conn->store_result()) {
					if ($result->num_rows) {
						$matches[$x] = $result->fetch_assoc();
					} else {
						$matches[$x] = null;
					}
					$x++;
					$result->free();
				}

				if ($this->conn->more_results()) {
					// DO something between results

				} else {
					break;
				}
			} while ($this->conn->next_result());
		}
		$this->closeCon($this->conn);
		return $matches;
	}

	private function makeDbCallSet(string $region, string $query)
	{
		$this->openCon($region);

		$queryResult = $this->conn->query($query);

		if ($queryResult == true) {
			$mySqliWarning = $this->conn->get_warnings();

			if ($mySqliWarning == true) {
				if ($mySqliWarning->errno == 1062) {
					// We will get this error this we will use INSERT IGNORE wich will throw a wrning on duplicate primary key
				} else {
					eh("Mysqli error  $mySqliWarning->errno  $mySqliWarning->message ");
				}
			}
		} else {
			// There is something wrong with the query
			// TODO: Log error messages?
			eh("something went wrong with the SQL query SET. " . $this->conn->error);
		}

		$this->closeCon($this->conn);
	}
	/** @return Objects\Summoner */
	public function getSummoner(string $region, string $summonerName)
	{
		$summonerName = str_replace(' ', '', $summonerName);

		$selectQuery = "SELECT * FROM `lol_database_$region`.`summoner_$region` WHERE `trimmedName` = '$summonerName'";

		$resultAssoc = $this->makeDbCallGet("$region", $selectQuery);

		// First time we lookup. If it doesn't exist make an API request and put it in the DB.
		if ($resultAssoc == null) {
			$lol = $this->makeApiRequest();

			$summonerDataDb = $lol->getSummonerName($region, $summonerName);
			$this->setSummoner($region, $summonerDataDb);
		} else {
			$resultAssoc["class"] = "summoner";

			$summonerDataDb = new Objects\Summoner($resultAssoc);
		}
		return $summonerDataDb;
	}
	public function setSummoner(string $region, Objects\Summoner $summoner)
	{
		$insertQuery = "INSERT IGNORE INTO `summoner_$region`(`id`, `accountId`, `puuid`, `name`, `profileIconId`, `revisionDate`, `summonerLevel`, `trimmedName`)
		VALUES ('$summoner->id','$summoner->accountId','$summoner->puuid','$summoner->name','$summoner->profileIconId','$summoner->revisionDate','$summoner->summonerLevel','$summoner->trimmedName')";

		$this->makeDbCallSet($region, $insertQuery);
	}
	/** @return Objects\MatchList */
	public function getMatchlist($region, string $accountId, int $limit = 10): Objects\MatchList
	{
		$selectQuery = "SELECT * FROM `matchlist_eun1` WHERE `accountId` = '$accountId' ORDER BY `matchlist_$region`.`timestamp` DESC LIMIT $limit";

		$resultAssoc = $this->makeDbCallGet($region, $selectQuery);

		// First time we lookup. If it doesn't exist make an API request and put it in the DB.
		if ($resultAssoc == null) {
			// API Init
			$lol = $this->makeApiRequest();
			// API CALL
			$dbMatchlist = $lol->getMatchlist($region, $accountId, null, null, null, null, null, null, $limit);
			// DB CALL
			$this->setMatchlist($region, $dbMatchlist, $accountId, $limit, $resultAssoc);
		} else {
			$result["matches"] = $resultAssoc;
			$result["class"] = "matchlist";

			$dbMatchlist = new Objects\MatchList($result);
		}
		return $dbMatchlist;
	}

	public function setMatchlist($region, Objects\MatchList $getMatchlist, string $accountId, int $limit, $resultAssoc = "false")
	{
		$value = "";
		$offset = 0;
		$dbMacthlist = null;

		// That means we have no games in our DB
		if ($resultAssoc == null) { }
		// We have games in our DB. Get them to compare to the API games
		else {
			$dbMacthlist = $this->getMatchlist($region, $accountId, $limit);
		}
		if ($dbMacthlist != null) {
			for ($i = 0; $i < sizeof($getMatchlist->matches); $i++) {
				if ($dbMacthlist->matches[0]->gameId == $getMatchlist->matches[$i]->gameId) {
					$offset = $i;
					break;
				}
			}
		}
		for ($j = 0; $j < sizeof($getMatchlist->matches); $j++) {
			$match = $getMatchlist->matches[$j];

			if (isset($dbMacthlist->matches[$j - $offset])) {
				if ($dbMacthlist->matches[$j - $offset]->gameId == $getMatchlist->matches[$j]->gameId) {
					// matches match meaning we have the same matches in our DB as from the API
					// In this case we do nothing
				} else {
					// no matches
					// This happens if they player played too many matches from the last time we checked or we search for old matches
					if ($j == sizeof($getMatchlist->matches) - 1) {
						$value = $value . "('$accountId', '$match->gameId', '$match->platformId', '$match->champion', '$match->queue', '$match->season', '$match->timestamp', '$match->role', '$match->lane');";
					} else {
						$value = $value . "('$accountId', '$match->gameId', '$match->platformId', '$match->champion', '$match->queue', '$match->season', '$match->timestamp', '$match->role', '$match->lane'), \n";
					}
				}
			} else {
				// No matching elements in our DB and API. We add it to the query
				// Possibly flawed logic. If the next element of the DB DOESNT'T exist we finish the query 
				if (isset($dbMacthlist->matches[$j - $offset + 1]) || $j == sizeof($getMatchlist->matches) - 1) {
					$value = $value . "('$accountId', '$match->gameId', '$match->platformId', '$match->champion', '$match->queue', '$match->season', '$match->timestamp', '$match->role', '$match->lane');";
				} else {
					$value = $value . "('$accountId', '$match->gameId', '$match->platformId', '$match->champion', '$match->queue', '$match->season', '$match->timestamp', '$match->role', '$match->lane'),\n";
				}
			}
		}
		if ($value == null) {
			return null;
			// If there are no records to add do nothing
		} else { }

		$insertQuery = "INSERT INTO `matchlist_$region`(`accountId`, `gameId`,`platformId`,`champion`,`queue`, `season`, `timestamp`, `role`, `lane`) VALUES $value";

		$this->makeDbCallSet($region, $insertQuery);
	}

	/** @return MatchById[] */
	public function getMatchById(string $region, MatchList $matchlist): Objects\MatchById
	{
		$selectQuery = "";
		foreach ($matchlist->matches as $key => $value) {
			$selectQuery = $selectQuery . "SELECT * FROM `gamebyid_eun1` WHERE `gameId` = " . $matchlist->matches[$key]->gameId . ";\n";
		}
		$result = $this->makeDbCallGetMulti($region, $selectQuery);
		// Find Missing games
		foreach ($result as $key => $value) {
			if (isset($value)) {
				// We have the match. No actions taken.
			} else {
				// We dont have that match in our DB. We will check the matchlist to see which game we don't have and download it from the API.
				$lol = $this->makeApiRequest();
				$result[$key] = $lol->getMatchById($region, $matchlist->matches[$key]->gameId);
				// Store the values to DB
				$this->setMatchById($region, $result[$key]);
				die;
			}
		}

		// Convert to MatchById Class
		foreach ($result as $key => $value) {

			if (is_array($value)) {
				$resultAssoc = json_decode($result[$key]["matchJson"], true);
				$resultAssoc["class"] = "matchbyid";
				$matchById[$key] = new Objects\MatchById($resultAssoc);
			} else {
				$matchById[$key] = $result[$key];
			}
		}
		return $matchById;
	}

	public function setMatchById(string $region, Objects\MatchList $matchById)
	{
		$json = json_encode($matchById);

		$insertQuery = "INSERT INTO `gamebyid_eun1` (`gameId`, `matchJson`) VALUES ('$matchById->gameId', '$json')";

		$this->makeDbCallSet($region, $insertQuery);
	}

	public function getTimeline(string $region)
	{
		throw new Exception("Unimplemented");
		return;
	}
	/** @var matchTimeline $timeline */
	public function setTimeline(string $region, $timeline)
	{
		throw new Exception("Unimplemented");
		return;
	}
	private function makeApiRequest()
	{
		$lol = new LeagueAPI();
		return $lol;
	}
}
