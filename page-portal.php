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
                    <li><a href="#tab-3"><?= types_render_field('portal-tab3-name'); ?></a></li>
                    <li><a href="#tab-4"><?= types_render_field('portal-tab4-name'); ?></a></li>
                </ul>
                <div class="tab-content active" id="tab-1">
                    <?= types_render_field('portal-tab1-content'); ?>
                </div>
                <div class="tab-content" id="tab-2">
                    <?= types_render_field('portal-tab2-content'); ?>
                </div>
                <div class="tab-content" id="tab-3">
                    <?= types_render_field('portal-tab3-content'); ?>
                </div>
                <div class="tab-content" id="tab-4">
                    <?= types_render_field('portal-tab4-content'); ?>
                </div>
            </section>
        </div>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
