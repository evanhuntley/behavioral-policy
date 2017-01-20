
<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="page publications" id="post-<?php the_ID(); ?>">

        <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="container">
                <?php
                    $date = types_render_field("event-date", array("format" => "M j, Y"));
                    $weekday = types_render_field("event-date", array("format" => "D"));
                    $month = types_render_field("event-date", array("format" => "M"));
                    $day = types_render_field("event-date", array("format" => "d"));
                    $location = types_render_field("event-location", array("raw" => true));
                ?>
                <div class="date">
                    <?php echo $month; ?>
                    <?php echo $day; ?>
                </div>
                <h1><?php the_title(); ?></h1>
                <div class="location">
                    <?php echo $location; ?>
                </div>
            </div>
        </div>

        <div class="primary container">
            <?php get_sidebar(); ?>
            <section class="content">

            </section>
        </div>

        <?php get_template_part('billboard', 'conference') ?>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
