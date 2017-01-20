<?php $firstClass = 'first-post'; ?>
    <article class="journal-article <?php echo $firstClass; ?>" id="post-<?php the_ID(); ?>">
		<?php $firstClass = ""; ?>
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
            <h3>
                <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
            	   <?php the_title(); ?>
                </a>
            </h3>
			<div class="authors">
				<?php
					echo 'by ' . types_render_field('article-author', array("separator" => ", "));
				?>
			</div>
            <?php if (is_post_type_archive('articles')) : ?>
    			<div class="options">
    				<a href="<?php echo types_render_field('article-file', array("raw" => true)); ?>" class="download" title="Download">
    					<i class="fa fa-download"></i>
    				</a>
    			</div>
            <?php endif; ?>
			<img src="<?= the_post_thumbnail_url('event-highlight'); ?>" />
	</article>
