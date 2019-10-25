
<div class="container-fluid">
	<div class="row align-items-end">
		{{-- Primary --}}
		<div>
							<div>
								<img style="width: 48px; height: 48px" src="/lolContent/img/perk-images/Styles/{{$activeGame->participants[$key]->perks->perkStyle}}.png" alt="">
							</div>
			@foreach ($runesPaths->paths[$activeGame->participants[$key]->perks->perkStyle]->slots as $key2 => $item)	
				@if ($key2 == 0)
				<div class="row">
					@foreach ($item->runes as $key3 => $item2)

						@if ($item2->id == $runes->runes[$activeGame->participants[$key]->perks->perkIds[0]]->id )
							<div class="col">
								<img class="tooltipp" title="{{ $item2->longDesc }}" style="width: 48px; height: 48px;" src="/lolContent/img/{{$item2->icon}}" alt="">
							</div>
							@php
								$i=1;
							@endphp
						@endif

					@endforeach
				</div>
				@elseif($key2 == 1)	
					<div class="row">
						@foreach ($item->runes as $key3 => $item2)

							@if ($activeGame->participants[$key]->perks->perkIds[$i] == $item2->id)
								<div class="col">
									<img class="tooltipp border border-primary" title="{{ $item2->longDesc }}" style="width: 48px; height: 48px; " src="/lolContent/img/{{$item2->icon}}" alt="">
								</div>
								@php
									$i++
								@endphp
							@else
								<div class="col">
									<img  class="tooltipp" title="{{ $item2->longDesc }}" style="width: 48px; height: 48px; " src="/lolContent/img/{{$item2->icon}}" alt="">
								</div>
							@endif

						@endforeach
					</div>
				@elseif($key2 == 2)
					<div class="row">
						@foreach ($item->runes as $key3 => $item2)

							@if ($activeGame->participants[$key]->perks->perkIds[$i] == $item2->id)
								<div class="col">
									<img class="tooltipp border border-primary" title="{{ $item2->longDesc }}" style="width: 48px; height: 48px; " src="/lolContent/img/{{$item2->icon}}" alt="">
								</div>
								@php
									$i++
								@endphp
							@else
								<div class="col">
									<img  class="tooltipp" title="{{ $item2->longDesc }}" style="width: 48px; height: 48px; " src="/lolContent/img/{{$item2->icon}}" alt="">
								</div>
							@endif

						@endforeach
					</div>
				@elseif($key2 == 3)
					<div class="row">
						@foreach ($item->runes as $key3 => $item2)

							@if ($activeGame->participants[$key]->perks->perkIds[$i] == $item2->id)
								<div class="col">
									<img class="tooltipp border border-primary" title="{{ $item2->longDesc }}" style="width: 48px; height: 48px; " src="/lolContent/img/{{$item2->icon}}" alt="">
								</div>
								@php
									$i++
								@endphp
							@else
								<div class="col">
									<img  class="tooltipp" title="{{ $item2->longDesc }}" style="width: 48px; height: 48px; " src="/lolContent/img/{{$item2->icon}}" alt="">
								</div>
							@endif

						@endforeach
					</div>
				@endif	
			@endforeach	
		</div>
		<div class="Divider"></div>
		{{-- Secondary --}}
		<div>	
			<div>
				<img style="width: 48px; height: 48px" src="/lolContent/img/perk-images/Styles/{{$activeGame->participants[$key]->perks->perkSubStyle}}.png" alt="">
			</div>
			@foreach ($runesPaths->paths[$activeGame->participants[$key]->perks->perkSubStyle]->slots as $key2 => $item)	
				@if ($key2 == 0)
					@foreach ($item->runes as $key3 => $item2)
						@if ($item2->id == $runes->runes[$activeGame->participants[$key]->perks->perkIds[0]]->id )
							<div>
								<img class="tooltipp" title="{{ $item2->longDesc }}" style="width: 48px; height: 48px" src="/lolContent/img/{{$item2->icon}}" alt="">
							</div>
						@endif
					@endforeach
				@elseif($key2 == 1)	
					<div class="row">
						@foreach ($item->runes as $key3 => $item2)

							@if ($activeGame->participants[$key]->perks->perkIds[$i] == $item2->id)
								<div class="col">
									<img class="tooltipp border border-primary" title="{{ $item2->longDesc }}" style="width: 48px; height: 48px; " src="/lolContent/img/{{$item2->icon}}" alt="">
								</div>
								@php
									$i++
								@endphp
							@else
								<div class="col">
									<img  class="tooltipp" title="{{ $item2->longDesc }}" style="width: 48px; height: 48px; " src="/lolContent/img/{{$item2->icon}}" alt="">
								</div>
							@endif

						@endforeach
					</div>
				@elseif($key2 == 2)
					<div class="row">
						@foreach ($item->runes as $key3 => $item2)

							@if ($activeGame->participants[$key]->perks->perkIds[$i] == $item2->id)
								<div class="col">
									<img class="tooltipp border border-primary" title="{{ $item2->longDesc }}" style="width: 48px; height: 48px; " src="/lolContent/img/{{$item2->icon}}" alt="">
								</div>
								@php
									$i++
								@endphp
							@else
								<div class="col">
									<img  class="tooltipp" title="{{ $item2->longDesc }}" style="width: 48px; height: 48px; " src="/lolContent/img/{{$item2->icon}}" alt="">
								</div>
							@endif

						@endforeach
					</div>
				@elseif($key2 == 3)
					<div class="row">
						@foreach ($item->runes as $key3 => $item2)

							@if ($activeGame->participants[$key]->perks->perkIds[$i] == $item2->id)
								<div class="col">
									<img class="tooltipp border border-primary" title="{{ $item2->longDesc }}" style="width: 48px; height: 48px; " src="/lolContent/img/{{$item2->icon}}" alt="">
								</div>
								@php
									$i++
								@endphp
							@else
								<div class="col">
									<img  class="tooltipp" title="{{ $item2->longDesc }}" style="width: 48px; height: 48px; " src="/lolContent/img/{{$item2->icon}}" alt="">
								</div>
							@endif

						@endforeach
					</div>
				@endif	
			@endforeach	
		</div>
		<div class="Divider"></div>
		<div class="misc"></div>
	</div>
</div>
<div class="bottom text">
	
</div>
<script type="text/javascript">
	$(document).ready(function() {
	  Tipped.create('.tooltipp');
	});
  </script>
  