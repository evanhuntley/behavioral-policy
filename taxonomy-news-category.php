<?php get_header(); ?>

<article role="main" class="page" id="news-archive">
	<div class="page-header" style="background-image: url('/wp-content/uploads/2017/01/news-resources-banner.jpg')">
		<div class="container">
			<?php 
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			?>
			<h1><?php echo $term->name; ?></h1>
		</div>
	</div>

	<div class="primary container">
		<section class="content">
			<div class="articles news-section">
				<ul>
				<?php while ( have_posts() ) : the_post(); ?>
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
					                <img src="<?php echo the_post_thumbnail_url('event-highlight'); ?>" alt="<?php the_title(); ?>">    
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
				<?php endwhile; ?>
				</ul>
				<div class="nav-previous alignleft"><?php previous_posts_link( 'Previous' ); ?></div>
				<div class="nav-next alignright"><?php next_posts_link( 'More &gt;' ); ?></div>
		</section>
	</div>

</article>

<?php get_template_part('billboard', 'submit') ?>

<?php get_footer(); ?>
