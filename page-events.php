<?php
/*
    Template Name: Events Page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page events" id="post-<?php the_ID(); ?>">

        <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="container">
                <h1>spotlights &amp; events</h1>
                <?php echo types_render_field("page-short-description"); ?>
            </div>
        </div>

        <div class="primary container">
            <?php get_sidebar(); ?>
            <section class="content">
                <!-- <div class="calendar" id="calendar">
                    <h1>Calendar</h1>
                    <?php
                        $args = array(
                            'post_type' => 'bspa-events',
                            'posts_per_page' => -1,
                            'orderby' => 'meta_value',
                            'meta_key'  => 'wpcf-event-date',
                            'order' => 'ASC',
                            'meta_query' => array(
                                array(
                                    'key' => 'wpcf-event-date',
                                    'value' => time(),
                                    'compare' => '>='
                                )
                            )                            
                        );

                        $events = new WP_Query( $args);

                        if ( $events->have_posts() ) :
                    ?>
                        <ul class="events-list">
                            <?php while ( $events->have_posts() ) : $events->the_post();

                                $date = types_render_field("event-date", array("format" => "M j, Y"));
                                $weekday = types_render_field("event-date", array("format" => "D"));
                                $month = types_render_field("event-date", array("format" => "M"));
                                $day = types_render_field("event-date", array("format" => "d"));
                                $location = types_render_field("event-location", array("raw" => true));
                                
                                $terms = get_the_terms($post->ID, 'event-types');
                                if ($terms) {
                                    $term = array_shift( $terms );
                                    $type = $term->slug;
                                }
                            ?>
                                <li class="event <?= $type; ?>">
                                    <div class="event-date">
                                        <span class="weekday"><?= $weekday; ?></span>
                                        <span class="month"><?= $month; ?></span>
                                        <span class="day"><?= $day; ?></span>
                                    </div>
                                    <div class="event-details">
                                        <?php if (types_render_field('event-external-url')) : ?>
                                            <h2><a target="_blank" href="<?php echo types_render_field('event-external-url', array("raw" => true)); ?>"><?php the_title(); ?></a></h2>
                                        <?php else : ?>
                                            <h2><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h2>    
                                        <?php endif; ?>
                                        <div class="location"><?= $location; ?></div>
                                        <?= $date; ?>
                                    </div>
                                    <div class="description">
                                        <?php the_content(); ?>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; wp_reset_query(); ?>
                </div> -->
                <h1>BSPA Annual Conference</h1>
                <?= types_render_field("events-annual-conference"); ?>
                
            </section>
        </div>

        <div class="events-page-spotlight" id="spotlight">
            <div class="container">
                <div class="content">
                    <h1>Spotlight Workshops</h1>
                    <?= types_render_field("events-spotlights-workshops"); ?>
                </div>
            </div>
        </div>

        <div class="events-event-highlights" id="event-highlights">
            <div class="container primary">
                <div class="content">
                <h1>Event Highlights</h1>
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
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
            </div>
        </div>

        <?php //get_template_part('billboard', 'notifications') ?>
        <?php get_template_part('billboard', 'join') ?>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
