<?php
// this file contains the contents of the popup window
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Insert Column</title>

<script type="text/javascript" src="includes/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="tiny_mce_popup.js"></script>
<style type="text/css" src="../wp-includes/js/tinymce/themes/advanced/skins/wp_theme/dialog.css"></style>

<style>
div{ padding: 5px 0; height: 20px;} label { display: block; float: left; margin: 4px 8px 0 0; width: 100px; } select, #button-dialog input { display: block; float: right; width: 130px; padding: 3px 5px;} select { width: 142px; } textarea {padding:3px 5px; width:150px; height:50px; float:right;} #insert { display: block; line-height: 24px; text-align: center; margin: 10px 0 0 0; float: right; text-decoration:none;} div.textarea-wrapper {height:70px;}
</style>

<script type="text/javascript">
 
var columnDialog = {
	local_ed : 'ed',
	init : function(ed) {
		columnDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertcolumn(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values 
		var group = jQuery('#column-dialog select#column-group').val();		 	 
		 
		var output = '';
		
		// setup the output of our shortcode
		output = '[' + group + ']';
			output += '[/' + group + ']';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(columnDialog.init, columnDialog);
 
</script>

</head>
<body>
	<div id="column-dialog">
		<form action="/" method="get" accept-charset="utf-8">
			<div>
				<label for="column-color">Column Type:</label>
				<select name="column-group" id="column-group" size="1">
				
					<option value="one_half" selected="selected">one half</option>
					<option value="one_half_last">one half last</option>
					
					<option value="one_third">one third</option>
					<option value="one_third_last">one third last</option>
					<option value="two_third">two third</option>
					<option value="two_third_last">two third last</option>
					
					<option value="one_fourth">one fourth</option>
					<option value="one_fourth_last">one fourth last</option>
					<option value="three_fourth">three fourth</option>
					<option value="three_fourth_last">three fourth last</option>
				</select>
			</div>
			<div>	
				<a href="javascript:columnDialog.insert(columnDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
			</div>
		</form>
	</div>
</body>
</html>