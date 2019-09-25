<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summoner extends Model
{
	/** @var string $id */
	public $id;
	/** @var string $accountId */
	public $accountId;
	/** @var string $puuid */
	public $puuid;
	/** @var string $name */
	public $name;
	/** @var int $profileIconId */
	public $profileIconId;
	/** @var int $revisionDate */
	public $revisionDate;
	/** @var int $summonerLevel */
	public $summonerLevel;
	/** @var string $trimmedName */
	public $trimmedName;

	protected $primaryKey = '$accountId';
	public $incrementing = false;
	protected $keyType = 'string';
}
