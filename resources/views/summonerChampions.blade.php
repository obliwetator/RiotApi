@section('title', 'Champions')

@extends('layout')

@section('content')

<script>
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
	$itemList.each(function(index, item){
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
</script>
<div id="champion filter FULL Ccontent" class="champion_filter">

	<div id="Navigation + Content">

		<div id="Navigation">

			<ul class="nav nav-tabs">
				<li class="nav-link active" role="tab">
					<a href="javascript:;">Season 9</a>
				</li>
				<li class="nav-link" role="tab">
					<a href="javascript:;">Season 8</a>
				</li>
				<li class="nav-link" role="tab">
					<a href="javascript:;">Season 7</a>
				</li>
				<li class="nav-link" role="tab">
					<a href="javascript:;">Season 6</a>
				</li>
				<li class="nav-link" role="tab">
					<a href="javascript:;">Season 5</a>
				</li>
				<li class="nav-link" role="tab">
					<a href="javascript:;">Season 4</a>
				</li>
				<li class="nav-link" role="tab">
					<a href="javascript:;">Season 3</a>
				</li>
				<li class="nav-link" role="tab">
					<a href="javascript:;">Season 2</a>
				</li>
				<li class="nav-link" role="tab">
					<a href="javascript:;">Season 1</a>
				</li>
				<li class="nav-link" role="tab">
					<a href="javascript:;">Normal</a>
				</li>
			</ul>
		</div>
		<div id="Content">

			<div id="This div gets hidden. Here are the stats">

				<div id="The ACTUAL content. Name it aftr the seaons as they are in RIOT API">

					<div id="Filters Total, Ranked etc">
						<div class="nav nav-tabs" id="tabHeaders">
							<p>Here go the 4 different filters which control the below divs</p>

							<div class="nav-link" id="Filter ALL">
								<a href="javascript:;">ALL</a>
							</div>
							<div class="nav-link" id="Filter RANKED SOLO">
								<a href="javascript:;">SOLO</a>
							</div>
							<div class="nav-link" id="FIlter FLEX">
								<a href="javascript:;">FLEX</a>
							</div>
							<div class="nav-link" id="Filter 3x3">
								<a href="javascript:;">3x3</a>
							</div>
						</div>
					</div>

					<div id="Actual stats Depending on the filter chosen">
						
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection