<?php

namespace App\Http\Controllers;

use API\LeagueAPI\LeagueAPI;
use API\dbCall\dbCall;
use Illuminate\Http\Request;

class PagesController extends Controller
{
	public function home()
	{
		return view('welcome');
	}

	public function test()
	{
		return view('test');
	}

	public function Summoner(Request $name)
	{
		clock()->startEvent("SummonerController", "Time spent in summoner controller");

		$summonerName = $name->get("name");
		// If no username is entered return 404
		if (!isset($summonerName)) {
			return abort(404);
		}

		// Init
		$lol = new LeagueAPI();
		$db = new dbCall();

		// Const?
		$region = 'eun1';
		$locale = 'en_GB';
		$version = '9.17.1';
		$limit = 2;

		clock()->startEvent("GetDbSummonerMatchlist", "Load summoner/matchlist from db");
		$summoner = $db->getSummoner($region, $summonerName);

		if (isset($summoner)) {
			
		}
		else{
			return abort(404);
		}

		// The summoner might exist but have no data on any matches. Return 404 in this case
		$matchlist = $db->getMatchlist($region, $summoner->accountId, $limit);
		clock()->endEvent("GetDbSummonerMatchlist");
		
		clock()->startEvent("getStaticData", "Load all the static data");

		// Load all static data for that specific page?
		$icons = $lol->getStaticProfileIcons($locale, $version);
		$summonerSpells = $lol->getStaticSummonerSpells($locale, $version);
		$staticChampions  =  $lol->getStaticChampions(true, $locale, $version);
		$staticItems =  $lol->getStaticItems($locale, $version);
		$staticRunes = $lol->getStaticRunesReforged($locale, $version);

		clock()->endEvent("getStaticData");




		clock()->startEvent("getMatchbyId", "Load Match by id from Db");
		// If we have a DB matchlist we try to get DB matchById
		if (isset($matchlist)) {
			$matchById = $db->getMatchById($region, $matchlist);
		}
		else {
			// We don't have the DB matchlist. Get it from API
			$matchlist = $lol->getMatchlist($region, $summoner->accountId, null, null, null, null, null, null, $limit);
			$db->setMatchlist($region,$matchlist,$summoner->accountId);

			$matchById = $db->getMatchById($region, $matchlist);
		}
		clock()->endEvent("getMatchbyId");

		clock()->startEvent("getLeagueSummoner", "Load LeagueSummoner");
		// find all the summonners from the games
		foreach ($matchById as $key => $value) {
			foreach ($value->participantIdentities as $key2 => $value2) {
				$summonerNameName[$key2] = $value2->player->summonerName;
			}
			$summonerNameObj[$key] = $summonerNameName;
		}
		// --------------------------------------------- // 
		$summonerLeagueTarget = $db->getLeagueSummonerSingle($region, $summoner->id);

		clock()->endEvent("getLeagueSummoner");

		clock()->endEvent("SummonerController");

		return view('summoner')
		->with(['summoner' => $summoner])
		->with(['icons' => $icons])
		->with(['matchById' => $matchById])
		->with(['summonerSpells' => $summonerSpells])
		->with(['champions' => $staticChampions])
		->with(['items' => $staticItems])
		->with(['runes' => $staticRunes])
		->with(['summonerLeagueTarget' => $summonerLeagueTarget])
		->with(['sumonerNameObj' => $summonerNameObj]);
	}

	

	public function summonerChampions(Request $name)
	{
		$summonerName = $name->get("name");

		return view('summonerChampions')->with(['summonerName' => $summonerName]);
	}

	public function champions()
	{
		clock()->startEvent("champions", "champions list page");
		$file = file_get_contents('lolContent/data/en_GB/championFull.json');
		$file = json_decode($file, true);

		clock()->endEvent("champions");

		clock()->startEvent("view", "champions list view");
		return view('champions')->with(['champions' => $file]);
	}

	public function stats()
	{
		return view('stats');
	}

	public function leaderboards()
	{
		return view('leaderboards');
	}

	// The returned view will be dynamically created depending on the champion name selected
	public function championsStat($name)
	{
		return view('championStats')->with(['name' => $name]);
	}
}
