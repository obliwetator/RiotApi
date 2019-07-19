<?php

require 'E:\xampp\htdocs\API\vendor\tracy\tracy\src\tracy.php';
require 'E:\xampp\htdocs\API\vendor\aaa\API\src\apiRequests\leagueAPI.php';
require 'E:\xampp\htdocs\API\vendor\aaa\API\functions\functions.php';
require 'E:\xampp\htdocs\API\vendor\aaa\API\DB\dbFunctions.php';

require 'E:\xampp\htdocs\API\vendor\autoload.php';
use Tracy\Debugger;

Debugger::enable();
// Debugger::$strictMode = true;
Debugger::$maxDepth = 10; // default: 3

use LeagueAPI\LeagueAPI;

$lol = new LeagueAPI();
$db = new dbCall();

$limit = 5;

$region = "eun1"; 
$locale = "en_GB";
$version = "9.13.1";
$a = $lol->getSummonerName($region, "alexisthebest");
$pa = $lol->getLeagueSummoner($region, $a->id);

pr($pa);

// pr($lol->getMatchById("eun1", 2000000000));
// $b = $db->getMatchlist($region, $a->accountId, $limit);
// $c = $db->getMatchById($region, $b);
// pr($c[0]);

// foreach ($c[0]->participants as $key => $value)
// {
// 	foreach ($value->stats as $key2 => $value2)
// 	{
// 		if ($key2 == "item0" ||$key2 == "item1" ||$key2 == "item2" ||$key2 == "item3" ||$key2 == "item4" ||$key2 == "item5" ) 
// 		{
// 			if ($value2 !== 0) 
// 			{
// 				$item[$key][$key2] = $lol->getStaticItem($value2, $locale, $version);
// 			}
// 		}
// 	}
// }

// GRILUJEME KONE

// STATIC DATA

// Champion
// $data = $lol->getStaticChampion(222, false);

// Item
// $data = $lol->getStaticItem(1001);

// Profile icons
// $data = $lol->getStaticProfileIcons("en_GB", "9.13.1");

// Runes
// $data = $lol->getStaticRunesReforged("en_GB", "9.13.1");

// Summoner spells
// $data = $lol->getStaticSummonerSpell("en_GB", "9.13.1", false);

// Maps
// $data = $lol->getStaticMaps("en_GB", "9.13.1");


// API
// $summoner = $db->getSummoner($region, "unsponsored");

// $matchlist = $db->getMatchlist($region, $summoner->accountId, $limit);
// $matchById = $db->getMatchById($region, $matchlist);
// dump($matchById);

?>