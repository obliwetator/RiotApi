$(function () {
	var $gameItemList = $('.ActualStats');

	$gameItemList.on('click', '.ButtonMatchDetail', function (evt) {
		$(".SummonerInfo").show();
		$(this).removeClass("active");
		return false;

	});
});



var deactivateItems = function()
{
	$(">.tabHeader", tabHeaders).removeClass("active");
}
var clickCurrentActiveMenu = function(isForce){
	$(">.tabHeader.active", tabHeaders).trigger('click', isForce);
};
$(document).ready(function(){

var tab = $(this),
	tabHeaders = tab.find(".tabHeaders").first(),
	tabItems = tab.find(".tabItems").first();
	$(function () {
		$(">.tabHeader", tabHeaders).on('click', function (evt) {
			var self = this;
	
			console.log("what");
	
			$(self).addClass("active");
			return false;
		});
	});
});

$('[data-toggle="tab"]').click(function(e) {
	var $this = $(this),
		loadurl = $this.attr('href'),
		targ = $this.attr('data-target');
	
	$.get(loadurl, function(data) {
		$(targ).html(data);
	});
	
	$this.tab('show');
	return false;
	});
