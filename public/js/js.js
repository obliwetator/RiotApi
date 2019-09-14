function parseURL(url){
	// http://james.padolsey.com/javascript/parsing-urls-with-the-dom/
	var a = document.createElement('a');
	a.href = url;
	return {
		source: url,
		protocol: a.protocol.replace(':', ''),
		host: a.hostname,
		port: a.port,
		query: a.search,
		params: (function(){
			var ret = {},
				seg = a.search.replace(/^\?/, '').split('&'),
				len = seg.length, i = 0, s;
			for (; i < len; i++) {
				if (!seg[i]) {
					continue;
				}
				s = seg[i].split('=');
				ret[s[0]] = s[1];
			}
			return ret;
		})(),
		file: (a.pathname.match(/\/([^/?#]+)$/i) || [, ''])[1],
		hash: a.hash.replace('#', ''),
		path: a.pathname.replace(/^([^/])/, '/$1'),
		relative: (a.href.match(/tps?:\/\/[^/]+(.+)/) || [, ''])[1],
		segments: a.pathname.replace(/^\//, '').split('/')
	};
}

$.test = {
	ajax: {
		prebuildOptions: function(settings, additionalParameters){
			var targetUrl = parseURL(settings.url);
			var pathQuery = targetUrl.path + targetUrl.query;
		},

		formSubmit: function(form, type, callback){

		},

		getJSON: function(options){

		},

		getHTML: function(options){

		}

	}
}

$(function () {
	var $gameItemList = $('.ActualStats');

	$gameItemList.on('click', '.ButtonMatchDetail', function (evt) {
		$(".SummonerInfo").show();
		$(this).removeClass("active");
		return false;
	});
});

var deactivateItems = function () {
	$(">.tabHeader", tabHeaders).removeClass("active");
}
var clickCurrentActiveMenu = function (isForce) {
	$(">.tabHeader.active", tabHeaders).trigger('click', isForce);
};
$(document).ready(function () {

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

$('[data-toggle="tab"]').click(function (e) {
	var $this = $(this),
		loadurl = $this.attr('href'),
		targ = $this.attr('data-target');

	$.get(loadurl, function (data) {
		$(targ).html(data);
	});

	$this.tab('show');
	return false;
});


$(document).ready(function(){
	$('#getRequest').click(function(err){
		$.ajax({
			type: 'GET',
			url: 'summoner/champions',
			error: function(jqxhr, status, exception){
				console.log("an error occured", exception);
			},
			success: function(data){
				
				$('#getRequestData').append(data);
			},
			statusCode: {
				404: function(){
					console.log("not found");
				}
		}

		});

	});
});