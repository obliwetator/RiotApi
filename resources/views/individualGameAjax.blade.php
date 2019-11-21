<div class="MatchDetailLayout">
	<div class="MatchDetailHeader">
		<ul class="nav nav-tabs"> {{--  FIND THIS --}}
			<li class="test nav-link active" data-tab-show-class="Overview">
				<a href>Overview</a>
			</li>
			<li class="test nav-link" data-tab-show-class="TeamAnalysis">
				<a href>Team analysis</a>
			</li>
			<li class="test nav-link" data-tab-show-class="Builds">
				<a href>Builds</a>
			</li>
			<li class="test nav-link" data-tab-show-class="etc">
				<a href>etc</a>
			</li>
		</ul>
	</div>
	<div class="MatchDetailContent tab-content"> {{--  AND THIS --}}
		{{-- Those divs correspond to the <ul> above --}}
		<div class="Overview tab-pane active" data-ajax-url="/summoner/individualGameAjax?gameId={{ $matchById[0]->gameId }}&summonerId={{ "test" }}">
					<div class="GameDetailWrap">
					{{-- The team that the searched summoner is search should always be in the first table. --}}
					<table class="GameDetailTable Win">
						<colgroup>
							<col class="ChampionImage" style="width: 38px">
							<col class="SummonerSpell" style="width: 38px">
							@isset($matchById[0]->participants[0]->stats->perk0)
							<col class="Runes" style="width: 38px">
							@endisset
							<col class="SummonerName" style="width: 140px">
							<col class="Tier" style="width: 140px">
							<col class="KDA" style="width: 80px">
							<col class="Damage" style="width: 110px">
							<col class="Ward" style="width: 60px">
							<col class="CS" style="width: 60px">
							<col class="Items" style="width: 200px">
						</colgroup>
						<thead class="Header">
							<tr>
								@if (isset($matchById[0]->participants[0]->stats->perk0))
									<th colspan="4">
										<span>Victory?</span>
										<span>Team color</span>
									</th>
								@else
									<th colspan="3">
										<span>Victory?</span>
										<span>Team color</span>
									</th>
								@endif
								<th>Tier</th>
								<th>KDA</th>
								<th>Damage</th>
								<th>Wards</th>
								<th>CS</th>
								<th>Items</th>
							</tr>
						</thead>
						<tbody>
							{{-- for each loop --}}
							@for ($i = 0; $i < sizeof($matchById[0]->participants)/2; $i++)
								<tr>
									<td class="ChampionImage">
										<a href="/champions/{{ $champions->data[$matchById[0]->participants[$i]->championId]->name }}/statistics" target="_blank" style="position: relative;">
											<img style="height: 32px; width: 32px;" src="/lolContent/img2/champion/{{$champions->data[$matchById[0]->participants[$i]->championId]->name}}.png" alt="{{ $champions->data[$matchById[0]->participants[$i]->championId]->name }}">
											<div class="LevelTable" style="position: absolute">{{ $matchById[0]->participants[$i]->stats->champLevel }}</div>
										</a>
									</td>
									<td class="SummonerSpell">
										<div class="Spell">	
											<img class="tooltipp" style="height: 20px; width: 20px;" title="{{ $summonerSpells->data[$matchById[0]->participants[$i]->spell1Id]->description }}" src="/lolContent/img2/spell/{{ $summonerSpells->data[$matchById[0]->participants[$i]->spell1Id]->id }}.png" alt="">
										</div>
										<div class="Spell" >
											<img class="tooltipp" style="height: 20px; width: 20px;" title="{{ $summonerSpells->data[$matchById[0]->participants[$i]->spell1Id]->description }}" src="/lolContent/img2/spell/{{ $summonerSpells->data[$matchById[0]->participants[$i]->spell2Id]->id }}.png" alt="">
										</div>
									</td>
									{{-- Fix if game was not played with new rune system TOD --}}
									@isset($matchById[0]->participants[$i]->stats->perk0)
									<td class="Rune">
										<div class="Rune">
											{{-- Zero index is Keystone --}}
											<img class="tooltipp" style="width: 20px; height: 20px" title="{{$runes->runes[$matchById[0]->participants[$i]->stats->perk0]->longDesc}}" src="/lolContent/img/{{$runes->runes[$matchById[0]->participants[$i]->stats->perk0]->icon}}" alt="{{$runes->runes[$matchById[0]->participants[$i]->stats->perk0]->icon}}">
										</div>
										<div class="Rune">
											<img class="tooltipp" style="width: 20px; height: 20px" title="{{$runes->runes[$matchById[0]->participants[$i]->stats->perk0]->longDesc}}" src="/lolContent/img/perk-images/Styles/{{$matchById[0]->participants[$i]->stats->perkSubStyle}}.png" alt=""> 
										</div>
									</td>	
									@endisset
									<td class="SummonerName">
										<a href='/summoner?name={{ $sumonerNameObj[0][$i]}}'>{{ $sumonerNameObj[0][$i]}}</a>
									</td>
									<td class="Tier">
										@if (isset($summonerLeague[0][$i]["RANKED_SOLO_5x5"]))
											<div>{{ $summonerLeague[0][$i]["RANKED_SOLO_5x5"]->tier. " " . $summonerLeague[0][$i]["RANKED_SOLO_5x5"]->rank }}</div>
										@else
											<div>Unranked</div>
										@endif
									</td>
									<td class="KDA">
										@if ($matchById[0]->participants[$i]->stats->deaths == 0)
											<span class="KdaRation">{{ round($matchById[0]->participants[$i]->stats->kills + $matchById[0]->participants[$i]->stats->assists, 2)}}</span> KDA
										@else
											<span class="KdaRation">{{ round(($matchById[0]->participants[$i]->stats->kills + $matchById[0]->participants[$i]->stats->assists) /$matchById[0]->participants[$i]->stats->deaths, 2)}}</span> KDA
										@endif
									</td>
									<td class="Dammage">Dmg: {{ $matchById[0]->participants[$i]->stats->totalDamageDealt}}</td>
									<td class="Wards">CW {{ $matchById[0]->participants[$i]->stats->visionWardsBoughtInGame}}</td>
									<td class="CS">
										<div class="CS">
											{{($matchById[0]->participants[$i]->stats->totalMinionsKilled + $matchById[0]->participants[$i]->stats->neutralMinionsKilled)}}
										</div>
										<div class="CSperMin">
											{{ round(($matchById[0]->participants[$i]->stats->totalMinionsKilled + $matchById[0]->participants[$i]->stats->neutralMinionsKilled) / ($matchById[0]->gameDuration / 60),1) }}/m
										</div>
									 </td>
									<td class="ItemBlock">
										@for ($j = 0; $j < 7; $j++)
										@php
											$itemName = "item". $j;
											$item = $matchById[0]->participants[$i]->stats->$itemName;
										@endphp
											<div class="Item" style="display: inline-block">
												<img src="/lolContent/img2/item/{{ $item }}.png" alt= "{{ $item }}" style="width: 22px; height: 22px;">
											</div>
										@endfor
									</td>
								</tr>
							@endfor
						</tbody>	
					</table>
					<div class="Summary">
							<hr class="bg-success">
								Here goes some summary that applies to both sides
							<hr class="bg-success">	
					</div>
					<table class="GameDetailTable Lose">
						<colgroup>
							<col class="ChampionImage" style="width: 38px">
							<col class="SummonerSpell" style="width: 38px">
							@isset($matchById[0]->participants[0]->stats->perk0)
							<col class="Runes" style="width: 38px">
							@endisset
							<col class="SummonerName" style="width: 140px">
							<col class="Tier" style="width: 140px">
							<col class="KDA" style="width: 80px">
							<col class="Damage" style="width: 110px">
							<col class="Ward" style="width: 60px">
							<col class="CS" style="width: 60px">
							<col class="Items" style="width: 200px">
						</colgroup>
						<thead class="Header">
							<tr>
								@if (isset($matchById[0]->participants[0]->stats->perk0))
									<th colspan="4">
										<span>Victory?</span>
										<span>Team color</span>
									</th>
								@else
									<th colspan="3">
										<span>Victory?</span>
										<span>Team color</span>
									</th>
								@endif
								<th>Tier</th>
								<th>KDA</th>
								<th>Damage</th>
								<th>Wards</th>
								<th>CS</th>
								<th>Items</th>
							</tr>
						</thead>
						<tbody>
							{{-- for each loop --}}
							{{-- It uses the previous index of $i. DO NOT INITIALIZE TO 0 --}}
							@for ($i; $i < sizeof($matchById[0]->participants); $i++)
								<tr>
									<td class="ChampionImage">
										<a href="/champions/{{ $champions->data[$matchById[0]->participants[$i]->championId]->name }}/statistics" target="_blank" style="position: relative;">
											<img style="height: 32px; width: 32px;" src="/lolContent/img2/champion/{{$champions->data[$matchById[0]->participants[$i]->championId]->name}}.png" alt="{{ $champions->data[$matchById[0]->participants[$i]->championId]->name }}">
											<div class="LevelTable" style="position: absolute">{{ $matchById[0]->participants[$i]->stats->champLevel }}</div>
										</a>
									</td>
									<td class="SummonerSpell">
										<div class="Spell">	
											<img class="tooltipp" style="height: 20px; width: 20px;" title="{{ $summonerSpells->data[$matchById[0]->participants[$i]->spell1Id]->description }}" src="/lolContent/img2/spell/{{ $summonerSpells->data[$matchById[0]->participants[$i]->spell1Id]->id }}.png" alt="">
										</div>
										<div class="Spell" >
											<img class="tooltipp" style="height: 20px; width: 20px;" title="{{ $summonerSpells->data[$matchById[0]->participants[$i]->spell1Id]->description }}" src="/lolContent/img2/spell/{{ $summonerSpells->data[$matchById[0]->participants[$i]->spell2Id]->id }}.png" alt="">
										</div>
									</td>
									@isset($matchById[0]->participants[$i]->stats->perk0)
									<td class="Rune">
										<div class="Rune">
											{{-- Zero index is Keystone --}}
											<img class="tooltipp" style="width: 20px; height: 20px" title="{{$runes->runes[$matchById[0]->participants[$i]->stats->perk0]->longDesc}}" src="/lolContent/img/{{$runes->runes[$matchById[0]->participants[$i]->stats->perk0]->icon}}" alt="{{$runes->runes[$matchById[0]->participants[$i]->stats->perk0]->icon}}">
										</div>
										<div class="Rune">
											<img class="tooltipp" style="width: 20px; height: 20px" title="{{$runes->runes[$matchById[0]->participants[$i]->stats->perk0]->longDesc}}" src="/lolContent/img/perk-images/Styles/{{$matchById[0]->participants[$i]->stats->perkSubStyle}}.png" alt=""> 
										</div>
									</td>	
									@endisset
									<td class="SummonerName">
										<a href='/summoner?name={{ $sumonerNameObj[0][$i] }}'>{{ $sumonerNameObj[0][$i]}}</a>
									</td>
									<td class="Tier">
										@if (isset($summonerLeague[0][$i]["RANKED_SOLO_5x5"]))
											<div>{{ $summonerLeague[0][$i]["RANKED_SOLO_5x5"]->tier. " " . $summonerLeague[0][$i]["RANKED_SOLO_5x5"]->rank }}</div>
										@else
											<div>Unranked</div>
										@endif
									</td>
									<td class="KDA">
										@if ($matchById[0]->participants[$i]->stats->deaths == 0)
											<span class="KdaRation">{{ round($matchById[0]->participants[$i]->stats->kills + $matchById[0]->participants[$i]->stats->assists, 2)}}</span>KDA
										@else
											<span class="KdaRation">{{ round(($matchById[0]->participants[$i]->stats->kills + $matchById[0]->participants[$i]->stats->assists) /$matchById[0]->participants[$i]->stats->deaths, 2)}}</span>KDA
										@endif
									</td>
									<td class="Dammage">Dmg: {{ $matchById[0]->participants[$i]->stats->totalDamageDealt}}</td>
									<td class="Wards">CW {{ $matchById[0]->participants[$i]->stats->visionWardsBoughtInGame}}</td>
									<td class="CS">
										<div class="CS">
											{{($matchById[0]->participants[$i]->stats->totalMinionsKilled + $matchById[0]->participants[$i]->stats->neutralMinionsKilled)}}
										</div>
											<div class="CSperMin">
												{{ round(($matchById[0]->participants[$i]->stats->totalMinionsKilled + $matchById[0]->participants[$i]->stats->neutralMinionsKilled) / ($matchById[0]->gameDuration / 60),1) }}/m
											</div>
										</td>
										<td class="ItemBlock">
											@for ($j = 0; $j < 7; $j++)
											@php
												$itemName = "item". $j;
												$item = $matchById[0]->participants[$i]->stats->$itemName;
											@endphp
												<div class="Item" style="display: inline-block">
													<img src="/lolContent/img2/item/{{ $item }}.png" alt= "{{ $item }}" style="width: 22px; height: 22px;">
												</div>
										@endfor
									</td>
								</tr>
							@endfor
						</tbody>																			
					</table>
					</div>
		</div>
		<div class="TeamAnalysis tab-pane">
			<p>Team Analysis</p>
		</div>
		<div class="Builds tab-pane">
			<p>Builds</p>
		</div>
		<div class="etc tab-pane">
			<p>Etc</p>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
	  Tipped.create('.tooltipp');
	});
  </script>
