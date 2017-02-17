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

        <div class="primary container">
            <?php get_sidebar(); ?>
            <section class="content">
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
            </section>
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
                    <a href="/news-category/in-the-news">View All</a>
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
                    <a href="/news-category/policy-making">View All</a>
                <h2>BSP in the News</h2>
                <?php
                $bsp_itn = news_query('bsp-in-the-news');

                if ($bsp_itn->have_posts()) :
                    ?>
                    <ul>
                        <?php while ( $bsp_itn->have_posts() ) : $bsp_itn->the_post(); ?>
                            <?php get_template_part('loop', 'newsitem') ?>
                        <?php endwhile;  ?>
                    </ul>
                <?php endif; wp_reset_query(); ?>
                <a href="/news-category/bsp-in-the-news">View All</a>
            </div>
        </div>

        <div class="in-action">

        </div>

        <div class="reports container">
            <div class="content">
                <h2>Reports</h2>
                <?php
                $reports = news_query('reports');

                if ($reports->have_posts()) :
                    ?>
                    <ul>
                        <?php while ( $reports->have_posts() ) : $reports->the_post(); ?>
                            <li><?php the_title(); ?></li>
                        <?php endwhile;  ?>
                    </ul>
                <?php endif; wp_reset_query(); ?>
                <a href="/news-category/reports">View All</a>
            </div>
        </div>

        <?php get_template_part('billboard', 'join') ?>

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
                <a href="/news-category/recommended-reading">View All</a>

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
                <a href="/news-category/free-resources">View All</a>
                
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
                <a href="/news-category/exec-ed">View All</a>
            </div>
        </div>

        <?php get_template_part('billboard', 'bsp') ?>

    </article>

<?php get_footer(); ?>
