<?php
/*
    Template Name: Member Portal
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page portal">
        
        <?php 
            global $current_user;
            get_currentuserinfo();
            $full_name = $current_user->display_name;
            $arr = explode(" ", $full_name, 2);
            $first = $arr[0];
        ?>

        <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="container">
                <h1>Hi, <?= $first; ?>! Welcome to the BSPA Member Portal!</h1>
                <?php echo types_render_field("page-short-description"); ?>
            </div>
        </div>

        <div class="primary container">
            <section class="content">
                <ul class="tab-nav">
                    <li><a class="active" href="#tab-1"><?= types_render_field('portal-tab1-name'); ?></a></li>
                    <li><a href="#tab-2"><?= types_render_field('portal-tab2-name'); ?></a></li>
                    <li><a href="/articles">BSP Archive</a></li>
                    <li><a href="#tab-4"><?= types_render_field('portal-tab4-name'); ?></a></li>
                </ul>
                <div class="tab-content active" id="tab-1">
                    <?= types_render_field('portal-tab1-content'); ?>
                </div>
                <div class="tab-content" id="tab-2">
                    <?php 
                        $favs = get_user_favorites($user_id = null, $site_id = null, $filters = null); 
                        
                        $args = array(
                            'post_type' => array( 'articles' ),
                            'orderby' => 'ASC',
                            'post__in' => $favs
                        );
                        
                        $favorites = new WP_Query($args);
                    ?>
                        <?php while ( $favorites->have_posts() ) : $favorites->the_post(); ?>
                            <?php get_template_part( 'loop', 'journal' ); ?>
                        <?php endwhile; ?>
                </div>
                <div class="tab-content" id="tab-3"></div>
                <div class="tab-content" id="tab-4">
                    <?php echo do_shortcode('[subscription_details]'); ?>
                </div>
            </section>
        </div>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
