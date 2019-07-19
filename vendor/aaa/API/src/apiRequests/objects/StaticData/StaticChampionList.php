<?php

namespace LeagueAPI\Objects\StaticData;
use LeagueAPI\Objects\ApiObjectIterable;

class StaticChampionList extends ApiObjectIterable
{
	/** @var string[] $keys */
	public $keys;
	/** @var StaticChampion[] $data */
	public $data;
	/** @var string $version */
	public $version;
	/** @var string $type */
	public $type;
	/** @var string $format */
	public $format;
}