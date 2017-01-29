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
            <img src="<?php echo the_post_thumbnail_url('event-highlight'); ?>" alt="<?php the_title(); ?>">
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
    <p><?php the_excerpt(); ?></p>
</li>
