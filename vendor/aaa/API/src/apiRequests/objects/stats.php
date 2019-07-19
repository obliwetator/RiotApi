<?php
//
//  Stat.php
//  Model Generated using http://www.jsoncafe.com/ 
//  Created on June 12, 2019

namespace LeagueAPI\Objects;

class Stat extends objectInit
{
    /** @var Integer $participantId */
    public $participantId;
    /** @var Boolean $win */
    public $win;
    /** @var Integer $item0 */
    public $item0;
    /** @var Integer $item1 */
    public $item1;
    /** @var Integer $item2 */
    public $item2;
    /** @var Integer $item3 */
    public $item3;
    /** @var Integer $item4 */
    public $item4;
    /** @var Integer $item5 */
    public $item5;
    /** @var Integer $item6 */
    public $item6;
    /** @var Integer $kills */
    public $kills;
    /** @var Integer $deaths */
    public $deaths;
    /** @var Integer $assists */
    public $assists;
    /** @var Integer $largestKillingSpree */
    public $largestKillingSpree;
    /** @var Integer $largestMultiKill */
    public $largestMultiKill;
    /** @var Integer $killingSprees */
    public $killingSprees;
    /** @var Integer $longestTimeSpentLiving */
    public $longestTimeSpentLiving;
    /** @var Integer $doubleKills */
    public $doubleKills;
    /** @var Integer $tripleKills */
    public $tripleKills;
    /** @var Integer $quadraKills */
    public $quadraKills;
    /** @var Integer $pentaKills */
    public $pentaKills;
    /** @var Integer $unrealKills */
    public $unrealKills;
    /** @var Integer $totalDamageDealt */
    public $totalDamageDealt;
    /** @var Integer $magicDamageDealt */
    public $magicDamageDealt;
    /** @var Integer $physicalDamageDealt */
    public $physicalDamageDealt;
    /** @var Integer $trueDamageDealt */
    public $trueDamageDealt;
    /** @var Integer $largestCriticalStrike */
    public $largestCriticalStrike;
    /** @var Integer $totalDamageDealtToChampions */
    public $totalDamageDealtToChampions;
    /** @var Integer $magicDamageDealtToChampions */
    public $magicDamageDealtToChampions;
    /** @var Integer $physicalDamageDealtToChampions */
    public $physicalDamageDealtToChampions;
    /** @var Integer $trueDamageDealtToChampions */
    public $trueDamageDealtToChampions;
    /** @var Integer $totalHeal */
    public $totalHeal;
    /** @var Integer $totalUnitsHealed */
    public $totalUnitsHealed;
    /** @var Integer $damageSelfMitigated */
    public $damageSelfMitigated;
    /** @var Integer $damageDealtToObjectives */
    public $damageDealtToObjectives;
    /** @var Integer $damageDealtToTurrets */
    public $damageDealtToTurrets;
    /** @var Integer $visionScore */
    public $visionScore;
    /** @var Integer $timeCCingOthers */
    public $timeCCingOthers;
    /** @var Integer $totalDamageTaken */
    public $totalDamageTaken;
    /** @var Integer $magicalDamageTaken */
    public $magicalDamageTaken;
    /** @var Integer $physicalDamageTaken */
    public $physicalDamageTaken;
    /** @var Integer $trueDamageTaken */
    public $trueDamageTaken;
    /** @var Integer $goldEarned */
    public $goldEarned;
    /** @var Integer $goldSpent */
    public $goldSpent;
    /** @var Integer $turretKills */
    public $turretKills;
    /** @var Integer $inhibitorKills */
    public $inhibitorKills;
    /** @var Integer $totalMinionsKilled */
    public $totalMinionsKilled;
    /** @var Integer $neutralMinionsKilled */
    public $neutralMinionsKilled;
    /** @var Integer $neutralMinionsKilledTeamJungle */
    public $neutralMinionsKilledTeamJungle;
    /** @var Integer $neutralMinionsKilledEnemyJungle */
    public $neutralMinionsKilledEnemyJungle;
    /** @var Integer $totalTimeCrowdControlDealt */
    public $totalTimeCrowdControlDealt;
    /** @var Integer $champLevel */
    public $champLevel;
    /** @var Integer $visionWardsBoughtInGame */
    public $visionWardsBoughtInGame;
    /** @var Integer $sightWardsBoughtInGame */
    public $sightWardsBoughtInGame;
    /** @var Integer $wardsPlaced */
    public $wardsPlaced;
    /** @var Integer $wardsKilled */
    public $wardsKilled;
    /** @var Boolean $firstBloodKill */
    public $firstBloodKill;
    /** @var Boolean $firstBloodAssist */
    public $firstBloodAssist;
    /** @var Boolean $firstTowerKill */
    public $firstTowerKill;
    /** @var Boolean $firstTowerAssist */
    public $firstTowerAssist;
    /** @var Boolean $firstInhibitorKill */
    public $firstInhibitorKill;
    /** @var Boolean $firstInhibitorAssist */
    public $firstInhibitorAssist;
    /** @var Integer $combatPlayerScore */
    public $combatPlayerScore;
    /** @var Integer $objectivePlayerScore */
    public $objectivePlayerScore;
    /** @var Integer $totalPlayerScore */
    public $totalPlayerScore;
    /** @var Integer $totalScoreRank */
    public $totalScoreRank;
    /** @var Integer $playerScore0 */
    public $playerScore0;
    /** @var Integer $playerScore1 */
    public $playerScore1;
    /** @var Integer $playerScore2 */
    public $playerScore2;
    /** @var Integer $playerScore3 */
    public $playerScore3;
    /** @var Integer $playerScore4 */
    public $playerScore4;
    /** @var Integer $playerScore5 */
    public $playerScore5;
    /** @var Integer $playerScore6 */
    public $playerScore6;
    /** @var Integer $playerScore7 */
    public $playerScore7;
    /** @var Integer $playerScore8 */
    public $playerScore8;
    /** @var Integer $playerScore9 */
    public $playerScore9;
    /** @var Integer $perk0 */
    public $perk0;
    /** @var Integer $perk0Var1 */
    public $perk0Var1;
    /** @var Integer $perk0Var2 */
    public $perk0Var2;
    /** @var Integer $perk0Var3 */
    public $perk0Var3;
    /** @var Integer $perk1 */
    public $perk1;
    /** @var Integer $perk1Var1 */
    public $perk1Var1;
    /** @var Integer $perk1Var2 */
    public $perk1Var2;
    /** @var Integer $perk1Var3 */
    public $perk1Var3;
    /** @var Integer $perk2 */
    public $perk2;
    /** @var Integer $perk2Var1 */
    public $perk2Var1;
    /** @var Integer $perk2Var2 */
    public $perk2Var2;
    /** @var Integer $perk2Var3 */
    public $perk2Var3;
    /** @var Integer $perk3 */
    public $perk3;
    /** @var Integer $perk3Var1 */
    public $perk3Var1;
    /** @var Integer $perk3Var2 */
    public $perk3Var2;
    /** @var Integer $perk3Var3 */
    public $perk3Var3;
    /** @var Integer $perk4 */
    public $perk4;
    /** @var Integer $perk4Var1 */
    public $perk4Var1;
    /** @var Integer $perk4Var2 */
    public $perk4Var2;
    /** @var Integer $perk4Var3 */
    public $perk4Var3;
    /** @var Integer $perk5 */
    public $perk5;
    /** @var Integer $perk5Var1 */
    public $perk5Var1;
    /** @var Integer $perk5Var2 */
    public $perk5Var2;
    /** @var Integer $perk5Var3 */
    public $perk5Var3;
    /** @var Integer $perkPrimaryStyle */
    public $perkPrimaryStyle;
    /** @var Integer $perkSubStyle */
    public $perkSubStyle;
    /** @var Integer $statPerk0 */
    public $statPerk0;
    /** @var Integer $statPerk1 */
    public $statPerk1;
    /** @var Integer $statPerk2 */
    public $statPerk2;
}
