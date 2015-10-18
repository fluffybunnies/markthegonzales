(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,clearTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity,prettyPrint */	
	
	
	function image360() {
		$(this).pe360();
		//$(this).peSplash();
	}
	
	function check(target) {
		var t = target.find(".pe-image-360");
		if (t.length > 0) {
			t.each(image360);
		}
		return false;
	}
	
	$.pixelentity.widgets.add(check);
}(jQuery));