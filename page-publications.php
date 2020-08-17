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
                    <?php 
                        $issue_list = get_terms( array(
                            'taxonomy' => 'journal_issue',
                            'hide_empty' => false,
                            'order' => 'DESC',
                            'meta_query' => array(
                                array(
                                    'key'	  	=> 'wpcf-issue-current',
                                    'value'	  	=> '1',
                                    'compare' 	=> '=',
                                )
                            ),
                        ));
                    ?>
                    <h1>Behavioral Science &amp; Policy</h1>
                    <?php the_content(); ?>
                    <?php foreach($issue_list as $issue) : ?>
                        <section class="bsp-issue-unit">      
                            <h2><?= $issue->name; ?></h2>       
                            <img class="bsp-cover" src="<?php echo types_render_termmeta('issue-cover-image', array("term_id" => $issue->term_id, "raw" => true)); ?>" alt="BSP Current Issue" />
                            <?php if (types_render_termmeta('issue-pdf', array("term_id" => $issue->term_id, "raw" => true))) : ?>       
                                <a target="_blank" class="button" href="<?php echo types_render_termmeta('issue-pdf', array("term_id" => $issue->term_id, "raw" => true)); ?>">Download</a>
                            <?php endif; ?>
                            <?php if (types_render_termmeta('issue-embed-url', array("term_id" => $issue->term_id, "raw" => true))) : ?>
                                <a target="_blank" data-lity class="button" href="<?php echo types_render_termmeta('issue-embed-url', array("term_id" => $issue->term_id, "raw" => true)); ?>">Read Online</a>
                            <?php else : ?>
                                <a class="button" href="/journal_issue/<?= $issue->slug ?>">Read Online</a>
                            <?php endif; ?>
                        </section>
                    <?php endforeach; ?>
                    <a class="past-issues-link" href="/publications/past-issues">View Past Issues</a>
                </div>
                <ul class="bsp-links">
                    <li><a href="/articles"><span>Search</span> find articles of interest<br />in the BSP archive</a></li>
                    <li><a href="/publications/past-issues"><span>past issues</span> view every volume of BSP to date</a></li>
                    <li><a href="/signup"><span>Subscribe</span> subscribe to BSP to get access to...</a></li>
                    <li><a target="_blank" href="http://bsp.msubmit.net/"><span>Submit</span> we are currently seeking submissions</a></li>
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
                                'posts_per_page' => 3,
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'meta_query'	=> array(
                                    array(
                                        'key'	  	=> 'wpcf-is-featured-article',
                                        'value'	  	=> '1',
                                        'compare' 	=> '!=',
                                    )
                            	)
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
