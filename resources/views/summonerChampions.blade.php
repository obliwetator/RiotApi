<script>

// This will select the seasons
$('#summonerChampions').on('click', function (e) {
  e.preventDefault();
  $(e.target).tab('show');
  console.log(e);
})
// This will select the queue type if its avalable
$('#queueType').on('click', function (e) {
  e.preventDefault();
  $(e.target).tab('show');
  console.log(e);
})


$(document).ready(function() {
    $("#getRequest").click(function(err) {
        $.ajax({
            type: "GET",
            url: "summoner/champions",
            error: function(jqxhr, status, exception) {
                console.log("an error occured", exception);
            },
            success: function(data) {
                $("#getRequestData").append(data);
            },
            statusCode: {
                404: function() {
                    console.log("not found");
                }
            }
        });
    });
});

</script>

<div id="champion filter FULL Ccontent" class="champion_filter">

	<div id="Navigation + Content">
		{{-- Navigation is universal across all searches --}}
		<div id="Navigation">
			<ul class="nav nav-tabs" id="summonerChampions">
				<li class="nav-item" role="tab">
					<a class="nav-link active" href="javascript:;">Season 9</a>
				</li>
				<li class="nav-item" role="tab">
					<a class="nav-link" href="javascript:;">Season 8</a>
				</li>
				<li class="nav-item" role="tab">
					<a class="nav-link" href="javascript:;">Season 7</a>
				</li>
				<li class="nav-item" role="tab">
					<a class="nav-link" href="javascript:;">Season 6</a>
				</li>
				<li class="nav-item" role="tab">
					<a class="nav-link" href="javascript:;">Season 5</a>
				</li>
				<li class="nav-item" role="tab">
					<a class="nav-link" href="javascript:;">Season 4</a>
				</li>
				<li class="nav-item" role="tab">
					<a class="nav-link" href="javascript:;">Season 3</a>
				</li>
				<li class="nav-item" role="tab">
					<a class="nav-link" href="javascript:;">Season 2</a>
				</li>
				<li class="nav-item" role="tab">
					<a class="nav-link" href="javascript:;">Season 1</a>
				</li>
				<li class="nav-item" role="tab">
					<a class="nav-link" href="javascript:;">Normal</a>
				</li>
			</ul>
		</div>


		<div id="Content">

			{{-- Foreach loop here that will create all the divs templates --}}
			{{-- We will initially load only the latest season. The rest can be loaded with AJAX from another view --}}
			<div id="This div gets hidden. Here are the stats" data-season="X">

				<div id="The ACTUAL content. Name it after the seaons as they are in RIOT API">
					{{-- Navigation ALL - SOLO - 5x5 - 3x3 --}}
					<div id="Filters Total, Ranked etc"> {{--  Those filters may not always be present IF statement --}}

						<ul class="nav nav-tabs" id="queueType">
							<li class="nav-item" id="Filter ALL">
								<a class="nav-link active" href="javascript:;">ALL</a>
							</li>
							<li class="nav-item" id="Filter RANKED SOLO">
								<a class="nav-link" href="javascript:;">SOLO</a>
							</li>
							<li class="nav-item" id="FIlter FLEX">
								<a class="nav-link" href="javascript:;">FLEX</a>
							</li>
							<li class="nav-item" id="Filter 3x3">
								<a class="nav-link" href="javascript:;">3x3</a>
							</li>
						</ul>
					</div>
					{{-- Content --}}
					<div class="Items" id="Actual stats Depending on the filter chosen">
						
						{{-- foreach Loop --}}
						<div data-queueType="TYPE">

						</div>
						{{-- 2 --}}
						{{-- 3 --}}
						{{-- 4 --}}
					</div>

				</div>
			</div>
			{{-- 2 --}}
			{{-- 3 --}}
			{{-- 4 --}}
			{{-- ... --}}
		</div>
	</div>
</div>
