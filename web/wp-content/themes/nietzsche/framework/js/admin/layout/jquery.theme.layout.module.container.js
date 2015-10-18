(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,clearTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity,prettyPrint */
	
	function addID(v) {
		return ".group_"+v;
	}
	
	function module() {}
	
	$.pixelentity.peFieldLayout.addModule("Container",module,{
		config: function() {
			this.container = true;
			this.allowed = this.conf.allowed ? [this.conf.allowed] : [];
			this.sortable = this.conf.allowed || "block";
		},
		init: function(data,isNew) {
			if (isNew && this.conf.create) {
				this.first = this.master.addBlock(this.conf.create,this.items);
			}
			if (this.titleField) {
				this.titleField.on("change",$.proxy(this.title,this)).trigger("change");
			}
		},
		add: function() {
			if (this.conf.force) {
				return this.master.addBlock(this.conf.force,this.items,"append",true);
			}
			return false;
		},
		filter: function() {
			return this.allowed.length > 0 ? this.allowed.map(addID).join(",") : false;
		}
	});
	
}(window.jqpe35 || jQuery));