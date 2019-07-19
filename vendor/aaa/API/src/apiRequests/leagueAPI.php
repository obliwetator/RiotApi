<?php
namespace LeagueAPI;

require 'E:\xampp\htdocs\API\vendor\aaa\API\src\apiRequests\curl.php';
require 'E:\xampp\htdocs\API\vendor\aaa\API\src\apiRequests\objects\objectInit.php';
require 'E:\xampp\htdocs\API\vendor\aaa\API\src\apiRequests\includes\includes.php';
require 'E:\xampp\htdocs\API\vendor\aaa\API\src\DragonData\DragonData.php';

use LeagueAPI\Objects\StaticData;
use DragonData;
use LeagueAPI\Objects\LeagueEntries;

class LeagueAPI{
	// $assoc determined whether the array is converted to an object(false) or an assosiative array(true)
	private $assoc = true;
	// API CALLS
	public function getSummonerName($region, string $summonerName) : Objects\Summoner
	{

		// remove spaces
		$summonerName = str_replace(' ', '', $summonerName);
		$targetUrl = "https://$region.api.riotgames.com/lol/summoner/v4/summoners/by-name/$summonerName";


		$data = curl($targetUrl, $this->assoc);

		$summoner = new Objects\Summoner($data);
		// Remove Spaces and save name with proper capitalization
		$summoner->trimmedName = str_replace(" ","", $summoner->name);

		return $summoner;
	}
	public function getSummonerId($region, string $summonerId) : Objects\Summoner
	{
		$targetUrl = "https://$region.api.riotgames.com/lol/summoner/v4/summoners/$summonerId";

		$data = curl($targetUrl, $this->assoc);

		$summoner = new Objects\Summoner($data);
		
		return $summoner;
	}

	public function getSummonerPuuId($region, string $puuId) : Objects\Summoner
	{
		$targetUrl = "https://$region.api.riotgames.com/lol/summoner/v4/summoners/by-puuid/$puuId";

		$data = curl($targetUrl, $this->assoc);
		
		return new Objects\Summoner($data);
	}
	public function getSummonerAccountId($region, string $summonerAccountId) : Objects\Summoner
	{
		$targetUrl = "https://$region.api.riotgames.com/lol/summoner/v4/summoners/by-account/$summonerAccountId";

		$data = curl($targetUrl, $this->assoc);

		return new Objects\Summoner($data);
	}
	public function getMatchlist($region, string $accountId, int $queue = null, int $season = null, int $champion = null, int $beginTime = null, int $endTime = null, int $beginIndex = null, int $endIndex = null ) : Objects\MatchList
	{
		$targetUrl = "https://$region.api.riotgames.com/lol/match/v4/matchlists/by-account/$accountId";

		$additionalParameters["queue"] = $queue;
		$additionalParameters["season"] = $season;
		$additionalParameters["champion"] = $champion;
		$additionalParameters["beginTime"] = $beginTime;
		$additionalParameters["endTime"] = $endTime;
		$additionalParameters["beginIndex"] = $beginIndex;
		$additionalParameters["endIndex"] = $endIndex;

		$data = curl($targetUrl, $this->assoc, $additionalParameters);

		return new Objects\MatchList($data);
	}
	public function getMatchById($region, int $matchId) :Objects\MatchById
	{
		$targetUrl = "https://$region.api.riotgames.com/lol/match/v4/matches/$matchId";

		$data = curl($targetUrl, $this->assoc);

		return new Objects\MatchById($data);
	}
	public function getMatchTimeline($region, int $matchId) :Objects\matchTimeline
	{
		$targetUrl = "https://$region.api.riotgames.com/lol/match/v4/timelines/by-match/$matchId";
		
		$data = curl($targetUrl, $this->assoc);

		return new Objects\matchTimeline($data);
	}

	public function getActiveMatchInfo($region, string $summonerId) :Objects\activeGame
	{
		//throw new Exception("Not implemented");
		$targetUrl = "https://$region.api.riotgames.com/lol/spectator/v4/active-games/by-summoner/$summonerId";

		$data = curl($targetUrl, $this->assoc);
		
		return new Objects\activeGame($data);
	}

