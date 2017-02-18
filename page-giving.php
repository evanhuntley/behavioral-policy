<?php
/*
    Template Name: Giving Page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page giving" id="post-<?php the_ID(); ?>">

        <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="container">
                <h1><?php the_title(); ?></h1>
                <?php echo types_render_field("page-short-description"); ?>
            </div>
        </div>

        <div class="primary container">
            <section class="content">
                <ul class="tab-nav">
                    <li><a class="active" href="#tab-1"><?= types_render_field('giving-tab1-name'); ?></a></li>
                    <li><a href="#tab-2"><?= types_render_field('giving-tab2-name'); ?></a></li>
                    <li><a href="#tab-3"><?= types_render_field('giving-tab3-name'); ?></a></li>
                    <li><a href="#tab-4"><?= types_render_field('giving-tab4-name'); ?></a></li>
                </ul>
                <div class="tab-content active" id="tab-1">
                    <?= types_render_field('giving-tab1-content'); ?>
                </div>
                <div class="tab-content" id="tab-2">
                    <?= types_render_field('giving-tab2-content'); ?>
                </div>
                <div class="tab-content" id="tab-3">
                    <div class="flip-cards">
                        <?= types_render_field('giving-tab3-content'); ?>
                    </div>
                </div>
                <div class="tab-content" id="tab-4">
                    <?= types_render_field('giving-tab4-content'); ?>
                </div>
            </section>
        </div>
        
        <div class="partners">
            <div class="container">
                <h2>Our Partners</h2>
                <hr />
                <?= types_render_field("giving-our-partners"); ?>
            </div>
        </div>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
