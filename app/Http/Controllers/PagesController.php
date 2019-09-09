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
		function Champion()
		{

		}
	    $summonerName = $name->get("name");

	    // Init
		$lol = new LeagueAPI();
		$db = new dbCall();

		// Const?
        $region = 'eun1';
        $locale = 'en_GB';
        $version = '9.13.1';
        $limit = 6;

        // Load all static data for that specific page?
		$icons = $lol->getStaticProfileIcons($locale, $version);
		$summonerSpells = $lol->getStaticSummonerSpells($locale, $version);
        $staticChampions  =  $lol->getStaticChampions(true , $locale, $version);
        $staticItems =  $lol->getStaticItems($locale, $version);
        $staticRunes = $lol->getStaticRunesReforged($locale, $version);
        //


		$summoner = $db->getSummoner($region, $summonerName);

		$matchlist = $db->getMatchlist($region, $summoner->accountId, $limit);
		// Load initial data
		// If we have a DB matchlist we try to get DB matchById
		if (isset($matchlist))
        {
            $matchById = $db->getMatchById($region, $matchlist);
        }
		// We don't have the DB matchlist. Get it from API
		else
        {
            $matchlist = $lol->getMatchlist($region, $summoner->accountId, null, null, null, null, null , null, null);
            $matchById = $db->getMatchById($region, $matchlist);
        }

		return view('summoner')->with(['summoner' => $summoner])->with(['icons' => $icons])->with(['matchById' => $matchById])->with(['summonerSpells' => $summonerSpells])->with(['champions' => $staticChampions])->with(['items' => $staticItems])->with (['runes' => $staticRunes]);
	}

	public function championsSummoner(Request $name)
	{
		return view('championsSummoner');
	}

	public function champions()
	{
		$file = file_get_contents('E:\xampp\htdocs\API\vendor\aaa\API\src\apiRequests\ChampionKeys.json');
		$file = json_decode($file,true);


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
}
