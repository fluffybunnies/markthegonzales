jQuery(document).ready(function($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,ajaxurl */
	
	var menu = $("#menu-to-edit");
	var timer = 0;
	
	function hide() {
		var custom = menu.find('li.menu-item-pe-custom:not(.menu-item-pe-custom-processed)');
		custom.each(function () {
			var item = custom.filter(this);
			var ctitle = item.find('input[data-name="title"]');
			if (ctitle.length === 1) {
				var otitle = item.find('input[name^="menu-item-title"]');
				if (otitle.length === 1) {
					ctitle
						.attr('name',otitle.attr('name'))
						.val(otitle.val())
						.addClass('edit-menu-item-title');
					otitle.remove();
				}
			}
			item.find('p.description:not(.field-move)').hide();
			item.addClass('menu-item-pe-custom-processed');
		});
	}
	
	function last() {
		$.pixelentity.tooltip(menu.find("li.menu-item:last"));
		hide();
	}
	
	function addTooltip(e, xhr, settings) {
		var req = settings.data;
		if (req.search('action=add-menu-item') != -1) {
			clearTimeout(timer);
			timer = setTimeout(last,500);
		}
	}
	
	jQuery(document).ajaxSuccess(addTooltip);
	
	jQuery(function () {
		$.pixelentity.tooltip(menu);
		hide();
	});

});

