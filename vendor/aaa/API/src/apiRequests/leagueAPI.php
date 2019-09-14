<?php

namespace API\LeagueAPI;

use API\DragonData\DragonData;
use API\LeagueAPI\Objects\StaticData;

require 'curl.php';
require 'functions.php';

class LeagueAPI
{
	// $assoc determined whether the array is converted to an object(false) or an assosiative array(true)
	private $assoc = true;

	// API CALLS
	public function getSummonerName(string $region, string $summonerName): Objects\Summoner
	{
		// remove spaces
		$summonerName = str_replace(' ', '', $summonerName);
		$targetUrl = "https://{$region}.api.riotgames.com/lol/summoner/v4/summoners/by-name/{$summonerName}";

		$data = curl($targetUrl, $this->assoc);

		$summoner = new Objects\Summoner($data);
		// Remove Spaces and save name with proper capitalization
		// $summoner->nameInputSanitization($summoner->name);
		$summoner->trimmedName = str_replace(' ', '', $summoner->name);

		return $summoner;
	}

	public function getSummonerId(string $region, string $summonerId): Objects\Summoner
	{
		$targetUrl = "https://{$region}.api.riotgames.com/lol/summoner/v4/summoners/{$summonerId}";

		$data = curl($targetUrl, $this->assoc);

		return new Objects\Summoner($data);
	}

	public function getSummonerPuuId(string $region, string $puuId): Objects\Summoner
	{
		$targetUrl = "https://{$region}.api.riotgames.com/lol/summoner/v4/summoners/by-puuid/{$puuId}";

		$data = curl($targetUrl, $this->assoc);

		return new Objects\Summoner($data);
	}

	public function getSummonerAccountId(string $region, string $summonerAccountId): Objects\Summoner
	{
		$targetUrl = "https://{$region}.api.riotgames.com/lol/summoner/v4/summoners/by-account/{$summonerAccountId}";

		$data = curl($targetUrl, $this->assoc);

		return new Objects\Summoner($data);
	}

	public function getMatchlist(string $region, string $accountId, int $queue = null, int $season = null, int $champion = null, int $beginTime = null, int $endTime = null, int $beginIndex = null, int $endIndex = null): Objects\MatchList
	{
		$targetUrl = "https://{$region}.api.riotgames.com/lol/match/v4/matchlists/by-account/{$accountId}";

		$additionalParameters['queue'] = $queue;
		$additionalParameters['season'] = $season;
		$additionalParameters['champion'] = $champion;
		$additionalParameters['beginTime'] = $beginTime;
		$additionalParameters['endTime'] = $endTime;
		$additionalParameters['beginIndex'] = $beginIndex;
		$additionalParameters['endIndex'] = $endIndex;

		$data = curl($targetUrl, $this->assoc, $additionalParameters);

		return new Objects\MatchList($data);
	}

	public function getMatchById(string $region, int $matchId): Objects\MatchById
	{
		$targetUrl = "https://{$region}.api.riotgames.com/lol/match/v4/matches/{$matchId}";

		$data = curl($targetUrl, $this->assoc);

		return new Objects\MatchById($data);
	}

	public function getMatchTimeline(string $region, int $matchId): Objects\matchTimeline
	{
		$targetUrl = "https://{$region}.api.riotgames.com/lol/match/v4/timelines/by-match/{$matchId}";

		$data = curl($targetUrl, $this->assoc);

		return new Objects\matchTimeline($data);
	}

	public function getActiveMatchInfo(string $region, string $summonerId): Objects\activeGame
	{
		//throw new Exception("Not implemented");
		$targetUrl = "https://{$region}.api.riotgames.com/lol/spectator/v4/active-games/by-summoner/{$summonerId}";

		$data = curl($targetUrl, $this->assoc);

		return new Objects\activeGame($data);
	}

	public function getChampionMasteriesSummoner(string $region, string $summonerId): Objects\championMasteriesFrame
	{
		$targetUrl = "https://{$region}.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/{$summonerId}";

		$data = curl($targetUrl, $this->assoc);

		return new Objects\championMasteriesFrame($data);
	}

	public function getChampionMasteriesSummonerByChampion(string $region, string $summonerId, int $championId): Objects\championMasteriesByChampion
	{
		$targetUrl = "https://{$region}.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/{$summonerId}/by-champion/{$championId}";

		$data = curl($targetUrl, $this->assoc);

		return new Objects\championMasteriesByChampion($data);
	}

