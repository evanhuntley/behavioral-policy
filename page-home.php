<?php
/*
    Template Name: Home Page
*/

    $tweet_1 = types_render_field("home-tweet-1", array("raw" => true));
    $tweet_2 = types_render_field("home-tweet-2", array("raw" => true));
    $tweet_3 = types_render_field("home-tweet-3", array("raw" => true));
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page" id="post-<?php the_ID(); ?>">

        <div class="billboard twitter">
            <div class="container">
                <h2>Our Favorite Tweets This Week</h2>
                <div class="row">
                    <div class="tweet">
                        <?= $tweet_1; ?>
                    </div>
                    <div class="tweet">
                        <?= $tweet_2; ?>
                    </div>
                    <div class="tweet">
                        <?= $tweet_3; ?>
                    </div>
                </div>
            </div>
        </div>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
