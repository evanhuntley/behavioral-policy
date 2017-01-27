<li class="news-item">
    <div class="news-image">
        <img src="<?php echo the_post_thumbnail_url('event-highlight'); ?>" alt="<?php the_title(); ?>">
        <?php
            $terms = get_the_terms($post->ID, 'news-format');
            if ($terms) {
                $term = array_shift( $terms );
                $format = $term->slug;
			}
        ?>
        <svg class="icon">
            <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/svg/sprite.svg#<?php echo $format; ?>"></use>
        </svg>
    </div>
    <h3><?php the_title(); ?></h3>
    <p><?php the_excerpt(); ?></p>
</li>
