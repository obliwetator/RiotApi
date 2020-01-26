
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
					<col class="color thingy" style="width:10px">
					<col class="champ image" style="width:60px">
					<col class="summoner spell" style="width:20px">
					<col class="runes" style="width:30px">
					<col class="name" style="width:130px">
					<col class="ranked icon" style="width:40px">
					<col class="LP" style="width:120px">
					<col class="ranked wr" style="width:120px">
					<col class="current season info" style="width:100px">
					<col class="current season info" style="width:100px">
					<col class="previous rank image" style="width:50px">
					<col class="tier average"  style="width:50px">
					@isset($activeGame->bannedChampions)
					<col class="bans" style="width:50px">
					@endisset
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
						{{-- If games is ranked(has bans) add this --}}
						@isset($activeGame->bannedChampions)
						<th>Bans</th>
						@endisset
					</tr>
				</thead>

				<tbody>
					{{-- LOOP dependign on summoner ammount --}}
					@foreach ($activeGame->participants as $key => $item)
					@if ($key < 5)
					<tr id="{{$key}}">
						<td colspan="2">
							{{-- Champion Image/link --}}
							<a href="/champions/{{$champions->data[$activeGame->participants[$key]->championId]->name}}/statistics" target="_blank">
								<img src="/lolContent/img2/champion/{{$champions->data[$activeGame->participants[$key]->championId]->name}}.png" alt="{{$champions->data[$activeGame->participants[$key]->championId]->name}}" style="height: 32px; width: 32px;">
							</a>
						</td>
						<td class="SummonerSpell">
							<div class="Spell">	
								<img style="height: 28px; width: 29px;" src="/lolContent/img2/spell/{{ $summonerSpells->data[$activeGame->participants[$key]->spell1Id]->id }}.png" alt="{{ $summonerSpells->data[$activeGame->participants[$key]->spell1Id]->id }}">
							</div>
							<div class="Spell">
								<img style="height: 28px; width: 28px;" src="/lolContent/img2/spell/{{ $summonerSpells->data[$activeGame->participants[$key]->spell2Id]->id }}.png" alt="{{ $summonerSpells->data[$activeGame->participants[$key]->spell2Id]->id }}">
							</div>
						</td>
						<td class="Runes">
							<div class="Rune" style="width: 32px; height: 32px">
								{{-- Zero index is Keystone --}}
								<img style="width: 100%; height: 100%" src="/lolContent/img/{{$runes->runes[$activeGame->participants[$key]->perks->perkIds[0]]->icon}}" alt="{{$runes->runes[$activeGame->participants[$key]->perks->perkIds[0]]->icon}}">
							</div>
							<div class="Rune">
								<img src="/lolContent/img/perk-images/Styles/{{$activeGame->participants[$key]->perks->perkSubStyle}}.png" alt=""> 
							</div>
						</td>
						<td class="Name">
							<div class="SummonerName">
								<a href="/summoner?name={{urlencode($activeGame->participants[$key]->summonerName)}}" target="_blank">{{$activeGame->participants[$key]->summonerName}}</a>
							</div>
						</td>
						<td class="Tier icon">
							@if (isset($summonerLeague[0][$key]["RANKED_SOLO_5x5"]))
								<img style="height: 32px; width: 32px;" src="/lolContent/emblems/Emblem_{{$summonerLeague[0][$key]["RANKED_SOLO_5x5"]->tier}}.png" alt="">
							@else
								{{-- Nothing gets displayed --}}
							@endif
						</td>
						<td class="Tier/level">
							@if (isset($summonerLeague[0][$key]["RANKED_SOLO_5x5"]))
								<div>{{ $summonerLeague[0][$key]["RANKED_SOLO_5x5"]->tier. " " . $summonerLeague[0][$key]["RANKED_SOLO_5x5"]->rank }}</div>
							@else
								{{-- Display the summoner level --}}
							@endif
						</td>
						<td class="Ranked WR">
							@if (isset($summonerLeague[0][$key]["RANKED_SOLO_5x5"]))
							<span>{{ $summonerLeague[0][$key]["RANKED_SOLO_5x5"]->wins }} W {{ $summonerLeague[0][$key]["RANKED_SOLO_5x5"]->losses }} L</span>
							@else
							<span>-</span>
							@endif
						</td>
						<td class="Season info">
							need champion stats
						</td>
						<td class="Season info">
							need champion stats
						</td>
						<td class="Last season">
							Last season rank(image)
						</td>
						<td class="Detailed runes">
							<button class="btn btn-primary" onclick="return $.test.spectate.displayRunes(this)">Runes</button>
						</td>
						{{-- If games is ranked(has bans) add this --}}
						@isset($activeGame->bannedChampions)
						<td class="Bans">
							{{-- No ban --}}
							@if ($activeGame->bannedChampions[$key]->championId > 0)
								<img src="/lolContent/img2/champion/{{ $champions->data[$activeGame->bannedChampions[$key]->championId]->name }}.png" alt="" style="width: 22px; height: 22px">
							@else
							<img src="/lolContent/img2/item/0.png" alt="" style="width: 22px; height: 22px">
							@endif
						</td>
						@endisset
					</tr>
					@endif
					@endforeach
				</tbody>
			</table>
			<table class="Team 200">
				<colgroup>	
					<col class="color thingy" style="width:10px">
					<col class="champ image" style="width:60px">
					<col class="summoner spell" style="width:20px">
					<col class="runes" style="width:30px">
					<col class="name" style="width:130px">
					<col class="ranked icon" style="width:40px">
					<col class="LP" style="width:120px">
					<col class="ranked wr" style="width:120px">
					<col class="current season info" style="width:100px">
					<col class="current season info" style="width:100px">
					<col class="previous rank image" style="width:50px">
					<col class="tier average"  style="width:50px">
					@isset($activeGame->bannedChampions)
					<col class="bans" style="width:50px">
					@endisset
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
						{{-- If games is ranked(has bans) add this --}}
						@isset($activeGame->bannedChampions)
						<th>Bans</th>
						@endisset
					</tr>
				</thead>

				<tbody>
					{{-- LOOP dependign on summoner ammount --}}
					@foreach ($activeGame->participants as $key => $item)
					@if ($key > 4)
					<tr id="{{$key}}">
						<td colspan="2">
							{{-- Champion Image/link --}}
							<a href="/champions/{{$champions->data[$activeGame->participants[$key]->championId]->name}}/statistics" target="_blank">
								<img src="/lolContent/img2/champion/{{$champions->data[$activeGame->participants[$key]->championId]->name}}.png" alt="{{$champions->data[$activeGame->participants[$key]->championId]->name}}" style="height: 32px; width: 32px;">
							</a>
						</td>
						<td class="Summoner Spell">
								<div class="Spell">	
									<img style="height: 28px; width: 29px;" src="/lolContent/img2/spell/{{ $summonerSpells->data[$activeGame->participants[$key]->spell1Id]->id }}.png" alt="{{ $summonerSpells->data[$activeGame->participants[$key]->spell1Id]->id }}">
								</div>
								<div class="Spell" >
									<img style="height: 28px; width: 28px;" src="/lolContent/img2/spell/{{ $summonerSpells->data[$activeGame->participants[$key]->spell2Id]->id }}.png" alt="{{ $summonerSpells->data[$activeGame->participants[$key]->spell2Id]->id }}">
								</div>
						</td>
						<td class="Runes">
							<div class="Rune" style="width: 32px; height: 32px">
								{{-- Zero index is Keystone --}}
								<img style="width: 100%; height: 100%" src="/lolContent/img/{{$runes->runes[$activeGame->participants[$key]->perks->perkIds[0]]->icon}}" alt="{{$runes->runes[$activeGame->participants[$key]->perks->perkIds[0]]->icon}}">
							</div>
							<div class="Rune">
								<div class="Rune">
									<img src="/lolContent/img/perk-images/Styles/{{$activeGame->participants[$key]->perks->perkSubStyle}}.png" alt=""> 
								</div>
							</div>
						</td>
						<td class="Name">
							<div class="SummonerName">
								<a href="/summoner?name={{urlencode($activeGame->participants[$key]->summonerName)}}" target="_blank">{{$activeGame->participants[$key]->summonerName}}</a>
							</div>
						</td>
						<td class="Tier icon">
							@if (isset($summonerLeague[0][$key]["RANKED_SOLO_5x5"]))
								<img style="height: 32px; width: 32px;" src="/lolContent/emblems/Emblem_{{$summonerLeague[0][$key]["RANKED_SOLO_5x5"]->tier}}.png" alt="">
							@else
								{{-- Nothing gets displayed --}}
							@endif
						</td>
						<td class="Tier/level">
							@if (isset($summonerLeague[0][$key]["RANKED_SOLO_5x5"]))
								<div>{{ $summonerLeague[0][$key]["RANKED_SOLO_5x5"]->tier. " " . $summonerLeague[0][$key]["RANKED_SOLO_5x5"]->rank }}</div>
							@else
								{{-- Display the summoner level --}}
							@endif
						</td>
						<td class="Ranked WR">
							@if (isset($summonerLeague[0][$key]["RANKED_SOLO_5x5"]))
							<span>{{ $summonerLeague[0][$key]["RANKED_SOLO_5x5"]->wins }} W {{ $summonerLeague[0][$key]["RANKED_SOLO_5x5"]->losses }} L</span>
							@else
							<span>-</span>
							@endif
						</td>
						<td class="Season info">
							need champion stats
						</td>
						<td class="Season info">
							need champion stats
						</td>
						<td class="Last season">
							Last season rank(image)
						</td>
						<td class="Detailed runes">
							<button class="btn btn-primary" onclick="return $.test.spectate.displayRunes(this)">Runes</button>
						</td>
						{{-- If games is ranked(has bans) add this --}}
						@isset($activeGame->bannedChampions)
						<td class="Bans">
							{{-- No ban --}}
							@if ($activeGame->bannedChampions[$key]->championId > 0)
								<img src="/lolContent/img2/champion/{{ $champions->data[$activeGame->bannedChampions[$key]->championId]->name }}.png" alt="" style="width: 22px; height: 22px">
							@else
								<img src="/lolContent/img2/item/0.png" alt="" style="width: 22px; height: 22px">
							@endif
						</td>
							@endisset
					</tr>
					@endif
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>




