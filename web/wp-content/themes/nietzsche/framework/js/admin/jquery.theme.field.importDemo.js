(function ($) {
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,tb_show,tb_remove,ajaxurl */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peFieldImportDemo = {	
		conf: {
			api: false
		} 
	};
	
	function PeFieldImportDemo(target, conf) {
		
		var id = target.attr("id");
		var button = $("#%0".format(id));
		var messages = $("#%0_messages".format(id));
		var nonce = button.attr("data-nonce");
		var progressInterval = 0;
		var checkingProgress = false;
		var done = false;
		
		function log(which,message) {
			messages.show().find("> div").hide().filter("#%0_%1".format(id,which)).show();
			if (message) {
				$("#%0_log".format(id)).html(message);
			}
		}
		
		function reloadPage() {
			location.href = location.href+"&imported=ok";
		}

		
		function result(data) {
			if (data && data.ok) {
				log("imported","The page will be now automatically reloaded to use imported settings.");
				setTimeout(reloadPage,2000);
			} else {
				
				log("warning",typeof data == "string" ? data : data.message);
			}
			done = true;
			clearInterval(progressInterval);
		}
		
		function importDemo(force) {
			if ($.pixelentity.peFieldWPPlugins) {
				if (!$.pixelentity.peFieldWPPlugins.ready) {
					$.pixelentity
						.confirm('Demo data can only be imported if all the plugins required by the theme are installed and active, would you like to automatically install the plugins and then import demo data ?')
						.done(function () {
							// disable the event so user can't trigger the import again while plugins are installing
							button.hide();
							log("plugins");
							$.pixelentity.peFieldWPPlugins.install();
							$.pixelentity.peFieldWPPlugins.callback = function () {
								importDemo();
							};
						});
					return false;
				}
			}
			
			if (force !== true  && (button.attr("data-confirm") == "yes")) {
				$.pixelentity
					.confirm('It seems that your Wordpress installation already contains data. Altough existing posts, pages, tags, categories will be preserved, loading demo data would overwrite your current widgets/sidebars configuration. Continue with the import ?')
					.done(function () {
						importDemo(true);
					});
				return false;
			}
			button.hide();
			log("saving",'<div id="peImportBar"></div><div id="peImportStep">Loading ...</div>');
			$( "#peImportBar").progressbar({
				value: 0
			});
			progressInterval = setInterval(checkProgress,2000);
			jQuery.post(
				ajaxurl,
				{
					action : "pe_theme_import_demo",
					nonce: nonce
				},
				result
			);
			return false;
		}
		
		function checkProgress() {
			if (checkingProgress) {
				return false;
			}
			checkingProgress = true;
			jQuery.post(
				ajaxurl,
				{
					action : "pe_theme_import_progress"
				},
				progress
			);
		}
		
		function progress(data) {
			if (done) {
				return;
			}
			if (data) {
				$("#peImportBar").progressbar({
					value: Math.ceil(100*data.progress/data.total)
				});
				$("#peImportStep").html(data.step);
			}
			checkingProgress = false;
		}


		
		// init function
		function start() {
			if (location.search.match(/imported=ok/)) {
				log("imported","<strong>New options loaded</strong>, you can now customize the theme");
				button.hide();
			} else {
				button.on('click',importDemo);
			}
		}
		
		$.extend(this, {
			// plublic API
			destroy: function() {
				target.data("peFieldImportDemo", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peFieldImportDemo = function(conf) {
		
		// return existing instance	
		var api = this.data("peFieldImportDemo");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peFieldImportDemo.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeFieldImportDemo(el, conf);
			el.data("peFieldImportDemo", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));