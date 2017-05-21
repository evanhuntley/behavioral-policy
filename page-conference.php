<?php
/*
    Template Name: Annual Conference Page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page annual-conference" id="post-<?php the_ID(); ?>">

        <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="container">
                <h1>BSPA Annual Conference</h1>
                <?php echo types_render_field("page-short-description"); ?>
            </div>
        </div>

        <?php 
            $month = types_render_field("upcoming-conference-date", array("format" => "M"));
            $day = types_render_field("upcoming-conference-date", array("format" => "d"));
            $year = types_render_field("upcoming-conference-date", array("format" => "Y"));
        ?>

        <div class="primary container">
            <section class="content">
                <?php if ($month) : ?>
                    <div class="event-date">
                        <span class="month"><?= $month; ?></span>
                        <span class="day"><?= $day; ?></span>
                        <span class="year"><?= $year; ?></span>
                    </div>
                    <h1><?php echo types_render_field("upcoming-conference-title"); ?></h1>
                    <?php echo types_render_field("upcoming-conference-desc"); ?>
                <?php endif; ?>
                <hr />
                <div class="about-conference">
                    <h2>About the BSPA Annual Conference</h2>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/g_conference.png" alt="BSPA Conference" />
                    <?php the_content(); ?>
                </div>
                <hr />
                <h3>Check out Photos, Videos and More from Our Past Conferences</h3>
                <?php // loop through events, tax query for conference, check dates, display buttons ?>
                <?php 
                    $args = array(
                        'post_type' => 'bspa-events',
                        'posts_per_page' => -1,
                        'meta_query' => array(
                            array(
                                'key'	  	=> 'wpcf-event-date',
                                'value'	  	=> time(),
                                'compare' 	=> '<',
                            )
                        ),
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'event-types',
                                'field'    => 'slug',
                                'terms'    => 'conference',
                            ),
                        )
                    );

                    $events = new WP_Query( $args);

                    while ( $events->have_posts() ) : $events->the_post(); 
                ?>
                    <a class="button" href="<?php echo get_the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                <?php endwhile; ?>
            </div>
            </section>
        </div>

        <?php get_template_part('billboard', 'join') ?>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
