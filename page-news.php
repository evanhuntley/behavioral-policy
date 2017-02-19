<?php
/*
Template Name: News Page
*/
?>

<?php get_header(); ?>

    <article role="main" class="page news" id="post-<?php the_ID(); ?>">

        <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="container">
                <h1>News &amp; Media</h1>
                <?php echo types_render_field("page-short-description"); ?>
            </div>
        </div>

        <div class="primary">
            <div class="container">
                <?php get_sidebar(); ?>
                <section class="content" id="news">
                    <h1 class="feature-heading">News</h1>
                    <ul class="featured-item">
                    <?php
                    $args = array(
                        'post_type' => 'news',
                        'posts_per_page' => 1,
                        'order' => 'RAND',
                        'meta_query' => array(
                            array(
                                'key'	  	=> 'wpcf-news-featured',
                                'value'	  	=> "1",
                                'compare' 	=> '=',
                            )
                        ),
                    );

                    $featured_news = new WP_Query($args);

                    if ($featured_news->have_posts()) :
                        ?>
                        <?php while ( $featured_news->have_posts() ) : $featured_news->the_post(); ?>
                            <?php get_template_part('loop', 'newsitem') ?>
                        <?php endwhile;  ?>
                    <?php endif; wp_reset_query(); ?>
                </ul>
                </section>
            </div>
        </div>

        <div class="news-section container">
            <div class="content">
                <h2>In the News</h2>
                <?php
                $in_the_news = news_query('in-the-news');

                if ($in_the_news->have_posts()) :
                    ?>
                    <ul>
                        <?php while ( $in_the_news->have_posts() ) : $in_the_news->the_post(); ?>
                            <?php get_template_part('loop', 'newsitem') ?>
                        <?php endwhile;  ?>
                    </ul>
                <?php endif; wp_reset_query(); ?>
                    <a class="more-link" href="/news-category/in-the-news">See All</a>
                <h2>Policy Making</h2>
                <?php
                $policy = news_query('policy-making');

                if ($policy->have_posts()) :
                    ?>
                    <ul>
                        <?php while ( $policy->have_posts() ) : $policy->the_post(); ?>
                            <?php get_template_part('loop', 'newsitem') ?>
                        <?php endwhile;  ?>
                    </ul>
                <?php endif; wp_reset_query(); ?>
                    <a class="more-link" href="/news-category/policy-making">See All</a>
                <h2>BSPA in the News</h2>
                <?php
                $bsp_itn = news_query('bspa-in-the-news');

                if ($bsp_itn->have_posts()) :
                    ?>
                    <ul>
                        <?php while ( $bsp_itn->have_posts() ) : $bsp_itn->the_post(); ?>
                            <?php get_template_part('loop', 'newsitem') ?>
                        <?php endwhile;  ?>
                    </ul>
                <?php endif; wp_reset_query(); ?>
                <a class="more-link" href="/news-category/bspa-in-the-news">See All</a>
            </div>
        </div>

        <?php get_template_part('billboard', 'in-action') ?>

        <div class="reports container" id="reports">
            <div class="content">
                <h2>Reports Corner</h2>
                <div class="reports-details">
                    <?= types_render_field('reports-corner-text'); ?>
                </div>
                <?php
                $reports = news_query('reports');

                if ($reports->have_posts()) :
                    ?>
                    <ul class="report-list">
                        <?php while ( $reports->have_posts() ) : $reports->the_post(); ?>
                            <li>
                                <img class="thumb" src="<?php echo the_post_thumbnail_url('event-highlight'); ?>" alt="<?php the_title(); ?>">
                                <div class="item-details">
                                    <h3><?php the_title(); ?></h3>
                                    <?= types_render_field('news-short-description'); ?>
                                    <img class="org" src="<?php echo types_render_field('report-organization-logo', array("raw" => true)); ?>" alt="<?php types_render_field('report-organization-name', array("raw" => true)); ?>">
                                </div>
                            </li>
                        <?php endwhile;  ?>
                    </ul>
                <?php endif; wp_reset_query(); ?>
            </div>
        </div>

        <div id="new-to-bsp">
            <?php get_template_part('billboard', 'new-to-bsp') ?>
        </div>

        <div class="news-section container">
            <div class="content">
                <h2>Recommended Reading</h2>
                <?php
                $reading = news_query('recommended-reading');

                if ($reading->have_posts()) :
                    ?>
                    <ul>
                        <?php while ( $reading->have_posts() ) : $reading->the_post(); ?>
                            <?php get_template_part('loop', 'newsitem') ?>
                        <?php endwhile;  ?>
                    </ul>
                <?php endif; wp_reset_query(); ?>
                <a class="more-link" href="/news-category/recommended-reading">See All</a>

                <h2>Free Resources</h2>
                <?php
                $free = news_query('free-resources');

                if ($free->have_posts()) :
                    ?>
                    <ul>
                        <?php while ( $free->have_posts() ) : $free->the_post(); ?>
                            <?php get_template_part('loop', 'newsitem') ?>
                        <?php endwhile;  ?>
                    </ul>
                <?php endif; wp_reset_query(); ?>
                <a class="more-link" href="/news-category/free-resources">See All</a>
                
                <h2>Exec Ed/Continuing Professional Development</h2>
                <?php
                $exec = news_query('exec-ed');

                if ($exec->have_posts()) :
                    ?>
                    <ul>
                        <?php while ( $exec->have_posts() ) : $exec->the_post(); ?>
                            <?php get_template_part('loop', 'newsitem') ?>
                        <?php endwhile;  ?>
                    </ul>
                <?php endif; wp_reset_query(); ?>
                <a class="more-link" href="/news-category/exec-ed">See All</a>
            </div>
        </div>

        <?php get_template_part('billboard', 'bsp') ?>

    </article>

<?php get_footer(); ?>
