@extends('layout')
	
@section('title', 'Champions')

@section('content')

<script>

		$( document ).ready(function() {
		// Filter champions function
		$('.champion_filter').on('click', '.nav-link', function(){
			var $filterList = $(this).closest('.champion_filter').find('.nav-link'),
			filterType = $(this).data("filterType"),
			// The jquery will select classes with this name and change them appropriatly
			// For bootstrap it can be an nonexistent class just to have a name to select
			$itemList = $(".custom_class"),
			itemClass = "custom_class";

			// $(".champion-list-filter__keyword input").val("");
			$itemList.each(function(index, item) {
                $(item).removeClass('hide').addClass('show').css('display', '');
            });

			$filterList.removeClass('active');
			$(this).addClass('active');

			$itemList.each(function(index, item)	{
                if (filterType === "ALL") {
                	$(item).css('display', '');
                    	return;
                }
				// We add custom data-role tag which will indicate that champion role so it can be sorted.
				// Alternative approach is to add the roles to the class names
				// Eg  class = "nav-link nav-link-TOP nav-link-MID" etc this will not alter the css for as long as those classes dont acitually exist

				// if ($(item).hasClass(itemClass + '-' + filterType)) {
                //      $(item).css('display', '');
                // } else {
                //     $(item).css('display', 'none');
				// }
				
                if ($(item).data(filterType.toLowerCase()) === filterType) {
                     $(item).css('display', '');
                } else {
                    $(item).css('display', 'none');
                }
			});
		});
		// Search function
		$('.class_input input').on('keyup keydown change', function()
		{
			var keyword = $(this).val().toLowerCase().replace(/[~!#$^&*=+|:;?"<,.>'\s]/g, ''),
			$championList = $('.custom_class');

			$championList.each(function(i, o){
				var championName = $(o).data('champion-name').toLowerCase(),
					championKey = $(o).data('champion-key');

				if (championName.indexOf(keyword) >= 0){
					$(o).removeClass('d-none');
					$(o).addClass('show');
				}
				else{
					$(o).removeClass('show');
					$(o).addClass('d-none');
				}
			});
		});
	});
</script>
	<div id="champion filter" class="champion_filter">
		<ul class="nav nav-tabs">
			<li class="nav-link active" role="tab" data-filter-type="ALL">
				<a href="javascript:;">All</a>
			</li>
			<li class="nav-link" role="tab" data-filter-type="TOP">
				<a href="javascript:;">Top</a>
			</li>
			<li class="nav-link" role="tab" data-filter-type="JUNGLE">
				<a href="javascript:;">Jungle</a>
			</li>
			<li class="nav-link" role="tab" data-filter-type="MID">
				<a href="javascript:;">Mid</a>
			</li>
			<li class="nav-link" role="tab" data-filter-type="BOT">
				<a href="javascript:;">Bot</a>
			</li>
			<li class="nav-link" role="tab" data-filter-type="SUPPORT">
				<a href="javascript:;">Support</a>
			</li>
			<li class="nav-link" role="tab" data-filter-type="ROTATION">
				<a href="javascript:;">Rotation</a>
			</li>
			<div class="class_input input" role="tab" id="searchField">
				<input type="text" placeholder="Champion name">
			</div>
		</ul>
</div>
<div id="champions container">
	@foreach ($champions["keys"] as $id => $championName)
	<div id="individual_champion" class="custom_class list-inline-item position-relative" data-champion-name = "{{$championName}}" data-TOP = "TOP" data-MID = "MID">
		<a href="/champions/{{$championName}}/statistics" class="d-block">
			<div id="image" class="__bg120 __bg120-{{$championName}}"></div>
			<div id="name">{{$championName}}</div>
			<div id="role tags" class="role-tags">
				<div class="role-tag">
					<span >Top</span>
				</div>
				<div class="role-tag">
					<span>Middle</span>
				</div>
			</div>
		</a>
	</div>
	@endforeach
@endsection

