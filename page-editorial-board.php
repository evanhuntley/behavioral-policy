<?php
/*
    Template Name: Editorial Board
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page" id="post-<?php the_ID(); ?>">
        
        <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="container">
                <h1>Editorial Board</h1>
                <?php echo types_render_field("page-short-description"); ?>
            </div>
        </div>

        <div class="primary container">
            <?php get_sidebar(); ?>
            <section class="content">
                <?php the_content(); ?>
                
                <div class="editors">
                    <ul class="grid-filters">
                        <li class="active" data-filter="*">All</li>
                        <?php
                            $terms = get_terms( array(
                                'taxonomy' => 'team-roles',
                                'include' => array(34, 35, 44, 7, 45, 36),
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
                            'orderby' => 'wpse_last_word', 
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'team-roles',
                                    'field'    => 'slug',
                                    'terms'    => array( 'associate-policy-editors', 'senior-disciplinary-editors', 'senior-policy-editors', 'founding-co-editors', 'consulting-editors', 'associate-disciplinary-editors' ),
                                ),
                            ),                            
                        );
                        $people = new WP_Query( $args);

                        while ( $people->have_posts() ) : $people->the_post();

                        $roles = get_the_terms($post, 'team-roles');
                        $areas = get_the_terms($post, 'areas-of-focus');

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
                                <?php
                                    $j = 1;
                                    foreach($areas as $area) {
                                        echo '<span>' . $area->name;
                                        if ( $j < sizeof($areas)) {
                                            echo ',';
                                        }
                                        echo '</span>';
                                        $j++;
                                    }
                                ?>
                            </p>
                        </li>
                    <?php endwhile; wp_reset_query(); ?>
                    </ul>                    
                </div>
            </section>
        </div>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
