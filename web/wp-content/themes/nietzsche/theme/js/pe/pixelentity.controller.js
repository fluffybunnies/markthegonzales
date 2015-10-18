(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,clearTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity,prettyPrint */
	
	var links,menu;
	var jwin = $(window),sc;
	var jhtml = $("html");
	var body;
	var dropdowns;
	var container;
	var containerH = 0,h = 0;
	var scroller;
	var filterable = false,isotope = false;
	var layoutSwitcher = false;
	var cells;
	var overs;
	var containerHeightTimer = 0;
	var footer,header,arrows,mobile,background;
	var fullpage;
	
	window.peGmapStyle = [
        {
            stylers: [
                { saturation: -100 }
            ]
        },{
            featureType: "road",
            elementType: "geometry",
            stylers: [
                { lightness: 100 },
                { visibility: "simplified" }
            ]
        },{
            featureType: "road",
            elementType: "labels",
            stylers: [
                { visibility: "off" }
            ]
        }
    ];
	
	function imgfilter() {
		return this.href.match(/\.(jpg|jpeg|png|gif)$/i);
	}
	
	pixelentity.classes.Controller = function() {
		
		var w,h;
		var active;
		var nav;
		
		function autoFlare(idx,el) {
			el = $(el);
			el.attr("data-target","flare");
		}
		
		function resize() {
			w = jwin.width();
			h = window.innerHeight ? window.innerHeight: jwin.height();
		}
		
		function addHover(idx) {
			var a = overs.eq(idx);
			
			a.prepend('<span class="cell-title"><span><i class="icon-%0"></i></span></span>'.format(a.attr("data-target") == "flare" ? "plus" : "info"));
			
		}
		
		function overEffect(e) {
			var a = overs.filter(e.currentTarget);
			var img = a.find("img");
			img.addClass("animated");
			a[e.type === "mouseenter" ? "addClass" : "removeClass"]("pe-status-over");
			//console.log(e.currentTarget);
		}
		
		function start() {
			
			body = $("body");
			mobile = $.pixelentity.browser.mobile;
			
			if (mobile) {
				$("a[data-rel='tooltip']").removeAttr("data-rel");
				jhtml.removeClass("desktop").addClass("mobile");
				if ($.pixelentity.browser.android) {
					jhtml.addClass("android");
				}
			} else {
				jhtml.addClass("desktop").removeClass("mobile");
			}
			
			links = $('a[data-target!="flare"]').not('a[data-toggle]');
			links.filter(imgfilter).each(autoFlare);
			
			if (!mobile) {
				overs = $('a.over-effect');
				overs.each(addHover);
				overs.on("mouseenter mouseleave",overEffect);
			}			
			
			$('a.peVideo').attr({
				"data-autoplay": "disabled"
			});
			
			$("img[data-original]:not(img.pe-lazyload-inited)").peLazyLoading();

			
			if (mobile) {
				setTimeout(function () {
					//alert("ok");
					jwin.triggerHandler("pe-lazyloading-refresh");
				},100);
			} else {

			}
			
			jwin.resize(resize);
			jwin.on("load",resize);
			resize();
			
		}
		
		$.extend(this, {
			// public API
			start: start
		});
	};
	
}(jQuery));
