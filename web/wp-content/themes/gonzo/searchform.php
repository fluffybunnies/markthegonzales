<div class="omc-sidebar-search">
		
		<form method="get" id="omc-main-search" action="<?php echo home_url(); ?>/">
			
			<fieldset>
			
				<label class="hidden" for="s"><?php _e('', 'gonzo'); ?></label>
				
				<input type="text" class="search_input_sidebar" value="<?php _e('Search', 'gonzo');?>..." onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="s" id="s" />
				
				<input type="submit" class="search_button_sidebar" id="searchsubmit" value="<?php _e('Go', 'gonzo');?> &rarr;" />
			
			</fieldset>
			
		</form>
		
</div><!-- /omc-sidebar-search -->