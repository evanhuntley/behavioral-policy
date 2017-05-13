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
                        'posts_per_page' => -1,
                        'order' => 'ASC'
                    );
                    $slides = new WP_Query( $args);

                    while ( $slides->have_posts() ) : $slides->the_post();

                    $simple = types_render_field('simple-centered', array("raw" => true));
                    $simple = $simple == 1 ? 'simple' : '';

                    $dark = types_render_field('dark-look', array("raw" => true));
                    $dark = $dark == 1 ? 'dark' : '';

                    $button_text = types_render_field('slide-button-text', array("raw" => true));
                    $button_url = types_render_field('slide-button-url', array("raw" => true));
                ?>
                <li class="<?= $simple; ?> <?= $dark; ?>" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
                    <div class="slide-content">
                        <h1><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                        <?php if ($button_text && $button_url) : ?>
                            <a class="button" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a>
                        <?php endif; ?>
                    </div>
                </li>
                <?php endwhile; wp_reset_query(); ?>
            </ul>
        </div>
        <div class="goals">
            <div class="container">
                <div class="block">
                    <div class="home-callout">
                        <h2>Accelerating Knowledge</h2>
                        <p>Promoting the dissemination of behavioral science insights</p>
                    </div>
                    <ul>
                        <li><a href="/journal/#_current">BSP</a></li>
                        <li><a href="/jobs-and-calls">Jobs &amp; Calls</a></li>
                        <li><a href="/jobs-and-calls#matchmaker">Matchmaker</a></li>
                        <li><a href="/blog">PolicyShop</a></li>
                        <li><a href="#">Reports Corner (Coming Soon!)</a></li>
                    </ul>
                </div>
                <div class="block">
                    <div class="home-callout second">
                        <h2>Community Building</h2>
                        <p>Convening communities and dialogues that promote the accessibility of social and behavioral science to policymakers and other practitioners.</p>
                    </div>
                    <ul>
                        <li><a href="/events">Annual Conferences</a></li>
                        <li><a href="/events/#_spotlight">Spotlight Workshops</a></li>
                    </ul>
                </div>
                <div class="block">
                    <div class="home-callout third">
                        <h2>Translating Behavioral Science</h2>
                        <p>Reviewing and interpreting state of the art research concerning practically relevant scientific knowledge for non-experts</p>
                    </div>
                    <ul>
                        <li><a href="#">BSPA Archive (Coming soon!)</a></li>
                        <li><a href="#">Workgroup taskforces (Behavioral Science &amp; Policy Series)</a></li>
                    </ul>
                </div>
            </div>
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
                <div class="follow">
                    <h2><i class="fa fa-twitter"></i> Follow us and share your stories</h2>
                    <p>We love feedback and want to hear from you! Whether you are interested in contributing stories or have a tweet that you want us to highlight, please email us at <a href="mailto:bspa@behavioralpolicy.org">bspa@behavioralpolicy.org</a></p>
                    <a href="https://twitter.com/BeSciPol" class="button alt">Follow us</a>
                </div>
            </div>
        </div>
        <?php get_template_part('billboard', 'bsp') ?>
        <?php get_template_part('billboard', 'subscribe') ?>
        <?php get_template_part('billboard', 'join') ?>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
