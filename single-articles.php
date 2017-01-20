<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="page single-article" id="post-<?php the_ID(); ?>">
        <div class="page-header">
            <div class="container">
                <h1>BSP LOGO</h1>
                <?php //echo types_render_field("page-short-description"); ?>
            </div>
        </div>

        <div class="primary container">
            <section class="content">
                <h1><?php the_title(); ?></h1>
                <div class="authors">
                    <?php
                        echo 'by ' . types_render_field('article-author', array("separator" => ", "));
                    ?>
                </div>
                <div class="options">
                    <a href="<?php echo types_render_field('article-file', array("raw" => true)); ?>" class="download" title="Download">
                        <i class="fa fa-download"></i>
                    </a>
                </div>
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php get_the_title(); ?>" />
                <div class="article-content">
                    <?php the_content(); ?>
                </div>
            </section>
        </div>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
