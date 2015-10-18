(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,setInterval,clearInterval,clearTimeout,WebKitCSSMatrix,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peTaglines = {	
		conf: {
			api: false
		} 
	};
	
	var mobile;
	
	function PeTaglines(target, conf) {
		
		var parent,taglines,current,slider,idx,delay;
		var autorotate = true;
		
		function position() {
			var h = parent.height();
			target.css("top",Math.round(h - current.height()) / 2);
		}

		
		function resize() {
			position();
		}
		
		function change() {
			if (idx >= 0 && current) {
				current.removeClass("pe-active");
			}
			idx = (idx + 1) % taglines.length;
			current = taglines.eq(idx);
			position();
			current.addClass("pe-active");
			if (autorotate) {
				setTimeout(change,delay);
			}
		}

		// init function
		function start() {
			var starget;

			mobile = $.pixelentity.browser.mobile;
			target.addClass("pe-need-resize");
			delay = (parseInt(target.attr("data-delay"),10) || 4)*1000;
			parent = target.parent();
			taglines = target.find("> .pe-tagline");
			idx = -1;
			current = taglines.eq(0);
			starget = parent.find(".peSlider:first");
			if (starget.length > 0) {
				slider = starget.data("peVoloSimpleSkin").getSlider();
				slider.bind("change.pixelentity",change);
				autorotate = starget.find("> div > div").length < 2;
			} else {
				change();
			}
			target.on("resize",resize);
		}
		
		$.extend(this, {
			// plublic API
			destroy: function() {
				target.data("peTaglines", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peTaglines = function(conf) {
		
		// return existing instance	
		var api = this.data("peTaglines");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peTaglines.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeTaglines(el, conf);
			el.data("peTaglines", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));
