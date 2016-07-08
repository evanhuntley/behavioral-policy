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
        <div class="flexslider">
            <ul class="slides">
                <?php
                    $args = array(
                        'post_type' => 'slides',
                        'posts_per_page' => 3
                    );
                    $slides = new WP_Query( $args);

                    while ( $slides->have_posts() ) : $slides->the_post();

                    $simple = types_render_field('simple-centered', array("raw" => true));
                    $simple = $simple == 1 ? 'simple' : '';
                ?>
                <li class="<?= $simple; ?>" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
                    <div class="slide-content">
                        <h1><?php the_title(); ?></h1>
                    </div>
                </li>
                <?php endwhile; wp_reset_query(); ?>
            </ul>
        </div>
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
