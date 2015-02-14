(function() {
	tinymce.create('tinymce.plugins.tabPlugin', {
		init : function(ed, url) {
			// Register commands
			ed.addCommand('mcetabPlugin', function() {
				ed.windowManager.open({
					file : url + '/tabs-popup.php', // file that contains HTML for our modal window
					width : 304 + parseInt(ed.getLang('button.delta_width', 0)), // size of our window
					height : 110 + parseInt(ed.getLang('button.delta_height', 0)), // size of our window
					inline : 1
				}, {
					plugin_url : url
				});
			});
			 
			// Register buttons
			ed.addButton('friendly_tab', {title : 'Insert Tabgroup', cmd : 'mcetabPlugin', image: url + '/includes/images/tabs.png' });
		}
		 
		
	});
	 
	// Register plugin
	// first parameter is the button ID and must match ID elsewhere
	// second parameter must match the first parameter of the tinymce.create() function above
	tinymce.PluginManager.add('friendly_tab', tinymce.plugins.tabPlugin);

})();