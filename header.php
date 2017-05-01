<?php ?>
<!DOCTYPE html>
<html>
<head>
<title><?php
	global $page, $paged;
	wp_title( '|', true, 'right' );
		bloginfo( 'name' );
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s' ), max( $paged, $page ) );
	?>
</title>
<meta name="description" content="<?php if ( is_single() ) {
	single_post_title('', true);
	} else {
	bloginfo('name'); echo " - "; bloginfo('description');
	}
?>" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="ClearType" content="true" />

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="shortcut icon" href="<?php echo bloginfo('template_directory'); ?>/favicon.png">
	<link rel="apple-touch-icon" href="<?php echo bloginfo('template_directory'); ?>/apple-touch-icon-precomposed.png"/>

	<script src="https://use.typekit.net/kqt4yvo.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory'); ?>/assets/css/style.css" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="top">
	<div class="access-nav">
		<div class="container">
			<?php
				$args = array(
					'menu' => 'Access Nav',
					'items_wrap' => '<div class="menu"><ul>%3$s</ul></div>',
					);
				wp_nav_menu($args);
			?>

			<ul class="social">
				<li>
					<a target="_blank" href="https://twitter.com/BeSciPol"><i class="fa fa-twitter"></i><span class="screen-reader-text">Twitter</span></a>
				</li>
				<li>
					<a target="_blank" href="https://www.linkedin.com/company/3114545"><i class="fa fa-linkedin"></i><span class="screen-reader-text">Linkedin</span></a>
				</li>
				<li>
					<a target="_blank" href="http://behavioralpolicy.org/feed"><i class="fa fa-rss"></i><span class="screen-reader-text">RSS</span></a>
				</li>
				<li>
					<a target="_blank" href="mailto:bspa@behavioralpolicy.org"><i class="fa fa-envelope-o"></i><span class="screen-reader-text">Email</span></a>
				</li>
			</ul>
		</div>
	</div>
    <header role="banner">
		<div class="container">
	        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="logo"><?php bloginfo( 'name' ); ?></a>
			<a class="nav-toggle" href="#"><span></span></a>
	        <nav role="navigation">
	            <?php
	                $args = array(
						'menu' => 'Main Nav',
	                    'container' => false,
	                    'items_wrap' => '<ul>%3$s</ul>',
	                    );
	                wp_nav_menu($args);
	            ?>
	        </nav>
		</div>
    </header>
