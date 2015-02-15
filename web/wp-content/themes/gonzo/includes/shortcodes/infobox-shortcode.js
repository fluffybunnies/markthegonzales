(function() {
	tinymce.create('tinymce.plugins.infoboxPlugin', {
		init : function(ed, url) {
			// Register commands
			ed.addCommand('mceinfoboxPlugin', function() {
				ed.windowManager.open({
					file : url + '/infobox-popup.php', // file that contains HTML for our modal window
					width : 304 + parseInt(ed.getLang('button.delta_width', 0)), // size of our window
					height : 170 + parseInt(ed.getLang('button.delta_height', 0)), // size of our window
					inline : 1
				}, {
					plugin_url : url
				});
			});
			 
			// Register buttons
			ed.addButton('friendly_infobox', {title : 'Insert Toggle', cmd : 'mceinfoboxPlugin', image: url + '/includes/images/info.png' });
		}
		 
		
	});
	 
	// Register plugin
	// first parameter is the button ID and must match ID elsewhere
	// second parameter must match the first parameter of the tinymce.create() function above
	tinymce.PluginManager.add('friendly_infobox', tinymce.plugins.infoboxPlugin);

})();