jQuery(document).ready(function($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,clearTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity,prettyPrint,ajaxurl */
	
	var form = $("#theme-options");
	var info;
	var clearStatusTimeout;
	
	function status(s) {
		info
			.find("div")
			.hide()
			.end()
			.find("."+s)
			.show()
			.end();
		clearTimeout(clearStatusTimeout);
		if (s != "warning") {
			clearStatusTimeout = setTimeout(clearStatus,1000);
		}
	}
	
	function clearStatus() {
		status("none");
	}
	
	function saved(result) {
		status((result && result.ok) ? "saved" : "warning");
	}
	
	function submit(e) {
		var data = $("#theme-options").serialize();
		status("saving");
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: data,
			success: saved
		});
		
		return false;
	}
	
	if (form.length > 0) {
		info = form.find(".info.bottom");
		form.delegate("input[type=submit]","click",submit);
		var action = $('<input type="hidden" name="action" value="pe_theme_options_save"/>');
		form.append(action);
	}
	
	var tabs = $(".pe_theme #options_tabs");
	if (parseFloat($.ui.version.match(/\d.\d/)[0]) != 1.8) {
		tabs.find("> ul li").removeClass("ui-tabs-selected");
		tabs.find("> div").removeClass("ui-tabs-hide");
	}
	tabs.tabs();
	
	
	function tabsOn() {
		tabs
			.tabs("destroy")
			.addClass("off");
	}

	function tabsOff() {
		tabs
			.tabs()
			.removeClass("off");
		
	}
	
	$.pixelentity.tooltip($("#theme-options"));
	
	var modal = {
			inited: false,
			msg: false,
			modal: false,
			response: false,
			init: function() {
				this.inited = true;
				this.modal = $('<div id="pe-theme-dialog" class="notification-dialog-wrap"><div class="notification-dialog-background"></div><div class="notification-dialog"><div class="pe-theme-dialog-message"><p class="wp-tab-first" tabindex="0"></p><p><a class="button button-primary wp-tab-last" href="#">YES</a><a class="button" href="#">NO</a></p></div></div></div>');
				this.msg = this.modal.find('p.wp-tab-first');
				this.buttons = {};
				this.buttons.yes = this.modal.find('a.button').eq(0).on('click',$.proxy(this.yes,this));
				this.buttons.cancel = this.modal.find('a.button').eq(1).on('click',$.proxy(this.cancel,this));
				this.modal.hide();
				$("body").append(this.modal);
			},
			hide: function (e) {
				if (e) {
					e.preventDefault();
				}
				this.modal.hide();
				return false;
			},
			yes: function(e) {
				this.response.resolve();
				return this.hide(e);
			},
			cancel: function(e) {
				this.response.reject();
				return this.hide(e);
			},
			confirm: function(html) {
				if (!this.inited) {
					this.init();
				}
				this.msg.html(html);
				this.modal.show();
				this.buttons.yes.focus();
				this.response = new $.Deferred();
				return this.response.promise();
			}
		};
	
	$.pixelentity.confirm = function (html) {
		return modal.confirm(html);
	};
		
	
	if (tabs.length > 0) {
		//var toggleTabs = $('<a href="" class="toggle_tabs">Tabs</a>');
		//$('.pe_theme .top-info').prepend(toggleTabs);
		//toggleTabs.toggle(tabsOn,tabsOff);
	}

	
});
