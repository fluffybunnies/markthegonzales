<?php
// this file contains the contents of the popup window
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Insert tab</title>

<script type="text/javascript" src="includes/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="tiny_mce_popup.js"></script>
<style type="text/css" src="../wp-includes/js/tinymce/themes/advanced/skins/wp_theme/dialog.css"></style>

<style>
div{ padding: 5px 0; height: 20px;} label { display: block; float: left; margin: 4px 8px 0 0; width: 100px; } select, #button-dialog input { display: block; float: right; width: 130px; padding: 3px 5px;} select { width: 142px; } textarea {padding:3px 5px; width:150px; height:50px; float:right;} #insert { display: block; line-height: 24px; text-align: center; margin: 10px 0 0 0; float: right; text-decoration:none;} div.textarea-wrapper {height:70px;}
</style>

<script type="text/javascript">
 
var tabDialog = {
	local_ed : 'ed',
	init : function(ed) {
		tabDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function inserttab(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values 
		var tab = jQuery('#tab-dialog select#tab-cat').val();		 	 
		 
		var output = '';
		
		
		if (tab == '2') {
			output = '[tabgroup]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[/tabgroup]';
		} else if (tab == '3') {
			output = '[tabgroup]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[/tabgroup]';
		} else if (tab == '4') {
			output = '[tabgroup]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[/tabgroup]';
		} else if (tab == '5') {
			output = '[tabgroup]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[/tabgroup]';
		} else if (tab == '6') {
			output = '[tabgroup]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[tab title="your title"]Put your tab content in here[/tab]';
			output += '[/tabgroup]';
		}
		
		
		
		
		
		
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(tabDialog.init, tabDialog);
 
</script>

</head>
<body>
	<div id="tab-dialog">
		<form action="/" method="get" accept-charset="utf-8">
			<div>
				<label for="tab-cat">Amount of Tabs</label>
				<select name="tab-cat" id="tab-cat" size="1">
					<option value="2" selected="selected">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select>
			</div>
			<div>	
				<a href="javascript:tabDialog.insert(tabDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
			</div>
		</form>
	</div>
</body>
</html>