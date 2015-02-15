<?php 
// Get theme options
$theme_options = get_option('option_tree');
$omc_logo_image = get_option_tree('omc_logo_image', $theme_options, false);
$omc_favicon = get_option_tree('omc_favicon', $theme_options, false);
$omc_header_font = get_option_tree('omc_header_font', $theme_options, false);
$omc_paragraph_font = get_option_tree('omc_paragraph_font', $theme_options, false);
$omc_top_menu = get_option_tree('omc_top_menu', $theme_options, false);
?>

<!doctype html >
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js page-<?php echo preg_replace('/[^a-z0-9_\-]/','',strtolower(get_query_var('pagename'))); ?>" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	
	<title><?php is_front_page() ? bloginfo('name') : wp_title(); ?></title>

	
	<?php if ($omc_favicon !== NULL) { ?><link href="<?php echo $omc_favicon; ?>" rel="shortcut icon"/><?php } ?>
	
	<meta name="description" content="<?php bloginfo('description');?>">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
		
	<?php wp_head(); ?>
	
	<!--[if IE 8]><link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri();?>/css/ie8.css" /><![endif]-->
	
	<!--[if IE 7]><link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri();?>/css/ie7.css" /><![endif]-->
	
	
	<link href='http://fonts.googleapis.com/css?family=<?php $omc_header_font = str_replace(" ", "+", $omc_header_font); echo $omc_header_font; ?>:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
	
	<?php if ($omc_paragraph_font !== NULL) { $omc_paragraph_font = str_replace(" ", "+", $omc_paragraph_font); echo("<link href='http://fonts.googleapis.com/css?family=".$omc_paragraph_font.":400italic,700italic,400,700' rel='stylesheet' type='text/css'>"); }?>
	
	<noscript>
		<style>
			.es-carousel ul{display:block;}
		</style>
	</noscript>	
	
	<?php get_template_part('header-options');?>
	
	<link rel="stylesheet" type="text/css" href="<?php \ace\Ace::vres('/assets/ace.css'); ?>" />

</head>

<body <?php body_class(); ?> >

	<div id="omc-transparent-layer">
	
	<!-- <div class="preloaders" style=""></div>  -->
		
		<?php if ($omc_top_menu === 'Yes') { ?>
		
			<div id="omc-top-menu">
				
				<?php wp_nav_menu( array('container_class' => 'omc-top-menu-inner', 'theme_location' => 'toplevel'));?>
				
				<br class="clear" />
				
			</div>
		
		<?php } ?>
		
		<div id="omc-container">
			
			<header>
			
				<?php if ( ! dynamic_sidebar( 'Header Banner' ) ) :  endif; ?>	
				
				<!--<a id="omc-logo" href="<?php echo home_url();?>"><img src="<?php if ($omc_logo_image !== NULL) { echo $omc_logo_image; } else { echo get_template_directory_uri();?>/images/logo.png<?php } ?>" alt="<?php bloginfo('name');?> logo" <?php if ($omc_logo_image === NULL) { echo('height="96"'); }?> /></a>-->
				<a id="omc-logo" href="<?php echo home_url();?>"><img src="<?php \ace\Ace::vres('/assets/logo.png'); ?>" alt="<?php bloginfo('name');?> logo" <?php if ($omc_logo_image === NULL) { echo('height="96"'); }?> /></a>
					
				<nav id="omc-main-navigation">				
				
					<?php if ( has_nav_menu( 'primary' ) ) { ?>
					
					<?php wp_nav_menu( array('container_class' => 'omc-over-480',  'fallback_cb' => 'none', 'theme_location' => 'primary', 'walker' => new Description_Walker));?>
					
					<?php } else {	wp_nav_menu(); } ?>
					
					<br class="clear" />
					
					<?php wp_nav_menu( array('container_class' => 'omc-under-480', 'theme_location' => 'mobile', 'fallback_cb' => 'none', 'items_wrap' => '%3$s'));?>
						
					<div id="omc-header-search-mobi">		
					
						<form method="get" id="mobi-search" class="omc-mobi-search-form" action="<?php echo home_url(); ?>/">
						
							<input type="text" class="omc-header-mobi-search-input-box" value=""  name="s" id="mobi-mobi-search">
							
							<input type="submit" class="omc-header-mobi-search-button" id="seadssdrchsubmit" value="">
							
						</form>
						
					</div>	
						
				</nav>
				
				<br class="clear" />				
				
			</header>