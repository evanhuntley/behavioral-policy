<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page" id="post-<?php the_ID(); ?>">
        <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="container">
                <h1><?php the_title(); ?></h1>
                <?php echo types_render_field("page-short-description"); ?>
            </div>
        </div>

        <div class="primary container">
            <section class="content">
                <?php the_content(); ?>
            </section>
            <?php get_sidebar(); ?>
        </div>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
