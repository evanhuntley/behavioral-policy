<?php get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

        <article role="main" class="single-post" id="post-<?php the_ID(); ?>">
            <div class="page-header">
				<div class="container">
					<h1><?php the_title(); ?></h1>
				</div>
            </div>
			
			<div class="primary container">
				<div class="content">
					<?php the_post_thumbnail('full');?>
					
					<div class="post-content">
						<?php the_content(); ?>
					</div>
					
					<p>Posted <strong><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></strong> on <time datetime="<?php the_time('l, F jS, Y') ?>" pubdate><?php the_time('l, F jS, Y') ?></time> &middot; <a href="<?php the_permalink(); ?>">Permalink</a></p>
					<?php //comments_template( '', true ); ?>
				</div>
				<?php get_sidebar('blog'); ?>
			</div>

            <?php endwhile; // end of the loop. ?>
        </article>

<?php get_footer(); ?>
