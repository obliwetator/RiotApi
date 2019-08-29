<?php

require '../../../../../../API/vendor/autoload.php';

use Tracy\Debugger;

Debugger::enable();
// Debugger::$strictMode = true;
Debugger::$maxDepth = 10; // default: 3

use API\LeagueAPI\LeagueAPI;
use API\dbCall\dbCall;

// $lol = new LeagueAPI();
// $db = new dbCall();


$region = "eun1";
$locale = "en_GB";
$version = "9.13.1";

$beginIndex = 0;
$endIdex = 100;




$lol = new LeagueAPI();
$db = new dbCall();
// $summoner = $lol->getSummonerName("eun1", "tiltmachine");
// $icons = $lol->getStaticProfileIcons("en_GB", "9.13.1");
// $matchlist = $lol->getMatchlist("eun1", $summoner->accountId, null, null, null, null , null, null, 10);
// $db->setMatchlist("eun1", $matchlist, $summoner->accountId, 0, 5);
// $matchById = $lol->getMatchById("eun1", $matchlist->matches[0]->gameId);

$dbSummoner = $db->getSummoner($region, "tiltmachine");
$v = $db->getMatchlist($region, $dbSummoner->accountId, $endIdex);




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

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
	<title>Document</title>
</head>
<body>
	<div id="comments"></div>

<button>Hey</button>
</body>
<script>

$(document).ready(function() {
	$("button").click(function() {
		$("#comments").load("load-comments.php");
	});
});
</script>
</html>