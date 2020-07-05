<?php
/*
    Template Name: Journal Issues
*/
?>

<?php get_header(); ?>

    <article role="main" class="page type-page" id="post-<?php the_ID(); ?>">
        
        <div class="page-header" style="background-image: url('/wp-content/uploads/2017/01/bg_home-bsp.jpg');">
            <div class="container">
                <h1>BSP: <?php single_term_title(); ?></h1>
                <p><?php echo term_description(); ?></p>
            </div>
        </div>

        <div class="primary container">
            <section class="content">
                <div class="featured-articles">
                    <?php
                    $term = get_queried_object();
                    $slug = $term->slug;
                    
                        $args = array(
                            'post_type' => 'article',
                            'posts_per_page' => -1,
                            'order' => 'ASC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'journal_issue',
                                    'field'    => 'slug',
                                    'terms'    => $slug
                                ),
                            ),                            
                        );
                        $results = new WP_Query( $args);

                        while ( $results->have_posts() ) : $results->the_post();
                        get_template_part( 'loop', 'journal' );
                        endwhile;
                    ?>
                </div>
            </section>
            <?php get_sidebar(); ?>
        </div>
    </article>

<?php get_footer(); ?>
