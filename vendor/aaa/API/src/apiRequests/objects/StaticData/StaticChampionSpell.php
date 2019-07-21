<?php
//
//  StaticChampionSpell.php
//  Model Generated using http://www.jsoncafe.com/ 
//  Created on July 12, 2019

namespace API\LeagueAPI\Objects\StaticData;
use API\LeagueAPI\Objects\objectInit;

class StaticChampionSpell extends objectInit
{
    /** @var string $id */
    public $id;
    /** @var string $name */
    public $name;
    /** @var string $description */
    public $description;
    /** @var string $tooltip */
    public $tooltip;
    /** @var StaticChampionLeveltip $leveltip */
    public $leveltip;
    /** @var int $maxrank */
    public $maxrank;
    /** @var int[] $cooldown */
    public $cooldown;
    /** @var string $cooldownBurn */
    public $cooldownBurn;
    /** @var int[] $cost */
    public $cost;
    /** @var string $costBurn */
    public $costBurn;
    /** @var int[] $datavalues */
    public $datavalues;
	/**
	 *   This field is a List of List of Double.
	 *
	 * @var int[][] $effect
	 */
	public $effect;
	/** @var string[] $effectBurn */
	public $effectBurn;
	/** @var StaticSpellVars[] $vars */
	public $vars;
    /** @var string $costType */
    public $costType;
    /** @var string $maxammo */
    public $maxammo;
    /** @var int[] $range */
    public $range;
    /** @var string $rangeBurn */
    public $rangeBurn;
    /** @var StaticChampionImage $image */
    public $image;
    /** @var string $resource */
    public $resource;
}