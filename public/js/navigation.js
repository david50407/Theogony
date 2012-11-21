/*
 * @filename navigation.css
 * @description class Navigation for navigating
 * @author davy
 *
 * @modify
 *     v0 2012.08.26 15:53 (GMT +8)
 *         initialize.
 */

$('.navigation-item').click(function() {
	if ($('.navigation-item.selcted') == $(this))
		return false;
	Navi.switchTab($(this));
	Navi.load($(this).attr('href'));
	return false;
});

if (typeof(window.Navigation) == "undefined")
{
	window["Navigation"] = {
		load: function (path, record_history)
		{
			if (typeof(record_history) == 'undefined')
				record_history = true;
			if ($('#main-' + path.replace('/', '--')).length == 0)
			{
				$('<div/>', { "id": "main-" + path.replace('/', '--'), "class": "main-page" })
					.append($('<div/>', { "class": "main-container" })
						.append($('.main-message', '#main-loading-template').clone())
					)
					.css("display", "none")
					.appendTo('#main');
			}
			Navi.hideAllPage();
			var main = $('#main-' + path.replace('/', '--'));
			var container = $('.main-container', main);
			main.css("display", "");
			
			$.ajax({
			  url: path,
			  dataType: 'html',
			  beforeSend: function(xhr){
			    xhr.setRequestHeader('X-PJAX', 'true')
			  },
			  success: function(data){
			    $(container).html(data);
					if (record_history)
				    History.pushState({ url: path, type: 'navi' }, $(data).filter('[data-title]').attr('data-title'), path);
				}
			});
		},
		hideAllPage: function ()
		{
			$('.main-page', '#main').css("display", "none");
		},
		switchTab: function (tab)
		{
			$('.navigation-item.selected').removeClass('selected');
			$(tab).addClass('selected');
		}
	};
	window["Navi"] = window.Navigation;
}

$(window).bind('statechange', function() {
	var state = History.getState();
	if (state.data.type == 'navi')
	{
		Navi.load(state.data.url, false);
		Navi.switchTab($('.navigation-item[href=' + state.data.url + ']'));
	}
});
