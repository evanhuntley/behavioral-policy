<?php
/*
    Template Name: Events Page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page about" id="post-<?php the_ID(); ?>">

        <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="container">
                <h1>spotlights &amp; events</h1>
                <?php echo types_render_field("page-short-description"); ?>
            </div>
        </div>

        <div class="primary container">
            <?php get_sidebar(); ?>
            <section class="content">
                <div class="event-featured">
                    <h1>Featured</h1>
                    <div class="featured-content">
                        <h2><?= types_render_field("event-feature-title"); ?></h2>
                        <?= types_render_field("event-feature-description"); ?>
                        <a class="button alt" href="<?= types_render_field("event-feature-url"); ?>"><?= types_render_field("event-feature-link-text"); ?></a>
                    </div>
                </div>
                <div class="calendar">
                    <h1>Calendar</h1>
                    <?php
                        $args = array(
                            'post_type' => 'bspa-events',
                            'posts_per_page' => -1
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
                            ?>
                                <li class="event">
                                    <div class="event-date">
                                        <span class="weekday"><?= $weekday; ?></span>
                                        <span class="month"><?= $month; ?></span>
                                        <span class="day"><?= $day; ?></span>
                                    </div>
                                    <div class="event-details">
                                        <h2><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <div class="location"><?= $location; ?></div>
                                        <?= $date; ?>
                                    </div>
                                    <div class="description">
                                        <?php the_content(); ?>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </section>
        </div>

        <div id="conference">
            <div class="container">
                <h1>BSPA Annual Conference</h1>
            </div>
        </div>

        <div id="spotlights">
            <div class="container">
                <h1>Spotlights Workshops</h1>
            </div>
        </div>

        <div id="highlights">
            <div class="container primary">
                <div class="content">
                <h1>Event Highlights</h1>
                <?php
                    $args = array(
                        'post_type' => 'event-highlights',
                        'posts_per_page' => -1
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
                                <a href="<?= $vid_url; ?>" data-lity><img src="<?= the_post_thumbnail_url('event-highlight'); ?>" /></a>
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

        <div class="billboard center" id="event-notifications">
            <div class="container">
                <h1>Sign Up for Early Bird Notifications of Our Events</h1>
            </div>
        </div>

        <div class="billboard center light join">
            <div class="container">
                <h2>Become a Member</h2>
                <p>There is a growing movement among public and private sector leaders to help bridge the divide between behavioral research and policy. We are a key part of this movement — as an information hub and as a community builder, fostering collaboration and connecting those applying behavioral science to specific problems for the greater good. We need you to join us in making this effort have a lasting impact.</p>
                <a href="https://behavioralpolicy.org/signup" class="button">Join Us</a>
            </div>
        </div>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