	public function getChampionMasteriesSummoner($region, string $summonerId) :Objects\championMasteriesFrame
	{
		$targetUrl = "https://$region.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/$summonerId";

		$data = curl($targetUrl, $this->assoc);
		
		return new Objects\championMasteriesFrame($data);
	}
	public function getChampionMasteriesSummonerByChampion($region, string $summonerId, int $championId) :Objects\championMasteriesByChampion
	{
		$targetUrl = "https://$region.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/$summonerId/by-champion/$championId";
	

		$data = curl($targetUrl, $this->assoc);
		
		return new Objects\championMasteriesByChampion($data);
	}
	/** Returns the sum of all mastery levels added up. Single int */
	public function getChampionMasteriesScore($region, string $summonerId) : int
	{
		$targetUrl = "https://$region.api.riotgames.com/lol/champion-mastery/v4/scores/by-summoner/$summonerId";
	
		$data = curl($targetUrl, $this->assoc);
		return $data;
	}

	/** @return LeagueSummoner[] */
	public function getLeagueSummoner($region, string $summonerId) : array
	{
		$targetUrl = "https://$region.api.riotgames.com/lol/league/v4/entries/by-summoner/$summonerId";

		$data = curl($targetUrl, $this->assoc);
		foreach ($data as $key => $value) 
		{
			$obj[$key] = new Objects\LeagueSummoner($value);
		}
		if (isset($obj)) 
		{
			return $obj;
		}
		else 
		{
			return $obj = ["No Ranked positions found"];
		}

	}

	/** Valid Game Modes
	 *  RANKED_SOLO_5x5,
	 *  RANKED_TFT,
	 *  RANKED_FLEX_SR,
	 *  RANKED_FLEX_TT
	 */
	public function getChallengerLeagues($region, string $gameMode) : Objects\ChallengerLeagues
	{
		$targetUrl = "https://$region.api.riotgames.com/lol/league/v4/challengerleagues/by-queue/$gameMode";

		$data = curl($targetUrl, $this->assoc);

		return new Objects\ChallengerLeagues($data);
	}

	/** Valid Game Modes
	 *  RANKED_SOLO_5x5,
	 *  RANKED_TFT,
	 *  RANKED_FLEX_SR,
	 *  RANKED_FLEX_TT
	 */
	public function getGrandmasterLeagues($region, string $gameMode) :Objects\ChallengerLeagues
	{
		$targetUrl = "https://$region.api.riotgames.com/lol/league/v4/grandmasterleagues/by-queue/$gameMode";

		$data = curl($targetUrl, $this->assoc);

		return new Objects\ChallengerLeagues($data);
	}

	/** Valid Game Modes
	 *  RANKED_SOLO_5x5,
	 *  RANKED_TFT,
	 *  RANKED_FLEX_SR,
	 *  RANKED_FLEX_TT
	 */
	public function getMasterLeague($region, string $gameMode) :Objects\ChallengerLeagues
	{
		$targetUrl = "https://$region.api.riotgames.com/lol/league/v4/masterleagues/by-queue/$gameMode";

		$data = curl($targetUrl, $this->assoc);

		return new Objects\ChallengerLeagues($data);
	}
		/** Valid Game Modes
	 *  RANKED_SOLO_5x5,
	 *  RANKED_TFT,
	 *  RANKED_FLEX_SR,
	 *  RANKED_FLEX_TT
	 * 
	* @return LeagueEntries[] */
	public function getLeagueEntries($region, string $gameMode, string $division, string $tier, int $page = null) : array
	{
		$targetUrl = "https://$region.api.riotgames.com/lol/league/v4/entries/$gameMode/$division/$tier";

		$additionalParameters["page"] = $page;
		$data = curl($targetUrl, $this->assoc, $additionalParameters);

		foreach ($data as $key => $value) {
			$obj[$key] = new Objects\LeagueEntries($value);
		}
		if (isset($obj)) 
		{
			return $obj;
		}
		else 
		{
			return $obj = ["No Ranked positions found"];
		}
	}

	public function getLeagueById($region, string $leagueId) :Objects\ChallengerLeagues
	{
		$targetUrl = "https://$region.api.riotgames.com/lol/league/v4/leagues/$leagueId";

		$data = curl($targetUrl, $this->assoc);

		return new Objects\ChallengerLeagues($data);
	}





