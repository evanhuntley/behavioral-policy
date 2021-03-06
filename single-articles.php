<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="page single-article" id="post-<?php the_ID(); ?>">
        <div class="page-header">
            <div class="container">
                <h1><img src="<?php echo get_template_directory_uri(); ?>/assets/img/l_bsp_small.png" alt="BSP" /></h1>
                <?php //echo types_render_field("page-short-description"); ?>
            </div>
        </div>

        <div class="primary container">
            <section class="content">
                <div class="article-header">
                    <h1><?php the_title(); ?></h1>
                    <div class="authors">
                        <?php
                            echo 'by ' . types_render_field('article-author', array("separator" => ", "));
                        ?>
                    </div>
                    <div class="date">
                        <?php the_date(); ?>
                    </div>
                    <div class="options">
                        <a href="<?php echo types_render_field('article-file', array("raw" => true)); ?>" class="download" title="Download">
                            <i class="fa fa-download"></i>
                        </a>
                    </div>
                    <?php
                        $terms = get_the_terms($post, 'areas-of-focus');
                        if ($terms) {
                            $term = array_shift( $terms );
                            $list = $term->slug;
                        }
                     ?>
                     <svg class="icon">
                         <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/svg/sprite.svg#<?php echo $list; ?>"></use>
                     </svg>
                </div>
                <div class="article-content">
                    <?php the_content(); ?>
                   <?php if (types_render_field('article-supplemental-material', array("raw" => true))) : ?>
                       <hr />
                       <a href="<?= types_render_field('article-supplemental-material', array("raw" => true)); ?>">Supplemental Material</a>
                   <?php endif; ?>
                   <?php if (types_render_field('article-author-note')) : ?>
                       <div class="author-note expand-block">
                           <div class="expand-title"><h3>Author Note</h3></div>
                           <div class="expand-description">
                               <?= types_render_field('article-author-note'); ?>
                           </div>
                       </div>
                   <?php endif; ?>
                   <?php if (types_render_field('article-author-affiliation')) : ?>
                       <div class="author-affiliation expand-block">
                           <div class="expand-title"><h3>Author Affiliation</h3></div>
                           <div class="expand-description">
                               <?= types_render_field('article-author-affiliation'); ?>
                           </div>
                       </div>
                   <?php endif; ?>
                   <?php if (types_render_field('article-references')) : ?>
                       <div class="references expand-block">
                           <div class="expand-title"><h3>References</h3></div>
                           <div class="expand-description">
                               <?= types_render_field('article-references'); ?>
                           </div>
                       </div>
                   <?php endif; ?>
                </div>
            </section>
        </div>

    </article>
<?php endwhile; ?>

<div class="related-articles container">
    <div class="content">
        <h1>Suggested Articles</h1>
        <?php
            $args = array(
                'post_type' => 'articles',
                'posts_per_page' => 3,
                'orderby' => 'RAND',
                'post__not_in' => array (get_the_ID())
            );

            $related = new WP_Query($args);

            while ( $related->have_posts() ) : $related->the_post(); ?>
                <?php get_template_part( 'loop', 'journal' ); ?>
            <?php endwhile; ?>
    </div>
</div>

<?php get_template_part('billboard', 'subscribe') ?>
<?php get_template_part('billboard', 'submit') ?>
<?php get_template_part('billboard', 'join') ?>

<?php get_footer(); ?>
