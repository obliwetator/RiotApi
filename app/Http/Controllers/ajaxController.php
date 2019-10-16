<?php

namespace App\Http\Controllers;

use API\LeagueAPI\LeagueAPI;
use API\dbCall\dbCall;
use Illuminate\Http\Request;

class ajaxController extends Controller
{
	public function Summoner(Request $request)
	{
		
		$name = $request->all();
		dd($name);
		return view('summonerAjax');
	}

	public function IndividualGameAjax(Request $name)
	{

		$gameId = $name->get("gameId");


		// Init
		$lol = new LeagueAPI();
		$db = new dbCall();

		// Const?
		$region = 'eun1';
		$locale = 'en_GB';
		$version = '9.17.1';
		$limit = 2;
		
		
		// Load all static data for that specific page?
		$summonerSpells = $lol->getStaticSummonerSpells($locale, $version);
		$staticChampions  =  $lol->getStaticChampions(true, $locale, $version);
		$staticItems =  $lol->getStaticItems($locale, $version);
		$staticRunes = $lol->getStaticRunesReforged($locale, $version);

		// $summoner = $db->getSummoner($region, $summonerName);
		$matchById = $db->getMatchByIdSingle($region, $gameId);

		// find all the summonners from the games
		foreach ($matchById as $key => $value) {
			foreach ($value->participantIdentities as $key2 => $value2) {
				$summonerNameId[$key2] = $value2->player->summonerId;
				$summonerNameName[$key2] = $value2->player->summonerName;
			}
			$summonerNameIdObj[$key] = $summonerNameId;
			$summonerNameObj[$key] = $summonerNameName;
		}
		// --------------------------------------------- // 

		$summonerLeague = $db->getLeagueSummoner($region, $summonerNameIdObj);
		/** Returning the pure html seems to take less space the the json encoded version. Further researchw required? 
		 * Upon removing spaces and tabs from the blade template the size dropped to the equivalent of the original html view
		 * Maybe json encodes each space individually?
		*/
		// $serialized = view('individualGameAjax')->with(['matchById' => $matchById])
		// ->with(['summonerSpells' => $summonerSpells])
		// ->with(['champions' => $staticChampions])
		// ->with(['items' => $staticItems])
		// ->with(['runes' => $staticRunes])
		// ->with(['summonerLeague' => $summonerLeague])
		// ->with(['sumonerNameObj' => $summonerNameObj])
		// ->render();

		// return response()->json(array('success' => true, 'html' => $serialized));

		return view('individualGameAjax')
		->with(['matchById' => $matchById])
		->with(['summonerSpells' => $summonerSpells])
		->with(['champions' => $staticChampions])
		->with(['items' => $staticItems])
		->with(['runes' => $staticRunes])
		->with(['summonerLeague' => $summonerLeague])
		->with(['sumonerNameObj' => $summonerNameObj]);
	}
}
