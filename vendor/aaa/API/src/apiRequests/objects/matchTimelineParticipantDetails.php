<?php

namespace LeagueAPI\Objects;

class matchTimelineParticipantDetails extends objectInit
{
	/** @var Integer $participantId */
	public $participantId;
	/** @var matchTimelinePosition $position */
	public $position;
	/** @var Integer $currentGold */
	public $currentGold;
	/** @var Integer $totalGold */
	public $totalGold;
	/** @var Integer $level */
	public $level;
	/** @var Integer $xp */
	public $xp;
	/** @var Integer $minionsKilled */
	public $minionsKilled;
	/** @var Integer $jungleMinionsKilled */
	public $jungleMinionsKilled;
	/** @var Integer $dominionScore */
	public $dominionScore;
	/** @var Integer $teamScore */
	public $teamScore;
}
