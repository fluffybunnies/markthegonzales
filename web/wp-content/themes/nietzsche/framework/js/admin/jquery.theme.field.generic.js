(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global wp, jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,JSON,ajaxurl, */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peFieldGeneric = {	
		conf: {
			api: true
		}
	};
	
	function PeFieldGeneric(target, conf) {
		
		function start() {
		}
		
		function setData(data) {
			target.val(data);
		}
		
		function getData() {
			return target.val();
		}
		
		$.extend(this, {
			// public API
			setData: setData,
			getData: getData,
			target: function () {
				return target;
			},
			destroy: function() {
				target.data("peFieldGeneric", null);
				target = undefined;
			}
		});
		
		// initialize
		var self = this;
		$(start);
		
	}
	
	// jQuery plugin implementation
	$.fn.peFieldGeneric = function(conf) {
		
		// return existing instance	
		var api = this.data("peFieldGeneric");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peFieldGeneric.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeFieldGeneric(el, conf);
			el.data("peFieldGeneric", api); 
		});
		
		return conf.api ? api: this;		 
	};
		
}(window.jqpe35 || jQuery));

