<?php
/*
    Template Name: About BSP Page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page about-bsp" id="post-<?php the_ID(); ?>">
        
        <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="container">
                <h1><img src="<?php echo get_template_directory_uri(); ?>/assets/img/l_bsp_small.png" alt="BSP" /></h1>
                <?php echo types_render_field("page-short-description"); ?>
            </div>
        </div>

        <div class="primary container">
            <section class="content">
                <?php the_content(); ?>
                
                <div class="editors">
                    <h2>Editors</h2>
                    <ul class="grid-filters">
                        <li class="active" data-filter="*">All</li>
                        <?php
                            $terms = get_terms( array(
                                'taxonomy' => 'team-roles',
                                'include' => array(34, 35, 44, 7),
                                'orderby' => 'name',
                                'order' => 'ASC'
                            ) );

                            foreach($terms as $term) :
                        ?>
                        <li data-filter=".<?php echo $term->slug; ?>">
                            <?php 
                                $str = str_replace("-", " ", $term->slug);
                                echo $str;
                            ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <ul class="grid">
                    <?php
                        $args = array(
                            'post_type' => 'people',
                            'posts_per_page' => -1,
                            'order' => 'ASC',
                            'orderby' => 'title',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'team-roles',
                                    'field'    => 'slug',
                                    'terms'    => array( 'senior-disciplinary-editor', 'senior-policy-editor', 'founding-coeditor', 'consulting-editor' ),
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
        </div>
        
        <?php get_template_part('areas-block') ?>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
