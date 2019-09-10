@extends('layout')

@section('title', 'summoner')

@section('content')

<script src="{{ asset('js/js.js')}}"></script>

    <?php /** @var API\LeagueAPI\Objects\Summoner $summoner
     * @var API\LeagueAPI\Objects\MatchById[] $matchById[]
     * @var API\LeagueAPI\Objects\StaticData\StaticProfileIconData $icons
     * @var API\LeagueAPI\Objects\StaticData\StaticChampionList $champions
     * @var API\LeagueAPI\Objects\StaticData\StaticItemList $items
     * @var API\LeagueAPI\Objects\StaticData\StaticRunesReforgedList $runes
     * @var API\LeagueAPI\Objects\StaticData\StaticSummonerSpellList $summonerSpells
     * @var API\LeagueAPI\Objects\StaticData\
     */ ?>

    <div class="Summoner">
        <div class="SummonerInfo">
            <h1>Some info about the summoner</h1>
            <p> {{ $summoner->name }} </p>
            <img src="/lolContent/img2/profileicon/{{$icons->data[$summoner->profileIconId]->image->full}}" alt="image" style="height: 5px">
            <br>
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
						<h1>Some Side Content</h1>
					<p>KDA: {{ ($matchById[0]->participants[0]->stats->kills + $matchById[0]->participants[0]->stats->assists) / $matchById[0]->participants[0]->stats->deaths  }}</p>
					<hr>

                </div>
                <div class = "col-md-6" id = "ActualContent">
					<h1>Actual Content</h1>
                    <div class="GamesContainer" id = "GamesContainer">
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
                <p>Some Champions</p>
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
