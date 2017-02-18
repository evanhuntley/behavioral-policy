<?php get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

        <article role="main" class="single-post" id="post-<?php the_ID(); ?>">
			<?php $class = has_category('bspa-this-week') ? 'weekly' : ''; ?>
            <div class="page-header <?= $class; ?>">
				<div class="container">
					<h1><?php the_title(); ?></h1>
				</div>
            </div>
			
			<div class="primary container">
				<div class="content">
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

            <?php endwhile; // end of the loop. ?>
        </article>

<?php get_footer(); ?>
