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

$('[data-toggle="tab"]').click(function(e) {
    var $this = $(this),
        loadurl = $this.attr("href"),
        targ = $this.attr("data-target");

    $.get(loadurl, function(data) {
        $(targ).html(data);
    });

    $this.tab("show");
    return false;
});

$(document).on("click", '.test', function(e){
	e.preventDefault();
	var link = $(this),
		linkClass = link.data('tab-show-class');

	console.log(linkClass);
	// Get the parent element in order to grab all the children an dhide them
	link.parent().children().removeClass('active');
	// Now to the clicked element add the active class
	link.addClass('active');
	
	var children;

	children = link.parent().parent().parent().children('.MatchDetailContent');


	children.children().removeClass('active');

	var targetClass = children.children("."+linkClass);

	targetClass.addClass('active');
	console.log(targetClass);
});
$('.test').on('click', function (e) {


  });

$( document ).ready(function() {
    $('.Stats.Button').on('click', function (e) {
		e.preventDefault();
		var link = $(this);

		// Get the parent element in order to grab all the children an dhide them
		var gameId = link.parent().parent().data("gameid");
		var Span = link.children().children().children().children();
		// Now to the clicked element add the active class
		
		var GameItem = link.parent().parent();
		var GameItemData = GameItem.data("game-result");


		var children = link.parent().parent().children('.GameDetails');
		var targetClass = children;

		if (GameItem.hasClass("active")) {
			children.hide();
			GameItem.removeClass("active");
			Span.text("More");
		}
		else{
			if (children.is(":visible")) {
				$.test.summoner.renewBtn.individualGame.ajax(gameId, targetClass);
			}
			else{
				children.show();
			}
			GameItem.addClass("active");

			Span.text("Less");
				
		}

	  });
});


$.test.summoner = {
	renewBtn: {
		start: function (btn){
			$.ajax({
				headers :{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				type: "POST",
				url: "summoner?name=1234",
				data: {name2: "???", value: 3},
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
		},
		individualGame: {
			ajax: function(gameId, targetClass){
				$.ajax({
					headers :{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
					type: "POST",
					url: "/summoner/individualGameAjax?gameId="+ gameId,
					data: gameId,
					error: function(jqxhr, status, exception) {
						console.log("an error occured", exception);
					},
					success: function(data) {
						targetClass.append(data);
					},
					statusCode: {
						404: function() {
							console.log("not found");
						}
					}
				});
			},
		},
	}
};