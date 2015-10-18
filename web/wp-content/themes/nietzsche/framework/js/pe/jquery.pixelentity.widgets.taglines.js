(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,setInterval,clearInterval,clearTimeout,WebKitCSSMatrix,pixelentity */
	
	function create(idx,t) {
		t = $(t);
		t.peTaglines({api:true});
	}

	function check(target) {
		var t = target.find(".pe-taglines");
		if (t.length > 0) {
			t.each(create);
			return true;
		}
		return false;
	}
	
	$.pixelentity.widgets.add(check);
}(jQuery));