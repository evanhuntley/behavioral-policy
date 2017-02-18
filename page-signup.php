<?php
/*
    Template Name: Signup Page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page signup" id="post-<?php the_ID(); ?>">

        <div class="subsription-options">
            <div class="container">
                
            </div>
        </div>
        
        <div class="subsription-options">
            <div class="container">
                <h2>BSP Subscription Options (Non-Member)</h2>
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
        </div>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
