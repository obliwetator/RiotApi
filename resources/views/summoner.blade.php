@extends('layout')

@section('title',$summoner->name)

@section('content')



	<?php
	 /** @var API\LeagueAPI\Objects\Summoner $summoner
     * @var API\LeagueAPI\Objects\MatchById[] $matchById[]
     * @var API\LeagueAPI\Objects\StaticData\StaticProfileIconData $icons
     * @var API\LeagueAPI\Objects\StaticData\StaticChampionList $champions
     * @var API\LeagueAPI\Objects\StaticData\StaticItemList $items
     * @var API\LeagueAPI\Objects\StaticData\StaticRunesReforgedList $runes
     * @var API\LeagueAPI\Objects\StaticData\StaticSummonerSpellList $summonerSpells
     * @var API\LeagueAPI\Objects\StaticData\
	 */ ?>

    <div class="Summoner">
        <div id="SummonerInfo Header" class="position-relative">
			<div id="image Face" class="d-inline-block" style="verical-align: top;">
				<div class="position-relative" id="border image Profile Icon">
					<img src="/lolContent/img2/profileicon/{{$icons->data[$summoner->profileIconId]->image->full}}" alt="Rank icon" style="" class="d-block">
					<span class="position-absolute" id="level" style="top: 100%; left: 40%; color: yellow; margin-top: -18px;	">{{$summoner->summonerLevel}}</span>
				</div>
			</div>
			<div id="Profile" class="d-inline-block" style="height: 128px; vertical-align: top;">
				<div id="Info">
					<span id ="name">{{ $summoner->name }}</span>
					<div id="Ranks">some rank</div>
				</div>
				<div id="Buttons"></div>
				<button type = "button" class="btn btn-warning" id="getRequest">Get Request</button>
			</div>

        
        </div>
        <div class="Menu">
            <h1>Some menus to choose from for different stats</h1>
            <dl class="nav nav-tabs">
                <dd id="Summary-tab" class="nav-link active" data-toggle="tab" href="#Summary" role="tab" aria-controls="Summary" aria-selected="true">
                    <a href='/summoner?name={{ $summoner->name }}'>Summary</a>
				</dd>
				
                <dd id="Champions-tab" class="nav-link" data-toggle="tab" href="#Champions" role="tab" aria-controls="Champions" aria-selected="false">
                    <a href='/summoner?name={{ $summoner->name }}'>Champions</a>
				</dd>
				
                <dd id="Leagues-tab" class="nav-link" data-toggle="tab" href="#Leagues" role="tab" aria-controls="Leagues" aria-selected="false">
                    <a href="/summoner?name={{ $summoner->name }}">Leagues</a>
				</dd>
				
                <dd id="LiveGame-tab" class="nav-link" data-toggle="tab" href="#LiveGame " role="tab" aria-controls="LiveGame" aria-selected="false">
                    <a href="/summoner?name={{ $summoner->name }}">Live Game</a>
                </dd>
            </dl>
        </div>
        <div class="tab-content" id="ActualStats">
            <div class = "tab-pane active show" id="Summary" aria-labelledby = "Summary-tab" role="tabpanel">
				<div class="row">
                <div class = "col-md-4" id = "SideContent">
					<div id = "tier box1">
						@if (isset($summonerLeague["RANKED_SOLO_5x5"]))
						<div id = "emblem" style="display: table-cell;">
								<img src="/lolContent/emblems/Emblem_{{$summonerLeague["RANKED_SOLO_5x5"]->tier}}.png" alt="{{ $summonerLeague["RANKED_SOLO_5x5"]->tier." icon"}}" style = "height: 128px; width: 128px;">
							</div>
							<div id = "info" style="display: table-cell">
								<div id="Rank Type">Ranked Solo</div>
								<div id="Tier Rank">{{$summonerLeague["RANKED_SOLO_5x5"]->tier}}  {{ $summonerLeague["RANKED_SOLO_5x5"]->rank}}</div>
								<div id="TIer info">
									<span id = "LP"> {{ $summonerLeague["RANKED_SOLO_5x5"]->leaguePoints. "LP /"}}</span>
									<span id="Win/loss">
										<span id = "win">{{ $summonerLeague["RANKED_SOLO_5x5"]->wins }}W</span>
										<span id = "loss">{{ $summonerLeague["RANKED_SOLO_5x5"]->losses }}L</span>
										<br>
										<span id="winration">Win rate {{ round($summonerLeague["RANKED_SOLO_5x5"]->wins / ($summonerLeague["RANKED_SOLO_5x5"]->losses + $summonerLeague["RANKED_SOLO_5x5"]->wins) * 100, 1)}}%</span>
									</span>
								</div>
								<div id="League Name"></div>
							</div>
						@else
						<div id = "emblem" style="display: table-cell;">
								<img src="/lolContent/emblems/Emblem_Provisional.png" alt="provisional icon" style = "height: 128px; width: 128px;">
							</div>
							<div id = "info" style="display: table-cell">
								<div id="Rank Type">Ranked Solo</div>
								<div id="Tier Rank">Uranked</div>
								<div id="TIer info">
									<span id = "LP"> </span>
									<span id="Win/loss">
										<span id = "win"></span>
										<span id = "loss"></span>
										<br>
										<span id="winration"></span>
									</span>
								</div>
								<div id="League Name"></div>
							</div>
						@endif

					</div>
					<hr>
					<div id = "tier box2">
						@php
							// We check if the summoner has a flex rank
						@endphp
						@if (isset($summonerLeague["RANKED_FLEX_SR"]))

						<div id = "emblem" style="display: table-cell;">
							<img src="/lolContent/emblems/Emblem_{{$summonerLeague["RANKED_FLEX_SR"]->tier}}.png" alt="{{ $summonerLeague["RANKED_SOLO_5x5"]->tier." icon"}}" style = "height: 128px; width: 128px;">
						</div>
						<div id = "info" style="display: table-cell">
							<div id="Rank Type">Ranked Flex</div>
							<div id="Tier Rank">{{$summonerLeague["RANKED_FLEX_SR"]->tier}}  {{ $summonerLeague["RANKED_FLEX_SR"]->rank}}</div>
							<div id="TIer info">
								<span id = "LP"> {{ $summonerLeague["RANKED_FLEX_SR"]->leaguePoints. "LP /"}}</span>
								<span id="Win/loss">
									<span id = "win">{{ $summonerLeague["RANKED_FLEX_SR"]->wins }}W</span>
									<span id = "loss">{{ $summonerLeague["RANKED_FLEX_SR"]->losses }}L</span>
									<br>
									<span id="winration">Win rate {{ round($summonerLeague["RANKED_FLEX_SR"]->wins / ($summonerLeague["RANKED_FLEX_SR"]->losses + $summonerLeague["RANKED_FLEX_SR"]->wins) * 100, 1)}}%</span>
								</span>
							</div>
							<div id="League Name"></div>
						</div>
						@else

						@php
							// If the summoner doesnt have a rank we display an empty border
						@endphp
						<div id = "emblem" style="display: table-cell;">
							<img src="/lolContent/emblems/Emblem_Provisional.png" alt="provisional icon" style = "height: 128px; width: 128px;">
						</div>
						<div id = "info" style="display: table-cell">
							<div id="Rank Type">Ranked Flex</div>
							<div id="Tier Rank">Unranked</div>
							<div id="TIer info">
								<span id = "LP"> </span>
								<span id="Win/loss">
									<span id = "win"></span>
									<span id = "loss"></span>
									<br>
									<span id="winration"></span>
								</span>
							</div>
							<div id="League Name"></div>
						</div>
						@endif

					</div>

                </div>
                <div class = "col-md-6" id = "ActualContent">
					<h1>Actual Content</h1>
                    <div class="GamesContainer" id = "">
						<p>GamesContainer</p>
                        <div class="Header">
							<div class="" id = "Navigation">
								<ul class="nav nav-tabs">
									<li id = "TotalGames" class = "nav-link">
										<a href="#" class="">Total</a>
									</li>
									<li id = "RankedSoloGames" class = "nav-link">
										<a href="#" class="">Ranked Solo</a>
									</li>
									<li id = "RankedFlexGames" class = "nav-link">
										<a href="#" class="">Ranked Flex</a>
									</li>
									<li id = "SelectQueueType" class = "nav-link">
										<a href="#" class="">Select Queue</a>
									</li>
								</ul>
							</div>
                        </div>
                        <div class="Content">
								<h1>Actual games (Depending on which queue is selected)</h1>
								<p>A div for each category of games we can select from the nav bar above</p>
							<div class = ""></div>
                            <div class="GameAverageBox">
									<p>{{ "game ID: ". $matchById[0]->gameId }}</p>
                            </div>
                            <div class="GameList">

                            </div>
                            <div class="MoreGamesButton">
                                <a href="javascript:;" class="ButtonMatchDetail">More games?</a>
	                        </div>
                        </div>
                    </div>
				</div>
            </div>
            </div>
            <div class = "tab-pane" id="Champions" aria-labelledby = "Champions-tab" role="tabpanel">
				<div id = "getRequestData"></div>
                <p>Div class full content goes here</p>
            </div>
            <div class = "tab-pane" id="Leagues" aria-labelledby = "Leagues-tab" role="tabpanel">
                <p>Some Leagues</p>
            </div>
            <div class = "tab-pane" id="LiveGame"  aria-labelledby = "LiveGame-tab" role="tabpanel">
                <p>Some Live Game</p>
            </div>

        </div>
	</div>

@endsection
