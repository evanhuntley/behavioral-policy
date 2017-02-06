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
					
					<?php if (has_category('bspa-this-week')) : ?>
						
						<ul class="btw-stories">
							<li>
								<h3><a href="<?= types_render_field('blog-story-1-url', array('raw' => true)); ?>"><?= types_render_field("blog-story-1-title"); ?></a></h3>
								<?= types_render_field("blog-story-1-content"); ?>
								<img class="btw-story-image" src="<?= types_render_field('blog-story-1-image', array('size' => 'event-highlight', 'url' => 'true')); ?>" />
							</li>
							<li>
								<h3><a href="<?= types_render_field('blog-story-2-url', array('raw' => true)); ?>"><?= types_render_field("blog-story-2-title"); ?></a></h3>
								<?= types_render_field("blog-story-2-content"); ?>
								<img class="btw-story-image" src="<?= types_render_field('blog-story-2-image', array('size' => 'event-highlight', 'url' => 'true')); ?>" />
							</li>
							<li>
								<h3><a href="<?= types_render_field('blog-story-3-url', array('raw' => true)); ?>"><?= types_render_field("blog-story-3-title"); ?></a></h3>
								<?= types_render_field("blog-story-3-content"); ?>
								<img class="btw-story-image" src="<?= types_render_field('blog-story-3-image', array('size' => 'event-highlight', 'url' => 'true')); ?>" />
							</li>
							<li>
								<h3><a href="<?= types_render_field('blog-story-4-url', array('raw' => true)); ?>"><?= types_render_field("blog-story-4-title"); ?></a></h3>
								<?= types_render_field("blog-story-4-content"); ?>
								<img class="btw-story-image" src="<?= types_render_field('blog-story-4-image', array('size' => 'event-highlight', 'url' => 'true')); ?>" />
							</li>
						</ul>
						
						<ul class="btw-tweets">
							<li class="tweet">
								<?php echo types_render_field( "tweet", array("separator" => "</li><li class='tweet'>") ); ?>
							</li>
						</ul>
					<?php endif; ?>
					
					<p>Posted <strong><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></strong> on <time datetime="<?php the_time('l, F jS, Y') ?>" pubdate><?php the_time('l, F jS, Y') ?></time> &middot; <a href="<?php the_permalink(); ?>">Permalink</a></p>
					<?php //comments_template( '', true ); ?>
				</div>
				<?php get_sidebar('blog'); ?>
			</div>

            <?php endwhile; // end of the loop. ?>
        </article>

<?php get_footer(); ?>
