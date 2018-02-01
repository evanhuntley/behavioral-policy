<?php
/*
    Template Name: Policy Areas
*/
?>

<?php get_header(); ?>

    <article role="main" class="page type-page" id="post-<?php the_ID(); ?>">
        
        <div class="page-header" style="background-image: url('/wp-content/uploads/2017/01/bg_home-bsp.jpg');">
            <div class="container">
                <h1><?php single_term_title(); ?></h1>
                <p><?php echo term_description(); ?></p>
            </div>
        </div>

        <div class="primary container">
            <section class="content">
                <div class="editors">
                    <h2>Editors</h2>
                    <ul class="grid">
                    <?php
                    $term = get_queried_object();
                    $slug = $term->slug;
                    
                        $args = array(
                            'post_type' => 'people',
                            'posts_per_page' => -1,
                            'order' => 'ASC',
                            'orderby' => 'wpse_last_word', 
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'areas-of-focus',
                                    'field'    => 'slug',
                                    'terms'    => $slug
                                ),
                            ),                            
                        );
                        $people = new WP_Query( $args);

                        while ( $people->have_posts() ) : $people->the_post();

                        $roles = get_the_terms($post, 'team-roles');

                        $role_slugs = '';
                        foreach($roles as $role) {
                            $role_slugs .= $role->slug . ' ';
                        }

                    ?>
                        <li class="grid-item <?php echo $role_slugs; ?>">
                            <a href="<?php echo get_the_permalink(); ?>">
                                <img src="<?php the_post_thumbnail_url('bio-thumb'); ?>" alt="<?php echo get_the_title(); ?>" />
                            </a>
                            <h1><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            <p>
                                <?php
                                    $i = 1;
                                    foreach($roles as $role) {
                                        echo '<span>' . $role->name;
                                        if ( $i < sizeof($roles)) {
                                            echo ',';
                                        }
                                        echo '</span>';
                                        $i++;
                                    }
                                ?>
                            </p>
                        </li>
                    <?php endwhile; wp_reset_query(); ?>
                    </ul>                    
                </div>
            </section>
            <?php get_sidebar(); ?>
        </div>
    </article>

<?php get_footer(); ?>
