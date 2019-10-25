@extends('layout')

@section('title',$summoner->name)

@section('js')

<script src="{{ asset('js/chart.js')}}"></script>
<script src="{{ asset('js/spectate.js')}}"></script>
<script src="{{ asset('js/summoner.js')}}"></script>
<script src="{{asset('/js/tipped.js')}}"></script>
@endsection

@section('content')

<script>

	</script>

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
    <div  class="position-relative">
		<div  class="d-inline-block">
			<div class="position-relative" >
				@if (isset($icons->data[$summoner->profileIconId]->image->full))
					<img src="/lolContent/img2/profileicon/{{$icons->data[$summoner->profileIconId]->image->full}}" alt="Rank icon" style="" class="d-block">
				@else
					<div>No image available for this image</div>
				@endif
				<span class="position-absolute" id="level" style="top: 100%; left: 40%; color: yellow; margin-top: -18px;	">{{$summoner->summonerLevel}}</span>
			</div>
		</div>
		<div  class="d-inline-block" style="height: 128px; vertical-align: top;">
			<div>
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
		{{-- add this href later 			href='/summoner?name={{ $summoner->name }} --}}
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li id="Summary-tab" class="nav-item" >
                <a data-toggle="tab" href="#Summary" role="tab" aria-controls="Summary" aria-selected="true" class="nav-link active">Summary</a>
			</li>
			
            <li id="Champions-tab" class="nav-item" >
                <a data-toggle="tab" href="#Champions" role="tab" aria-controls="Champions" aria-selected="false" class="nav-link">Champions</a>
			</li>
			
            <li id="Leagues-tab" class="nav-item" >
                <a data-toggle="tab" href="#Leagues" role="tab" aria-controls="Leagues" aria-selected="false" class="nav-link">Leagues</a>
			</li>
			
            <li id="LiveGame-tab" class="nav-item" >
                <a data-toggle="tab" href="#LiveGame " role="tab" aria-controls="LiveGame" aria-selected="false" class="nav-link">Live Game</a>
            </li>
        </ul>
    </div>
    <div class="tab-content" >
        <div class = "tab-pane active show" id="Summary" aria-labelledby = "Summary-tab" role="tabpanel">
			@if (isset($matchById))
				<div class="container-fluid">
					<div class="row">
						<div class = "col-md-3" >
							<div>
							@if (isset($summonerLeagueTarget["RANKED_SOLO_5x5"]))
								<div class="d-inline-block" style="vertical-align: middle">
									<img src="/lolContent/emblems/Emblem_{{$summonerLeagueTarget["RANKED_SOLO_5x5"]->tier}}.png" alt="{{ $summonerLeagueTarget["RANKED_SOLO_5x5"]->tier." icon"}}" style = "height: 128px; width: 128px;">
								</div>
								<div class="d-inline-block" style="vertical-align: middle">
									<div>Ranked Solo</div>
									<div>{{$summonerLeagueTarget["RANKED_SOLO_5x5"]->tier}}  {{ $summonerLeagueTarget["RANKED_SOLO_5x5"]->rank}}</div>
									<div>
										<span> {{ $summonerLeagueTarget["RANKED_SOLO_5x5"]->leaguePoints}}LP -</span>
										<span>
											<span>&nbsp;{{ $summonerLeagueTarget["RANKED_SOLO_5x5"]->wins }}W</span>
											<span>{{ $summonerLeagueTarget["RANKED_SOLO_5x5"]->losses }}L</span>
											<br>
											<span>Win rate {{ round($summonerLeagueTarget["RANKED_SOLO_5x5"]->wins / ($summonerLeagueTarget["RANKED_SOLO_5x5"]->losses + $summonerLeagueTarget["RANKED_SOLO_5x5"]->wins) * 100, 1)}}%</span>
										</span>
									</div>
									<div></div>
								</div>
							@else
								<div>
									<div class="d-inline-block" style="vertical-align: middle">
										<img src="/lolContent/emblems/Emblem_Provisional.png" alt="provisional icon" style = "height: 128px; width: 128px;">
									</div>
									<div class="d-inline-block" style="vertical-align: middle">
										<div>Ranked Solo</div>
										<div>Uranked</div>
									</div>
								</div>
							@endif
							</div>	
							<hr class="bg-success">
							{{-- We check if the summoner has a flex rank --}}
							@if (isset($summonerLeagueTarget["RANKED_FLEX_SR"]))
								<div>
									<div class="d-inline-block" style="vertical-align: middle">
										<img src="/lolContent/emblems/Emblem_{{$summonerLeagueTarget["RANKED_FLEX_SR"]->tier}}.png" alt="{{ $summonerLeagueTarget["RANKED_FLEX_SR"]->tier." icon"}}" style = "height: 128px; width: 128px;">
									</div>
									<div class="d-inline-block" style="vertical-align: middle">
											<div>Ranked Flex</div>
											<div>{{$summonerLeagueTarget["RANKED_FLEX_SR"]->tier}}  {{ $summonerLeagueTarget["RANKED_FLEX_SR"]->rank}}</div>
											<div>
												<span> {{ $summonerLeagueTarget["RANKED_FLEX_SR"]->leaguePoints}}LP -</span>
												<span>
												<span>&nbsp;{{ $summonerLeagueTarget["RANKED_FLEX_SR"]->wins }}W</span>
													<span>{{ $summonerLeagueTarget["RANKED_FLEX_SR"]->losses }}L</span>
													<br>
													<span>Win rate {{ round($summonerLeagueTarget["RANKED_FLEX_SR"]->wins / ($summonerLeagueTarget["RANKED_FLEX_SR"]->losses + $summonerLeagueTarget["RANKED_FLEX_SR"]->wins) * 100, 1)}}%</span>
												</span>
											</div>
									</div>
								</div>
							@else
							<div>
										{{-- If the summoner doesnt have a rank we display an empty border --}}
									<div class="d-inline-block" style="vertical-align: middle">
										<img src="/lolContent/emblems/Emblem_Provisional.png" alt="provisional icon" style = "height: 128px; width: 128px;">
									</div>
									<div class="d-inline-block" style="vertical-align: middle">
										<div>Ranked Flex</div>
										<div>Unranked</div>
									</div>
							</div>
							@endif
						</div>
						<div class = "col-md-9" >
							<div class="container-fluid" >
								<div class="Header">
										<div class="" id="Navigation">
											<ul class="nav nav-tabs">
												<li id="TotalGames" class = "nav-link active">
													<a href="#" class="">Total</a>
												</li>
												<li id="RankedSoloGames" class = "nav-link">
													<a href="#" class="">Ranked Solo</a>
												</li>
												<li id="RankedFlexGames" class = "nav-link">
													<a href="#" class="">Ranked Flex</a>
												</li>
												<li id="SelectQueueType" class = "nav-link">
													<a href="#" class="">Select Queue</a>
												</li>
											</ul>
										</div>
								</div>
								   <div class="Content">
									<div class="GameAverageBox">
										<div style="width:100px; height: 100px">
											<canvas id="myChart" width="100px" height="100px"></canvas>
										</div>
										<div>Static for now- This will show the winratio for the below games</div>
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
										foreach ($match->participants as $key2 => $value) {
											// The participant IDs start from 1 in the JSON
											if ($key2 < $howManyParticipants/2) {
												$totalKills100[$key][$key2 + 1] = $value->stats->kills;
											}
											else {
												$totalKills200[$key][$key2 + 1] = $value->stats->kills;
											}
										}
									}
									// 0-4 TEAM 100    5-9 TEAM 200
									@endphp
									@foreach ($matchById as $key => $match)
										<div class="GameItemWrap border">
											
												@if ($targetSummoner[$key][$summoner->name] < 5)
												<div class="GameItem {{ $match->teams[0]->win}}" data-gameId="{{$match->gameId}}" data-game-result="{{ $match->teams[0]->win}}">
												@else
												<div class="GameItem {{ $match->teams[1]->win}}" data-gameId="{{$match->gameId}}" data-game-result="{{ $match->teams[1]->win}}">
												@endif
												
												<div>Game ID: {{$match->gameId}} (temp)</div>
												{{-- This is the preview before we load the details --}}
												<div>
													<div class="GameStats" style="display:table-cell;vertical-align: middle; padding-left: 6px; padding-right: 6px">
														<div class="GameType">
															{{ $match->gameMode }}
														</div>
														<div class="Timestamp">
															{{-- Some fancy js to update the time realtime? --}}
															@if (time() - (($match->gameCreation + $match->gameDuration)/1000) > 24*60*60)
																<span>{{ date('j \D\a\y\s G \ \h\o\u\r\s \ \a\g\o' ,time() - (($match->gameCreation + $match->gameDuration)/1000) ) }}</span>
															@else
																@if (time() - (($match->gameCreation + $match->gameDuration)/1000) > 60*60)
																	<span>{{ date('G \h\o\u\r\s i \m\i\n\u\t\e\s \ \a\g\o' ,time() - (($match->gameCreation + $match->gameDuration)/1000) ) }}</span>
																@else
																	<span>{{ date('i \m\i\n\u\t\e\s \ \a\g\o' ,time() - (($match->gameCreation + $match->gameDuration)/1000) ) }}</span>
																@endif
															@endif
														</div>
														<div class="Bar">
														</div>
														@if ($targetSummoner[$key][$summoner->name] < 5)
															<div class="GameResult">{{ $match->teams[0]->win}}</div>
														@else
															<div class="GameResult">{{ $match->teams[1]->win}}</div>
														@endif
														<div class="GameLength">Duration: {{ intdiv($match->gameDuration , 60) }}m {{ $match->gameDuration%60 }}s</div>
													</div>
													<div class="GameSettingsInfo" style="display:table-cell; vertical-align: middle; padding-left: 6px; padding-right: 6px">
														<div class="ChampionImage d-inline-block" style="vertical-align: middle">
															<a href="/champions/{{$champions->data[$champion[$key]]->name}}/statistics" target="_blank">
																<img src="/lolContent/img2/champion/{{$champions->data[$champion[$key]]->name}}.png" alt="{{$champions->data[$champion[$key]]->name}}" style="height: 64px; width: 64px;">
															</a>
														</div>
														<div class="SummonerSpell d-inline-block" style="vertical-align: middle">
															<div class="Spell">	
																<img style="height: 28px; width: 29px;" src="/lolContent/img2/spell/{{ $summonerSpells->data[$match->participants[$targetSummoner[$key][$summoner->name]]->spell1Id]->id }}.png" alt="{{ $summonerSpells->data[$match->participants[$targetSummoner[$key][$summoner->name]]->spell1Id]->id }}">
															</div>
															<div class="Spell" >
																<img style="height: 28px; width: 28px;" src="/lolContent/img2/spell/{{ $summonerSpells->data[$match->participants[$targetSummoner[$key][$summoner->name]]->spell2Id]->id }}.png" alt="{{ $summonerSpells->data[$match->participants[$targetSummoner[$key][$summoner->name]]->spell2Id]->id }}">
															</div>
														</div>
														<div class="Runes d-inline-block" style="vertical-align: middle">
															<div class="Rune" style="width: 32px; height: 32px">
																<img style="width: 100%; height: 100%" src="/lolContent/img/{{$runes->runes[$match->participants[$targetSummoner[$key][$summoner->name]]->stats->perk0]->icon}}" alt="{{$runes->runes[$match->participants[$targetSummoner[$key][$summoner->name]]->stats->perk0]->name}}">
															</div>
															<div class="Rune">
																<img src="/lolContent/img/perk-images/Styles/{{$match->participants[$targetSummoner[$key][$summoner->name]]->stats->perkSubStyle}}.png" alt=""> 
															</div>
														</div>
														<div class="ChampionName">
															<a href="/champions/{{$champions->data[$champion[$key]]->name}}/statistics" target="_blank">{{$champions->data[$champion[$key]]->name}}</a>
														</div>
													</div>
													<div class="KDA" style="display:table-cell;vertical-align: middle; padding-left: 6px; padding-right: 6px">
														<div class="KDA">
															<span class="Kill">{{$match->participants[$targetSummoner[$key][$summoner->name]]->stats->kills}}</span> /
															<span class="Death">{{$match->participants[$targetSummoner[$key][$summoner->name]]->stats->deaths}}</span> /
															<span class="Assist">{{$match->participants[$targetSummoner[$key][$summoner->name]]->stats->assists}}</span>
														</div>
														<div class="KDARatio">
															@if ($match->participants[$targetSummoner[$key][$summoner->name]]->stats->deaths == 0)
																<span class="KdaRation">{{ round(($match->participants[$targetSummoner[$key][$summoner->name]]->stats->kills + $match->participants[$targetSummoner[$key][$summoner->name]]->stats->assists), 2)}}</span>KDA
															@else
															<span class="KdaRation">{{ round(($match->participants[$targetSummoner[$key][$summoner->name]]->stats->kills + $match->participants[$targetSummoner[$key][$summoner->name]]->stats->assists)/$match->participants[$targetSummoner[$key][$summoner->name]]->stats->deaths, 2)}}</span>KDA
															@endif
														</div>
													</div>
													<div class="Stats" style="display:table-cell;vertical-align: middle; padding-left: 6px; padding-right: 6px">
														<div class="Level">{{ $match->participants[$targetSummoner[$key][$summoner->name]]->stats->champLevel }} Level</div>
														<div class="CS">
															<span class="CS">{{($match->participants[$targetSummoner[$key][$summoner->name]]->stats->totalMinionsKilled + $match->participants[$targetSummoner[$key][$summoner->name]]->stats->neutralMinionsKilled)}} ({{ round(($match->participants[$targetSummoner[$key][$summoner->name]]->stats->totalMinionsKilled + $match->participants[$targetSummoner[$key][$summoner->name]]->stats->neutralMinionsKilled) / ($match->gameDuration / 60),1) }}) per Min</span>
														</div>
														@if ($targetSummoner[$key][$summoner->name] <= 5)
															{{-- Team 100 --}}
															@if (array_sum($totalKills100[$key]) > 0)
																<div class="Kill Participation">{{round(( ($match->participants[$targetSummoner[$key][$summoner->name]]->stats->kills + $match->participants[$targetSummoner[$key][$summoner->name]]->stats->assists ) / array_sum($totalKills100[$key]) * 100)), 2}}% KP</div>
															@else
																<div class="Kill Participation">0% KP</div>
															@endif
														@else
															{{-- Team 200 --}}
															@if (array_sum($totalKills200[$key]) > 0)
																<div class="Kill Participation">{{round( ($match->participants[$targetSummoner[$key][$summoner->name]]->stats->kills + $match->participants[$targetSummoner[$key][$summoner->name]]->stats->assists) / array_sum($totalKills200[$key]) * 100), 2}}% KP</div>
															@else
																<div class="Kill Participation">0% KP</div>
															@endif
														@endif
													</div>
													<div class="Items" style="display:table-cell; height: 96px;vertical-align: middle; padding-left: 6px; padding-right: 6px">
														<div class="ItemList" style="width: 96px;">
															@for ($i = 0; $i < 7; $i++)
															@php
																$itemName = "item". $i;
																$item = $match->participants[$targetSummoner[$key][$summoner->name]]->stats->$itemName;
															@endphp
																<div class="Item" style="display: inline-block">
																	<img src="/lolContent/img2/item/{{ $item }}.png" alt= "{{ $item }}" style="width: 22px; height: 22px;">
																</div>
																@endfor
														</div>
														<div class="ControllWards">
														
														</div>
													</div>
													<div class="Participants" style="display:table-cell;vertical-align: middle; padding-left: 6px; padding-right: 6px">
														{{-- Left block --}}
														<div class="Team" style="display: table-cell; width: 170px">
															@for ($i = 0; $i < sizeof($match->participants)/2; $i++)
															<div class="Summoner" style="display: block;">
																<div class="ChampionImage" style="display: inline-block">
																	<img src="/lolContent/img2/champion/{{ $champions->data[$match->participants[$i]->championId]->name}}.png" alt= "{{ $champions->data[$match->participants[$i]->championId]->name}}" style="width: 22px; height: 22px;">
																</div>
																<div class="SummonerName" style="display: inline-block">
																	<a href="/summoner?name={{urlencode($match->participantIdentities[$i]->player->summonerName)}}" target="_blank">{{$match->participantIdentities[$i]->player->summonerName}}</a>
																</div>
															</div>
															@endfor
														</div>
														{{-- Right Block --}}
														<div class="Team" style="display: table-cell">
															@for ($i; $i < sizeof($match->participants); $i++)
															<div class="Summoner" style="display: block;">
																<div class="ChampionImage" style="display: inline-block">
																	<img src="/lolContent/img2/champion/{{ $champions->data[$match->participants[$i]->championId]->name}}.png" alt= "{{ $champions->data[$match->participants[$i]->championId]->name}}" style="width: 22px; height: 22px;">
																</div>
																<div class="SummonerName" style="display: inline-block">
																	<a href="/summoner?name={{urlencode($match->participantIdentities[$i]->player->summonerName)}}" target="_blank">{{$match->participantIdentities[$i]->player->summonerName}}</a>
																</div>
															</div>
															@endfor
														</div>
													</div>
													<div class="Stats Button" style="display:table-cell; height: 118px">
														<div class="Content" style="position: relative; height: 118px; width: 50px">
															<div class="Item" style="position: absolute; top: 95px; left: 10px; ">
																<a href="javascript:;" class="ButtonStats" style="">
																	<span>More</span>
																</a>
															</div>
														</div>
													</div>
											</div>
												<div class="GameDetails">{{--  Here we will load the game details with AJAX  --}}</div>
										</div>
									</div>
									<hr class="bg-success">
									@endforeach
									</div>
								   </div>
								<div class="MoreGamesButton">
									<a href="javascript:;" class="ButtonMatchDetail">More games?</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			@else
				<h1>No games to show (temp layout)</h1>
			@endif

		</div>
		<div class = "tab-pane" id="Champions" aria-labelledby = "Champions-tab" role="tabpanel">
			<div id="getRequestData"></div>
			<p>Some champions</p>
		</div>
		<div class = "tab-pane" id="Leagues" aria-labelledby = "Leagues-tab" role="tabpanel">
			<p>Some Leagues</p>
		</div>
		<div class = "tab-pane" id="LiveGame"  aria-labelledby = "LiveGame-tab" role="tabpanel"></div>
	</div>
</div>
@endsection