	protected function addQuery( string $name, $value )
	{
		if (!is_null($value))
		{
			$this->query_data[$name] = $value;
		}

		return $this;
	}

	// STATIC DATA CALLS
	public function getStaticChampions(bool $data_by_key = null, string $locale = 'en_GB', string $version = null ): StaticData\StaticChampionList
	{
		// Fetch StaticData from JSON files
		if ($data_by_key)
			$data = DragonData::getStaticChampionsWithKeys($locale, $version);
		else
			$data = DragonData::getStaticChampions($locale, $version);

		if (!$data) throw new ServerException("StaticData failed to be loaded.");

		// Create missing data
		$data['keys'] = array_map(function ($d) use ($data_by_key) {
			return $data_by_key
				? $d['id']
				: $d['key'];
		}, $data['data']);
		$data['keys'] = array_flip($data['keys']);

		return new StaticData\StaticChampionList($data);
	}
	public function getStaticChampion($championId, $details = false, $locale = "en_GB", $version = "9.13.1") :StaticData\StaticChampion
	{
		// $version/data/$locale/champion.json
		// champion.json (less detailed version)
		// We grab the whole json(as an array) and then we will search for the specified champion ID and return the appropriate array
		$data = DragonData::getStaticChampionDataById($championId, $locale, $version);
		if ($details == true) 
		{
			// We have the champion data. With the champion name we grab the detailed champion file 
			// $version/data/$locale/champion/$championId(Champion Name)
			// "https://ddragon.leagueoflegends.com/cdn/9.13.1/data/en_US/champion/Orianna.json"
			// The brackets on the end return the proper array.
			$data = DragonData::getStaticChampionDataDetails($data["id"], $locale, $version)["data"][$data["id"]];
		}
		return new StaticData\StaticChampion($data);
	}
	/** Get ALL items */
	public function getStaticItems(string $locale = 'en_GB', string $version = null) : StaticData\StaticItemList
	{
		$data = DragonData::getStaticItems($locale, $version);
		
		array_walk($data['data'], function (&$d, $k) {
			$d['id'] = $k;
		});
		return new StaticData\StaticItemList($data);
	}
	/** Get a specific item by its ID */
	public function getStaticItem(int $itemId, string $locale = 'en_GB', string $version = null) :StaticData\StaticItem
	{
		$data = DragonData::getStaticItem($itemId, $locale, $version);

		$data['id'] = $itemId;

		return new StaticData\StaticItem($data);
	}

	public function getStaticProfileIcons(string $locale = 'en_GB', string $version = null)
	{
		$data = DragonData::getStaticProfileIcons($locale, $version);

		return $data;
	}
	public function getStaticRunesReforged(string $locale = 'en_GB', string $version = null)
	{
		$data = DragonData::getStaticRunesReforged($locale, $version);
		// alter the data a bit
			$r = [];
			$ar = [];
			$arr = [];
			foreach ($data as $key => $value) 
			{
				foreach ($value as $key2 => $value2) 
				{
					if ($key2 == "slots")
					{
						foreach ($value2 as $key3 => $value3)
						{
							foreach ($value3['runes'] as $key3 => $value3) 
							{
								$r[$value3['id']] = $value3;
							}
						}
					}
					else
					{
						$ar[$key2] = $value2;
					}
				}
				$ar["runes"] = $r;
				$arr[$ar["id"]] = $ar;
				$r = [];
			}
		return $arr;
	}

	public function getStaticSummonerSpell(string $locale = 'en_GB', string $version = null, $key = true)
	{
		$data = false;
		// We alter the array to be able to search by spell ID. Makes things much easier.
		if ($key == true) 
		{
			$data = DragonData::getStaticSummonerSpellsWithKeys($locale, $version);
		}
		else
		{
			$data = DragonData::getStaticSummonerSpells($locale, $version);
		}
		if($data == false)
		{
			throw new Exception("Static data for summoner spell not found", 404);
		}

		return $data;
	}
	/** This will return ONLY the current active maps.*/
	public function getStaticMaps(string $locale = 'en_GB', string $version = null)
	{
		$data = DragonData::getStaticMaps($locale, $version);

		return $data;
	}
}
?>