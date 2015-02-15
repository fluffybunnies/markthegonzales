<?php
$theme_options = get_option('option_tree');
$omc_google_analytics = get_option_tree('omc_google_analytics', $theme_options, false);
$omc_copyright_text = get_option_tree('omc_copyright_text', $theme_options, false);
$omc_enable_copyright = get_option_tree('omc_enable_copyright', $theme_options, false);
$omc_enable_footer_widget = get_option_tree('omc_enable_footer_widget', $theme_options, false);
$omc_footer_widget_logo = get_option_tree('omc_footer_widget_logo', $theme_options, false);
$omc_footer_widget_text = get_option_tree('omc_footer_widget_text', $theme_options, false);
$omc_footer_facebook = get_option_tree('omc_footer_facebook', $theme_options, false);
$omc_footer_twitter = get_option_tree('omc_footer_twitter', $theme_options, false);
$omc_footer_flickr = get_option_tree('omc_footer_flickr', $theme_options, false);
$omc_footer_pinterest = get_option_tree('omc_footer_pinterest', $theme_options, false);
$omc_footer_vimeo = get_option_tree('omc_footer_vimeo', $theme_options, false);
$omc_footer_youtube = get_option_tree('omc_footer_youtube', $theme_options, false);
$omc_footer_google = get_option_tree('omc_footer_google', $theme_options, false);
?>
	
	<footer id="omc-boxed">
	
		<div id="omc-footer-border"></div>
	
		<div id="omc-inner-footer">

			<div class="omc-footer-widget-column">
				
				<div class="omc-footer-widget">
				
					<?php if ($omc_enable_footer_widget !== NULL) { ?>
					
						<div class="omc-footer-widget">
						
							<img src="<?php echo $omc_footer_widget_logo;?>" alt="footer logo" class="footer-logo" />
							<br/>
							<?php if ($omc_footer_pinterest !== NULL) {?><a class="omc-social-small pinterest" href="<?php echo $omc_footer_pinterest;?>"></a><?php } ?>
							<?php if ($omc_footer_facebook !== NULL) {?><a class="omc-social-small facebook" href="<?php echo $omc_footer_facebook;?>"></a><?php } ?>
							<?php if ($omc_footer_twitter !== NULL) {?><a class="omc-social-small twitter" href="<?php echo $omc_footer_twitter;?>"></a><?php } ?>
							<?php if ($omc_footer_flickr !== NULL) {?><a class="omc-social-small linkedin" href="<?php echo $omc_footer_flickr;?>"></a><?php } ?>
							<?php if ($omc_footer_vimeo !== NULL) {?><a class="omc-social-small vimeo" href="<?php echo $omc_footer_vimeo;?>"></a><?php } ?>
							<?php if ($omc_footer_youtube !== NULL) {?><a class="omc-social-small youtube" href="<?php echo $omc_footer_youtube;?>"></a><?php } ?>
							<?php if ($omc_footer_google !== NULL) {?><a class="omc-social-small google" href="<?php echo $omc_footer_google;?>"></a><?php } ?>
							
							<!-- <a class="omc-social-small linkedinn" href="http://www.linkedin.com/your_user/"></a> -->
							<!-- <a class="omc-social-small instagram" href="http://www.instagram.com/your_user/"></a>	-->


							<br class="clear"/>
							<p><?php echo $omc_footer_widget_text; ?></p>
							
						</div><!-- /omc-footer-widget -->
					
					<?php } ?>
					
					<?php if ( ! dynamic_sidebar( 'Footer Column 1' ) ) :  endif; ?>		
				
				</div><!-- /omc-footer-widget -->
				
			</div><!--- /first-footer-column -->

			<div class="omc-footer-widget-column">
				
				<?php if ( ! dynamic_sidebar( 'Footer Column 2' ) ) :  endif; ?>		
					
			</div><!--- /second-footer-column -->

			<div class="omc-footer-widget-column">
				
				<?php if ( ! dynamic_sidebar( 'Footer Column 3' ) ) :  endif; ?>		
					
			</div><!--- /third-footer-column -->

			<div class="omc-footer-widget-column no-right">
				
				<?php if ( ! dynamic_sidebar( 'Footer Column 4' ) ) :  endif; ?>		
					
			</div><!--- /fourth-footer-column -->
			
			<br class="clear" />
		
		</div><!-- /omc-inner-footer -->
		
	</footer>
	
	<?php if ($omc_enable_copyright !== NULL) { ?>
	
		<div class="omc-copyright-area">
			
			<div class="omc-copyright-left">
				
				<p><?php echo $omc_copyright_text; ?></p>
				
			</div><!-- /omc-copyright-left -->
			
			<div class="omc-copyright-right">
				
				<?php wp_nav_menu( array('container_class' => 'omc-copyright-menu', 'theme_location' => 'copyright'));?>
				
				<br class="clear" />
				
			</div><!-- /omc-copyright-right -->
			
			<br class="clear" /> 
		<a href="#top" class="omc-mobile-back-to-top omc-bottom-b-t-t"><?php _e('Back to Top', 'gonzo');?> &uarr;</a>	
		</div><!-- /omc-copyright-area -->
		
	<?php } ?>	

	<p id="back-top"><a href="#top"><span></span></a></p>

	<?php wp_footer(); ?>

	<!--[if lt IE 7 ]>
		<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
		<script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
	<![endif]-->

	</div><!-- /transparent-layer -->
	
	<?php echo $omc_google_analytics; ?>
	
</body>

</html>
