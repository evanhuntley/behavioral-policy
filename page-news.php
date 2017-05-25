<?php
/*
Template Name: News Page
*/
?>

<?php get_header(); ?>

    <article role="main" class="page news" id="post-<?php the_ID(); ?>">

        <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="container">
                <h1>News &amp; Resources</h1>
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

        <div class="news-main container">
            <div class="content">
                <div class="news-section" id="in-the-news">
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
                    <a class="more-link" href="/news-category/in-the-news">Show All</a>
                </div>
                <div class="news-section">
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
                    <a class="more-link" href="/news-category/bspa-in-the-news">Show All</a>
                </div>    
            </div>
        </div>
        
        <div class="billboard center light resources" id="resources" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="container">
                <h2>resources</h2>
            </div>
        </div>

        <div class="reports container">
            <div class="content">
                <div class="in-action" id="in-action">
                    <h2>Behavioral Science in Action</h2>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/g_map.png" alt="BSPA in action" />
                    <div class="orgs">
                        <?= types_render_field('behavioral-science-in-action'); ?>
                    </diV>
                </div>
                <div class="online-database" id="online-database">
                    <h2>Online Databases</h2>
                    <?= types_render_field('online-database'); ?>
                </div>
                <h2>Reports Corner</h2>
                <div class="reports-details" id="reports">
                    <?= types_render_field('reports-corner-text'); ?>
                </div>
                <?php
                $reports = news_query('reports');

                if ($reports->have_posts()) :
                    ?>
                    <ul class="report-list">
                        <?php while ( $reports->have_posts() ) : $reports->the_post(); ?>
                            <li>
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

        <div class="additional-resources" id="additional-resources">
            <div class="container">
                <div class="content">
                    <h1>additional resources</h1>
                    <div class="news-section">
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
                        <a class="more-link" href="/news-category/recommended-reading">Show All</a>
                    </div>
                    <div class="news-section">
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
                        <a class="more-link" href="/news-category/free-resources">Show All</a>
                    </div>
                </div>
            </div>
        </div>

        <?php get_template_part('billboard', 'bsp') ?>

    </article>

<?php get_footer(); ?>
