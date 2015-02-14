<?php
// this file contains the contents of the popup window
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Insert loop</title>

<script type="text/javascript" src="includes/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="tiny_mce_popup.js"></script>
<style type="text/css" src="../wp-includes/js/tinymce/themes/advanced/skins/wp_theme/dialog.css"></style>

<style>
div{ padding: 5px 0; height: 20px;} label { display: block; float: left; margin: 4px 8px 0 0; width: 100px; } select, #button-dialog input { display: block; float: right; width: 130px; padding: 3px 5px;} select { width: 142px; } textarea {padding:3px 5px; width:150px; height:50px; float:right;} #insert { display: block; line-height: 24px; text-align: center; margin: 10px 0 0 0; float: right; text-decoration:none;} div.textarea-wrapper {height:70px;} input#loop-cat {display: block; float: right; width: 130px; padding: 3px 5px;}
</style>

<script type="text/javascript">
 
var loopDialog = {
	local_ed : 'ed',
	init : function(ed) {
		loopDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	insert : function insertloop(ed) {
	 
		// Try and remove existing style / blockquote
		tinyMCEPopup.execCommand('mceRemoveNode', false, null);
		 
		// set up variables to contain our input values 
		var category = jQuery('#loop-cat').val();		 	 
		var module = jQuery('#loop-dialog select#loop-module').val();		 	 
		 
		var output = '';
		
		// setup the output of our shortcode
		output = '[loop ';
			output += 'category=' + category + ' ';
			output += 'module=' + module + ' ]';
		
		tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		 
		// Return
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(loopDialog.init, loopDialog);
 
</script>

</head>
<body>
	<div id="loop-dialog">
		<form action="/" method="get" accept-charset="utf-8">
			<div>
				<label for="loop-category">Category Slug</label>
				<input type="text" name="loop-category" value="" id="loop-cat" />
			</div>
			<div>
				<label for="loop-module">Layout Module</label>
				<select name="loop-module" id="loop-module" size="1">
					<option value="" selected="selected">Select</option>
					<option value="a">Module A (Half-width)</option>
					<option value="b">Module B (Full-width)</option>
					<option value="c">Module C (Quarter-width)</option>
					<option value="gallery">Module - Gallery</option>

				</select>
			</div>
			<div>	
				<a href="javascript:loopDialog.insert(loopDialog.local_ed)" id="insert" style="display: block; line-height: 24px;">Insert</a>
			</div>
		</form>
	</div>
</body>
</html>