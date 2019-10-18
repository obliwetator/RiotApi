<div class="Some button(s)">
	<button class="btn btn-dark">Button to refresh/retry Doesnt work</button>
</div>

<div class="Spectate box">
	<div class="container-fluid">
		<div class="Title">
			<div class="d-inline-block" style="">{{ $activeGame->gameMode }}</div>
			<div class="d-inline-block" style="border-left: 1px solid;">{{ $activeGame->gameQueueConfigId }}</div>
			<div class="d-inline-block" data-startTime="{{ $activeGame->gameStartTime }}" style="border-left: 1px solid;">{{ $activeGame->gameStartTime }}</div>
		</div>

		<div class="Content">
			<table class="Team 100">
				<colgroup>
					<col style="width:10px">
					<col style="width:60px">
					<col style="width:20px">
					<col style="width:30px">
					<col style="width:30px">
					<col style="width:150px">
					<col style="width:150px">
					<col style="width:150px">
					<col style="width:100px">
					<col style="width:100px">
					<col style="width:100px">
					<col style="width:50px">
				</colgroup>
				
				<thead>
					<tr>
						<th class="bg-primary"></th>
						<th colspan="4">Blue/red Team</th>
						<th colspan="2">{The Season ranked}</th>
						<th>Ranekd Winratio</th>
						<th colspan="2">{The season stats}</th>
						<th>Previous {season} rank</th>
						<th>Tier Average</th>
					</tr>
				</thead>

				<tbody>
					{{-- LOOP dependign on summoner ammount --}}
					<tr>
						<td colspan="2">
							{{-- Champion Image/link --}}
							<a href="/champions/{{$champions->data[$activeGame->participants[0]->championId]->name}}/statistics" target="_blank">
								<img src="/lolContent/img2/champion/{{$champions->data[$activeGame->participants[0]->championId]->name}}.png" alt="{{$champions->data[$activeGame->participants[0]->championId]->name}}" style="height: 32px; width: 32px;">
							</a>
						</td>
						<td class="Summoner Spell">
							<div class="Spell">	
								<img style="height: 28px; width: 29px;" src="/lolContent/img2/spell/{{ $summonerSpells->data[$activeGame->participants[0]->spell1Id]->id }}.png" alt="{{ $summonerSpells->data[$activeGame->participants[0]->spell1Id]->id }}">
							</div>
							<div class="Spell" >
								<img style="height: 28px; width: 28px;" src="/lolContent/img2/spell/{{ $summonerSpells->data[$activeGame->participants[0]->spell2Id]->id }}.png" alt="{{ $summonerSpells->data[$activeGame->participants[0]->spell2Id]->id }}">
							</div>
						</td>
						<td class="Runes">
							<div class="Rune" style="width: 32px; height: 32px">
								{{-- Zero index is Keystone --}}
								<img style="width: 100%; height: 100%" src="/lolContent/img/{{$runes->runes[$activeGame->participants[0]->perks->perkIds[0]]->icon}}" alt="{{$runes->runes[$activeGame->participants[0]->perks->perkIds[0]]->icon}}">
							</div>
							<div class="Rune">
								<div class="Rune">
									<img src="/lolContent/img/perk-images/Styles/{{$activeGame->participants[0]->perks->perkSubStyle}}.png" alt=""> 
								</div>
							</div>
						</td>
						<td class="Name">
							<div class="SummonerName">
								<a href="/summoner?name={{urlencode($activeGame->participants[0]->summonerName)}}" target="_blank">{{$activeGame->participants[0]->summonerName}}</a>
							</div>
						</td>
						<td class="Tier icon">
							@if (isset($summonerLeague[0][0]["RANKED_SOLO_5x5"]))
								<img style="height: 32px; width: 32px;" src="/lolContent/emblems/Emblem_{{$summonerLeague[0][0]["RANKED_SOLO_5x5"]->tier}}.png" alt="">
							@else
								{{-- Nothing gets displayed --}}
							@endif
						</td>
						<td class="Tier/level">
							@if (isset($summonerLeague[0][0]["RANKED_SOLO_5x5"]))
								<div>{{ $summonerLeague[0][0]["RANKED_SOLO_5x5"]->tier. " " . $summonerLeague[0][0]["RANKED_SOLO_5x5"]->rank }}</div>
							@else
								{{-- Display the summoner level --}}
							@endif
						</td>
						<td class="Ranked WR">
							<span>{{ $summonerLeague[0][0]["RANKED_SOLO_5x5"]->wins }} W {{ $summonerLeague[0][0]["RANKED_SOLO_5x5"]->losses }} L</span>
							<span></span>
						</td>
						<td class="Season info"></td>
						<td class="Season info"></td>
						<td class="Last season"></td>
						<td class="Detailed runes"></td>
					</tr>
				</tbody>
			</table>
			<table class="Team 200">

			</table>
		</div>
	</div>
</div>