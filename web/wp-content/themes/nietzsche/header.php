<!DOCTYPE html class="page-<?php echo preg_replace('/[^a-z0-9_\-]/','',strtolower(get_query_var('pagename'))); ?>">
<?php $t =& peTheme();?>
<?php $content =& $t->content; ?>
<?php $meta = $t->content->meta(); ?>
<!--[if IE 8 ]><html class="desktop ie8 no-js" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9 ]><html class="desktop ie9 no-js" <?php language_attributes(); ?>><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" <?php language_attributes();?>><!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<meta name="format-detection" content="telephone=no" />

	<!--[if lt IE 9]>
	<script type="text/javascript">/*@cc_on'abbr article aside audio canvas details figcaption figure footer header hgroup mark meter nav output progress section summary subline time video'.replace(/\w+/g,function(n){document.createElement(n)})@*/</script>
	<![endif]-->
	<script type="text/javascript">if(Function('/*@cc_on return document.documentMode===10@*/')()){document.documentElement.className+=' ie10';}</script>
	<script type="text/javascript">(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php if ( ! function_exists( 'wp_site_icon' ) ) : ?>

		<!-- favicon -->
		<link rel="shortcut icon" href="<?php echo esc_url( $t->options->get("favicon") ); ?>" />

	<?php endif; ?>

	<?php $t->font->load(); ?>

	<!-- wp_head() -->
	<?php $t->header->wp_head(); ?>
</head>

<body <?php $content->body_class(); ?>>

<?php $menu_type = $t->options->get( 'menu_type' ); ?>
<?php $menu_type = ( ( is_page() || is_singular( 'project' ) ) && ! empty( $meta->header->header_type ) && 'global' !== $meta->header->header_type ) ? $meta->header->menu_type  : $menu_type; ?>

<?php get_template_part( 'main-menu-' . sanitize_file_name( $menu_type ) ); ?>

<div class="wrapper skin">
	<div class="wrapper-inner">

		<?php $header_type = $t->options->get( 'header_type' ); ?>
		<?php $header_type = ( ( is_page() || is_singular( 'project' ) ) && ! empty( $meta->header->header_type ) && 'global' !== $meta->header->header_type ) ? $meta->header->header_type  : $header_type; ?>

		<?php get_template_part( 'header-' . sanitize_file_name( $header_type ) ); ?>