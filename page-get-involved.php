<?php
/*
    Template Name: Get Involved Page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page get-involved" id="post-<?php the_ID(); ?>">

        <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="container">
                <h1>Get Involved</h1>
                <?php echo types_render_field("page-short-description"); ?>
            </div>
        </div>

        <div class="primary container">
            <?php get_sidebar(); ?>
            <section class="content">
                <div class="cards">
                    <?= types_render_field('gi-flip-cards'); ?>
                </div>
                <?php the_content(); ?>
            </section>
        </div>
        
        <div class="billboard center light">
            <div class="container">
                <h2>Careers</h2>
                <p><?= types_render_field('gi-careers-blurb'); ?></p>
            </div>
        </div>
        
        <div class="careers container" id="careers">
            <div class="content">
                <?= types_render_field('gi-careers-content'); ?>
            </div>
        </div> 

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
