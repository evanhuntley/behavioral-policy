<?php
/*
    Template Name: Publications Page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="page publications" id="post-<?php the_ID(); ?>">

        <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="container">
                <h1>Publications</h1>
                <?php echo types_render_field("page-short-description"); ?>
            </div>
        </div>

        <div class="primary container">
            <?php get_sidebar(); ?>
            <section class="content">
                <div class="current-bsp">
                    <img class="bsp-cover" src="<?php echo types_render_field('bsp-issue-cover', array("raw" => true)); ?>" alt="BSP Current Issue" />
                    <h1>Behavioral Science &amp; Policy</h1>
                    <?php the_content(); ?>
                    <a target="_blank" class="button" href="<?php echo types_render_field('bsp-issue-pdf'); ?>">Download</a>
                    <a target="_blank" class="button" href="<?php echo types_render_field('bsp-issue-url'); ?>">Read Online</a>
                </div>
                <ul class="bsp-links">
                    <li><a href="#"><span>Submit</span> we are currently seeking submissions</a></li>
                    <li><a href="/#subscribe"><span>Subscribe</span> subscribe to BSP to get access to...</a></li>
                    <li><a href="/publications/about"><span>Learn More</span> meet our editors and learn more about the journal</a></li>
                    <li><a href="/articles"><span>Archive</span> sign in to access the<br /> BSP archive</a></li>
                </ul>
                <div class="featured-articles" id="featured">

                    <?php
                        $sortby = get_query_var('sortby') ? get_query_var('sortby') : 'featured';
                        $args = array();
                    ?>
                    <ul class="filters">
                        <li <?php if ($sortby == 'featured') echo 'class="active"'; ?>><a href="<?php echo add_query_arg(array('sortby' => 'featured'), '/publications/#featured'); ?>">Featured Articles</a></li>
                        <li <?php if ($sortby == 'date') echo 'class="active"'; ?>><a href="<?php echo add_query_arg(array('sortby' => 'date'), '/publications/#featured'); ?>">Most Recent</a></li>
                    </ul>
                    <?php
                        if ($sortby == 'featured') {
                            $args = array(
                                'post_type' => 'articles',
                                'posts_per_page' => 3,
                                'orderby' => 'date',
                                'order' => 'RAND',
                                'meta_query'	=> array(
                                    array(
                                        'key'	  	=> 'wpcf-is-featured-article',
                                        'value'	  	=> '1',
                                        'compare' 	=> '=',
                                    )
                            	),
                            );

                        } else {
                            $args = array(
                                'post_type' => 'articles',
                                'posts_per_page' => 3,
                                'orderby' => 'date',
                                'order' => 'DESC'
                            );
                        }

                        $related = new WP_Query($args);

                        while ( $related->have_posts() ) : $related->the_post(); ?>
                            <?php get_template_part( 'loop', 'journal' ); ?>
                        <?php endwhile; ?>
                </div>
            </section>
        </div>

        <?php get_template_part('billboard', 'subscribe') ?>
        <?php get_template_part('billboard', 'submit') ?>
        <?php get_template_part('billboard', 'join') ?>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
