<?php
/*
    Template Name: Journal Issues
*/
?>

<?php get_header(); ?>

    <article role="main" class="page type-page" id="post-<?php the_ID(); ?>">
        
        <div class="page-header" style="background-image: url('/wp-content/uploads/2017/01/bg_home-bsp.jpg');">
            <div class="container">
                <h1><?php single_term_title(); ?></h1>
                <p><?php echo term_description(); ?></p>
            </div>
        </div>

        <div class="primary container">
            <section class="content">
                <div class="editors">
                    <h2>Journal Issues</h2>                 
                </div>
            </section>
            <?php get_sidebar(); ?>
        </div>
    </article>

<?php get_footer(); ?>