	/** Returns the sum of all mastery levels added up. Single int */
	public function getChampionMasteriesScore(string $region, string $summonerId): int
	{
		$targetUrl = "https://{$region}.api.riotgames.com/lol/champion-mastery/v4/scores/by-summoner/{$summonerId}";

		return curl($targetUrl, $this->assoc);
	}

	/** Valid Game Modes
	 *  RANKED_SOLO_5x5,
	 *  RANKED_TFT,
	 *  RANKED_FLEX_SR,
	 *  RANKED_FLEX_TT.
	 * 
	 * This function can return null.
	 *
	 *  @param mixed $region
	 *  @return Objects\LeagueSummoner[] */
	public function getLeagueSummoner(string $region, string $summonerId)
	{
		$targetUrl = "https://{$region}.api.riotgames.com/lol/league/v4/entries/by-summoner/{$summonerId}";

		$data = curl($targetUrl, $this->assoc);

		if (isset($data)) {
			foreach ($data as $key => $value) {
				// Name the array values after their corresponsing league to find the easier
				$obj[$value["queueType"]] = new Objects\LeagueSummoner($value);
			}
			if (isset($obj)) {
				return $obj;
			} else {
				return $obj = null;
			}
		}
	}

	/** Valid Game Modes
	 *  RANKED_SOLO_5x5,
	 *  RANKED_TFT,
	 *  RANKED_FLEX_SR,
	 *  RANKED_FLEX_TT.
	 *
	 * @param mixed $region
	 */
	public function getChallengerLeagues(string $region, string $gameMode): Objects\ChallengerLeagues
	{
		$targetUrl = "https://{$region}.api.riotgames.com/lol/league/v4/challengerleagues/by-queue/{$gameMode}";

		$data = curl($targetUrl, $this->assoc);

		return new Objects\ChallengerLeagues($data);
	}

	/** Valid Game Modes
	 *  RANKED_SOLO_5x5,
	 *  RANKED_TFT,
	 *  RANKED_FLEX_SR,
	 *  RANKED_FLEX_TT.
	 *
	 * @param mixed $region
	 */
	public function getGrandmasterLeagues(string $region, string $gameMode): Objects\ChallengerLeagues
	{
		$targetUrl = "https://{$region}.api.riotgames.com/lol/league/v4/grandmasterleagues/by-queue/{$gameMode}";

		$data = curl($targetUrl, $this->assoc);

		return new Objects\ChallengerLeagues($data);
	}

	/** Valid Game Modes
	 *  RANKED_SOLO_5x5,
	 *  RANKED_TFT,
	 *  RANKED_FLEX_SR,
	 *  RANKED_FLEX_TT.
	 *
	 * @param mixed $region
	 */
	public function getMasterLeague(string $region, string $gameMode): Objects\ChallengerLeagues
	{
		$targetUrl = "https://{$region}.api.riotgames.com/lol/league/v4/masterleagues/by-queue/{$gameMode}";

		$data = curl($targetUrl, $this->assoc);

		return new Objects\ChallengerLeagues($data);
	}

	/** Valid Game Modes
	 *  RANKED_SOLO_5x5,
	 *  RANKED_TFT,
	 *  RANKED_FLEX_SR,
	 *  RANKED_FLEX_TT.
	 *
	 * This function can return null
	 * @param mixed $region
	 *
	 * @return Objects\LeagueEntries[] */
	public function getLeagueEntries(string $region, string $gameMode, string $division, string $tier, int $page = null)
	{
		$targetUrl = "https://{$region}.api.riotgames.com/lol/league/v4/entries/{$gameMode}/{$division}/{$tier}";

		$additionalParameters['page'] = $page;
		$data = curl($targetUrl, $this->assoc, $additionalParameters);

		if (isset($data)) {
			foreach ($data as $key => $value) {
				$obj[$key] = new Objects\LeagueEntries($value);
			}
			if (isset($obj)) {
				return $obj;
			} else {
				return $obj = null;
			}
		}
	}

	public function getLeagueById(string $region, string $leagueId): Objects\ChallengerLeagues
	{
		$targetUrl = "https://{$region}.api.riotgames.com/lol/league/v4/leagues/{$leagueId}";

		$data = curl($targetUrl, $this->assoc);

		return new Objects\ChallengerLeagues($data);
	}

	// STATIC DATA CALLS
	public function getStaticChampions(bool $data_by_key = null, string $locale = 'en_GB', string $version = null): StaticData\StaticChampionList
	{
		// Fetch StaticData from JSON files
		if ($data_by_key) {
			$data = DragonData::getStaticChampionsWithKeys($locale, $version);
		} else {
			$data = DragonData::getStaticChampions($locale, $version);
		}
		// Create missing data
		$data['keys'] = array_map(function ($d) use ($data_by_key) {
			return $data_by_key
				? $d['id']
				: $d['key'];
		}, $data['data']);
		$data['keys'] = array_flip($data['keys']);

		return new StaticData\StaticChampionList($data);
	}

