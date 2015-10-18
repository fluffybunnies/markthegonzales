(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,clearTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity,prettyPrint */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peSplash = {	
		conf: {
			api: false
		} 
	};
	
	var jwin,mobile,body,nw,nh,w,h;
	
	function PeSplash(target, conf) {
		
		function resize() {
			nw = jwin.width();
			nh = window.innerHeight ? window.innerHeight: jwin.height();
			
			if (nw === w && nh === h) {
				return;
			}
			
			w = nw;
			h = nh;
			
			// test this
			if (mobile && jwin.scrollTop() > 0) {
				return;
			}
			
			if (target.length > 0) {
				var fh = Math.max(300,h-body.find("section.pe-main-section:first").offset().top);
				var mh = parseInt(target.attr("data-maxheight"),10);
				if (mh > 0) {
					fh = Math.min(fh,mh);
				}
				
				mh = parseInt(target.attr("data-minheight"),10);
				
				if (mh > 0) {
					fh = Math.max(fh,mh);
				}
				target.height(fh);
				fullPageResize();
				setTimeout(fullPageResize,500);
				if ($.browser.msie && $.browser.version < 10) {
					setTimeout(fullPageResize,1500);
					setTimeout(fullPageResize,2000);
					setTimeout(fullPageResize,2500);
				}
			}
			
		}
		
		function fullPageResize() {
			target.find(".pe-need-resize").trigger("resize");
		}
		
		// init function
		function start() {
			mobile = $.pixelentity.browser.mobile;
			body = $("body");
			jwin = $(window);
			if ($.pixelentity.wresize) {
				$.pixelentity.wresize(resize);
			} else {
				jwin.resize(resize);
			}	
			jwin.on("load",resize);
			resize();
		}
		
		$.extend(this, {
			// plublic API
			destroy: function() {
				target.data("peSplash", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peSplash = function(conf) {
		
		// return existing instance	
		var api = this.data("peSplash");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peSplash.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeSplash(el, conf);
			el.data("peSplash", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));