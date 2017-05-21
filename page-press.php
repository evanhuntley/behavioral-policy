<?php
/*
    Template Name: Press Page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page press" id="post-<?php the_ID(); ?>">

        <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="container">
                <h1>Press</h1>
                <?php echo types_render_field("page-short-description"); ?>
            </div>
        </div>
        
        <div class="press-kit">
            <h2>Press Kit</h2>
            <a class="button" href="<?= types_render_field('press-kit', array('raw' => true)); ?>"><i class="fa fa-arrow-circle-down"></i> Download Press Kit</a>
        </div>

        <div class="primary container">
            <div class="in-the-news">
                <h2>In the News</h2>
                <?= types_render_field("press-in-the-news"); ?>
            </div>
            <div class="press-releases">
                <h2>Press Releases</h2>
                <?= types_render_field("press-releases"); ?>
            </div>
        </div>
        
        <div class="media">
            <h1>Media Contact</h1>
            <?= types_render_field("media-contact"); ?>
        </div>
        
    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
