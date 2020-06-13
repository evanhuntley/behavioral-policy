<?php

add_theme_support( 'menus' );

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => __( 'Sidebar' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside>',
		'after_widget' => '</aside>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

add_post_type_support('page', 'excerpt');

function post_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>

			<p class="comment-meta">
				<?php printf( __( '%s' ), sprintf( '%s', get_comment_author_link() ) ); ?>

                <a class="comment-date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                    <?php printf( __( '%1$s' ), get_comment_date() ); ?>
                </a>

                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
                <?php endif; ?>
            </p>
		</div>

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
	</div>

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>

	<li class="post pingback">
		<p><?php _e( 'Pingback:' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)' ), ' ' ); ?></p>
	<?php

		break;
	endswitch;
}

// Custom functions

// Tidy up the <head> a little. Full reference of things you can show/remove is here: http://rjpargeter.com/2009/09/removing-wordpress-wp_head-elements/
remove_action('wp_head', 'wp_generator');// Removes the WordPress version as a layer of simple security

add_theme_support('post-thumbnails');

// REMOVE EXTRANEOUS CLASSES FROM WORDPRESS MENUS - siteart.co.uk/remove-extraneous-classes-from-wordpress-menus
function custom_wp_nav_menu($var) {
        return is_array($var) ? array_intersect($var, array(
                // List of useful classes to keep
                'current_page_item',
                'current_page_parent',
                'current_page_ancestor',
				'menu-item-has-children'
                )
        ) : '';
}
add_filter('nav_menu_css_class', 'custom_wp_nav_menu');
add_filter('nav_menu_item_id', 'custom_wp_nav_menu');
add_filter('page_css_class', 'custom_wp_nav_menu');

// REPLACE "current_page_" WITH CLASS "active"
function current_to_active($text){
        $replace = array(
                // List of classes to replace with "active"
                'current_page_item' => 'active',
                'current_page_parent' => 'active',
                'current_page_ancestor' => 'active',
        );
        $text = str_replace(array_keys($replace), $replace, $text);
                return $text;
        }
add_filter ('wp_nav_menu','current_to_active');

// Custom Image Sizes
add_action( 'after_setup_theme', 'bp_theme_setup' );
function bp_theme_setup() {
  add_image_size( 'person', 200, 250, true ); // (cropped)
  add_image_size( 'bio-thumb', 220, 161, true ); // (cropped)
  add_image_size( 'bio-large', 576, 863, false );
  add_image_size( 'news-item', 302, 170, true); // (cropped)
  add_image_size( 'event-highlight', 500, 281, true); // (cropped)
  add_image_size('promo', 846, 360, true); // (cropped)
}

// Menu Meta Box
function custom_meta_box_markup($object)
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    ?>
        <div>
			<p><strong>Menu</strong></p>
            <label class="screen-reader-text" for="meta-box-dropdown">Menu</label>
            <select name="meta-box-dropdown">
				<option>-- Inherit --</option>
				<?php
					$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

					foreach ( $menus as $menu ) {

						if ( $menu->name == get_post_meta($object->ID, "meta-box-dropdown", true))
						{
						    ?>
						        <option selected><?php echo $menu->name; ?></option>
						    <?php
						}
						else {
							?>
						        <option><?php echo $menu->name; ?></option>
						    <?php
						}
					}
				?>
				<option>-- None --</option>
            </select>
        </div>
    <?php
}

function add_custom_meta_box()
{
    add_meta_box("demo-meta-box", "Subnavigation", "custom_meta_box_markup", "page", "side", "low", null);
}

add_action("add_meta_boxes", "add_custom_meta_box");

function save_custom_meta_box($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "page";
    if($slug != $post->post_type)
        return $post_id;

    $meta_box_dropdown_value = "";

    if(isset($_POST["meta-box-dropdown"]))
    {
        $meta_box_dropdown_value = $_POST["meta-box-dropdown"];
    }
    update_post_meta($post_id, "meta-box-dropdown", $meta_box_dropdown_value);
}

add_action("save_post", "save_custom_meta_box", 10, 3);


// Custom Query Vars for Paper Filters
function custom_query_vars_filter($vars) {
  $vars[] = 'jobs-cat';
  $vars[] = 'calls-cat';
  $vars[] = 'sortby';
  return $vars;
}
add_filter( 'query_vars', 'custom_query_vars_filter' );

// Custom Query Vars for Paper Filters
function custom_article_vars_filter($vars) {
  $vars[] = 'sortby';
  return $vars;
}
add_filter( 'query_vars', 'custom_article_vars_filter' );

// Button Shortcode
// [button text="Words" url="URL" color="blue"]
function button_func( $atts ) {

	$a = shortcode_atts( array(
	    'text' => 'Button',
	    'url' => '/',
		'color' => 'orange',
		'new-window' => false
	), $atts );

	$a['color'] == 'blue' ? $class = 'alt' : $class = '';

	$new = ($a['new-window'] == true) ? ' target="_blank" ' : '';

	$button = '<a' . $new . ' href="' . $a['url'] . '" class="button shortcode ' . $class . '">' . $a['text'] . '</a>';
	return $button;
}
add_shortcode( 'button', 'button_func' );


