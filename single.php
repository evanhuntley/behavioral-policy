<?php get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<?php if (in_category('behavioral-scientist')) : ?>
				<article role="main" class="single-post behavioral-scientist" id="post-<?php the_ID(); ?>">
				<div class="primary container">
					<div class="content">				
						<h1><?php the_title(); ?> Testing</h1>
						<div class="post-meta">
							<p class="author">By </p>
							<?php the_date('F j, Y'); ?>
						</div>
						<p class="attribution"><a href="http://behavioralscientist.org/">Published in partnership with The Behavioral Scientist</a></p>
						<div class="featured-image">
							<?php the_post_thumbnail('full');?>
						</div>
						<div class="post-content">
							<?php the_content(); ?>
						</div>
					</div>
					<?php get_sidebar('blog'); ?>
				</div>
			</article>
			<?php else : ?>
				<article role="main" class="single-post" id="post-<?php the_ID(); ?>">
				<?php $class = has_category('bspa-this-week') ? 'weekly' : ''; ?>
	            <div class="page-header <?= $class; ?>">
					<div class="container">
						<h1><?php the_title(); ?></h1>
					</div>
	            </div>
				
				<div class="primary container">
					<div class="content">
						<div class="simple-navigation">
							<?php previous_post_link('%link', '&lt; Previous', false); ?> 
							<?php next_post_link( '%link', 'Next &gt;', false ); ?>
						</div>
						<?php the_post_thumbnail('full');?>
						
						<div class="post-content">
							<?php the_content(); ?>
							
							<?php if (has_category('bspa-this-week')) : ?>
								
								<ul class="btw-stories">
									<li>
										<img class="btw-story-image" src="<?= types_render_field('blog-story-1-image', array('size' => 'event-highlight', 'url' => 'true')); ?>" />
										<h3><a href="<?= types_render_field('blog-story-1-url', array('raw' => true)); ?>"><?= types_render_field("blog-story-1-title"); ?></a></h3>
										<?= types_render_field("blog-story-1-content"); ?>
									</li>
									<li>
										<img class="btw-story-image" src="<?= types_render_field('blog-story-2-image', array('size' => 'event-highlight', 'url' => 'true')); ?>" />
										<h3><a href="<?= types_render_field('blog-story-2-url', array('raw' => true)); ?>"><?= types_render_field("blog-story-2-title"); ?></a></h3>
										<?= types_render_field("blog-story-2-content"); ?>
									</li>
									<li>
										<img class="btw-story-image" src="<?= types_render_field('blog-story-3-image', array('size' => 'event-highlight', 'url' => 'true')); ?>" />
										<h3><a href="<?= types_render_field('blog-story-3-url', array('raw' => true)); ?>"><?= types_render_field("blog-story-3-title"); ?></a></h3>
										<?= types_render_field("blog-story-3-content"); ?>
									</li>
									<li>
										<img class="btw-story-image" src="<?= types_render_field('blog-story-4-image', array('size' => 'event-highlight', 'url' => 'true')); ?>" />
										<h3><a href="<?= types_render_field('blog-story-4-url', array('raw' => true)); ?>"><?= types_render_field("blog-story-4-title"); ?></a></h3>
										<?= types_render_field("blog-story-4-content"); ?>
									</li>
								</ul>
								<h2>In Other News...</h2>
								<ul class="btw-tweets">
									<li class="tweet">
										<?php echo types_render_field( "tweet", array("separator" => "</li><li class='tweet'>") ); ?>
									</li>
								</ul>
							<?php endif; ?>
						</div>
						
						<p class="date"><time datetime="<?php the_time('l, F jS, Y') ?>" pubdate><?php the_time('F j, Y') ?></time></p>
						<?php //comments_template( '', true ); ?>
					</div>
					<?php get_sidebar('blog'); ?>
				</div>				
			<?php endif; ?>
			</article>
            <?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
