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




$.test.summoner = {
	renewBtn: {
		start: function (btn){
			$.ajax({
				headers :{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				type: "POST",
				url: "summoner?name=1234",
				data: {name2: "nani", value: 3},
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
		nani: function(){
			alert("fa");
		},
	}
};