(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global wp, jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,JSON,ajaxurl, */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peFieldButtonset = {	
		conf: {
			api: true
		}
	};
	
	function PeFieldButtonset(target, conf) {
		var inputs;
		var multiple = false;
		var inited = false;
		var values = false;
		
		function start() {
			inited = true;
			target.buttonset();
			inputs=target.find('input');
			multiple = inputs.first().attr("type") === 'checkbox';
			save();
		}
		
		function save() {
			if (values !== false) {
				inputs.prop('checked',false);
				$(values).each(function () {
					inputs.filter('input[value="%0"]'.format(this)).prop('checked',true);
				});
			}
			target.buttonset("refresh");
		}
		
		function setData(data) {
			if (typeof data === "string") {
				data = [data];
			}
			values = data;
			if (inited) {
				save();
			}
		}
		
		function getData() {
			var checked = inputs.filter(':checked'), value;
			if (multiple) {
				value = [];
				checked.each(function (idx) {
					value.push(checked.eq(idx).val());
				});
			} else {
				value = checked.val();
			}
			return value;
		}
		
		$.extend(this, {
			// plublic API
			setData: setData,
			getData: getData,
			target: function () {
				return target;
			},
			destroy: function() {
				target.data("peFieldButtonset", null);
				target = undefined;
			}
		});
		
		// initialize
		var self = this;
		$(start);
		
	}
	
	// jQuery plugin implementation
	$.fn.peFieldButtonset = function(conf) {
		
		// return existing instance	
		var api = this.data("peFieldButtonset");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peFieldButtonset.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeFieldButtonset(el, conf);
			el.data("peFieldButtonset", api); 
		});
		
		return conf.api ? api: this;		 
	};
		
}(jQuery));
