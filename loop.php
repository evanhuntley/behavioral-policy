<?php ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
	<?php if ( ! have_posts() ) : ?>
        <article role="main" class="primary-content">
            <h1><?php _e( '404 - I&#39;m sorry but the page can&#39;t be found' ); ?></h1>
            <p>Please try searching again or head back to the homepage.</p>
        </article>
    <?php endif; ?>
<?php ?>

    <?php if ( is_day() ) : ?><?php printf( __( '<h1><span>Daily Archive</span> %s</h1>' ), get_the_date() ); ?>
    <?php elseif ( is_month() ) : ?><?php printf( __( '<h1><span>Monthly Archive</span> %s</h1>' ), get_the_date('F Y') ); ?>
    <?php elseif ( is_year() ) : ?><?php printf( __( '<h1><span>Yearly Archive</span> %s</h1>' ), get_the_date('Y') ); ?>
    <?php elseif ( is_category() ) : ?><?php echo '<h1>' . single_cat_title() . '</h1>'; ?>
    <?php elseif ( is_search() ) : ?><?php printf( __( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>' ); ?>
    <?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>
	<?php /* How to display standard posts and search results */ ?>

        <article class="blog-item">
			<img class="blog-image" src="<?php echo the_post_thumbnail_url('bio-thumb'); ?>" />
			<div class="blog-details">
				<?php if (in_category('behavioral-scientist')) : ?>
					<p class="bs-featured-in">Featured in Behavioral Scientist</p>
				<?php endif; ?>
				<a target="_blank" class="blog-title-link" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
					<h2><?php the_title(); ?></h2>
				</a>
				<p class="author">By 
					<?php echo (types_render_field('bs-author') ?  types_render_field('bs-author') : 'PolicyShop Admin'); ?>
				</p>
				<time datetime="<?php the_time('F jS, Y') ?>" pubdate><?php the_time('F, j Y') ?></time>
				<?php the_excerpt(); ?>
			</div>
		</article>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
    <ul class="navigation">
        <li class="older">
            <?php next_posts_link( __( '&larr; Older posts' ) ); ?>
        </li>
        <li class="newer">
            <?php previous_posts_link( __( 'Newer posts &rarr;' ) ); ?>
        </li>
    </ul>
<?php endif; ?>
