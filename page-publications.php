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
                    <a target="_blank" data-lity class="button" href="http://issuu.com/behavioralsciencepolicyassociation/docs/bspvol2no2_web_d4a8a301952b1a?e=28763323/49295524">Read Online</a>
                </div>
                <ul class="prior-issues">
                    <li>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/bsp-1-1.jpg" />
                        <a target="_blank" href="/wp-content/uploads/2017/05/bsp_vol1issue1_web.pdf">Download</a>
                        <a target="_blank" data-lity href="http://issuu.com/behavioralsciencepolicyassociation/docs/bsp_vol2issue1_web?e=28763323/48970013">Read Online</a>
                    </li>
                    <li>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/bsp-1-2.jpg" />
                        <a target="_blank" href="/wp-content/uploads/2017/05/bsp_vol1issue2_web.pdf">Download</a>
                        <a target="_blank" data-lity href="http://issuu.com/behavioralsciencepolicyassociation/docs/bsp_vol1issue2_web?e=28763323/49363821">Read Online</a>                        
                    </li>
                    <li>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/bsp-2-1.jpg" />
                        <a target="_blank" href="/wp-content/uploads/2017/05/bsp_vol2issue1_web.pdf">Download</a>
                        <a target="_blank" data-lity href="http://issuu.com/behavioralsciencepolicyassociation/docs/bsp_vol1issue1_web?e=28763323/49363811">Read Online</a>                        
                    </li>
                </ul>
                <ul class="bsp-links">
                    <li><a target="_blank" href="http://bsp.msubmit.net/"><span>Submit</span> we are currently seeking submissions</a></li>
                    <li><a href="/signup"><span>Subscribe</span> subscribe to BSP to get access to...</a></li>
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
                                'orderby' => 'menu_order',
                                'order' => 'DESC',
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
                                'posts_per_page' => -1,
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

        <?php get_template_part('billboard', 'submit') ?>
        <?php get_template_part('billboard', 'subscribe') ?>
        <?php get_template_part('billboard', 'join') ?>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
