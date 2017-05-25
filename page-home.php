<?php
/*
    Template Name: Home Page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page" id="post-<?php the_ID(); ?>">
        <div class="flexslider">
            <ul class="slides">
                <?php
                    $args = array(
                        'post_type' => 'slides',
                        'posts_per_page' => -1,
                        'order' => 'ASC'
                    );
                    $slides = new WP_Query( $args);

                    while ( $slides->have_posts() ) : $slides->the_post();

                    $simple = types_render_field('simple-centered', array("raw" => true));
                    $simple = $simple == 1 ? 'simple' : '';

                    $dark = types_render_field('dark-look', array("raw" => true));
                    $dark = $dark == 1 ? 'dark' : '';
                    
                    $blue = types_render_field('slide-blue-button', array("raw" => true));
                    $blue = $blue == 1 ? 'alt' : '';

                    $button_text = types_render_field('slide-button-text', array("raw" => true));
                    $button_url = types_render_field('slide-button-url', array("raw" => true));
                ?>
                <li class="<?= $simple; ?> <?= $dark; ?>" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
                    <div class="slide-content">
                        <h1><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                        <?php if ($button_text && $button_url) : ?>
                            <a class="button <?= $blue; ?>" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a>
                        <?php endif; ?>
                    </div>
                </li>
                <?php endwhile; wp_reset_query(); ?>
            </ul>
        </div>
        <div class="goals">
            <div class="home-callout">
                <div class="callout-header">
                    <h2>Accelerating Knowledge</h2>
                </div>
                <div class="callout-content">
                    <p>Promoting the dissemination of behavioral science insights</p>
                </div>
            </div>
            <div class="home-callout second">
                <div class="callout-header">
                    <h2>Community Building</h2>
                </div>
                <div class="callout-content">
                    <p>Convening communities and dialogues that promote the accessibility of social and behavioral science to policymakers and other practitioners</p>
                </div>
            </div>
            <div class="home-callout third">
                <div class="callout-header">
                    <h2>Translating Behavioral Science</h2>
                </div>
                <div class="callout-content">
                    <p>Reviewing and interpreting state of the art research concerning practically relevant scientific knowledge for non-experts</p>
                </div>
            </div>
        </div>
        <div class="cards">
            <div class="container">
                <div class="flip-cards">
                    <?= types_render_field('home-flip-cards'); ?>
                </div>
            </div>
        </div>
        <div class="billboard center twitter">
            <div class="container">
                <h2>Our Favorite Tweets This Week</h2>
                <div class="row">
                    <div class="tweet">
                        <?= ot_get_option('weekly_tweet_1'); ?>
                    </div>
                    <div class="tweet">
                        <?= ot_get_option('weekly_tweet_2'); ?>
                    </div>
                    <div class="tweet">
                        <?= ot_get_option('weekly_tweet_3'); ?>
                    </div>
                    <div class="tweet">
                        <?= ot_get_option('weekly_tweet_4'); ?>
                    </div>
                </div>
                <div class="follow">
                    <h2><i class="fa fa-twitter"></i> Follow us and share your stories</h2>
                    <p>We love feedback and want to hear from you! Whether you are interested in contributing stories or have a tweet that you want us to highlight, please email us at <a href="mailto:bspa@behavioralpolicy.org">bspa@behavioralpolicy.org</a></p>
                    <a target="_blank" href="https://twitter.com/BeSciPol" class="button alt">Follow us</a>
                </div>
            </div>
        </div>
        <?php get_template_part('billboard', 'bsp') ?>
        <?php get_template_part('billboard', 'subscribe') ?>
        <?php get_template_part('billboard', 'join') ?>

    </article>
<?php endwhile; ?>

<div class="popup lity-hide">
    <h1>Get Closer to Cutting Edge Research</h1>
    <p>Sign up for highlights of the latest behavioral science research from around the world</p>
    <p><strong>Join the Community Today</strong></p>
    <?php echo do_shortcode('[gravityform id="4" title="false" description="false" ajax="true"]'); ?>
</div>

<?php get_footer(); ?>
