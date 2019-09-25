@extends('layout')

@section('title',$summoner->name)

@section('js')
<script src="{{ asset('js/summoner.js')}}"></script>
@endsection

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
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
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
				<button type = "button" class="btn btn-danger" id="getData" onclick="$.test.summoner.renewBtn.start(this);">Refresh</button>
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
                <div class = "col-md-8" id = "ActualContent">
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
							<div class = ""></div>
                            <div class="GameAverageBox">
									<p>Here goes winratio etc...</p>
                            </div>
                            <div class="GameList">
								{{-- each div is an individual game --}}

								@php

								foreach ($matchById as $key => $match) {
									// We store how many partipants there are for each game
									$howManyParticipants = sizeof($match->participants);
									foreach ($match->participantIdentities as $key2 => $value2) {

										if ($value2->player->summonerName == $summoner->name) {
											$targetSummoner[$key][$value2->player->summonerName] = $key2;
											$targetProfileIcon = $value2->player->profileIcon;
											$champion[$key] = $match->participants[$targetSummoner[$key][$summoner->name]]->championId;
											// $team[$key] = $match->participants[$targetSummoner[$key][$summoner->name]]->teamId;
										}
										
									}

									foreach ($match->participants as $key => $value) {
										// The participant IDs start from 1 in the JSON
										if ($key < $howManyParticipants/2) {
											$totalKills100[$key + 1] = $value->stats->kills;
										}
										else {
											$totalKills200[$key + 1] = $value->stats->kills;
										}
									}
								}
								// 0-4 TEAM 100    5-9 TEAM 200
								@endphp

								@foreach ($matchById as $key => $match)
									
									<div class="GameItemWrap">
										<div class="GameItem Win/Loss">
											{{-- This is the preview before we load the details --}}
											<div class="content">
												<div class="GameStats" style="display:table-cell">
													<div class="GameType">
														{{ $match->gameMode }}
													</div>
													<div class="Timestamp">
														{{-- Some fancy js to update the time realtime? --}}
														<span></span>
													</div>
													<div class="Bar">
														
													</div>
													<div class="GameResult">{{ $match->teams[0]->win}}</div>
													<div class="GameLength">Duration: {{ round($match->gameDuration / 60, 1) }} Min</div>
												</div>
												<div class="GameSettingsInfo" style="display:table-cell">
													<div class="ChampionImage">
														<a href="/champions/{{$champions->data[$champion[$key]]->name}}/statistics" target="_blank">
															<img src="/lolContent/img2/champion/{{$champions->data[$champion[$key]]->name}}.png" alt="{{$champions->data[$champion[$key]]->name}}" style="height: 48px; width: 48px;">
														</a>
													</div>
													<div class="SummonerSpell">
														<div class="Spell">
															<img src="{name}" alt="">
														</div>
														<div class="Spell">
															<img src="{name}" alt="">
														</div>
													</div>
													<div class="Runes">
														<div class="Rune">
															<img src="{name}" alt="">
														</div>
														<div class="Rune">
															<img src="{name}" alt="">
														</div>
													</div>
													<div class="ChampionName">
														<a href="/champion/{name}/statistics" target="_blank"></a>
													</div>
												</div>
												<div class="KDA" style="display:table-cell">
													<div class="KDA">
														<span class="Kill">{{$match->participants[$targetSummoner[$key][$summoner->name]]->stats->kills}}</span> /
														<span class="Death">{{$match->participants[$targetSummoner[$key][$summoner->name]]->stats->deaths}}</span> /
														<span class="Assist">{{$match->participants[$targetSummoner[$key][$summoner->name]]->stats->assists}}</span>
													</div>
													<div class="KDARatio">
														<span class="KdaRation">{{ round(($match->participants[$targetSummoner[$key][$summoner->name]]->stats->kills + $match->participants[$targetSummoner[$key][$summoner->name]]->stats->assists)/$match->participants[$targetSummoner[$key][$summoner->name]]->stats->deaths, 2)}}</span>KDA
													</div>
												</div>
												<div class="Stats" style="display:table-cell">
													<div class="Level">{{ $match->participants[$targetSummoner[$key][$summoner->name]]->stats->champLevel }} Level</div>
													<div class="CS">
														<span class="CS">{{($match->participants[$targetSummoner[$key][$summoner->name]]->stats->totalMinionsKilled + $match->participants[$targetSummoner[$key][$summoner->name]]->stats->neutralMinionsKilled)}} ({{ round(($match->participants[$targetSummoner[$key][$summoner->name]]->stats->totalMinionsKilled + $match->participants[$targetSummoner[$key][$summoner->name]]->stats->neutralMinionsKilled) / ($match->gameDuration / 60),1) }}) per Min</span>
													</div>

													@if ($targetSummoner[$key][$summoner->name] <= 5)
														{{-- Team 100 --}}
														<div class="Kill Participation">{{round(($match->participants[$targetSummoner[$key][$summoner->name]]->stats->kills / array_sum($totalKills100) * 100)), 2}}% KP</div>
													@else()
														{{-- Team 200 --}}
														<div class="Kill Participation">{{round(($match->participants[$targetSummoner[$key][$summoner->name]]->stats->kills / array_sum($totalKills200) * 100)), 2}}% KP</div>
													@endif
												</div>
												<div class="Items" style="display:table-cell">
													<div class="ItemList">
														<div class="Item">
															<img src="{name}" alt="{name}">
															{{-- Copy 6 more times after filling --}}
														</div>
													</div>
													<div class="ControllWards">
	
													</div>
												</div>
												<div class="Participants" style="display:table-cell">
													<div class="Team" style="display: table-cell">
														<div class="Summoner">
															<div class="ChampionImage">
																{image}
															</div>
															<div class="SummonerName">
																<a href="/summoner?name={name}" target="_blank">{name}</a>
															</div>
														</div>
														<div class="Summoner">
															<div class="ChampionImage">
																{image}
															</div>
															<div class="SummonerName">
																<a href="/summoner?name={name}" target="_blank">{name}</a>
															</div>
														</div>
														<div class="Summoner">
															<div class="ChampionImage">
																{image}
															</div>
															<div class="SummonerName">
																<a href="/summoner?name={name}" target="_blank">{name}</a>
															</div>
														</div>
														<div class="Summoner">
															<div class="ChampionImage">
																{image}
															</div>
															<div class="SummonerName">
																<a href="/summoner?name={name}" target="_blank">{name}</a>
															</div>
														</div>
														<div class="Summoner">
															<div class="ChampionImage">
																{image}
															</div>
															<div class="SummonerName">
																<a href="/summoner?name={name}" target="_blank">{name}</a>
															</div>
														</div>
													</div>
													<div class="Team" style="display: table-cell">
														<div class="Summoner">
															<div class="ChampionImage">
																{image}
															</div>
															<div class="SummonerName">
																<a href="/summoner?name={name}" target="_blank">{name}</a>
															</div>
														</div>
														<div class="Summoner">
															<div class="ChampionImage">
																{image}
															</div>
															<div class="SummonerName">
																<a href="/summoner?name={name}" target="_blank">{name}</a>
															</div>
														</div>
														<div class="Summoner">
															<div class="ChampionImage">
																{image}
															</div>
															<div class="SummonerName">
																<a href="/summoner?name={name}" target="_blank">{name}</a>
															</div>
														</div>
														<div class="Summoner">
															<div class="ChampionImage">
																{image}
															</div>
															<div class="SummonerName">
																<a href="/summoner?name={name}" target="_blank">{name}</a>
															</div>
														</div>
														<div class="Summoner">
															<div class="ChampionImage">
																{image}
															</div>
															<div class="SummonerName">
																<a href="/summoner?name={name}" target="_blank">{name}</a>
															</div>
														</div>
													</div>
												</div>
												<div class="Stats Button" style="display:table-cell">
													<div class="Content">
														<div class="Item">
															<a href="javascript:;">
																Some arrow image
															</a>
														</div>
													</div>
												</div>
											</div>
											{{-- We will load this game with ajax when we try tp expand the window --}}
											<div class="GameDetails">
	
											</div>
										</div>
									</div>
								@endforeach


							<div>
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
