<?php
    $terms = get_the_terms($post->ID, 'news-format');
    if ($terms) {
        $term = array_shift( $terms );
        $format = $term->slug;
    }
?>
<li class="news-item">
    <div class="news-image">
        <a <?= $format == 'video' ? 'data-lity' : ''; ?> href="<?= types_render_field('news-item-url', array("raw" => true)); ?>" title="<?php the_title(); ?>">
            <?php if (types_render_field('news-featured') == '1') : ?>
                <img src="<?php echo the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>">    
            <?php else : ?>
                <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php echo the_post_thumbnail_url('news-item'); ?>" alt="<?php the_title(); ?>">
                <?php else : ?>
                    <img src="http://placehold.it/302x170" />
                <?php endif; ?>
            <?php endif; ?>
            <svg class="icon">
                <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/svg/sprite.svg#<?php echo $format; ?>"></use>
            </svg>
        </a>
    </div>
    <h3>
        <a href="<?= types_render_field('news-item-url', array("raw" => true)); ?>" title="<?php the_title(); ?>" <?= $format = 'video' ? 'data-lity' : ''; ?>>
            <?php the_title(); ?>
        </a>
    </h3>
    <?= types_render_field('news-short-description'); ?>
</li>
