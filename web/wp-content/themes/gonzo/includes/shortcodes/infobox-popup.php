<?php
// this file contains the contents of the popup window
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Insert infobox</title>

<script type="text/javascript" src="includes/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="tiny_mce_popup.js"></script>
<style type="text/css" src="../wp-includes/js/tinymce/themes/advanced/skins/wp_theme/dialog.css"></style>

<style>
div{ padding: 5px 0; height: 20px;} label { display: block; float: left; margin: 4px 8px 0 0; width: 100px; } select, #button-dialog input { display: block; float: right; width: 130px; padding: 3px 5px;} select { width: 142px; } textarea {padding:3px 5px; width:150px; height:50px; float:right;} #insert { display: block; line-height: 24px; text-align: center; margin: 10px 0 0 0; float: right; text-decoration:none;} div.textarea-wrapper {height:70px;}
</style>

<script type="text/javascript">
 
var infoboxDialog = {
	local_ed : 'ed',
	init : function(ed) {
		infoboxDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertinfobox(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values 
		var infoboxVisible = jQuery('#infobox-dialog select#alert-type').val();		 	 
		var infoboxRevealed = jQuery('#infobox-dialog textarea#infobox-revealed').val();		 	 
		 
		var output = '';	
		
		output = '[alert type="' + infoboxVisible + '"]' + infoboxRevealed + '[/alert]';			
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(infoboxDialog.init, infoboxDialog);
 
</script>

</head>
<body>
	<div id="infobox-dialog">
		<form action="/" method="get" accept-charset="utf-8">
			<div>
				<label for="tab-cat">Alert Type</label>
				<select name="tab-cat" id="alert-type" style="width:162px" size="1">
					<option value="red" selected="selected">Warning (red)</option>
					<option value="green">Success (green)</option>
					<option value="yellow">Neutral (yellow)</option>
					<option value="blue">Neutral (blue)</option>
				</select>
			</div>
			<div class="textarea-wrapper">
				<label for="infobox-cat">Revealed Text</label>
				<textarea name="infobox-cat" id="infobox-revealed">Your message!</textarea>
			</div>
			<div style="margin-top:-16px;">	
				<a href="javascript:infoboxDialog.insert(infoboxDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
			</div>
		</form>
	</div>
</body>
</html>