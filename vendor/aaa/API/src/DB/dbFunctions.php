<?php

namespace API\dbCall;

use API\LeagueAPI\LeagueAPI;

use API\LeagueAPI\Objects;

class dbCall
{
	/** @var \mysqli $conn */
	public $conn;
	

	private function openCon(string $dbRegion)
	{
		$db_server = "localhost";
		$db_user = "root";
		$db_pass = "";
		$db_database = "lol_database_" . $dbRegion;

		$conn = new \mysqli($db_server, $db_user, $db_pass, $db_database) or die("Connect failed: %s\n" . $conn->error);

		$this->conn = $conn;
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

			if ($queryResult->num_rows >= 1) {
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
		$x = 0;
		if ($this->conn->multi_query($query)) {
			do {
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

	private function makeDbCallSetMulti(string $region, string $query)
	{
		
	}
	/** @return Objects\Summoner */
	public function getSummoner(string $region,	$summonerName)
	{
		$summonerName = str_replace(' ', '', $summonerName);

		$selectQuery = "SELECT * FROM `summoner_$region` WHERE `trimmedName` = '$summonerName'";

		$resultAssoc = $this->makeDbCallGet($region, $selectQuery);


		// First time we lookup. If it doesn't exist make an API request and put it in the DB.
		if ($resultAssoc == null) {
			$lol = $this->makeApiRequest();
			$summonerDataDb = $lol->getSummonerNameSingle($region, $summonerName);
			$this->setSummonerSingle($region, $summonerDataDb);
		} else {
			$resultAssoc = $resultAssoc[0];
			$summonerDataDb = new Objects\Summoner($resultAssoc);
		}
		return $summonerDataDb;
	}
	public function getSummoners(string $region, array $summonerNames)
	{
		$selectQuery = "SELECT * FROM `summoner_$region` WHERE 'trimmedName' = ";
		foreach ($summonerNames as $key => $summoner) {
			$summoner = str_replace(' ', '', $summoner);
			if (array_key_last($summonerNames) == $key) {
				$selectQuery .= "'$summoner';";
			}
			else{
				$selectQuery .= "'$summoner' AND 'trimmedName' =";
			}

		}
		$resultAssoc = $this->makeDbCallGetMulti($region, $selectQuery);

		// First time we lookup. If it doesn't exist make an API request and put it in the DB.
		if ($resultAssoc[0] == null) {
			$lol = $this->makeApiRequest();
			$summonersDataDb = $lol->getSummonerName($region, $summonerNames);
			$this->setSummoner($region, $summonersDataDb);
		} else {
			$summonersDataDb = new Objects\Summoner($resultAssoc);
		}
		return $summonersDataDb;
	}
	/** @param Objects\Summoner[] $summoner */
	public function setSummoner(string $region, $summoners)
	{
		$insertQuery = "INSERT IGNORE INTO `summoner_$region`(`id`, `accountId`, `puuid`, `name`, `profileIconId`, `revisionDate`, `summonerLevel`, `trimmedName`)VALUES ";
		foreach ($summoners as $key => $value) {
			if (array_key_last($summoners) == $key) {

				$insertQuery .= "('$value->id','$value->accountId','$value->puuid','$value->name','$value->profileIconId','$value->revisionDate','$value->summonerLevel','$value->trimmedName');";
			}
			else{
				$insertQuery .= "('$value->id','$value->accountId','$value->puuid','$value->name','$value->profileIconId','$value->revisionDate','$value->summonerLevel','$value->trimmedName'),";
			}
		}

		

		$this->makeDbCallSet($region, $insertQuery);
	}

	public function setSummonerSingle(string $region, $summoner)
	{
		$insertQuery = "INSERT IGNORE INTO `summoner_$region`(`id`, `accountId`, `puuid`, `name`, `profileIconId`, `revisionDate`, `summonerLevel`, `trimmedName`)
		VALUES ('$summoner->id','$summoner->accountId','$summoner->puuid','$summoner->name','$summoner->profileIconId','$summoner->revisionDate','$summoner->summonerLevel','$summoner->trimmedName');";

		$this->makeDbCallSet($region, $insertQuery);
	}
	/** @return null|Objects\MatchList */
	public function getMatchlist($region, string $accountId, int $limit, $queue = null, $season = null, $champion = null, $beginTime = null, $endTime = null, $beginIndex = null)
	{
		$selectQuery = "SELECT * FROM `matchlist_$region` WHERE `accountId` = '$accountId' ORDER BY `matchlist_$region`.`timestamp` DESC LIMIT $limit";

		$resultAssoc = $this->makeDbCallGet($region, $selectQuery);


		if ($resultAssoc == null)
		{
			$lol = $this->makeApiRequest();
			$dbMatchlist = $lol->getMatchlist($region, $accountId, $queue, $season, $champion, $beginTime, $endTime, $beginIndex, $limit);

			$this->setMatchlist($region, $dbMatchlist, $accountId);
			return $dbMatchlist;
		}
		else {
			$result["matches"] = $resultAssoc;
			$dbMatchlist = new Objects\MatchList($result);

			return $dbMatchlist;
		}
	}

	public function setMatchlist($region, Objects\MatchList $getMatchlist, string $accountId)
	{
		$value = "";
		$selectQuery2 = "";
		// We check which of those games we have in our DB for that spacific summoner
		// If the result returned is null that means that gameId is not in our db
		// In this case we should get the game from the API
		for ($i = 0; $i < sizeof($getMatchlist->matches); $i++) {
			$matches = $getMatchlist->matches[$i];
			$selectQuery2 .= "SELECT * FROM `matchlist_$region` WHERE `gameId` = '$matches->gameId' AND `accountId` = '$accountId';";
		}
		// Returns an array with the format $dbMatchlist[]["propertyName"]
		$dbMatchlist = $this->makeDbCallGetMulti($region, $selectQuery2);

		// We get the game that matches the gameIds in our DB and check them up against the API data to decide which games we will store in our DB

			for ($i = 0; $i < sizeof($dbMatchlist); $i++) {
				// We will create the sql query if we DONT have the game in our db
				// If we dont have the game in our DB the value of dbMatchlist array at that index will be NULL

				// We dont have the game in our DB. We will create the query
				if ($dbMatchlist[$i] == null) {
					// Makes the construction of the query easier
					$match = $getMatchlist->matches[$i];
					// If its the last element of the list we ad an ;
					if (sizeof($dbMatchlist) == $i + 1) {
						$value .= "('$accountId', '$match->gameId', '$match->platformId', '$match->champion', '$match->queue', '$match->season', '$match->timestamp', '$match->role', '$match->lane');";
					} else {
						$value .= "('$accountId', '$match->gameId', '$match->platformId', '$match->champion', '$match->queue', '$match->season', '$match->timestamp', '$match->role', '$match->lane'), \n";
					}
				} else {
					// We have the game in our DB. We do nothing in this case
				}
			}
			// We initialize the $value with "" so if default present is empty it means that the value isn't set
		if ($value != "") {
			$insertQueryP = "INSERT INTO `matchlist_$region` (`accountId`, `gameId`,`platformId`,`champion`,`queue`, `season`, `timestamp`, `role`, `lane`) VALUES (";
			$insertQuery = "INSERT INTO `matchlist_$region`(`accountId`, `gameId`,`platformId`,`champion`,`queue`, `season`, `timestamp`, `role`, `lane`) VALUES $value";

			$this->makeDbCallSet($region, $insertQuery);
		} else {
			// We have nothing to add to DB which means we do nothing
		}
	}

	/** Retuns an array of Matches
	 * @return MatchById[] */
	public function getMatchById(string $region, Objects\MatchList $matchlist): array
	{
		$selectQuery = "";
		foreach ($matchlist->matches as $key => $value) {
			$matchIds[$key] = $matchlist->matches[$key]->gameId;
			$selectQuery = $selectQuery . "SELECT * FROM `gamebyid_eun1` WHERE `gameId` = " . $matchIds[$key] . ";\n";
		}
		$resultDb = $this->makeDbCallGetMulti($region, $selectQuery);
		// Find Missing games
		foreach ($resultDb as $key => $value) {
			if (isset($value)) {
				// We have the match. No actions taken.
			} else {
				// We dont have that match in our DB. We will check the matchlist to see which game we don't have and download it from the API.
				$gamesToFind[$key] = $matchlist->matches[$key]->gameId;
			}
		}
		if (isset($gamesToFind)) {
			$lol = $this->makeApiRequest();
			$result = $lol->getMatchById($region, $gamesToFind);

			// Store the values to DB
			$this->setMatchById($region, $result);
		}
		// We combine the Db array and the APi array since we may have mising games in our DB
		// On repeat requests we will have all the games in our db. No need to check
		if (isset($result)) {
			foreach ($resultDb as $key => $value) {
				if (isset($value)) {
					$result[$key] = $value;
				}
			}
			// Then we sort those 2 arrays by their key
			ksort($result);
		}
		else {
			foreach ($resultDb as $key => $value) {
				if (isset($value)) {
					$result[$key] = $value;
				}
			}
		}
		// Convert to MatchById Class
		foreach ($result as $key => $value) {
			if (is_array($value)) {
				$resultAssoc = json_decode($result[$key]["matchJson"], true);
				$matchById[$key] = new Objects\MatchById($resultAssoc);
			} else {
				$matchById[$key] = $result[$key];
			}
		}
		return $matchById;
	}



	/**
	 *  @param \API\LeagueAPI\Objects\MatchById[] $matchById 
	 * 
	 */
	public function setMatchById(string $region,array $matchById)
	{
		$insertQuery = "INSERT IGNORE INTO `gamebyid_eun1` (`gameId`, `matchJson`) VALUES ";


		foreach ($matchById as $key => $value) {
			$json[$key] = json_encode($matchById[$key], JSON_UNESCAPED_UNICODE );
			$what[$key] = $key;
			$jsonInsert = $json[$key];
			if (array_key_last($matchById) == $key) {
				$insertQuery .= "('$value->gameId', '$jsonInsert');";
			}
			else {

				$insertQuery .= "('$value->gameId', '$jsonInsert'),";
			}
		}
		$this->makeDbCallSet($region, $insertQuery);
	}
	/** @param \API\LeagueAPI\Objects\LeagueSummoner[][][] $summonersLeagues */
	public function setLeagueBySummoner(string $region,array $summonersLeagues)
	{
		$insertQuery = "INSERT IGNORE INTO `leaguebysummoner_eun1` (`id`, `name`, `queueType`, `tier`, `rank`, `leagueId`, `leaguePoints`, `wins`, `losses`, `veteran`, `inactive`, `freshBlood`, `hotStreak`) VALUES ";
		
		// we will get an array of arrays of arrays -> object
		foreach ($summonersLeagues as $key => $match) {
			foreach ($match as $key2 => $participants) {
				foreach ($participants as $key3 => $league) {
					if (array_key_last($summonersLeagues) == $key && array_key_last($match) == $key2 && array_key_last($participants) == $key3){
						$insertQuery .= "('$league->summonerId', '$league->summonerName', '$league->queueType', '$league->tier', '$league->rank', '$league->leagueId', '$league->leaguePoints', '$league->wins', '$league->losses', '$league->veteran', '$league->inactive', '$league->freshBlood', '$league->hotStreak');";
					}
					else {
						$insertQuery .= "('$league->summonerId', '$league->summonerName', '$league->queueType', '$league->tier', '$league->rank', '$league->leagueId', '$league->leaguePoints', '$league->wins', '$league->losses', '$league->veteran', '$league->inactive', '$league->freshBlood', '$league->hotStreak'),";
					}
				}
			}
		}
		$this->makeDbCallSet($region,$insertQuery);
	}
	/** 
	 * THIS API CAN RETURN NULL
	 * @param \API\LeagueAPI\Objects\Summoner[][] $match  
	*/
	public function getLeagueSummoner(string $region, array $match)
	{
		$selectQuery = "";

        foreach ($match as $key => $summoners) {
			foreach ($summoners as $key2 => $summoner) {
					$selectQuery .= "SELECT * FROM `leaguebysummoner_eun1` WHERE `id` = '$summoner->id';";
			}
			$resultDb = $this->makeDbCallGetMulti($region, $selectQuery);
		}

		dd($match);
		die;

		// Find Missing Entries
		foreach ($resultDb as $key => $value) {
			if (!$value == null) {
				// We have the entry. No actions taken.
			} else {
				// We dont have that entry in our DB. We will check the summoners to see which game we don't have and download it from the API.
				$entriesToFind[$key] = $match[$key];
			}
		}

		if (isset($entriesToFind)) {

			$lol = $this->makeApiRequest();
			$result = $lol->getLeagueSummoner($region, $entriesToFind);
			dd($result);
			// Store the values to DB
			$this->setLeagueBySummoner($region, $result);
		}

		// We combine the Db array and the APi array since we may have mising games in our DB
		// On repeat requests we will have all the games in our db. No need to check
		if (isset($result)) {
			foreach ($resultDb as $key => $value) {
				if (isset($value)) {
					$result[$key] = $value;
				}
			}
			// Then we sort those 2 arrays by their key
			ksort($result);
		}

		// Convert to MatchById Class
		foreach ($result as $key => $value) {
			if (is_array($value)) {
				$resultAssoc = json_decode($result[$key], true);
				$matchById[$key] = new Objects\MatchById($resultAssoc);
			} else {
				$matchById[$key] = $result[$key];
			}
		}
		return $matchById;



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