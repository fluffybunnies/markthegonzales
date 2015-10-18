(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,clearTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity,prettyPrint */	
	
	
	function module() {}
	
	module.prototype = {
		setup: function(master,conf) {
			this.conf = conf;
			this.master = master;
			//this.id = master.getNextID();
			this.container = false;
			this.config();
		},
		template: function(target) {
			this.target = target;
			this.items = target.find("ul.pe_block_container:first");
			this.titleField = target.find(".config input[data-datatype='blocktitle'], .config select[data-datatype='blocktitle']").eq(0);
			this.titleField = this.titleField.length > 0 ? this.titleField : false; 
			return target;
		},
		config: function() {
		},
		init: function(data,isNew) {
			if (this.titleField) {
				this.titleField.on("change",$.proxy(this.title,this)).trigger("change");
			}
		},
		title: function() {
			if (this.titleField) {
				this.target.find("span.title:first").text(this.titleField.val().replace(/<br\/?>/,' - '));
			}
		},
		focus: function() {
			this.target.find(".config input,.config textarea,.config select").eq(0).focus();
		},
		remove: function() {
		},
		filter: function() {
			return false;
		}
	};
	
	$.pixelentity.peFieldLayout.addModule("Standard",module);
	
	
}(window.jqpe35 || jQuery));