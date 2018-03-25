<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
	<?php if (in_category('behavioral-scientist')) : ?>
		<article role="main" class="single-post behavioral-scientist" id="post-<?php the_ID(); ?>">
			<div class="primary container">
				<div class="content">				
					<h1><?php the_title(); ?> Testing</h1>
					<div class="post-meta">
						<p class="author">By <?= types_render_field('bs-author'); ?></p>
						<?php the_date('F j, Y'); ?>
					</div>
					<div class="header-components">
					<p class="attribution header-col"><a href="http://behavioralscientist.org/">Published in partnership with The Behavioral Scientist</a></p>
					<div class="social-media header-col">
						<div class="social-buttons">
							<ul>
								<li>
									<a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank">
										<i class="fa fa-facebook"></i>
									</a>
								</li>
								<li>
									<a class="twitter" href="http://twitter.com/intent/tweet?text=<?php the_title(); ?>%20<?php the_permalink(); ?>%20via%20%40BeSciPol" target="_blank">
										<i class="fa fa-twitter"></i>
									</a>
								</li>
								<li>
									<a class="linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;summary=<?php echo wp_strip_all_tags(get_the_excerpt()); ?>&amp;source=Behavioral Science and Policy Association">
										<i class="fa fa-linkedin"></i>
									</a>
								</li>
								<li>
									<a class="email" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php echo wp_strip_all_tags(get_the_excerpt()); ?> %E2%80%9D%0A%0A<?php the_permalink(); ?>">
										<i class="fa fa-envelope"></i>
									</a>
								</li>
								<li>
									<a class="print" href="javascript:window.print()">
										<i class="fa fa-print"></i>
									</a>
								</li>
							</ul>
						</div>
						</div>
					</div>
					<div class="featured-image">
						<?php the_post_thumbnail('full');?>
					</div>
					<div class="post-content">
						<?php the_content(); ?>
						<?php if (types_render_field('bs-author-info')) : ?>
							<div class="expand-block">
								<div class="expand-title"><h3>Author</h3></div>
								<div class="expand-description">
									<?= types_render_field('bs-author-info'); ?>
								</div>
							</div>
						<?php endif; ?>
						<?php if (types_render_field('bs-references')) : ?>
							<div class="expand-block">
								<div class="expand-title"><h3>References</h3></div>
								<div class="expand-description">
									<?= types_render_field('bs-references'); ?>
								</div>
							</div>
						<?php endif; ?>
						<div class="bs-block">
							<img src="<?php echo bloginfo('template_directory'); ?>/assets/img/l_behavioral-scientist.png" alt="Behavioral Scientist" />
							<p>This piece was published in partnership with The Behavioral Scientist, a collaboration between BSPA, <a href="http://ideas42.org/">ideas42</a> and the <a href="https://research.chicagobooth.edu/cdr/">Center for Decision Research</a>.  The Behavioral Scientist is a non-profit online magazine that offers readers original, thought-provoking reports from the front lines of behavioral science.  Visit us at <a href="http://behavioralscientist.org">behavioralscientist.org</a>.</p>
						</div>
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
