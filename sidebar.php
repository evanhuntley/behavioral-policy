
<section role="complementary" class="secondary-content">
    <?php if ( get_post_type() == 'page') {
        $post_ID = $post->ID;
        $menu = get_post_meta( get_the_ID(), 'meta-box-dropdown', true );
        if ( $menu && ($menu != '-- None --') && !is_search() ) {
            echo '<nav class="subnav">';
            if ( $menu == '-- Inherit --') {
                $parent_id = wp_get_post_parent_id( $post_ID );
                $new_menu = get_post_meta( $parent_id, 'meta-box-dropdown', true );

                while ( $new_menu == '-- Inherit --') {
                    $parent_id = wp_get_post_parent_id( $parent_id );
                    $new_menu = get_post_meta( $parent_id, 'meta-box-dropdown', true );
                }

                if ( $new_menu != '-- None --') {
                    wp_nav_menu( array('menu' => $new_menu, 'container' => ''));
                }

            } else {
                wp_nav_menu( array('menu' => $menu, 'container' => ''));
            }
            echo '</nav>';
        }
    }
    ?>
    
    <?php 
        if (is_page('events')) : 
    ?>
        <div class="events-event-highlights">
            <h3>Event Highlights</h3>
        <?php
            $args = array(
                'post_type' => 'event-highlights',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'DESC',
                'meta_query' => array(
                    array(
                        'key'	  	=> 'wpcf-event-highlight-featured',
                        'value'	  	=> '1',
                        'compare' 	=> '=',
                    )
                ),
            );

            $event_highlights = new WP_Query( $args);

            if ( $event_highlights->have_posts() ) :
        ?>
            <ul class="event-highlight-list">
                <?php while ( $event_highlights->have_posts() ) : $event_highlights->the_post(); ?>
                    <li>
                        <?php
                            $vid_url = types_render_field('event-highlight-vimeo-url', array("raw" => true));
                        ?>
                        <a href="<?= $vid_url; ?>" data-lity>
                            <img src="<?= the_post_thumbnail_url('event-highlight'); ?>" />
                            <svg class="icon">
                                <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/svg/sprite.svg#video"></use>
                            </svg>
                        </a>
                        <h3><a href="<?= $vid_url; ?>" data-lity><?php the_title(); ?></a></h3>
                        <div class="description">
                            <?php echo types_render_field('event-highlight-short-description'); ?>
                        </div>
                    </li>
                <?php endwhile; wp_reset_query(); ?>
            </ul>
        <?php endif; ?>    
        </div>
    <?php endif; ?>
    
    <?php
        if (is_post_type_archive('articles')) {
            echo '<h2>Search Archive</h2>';
            //echo do_shortcode('[searchandfilter id="13596"]');
            echo do_shortcode('[searchandfilter id="13950"]');
        }
     ?>
</section>