	public function getStaticChampion($championId, $details = false, $locale = 'en_GB', $version = '9.13.1'): StaticData\StaticChampion
	{
		// $version/data/$locale/champion.json
		// champion.json (less detailed version)
		// We grab the whole json(as an array) and then we will search for the specified champion ID and return the appropriate array
		$d = new DragonData();
		$data = DragonData::getStaticChampionDataById($championId, $locale, $version);
		if (true == $details) {
			// We have the champion data. With the champion name we grab the detailed champion file
			// $version/data/$locale/champion/$championId(Champion Name)
			// "https://ddragon.leagueoflegends.com/cdn/9.13.1/data/en_US/champion/Orianna.json"
			// The brackets on the end return the proper array.
			$data = DragonData::getStaticChampionDataDetails($data['id'], $locale, $version)['data'][$data['id']];
		}

		return new StaticData\StaticChampion($data);
	}

	/** Get ALL items */
	public function getStaticItems(string $locale = 'en_GB', string $version = null): StaticData\StaticItemList
	{
		$data = DragonData::getStaticItems($locale, $version);

		array_walk($data['data'], function (&$d, $k) {
			$d['id'] = $k;
		});

		return new StaticData\StaticItemList($data);
	}

	/** Get a specific item by its ID */
	public function getStaticItem(int $itemId, string $locale = 'en_GB', string $version = null): StaticData\StaticItem
	{
		$data = DragonData::getStaticItem($itemId, $locale, $version);

		$data['id'] = $itemId;

		return new StaticData\StaticItem($data);
	}

	public function getStaticProfileIcons(string $locale = 'en_GB', string $version = null): StaticData\StaticProfileIconData
	{
		$data = DragonData::getStaticProfileIcons($locale, $version);

		return new StaticData\StaticProfileIconData($data);
	}

	/** Retrieve reforged rune path.
	 *
	 * This will retrieve all the runes and they ARE organized by the Paths ( 8100, 8200 .. etc)
	 */
	public function getStaticReforgedRunePaths(string $locale = 'en_US', string $version = null): StaticData\StaticRunesReforgedPathList
	{
		// Fetch StaticData from JSON files
		$data = DragonData::getStaticRunesReforged($locale, $version);

		// Create missing data
		$r = [];
		foreach ($data as $path)
			$r[$path['id']] = $path;
		$data = ['paths' => $r];

		// Parse array and create instances
		return new StaticData\StaticRunesReforgedPathList($data);
	}
	/** Retrieve reforged rune path.
	 *
	 * This will retrieve all the runes and they AREN'T organized by the Paths
	 */
	public function getStaticRunesReforged(string $locale = 'en_GB', string $version = null): StaticData\StaticRunesReforgedList
	{
		$data = DragonData::getStaticRunesReforged($locale, $version);

		$r = [];
		foreach ($data as $path) {
			foreach ($path['slots'] as $slot) {
				foreach ($slot['runes'] as $item) {
					$r[$item['id']] = $item;
				}
			}
		}
		$data = ['runes' => $r];


		return new StaticData\StaticRunesReforgedList($data);
	}
	/** Get all summoner spells
	 *
	 * $key value determines whether we get an array that indexes the Summoner Spells by their ID or their name. Default is ID
	 */
	public function getStaticSummonerSpells(string $locale = 'en_GB', string $version = null, $key = true) : StaticData\StaticSummonerSpellList
	{
		// We alter the array to be able to search by spell ID. Makes things much easier.
		if (true == $key) {
			$data = DragonData::getStaticSummonerSpellsWithKeys($locale, $version);
		} else {
			$data = DragonData::getStaticSummonerSpells($locale, $version);
		}
		return new StaticData\StaticSummonerSpellList($data);
	}

	public function getStaticSummonerSpell(int $key, string $locale = 'en_GB', string $version = null)
	{
		$data = DragonData::getStaticSummonerSpellById($key, $locale, $version);

		return new StaticData\StaticSummonerSpell($data);
	}

	/** This will return ONLY the current active maps.*/
	public function getStaticMaps(string $locale = 'en_GB', string $version = null)
	{
		return DragonData::getStaticMaps($locale, $version);
	}

	protected function addQuery(string $name, $value)
	{
		if (!is_null($value)) {
			$this->query_data[$name] = $value;
		}

		return $this;
	}
}
