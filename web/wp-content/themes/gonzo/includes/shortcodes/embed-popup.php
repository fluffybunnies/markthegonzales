<?php
// this file contains the contents of the popup window
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Insert embed</title>

<script type="text/javascript" src="includes/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="tiny_mce_popup.js"></script>
<style type="text/css" src="../wp-includes/js/tinymce/themes/advanced/skins/wp_theme/dialog.css"></style>

<style>
div{ padding: 5px 0; height: 20px;} label { display: block; float: left; margin: 4px 8px 0 0; width: 100px; } select, #button-dialog input { display: block; float: right; width: 130px; padding: 3px 5px;} select { width: 142px; } textarea {padding:3px 5px; width:150px; height:50px; float:right;} #insert { display: block; line-height: 24px; text-align: center; margin: 10px 0 0 0; float: right; text-decoration:none;} div.textarea-wrapper {height:70px;}
</style>

<script type="text/javascript">
 
var embedDialog = {
	local_ed : 'ed',
	init : function(ed) {
		embedDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertembed(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values 
		var id = jQuery('input#video-id').val();					 	 
		var site = jQuery('select#video-type').val();					 	 
		 
		var output = '';		
		
		output = '[video id="' + id + '" site="' + site + '"][/video]';		
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(embedDialog.init, embedDialog);
 
</script>

</head>
<body>
	<div id="button-dialog">
		<form action="/" method="get" accept-charset="utf-8">
			<div>
				<label for="button-size">Video Site</label>
				<select name="button-size" id="video-type" size="1">
					<option value="youtube" selected="selected">Youtube</option>
					<option value="vimeo">Vimeo</option>
				</select>
			</div>
			<div>
				<label for="button-text">Video ID</label>
				<input type="text" name="button-text" value="" id="video-id" />
			</div>
			<div>	
				<a href="javascript:embedDialog.insert(embedDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
			</div>
		</form>
	</div>
</body>
</html>