// Event Highlight Shortcode
// [recording id="#"]
function recording_func( $atts ) {

	$a = shortcode_atts( array(
	    'id' => '#',
	), $atts );
	
	$args = array(
		'post_type' => 'event-highlights',
		'p' => $a['id']
	);

	$recordings = new WP_Query( $args);	
	
	while ( $recordings->have_posts() ) : $recordings->the_post();
		$vid_url = types_render_field('event-highlight-vimeo-url', array("raw" => true));
		$recording .= '<li>';
		$recording .= '<a href="' . $vid_url .'" data-lity>';
		$recording .= '<img src="' . get_the_post_thumbnail_url($post->ID, 'event-highlight') . '" />';
		$recording .= '<svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/svg/sprite.svg#video"></use></svg></a>';
		$recording .= '<h3><a href="' . $vid_url . '" data-lity>' . get_the_title() . '</a></h3>';
		$recording .= '<div class="description">' . types_render_field('event-highlight-short-description') . '</div>';
		$recording .= '</li>';	
	endwhile;
	return $recording;
}
add_shortcode( 'recording', 'recording_func' );

// Blog Star Block Shortcode
// [starblock]Stuff Here[/starblock]
function starblock_func( $atts, $content = null ) {

	return '<div class="star-block"><span class="star-white"></span><span class="star-grey"></span>' . $content . '</div>';

}
add_shortcode( 'starblock', 'starblock_func' );

// Blog Tag Block Shortcode
// [tagblock]Stuff Here[/tagblock]
function tagblock_func( $atts, $content = null ) {

	return '<div class="tag-block"><span class="tag-icon"></span>' . $content . '</div>';

}
add_shortcode( 'tagblock', 'tagblock_func' );

// Date Shortcode
// [bigdate day="19" month="Sept" year="2017"]
function bigdate_func( $atts ) {

	$a = shortcode_atts( array(
	    'day' => '01',
	    'month' => 'Jan',
		'year' => '2017'
	), $atts );

	$bigdate = '<div class="bigdate"><span class="month">' . $a['month'] . '</span><span class="day">' . $a['day'] . '</span><span class="year">' . $a['year'] . '</span></div>';
	return $bigdate;
}
add_shortcode( 'bigdate', 'bigdate_func' );

// News Query
function news_query($cat) {

	$args = array(
		'post_type' => 'news',
		'posts_per_page' => 3,
		'orderby' => 'date',
		'order' => 'DESC',
		'tax_query' => array(
			array(
				'taxonomy' => 'news-category',
				'field'    => 'slug',
				'terms'    => $cat,
			),
		)
	);

	return new WP_Query($args);
}

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wpdocs_excerpt_more( $more ) {
    return sprintf( '<a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( 'Read More', 'textdomain' )
    );
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

// Disable Autofill on Gravityforms
add_filter( 'gform_form_tag', 'gform_form_tag_autocomplete', 11, 2 );
function gform_form_tag_autocomplete( $form_tag, $form ) {
	if ( is_admin() ) return $form_tag;
	if ( GFFormsModel::is_html5_enabled() ) {
		$form_tag = str_replace( '>', ' autocomplete="off">', $form_tag );
	}
	return $form_tag;
}
add_filter( 'gform_field_content', 'gform_form_input_autocomplete', 11, 5 );
function gform_form_input_autocomplete( $input, $field, $value, $lead_id, $form_id ) {
	if ( is_admin() ) return $input;
	if ( GFFormsModel::is_html5_enabled() ) {
		$input = preg_replace( '/<(input|textarea)/', '<${1} autocomplete="off" ', $input );
	}
	return $input;
}

// Remove Unneeded Emoji stuff
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Remove comment-reply.min.js from footer
function eh_clean_header_hook(){
	wp_deregister_script( 'comment-reply' );
         }
add_action('init','eh_clean_header_hook');

add_filter( 'gform_init_scripts_footer', '__return_true' );

add_filter( 'gform_field_validation_15_20', 'custom_validation', 10, 4 );
function custom_validation( $result, $value, $form, $field ) {
 
    if ( $result['is_valid'] && $value != 'RWJFDuke' ) {
        $result['is_valid'] = false;
        $result['message'] = 'Hmm... That code isn\'t right... try again.';
    }
    return $result;
}

/**
 * Order posts by the last word in the post_title. 
 * Activated when orderby is 'wpse_last_word' 
 * @link https://wordpress.stackexchange.com/a/198624/26350
 */
add_filter( 'posts_orderby', function( $orderby, \WP_Query $q )
{
    if( 'wpse_last_word' === $q->get( 'orderby' ) && $get_order =  $q->get( 'order' ) )
    {
        if( in_array( strtoupper( $get_order ), ['ASC', 'DESC'] ) )
        {
            global $wpdb;
            $orderby = " SUBSTRING_INDEX( {$wpdb->posts}.post_title, ' ', -1 ) " . $get_order;
        }
    }
    return $orderby;
}, PHP_INT_MAX, 2 );

?>
