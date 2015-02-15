<?php
// this file contains the contents of the popup window
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Insert toggle</title>

<script type="text/javascript" src="includes/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="tiny_mce_popup.js"></script>
<style type="text/css" src="../wp-includes/js/tinymce/themes/advanced/skins/wp_theme/dialog.css"></style>

<style>
div{ padding: 5px 0; height: 20px;} label { display: block; float: left; margin: 4px 8px 0 0; width: 100px; } select, #button-dialog input { display: block; float: right; width: 130px; padding: 3px 5px;} select { width: 142px; } textarea {padding:3px 5px; width:150px; height:50px; float:right;} #insert { display: block; line-height: 24px; text-align: center; margin: 10px 0 0 0; float: right; text-decoration:none;} div.textarea-wrapper {height:70px;}
</style>

<script type="text/javascript">
 
var toggleDialog = {
	local_ed : 'ed',
	init : function(ed) {
		toggleDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function inserttoggle(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values 
		var toggleVisible = jQuery('#toggle-dialog textarea#toggle-visible').val();		 	 
		var toggleRevealed = jQuery('#toggle-dialog textarea#toggle-revealed').val();		 	 
		 
		var output = '';		
		
		output = '[show_hide title="' + toggleVisible + '"]' + toggleRevealed + '[/show_hide]';		
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(toggleDialog.init, toggleDialog);
 
</script>

</head>
<body>
	<div id="toggle-dialog">
		<form action="/" method="get" accept-charset="utf-8">
			<div class="textarea-wrapper">
				<label for="toggle-cat">Visible Text</label>
				<textarea name="toggle-cat" id="toggle-visible">When you click here...</textarea>
			</div>
			<div class="textarea-wrapper">
				<label for="toggle-cat">Revealed Text</label>
				<textarea name="toggle-cat" id="toggle-revealed">...this text appears!</textarea>
			</div>
			<div style="margin-top:-16px">	
				<a href="javascript:toggleDialog.insert(toggleDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
			</div>
		</form>
	</div>
</body>
</html>