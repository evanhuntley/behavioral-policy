<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page" id="post-<?php the_ID(); ?>">
        <header class="section-header">
            <h1><?php the_title(); ?></h1>
        </header>

        <div class="primary container">
            <section class="content">
                <?php the_content(); ?>
            </section>
            <?php get_sidebar(); ?>
        </div>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
