(function() {
	tinymce.create('tinymce.plugins.loopPlugin', {
		init : function(ed, url) {
			// Register commands
			ed.addCommand('mceloopPlugin', function() {
				ed.windowManager.open({
					file : url + '/loops-popup.php', // file that contains HTML for our modal window
					width : 304 + parseInt(ed.getLang('button.delta_width', 0)), // size of our window
					height : 135 + parseInt(ed.getLang('button.delta_height', 0)), // size of our window
					inline : 1
				}, {
					plugin_url : url
				});
			});
			 
			// Register buttons
			ed.addButton('friendly_loop', {title : 'Insert Layout Module', cmd : 'mceloopPlugin', image: url + '/includes/images/icon.gif' });
		}
		 
		
	});
	 
	// Register plugin
	// first parameter is the button ID and must match ID elsewhere
	// second parameter must match the first parameter of the tinymce.create() function above
	tinymce.PluginManager.add('friendly_loop', tinymce.plugins.loopPlugin);

})();