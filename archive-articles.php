<?php get_header(); ?>

<?php
	if ( have_posts() )
		the_post();
?>

<article role="main" class="page" id="article-archive">
	<div class="page-header">
		<div class="container">
			<h1>BSP Logo</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum officia autem doloremque repellendus, cupiditate adipisci officiis itaque libero culpa quaerat eius sit blanditiis, delectus atque odio quia id repellat facilis!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia laborum assumenda aliquam animi? Cum aspernatur fugiat sint repellat eius velit dolore fuga ut suscipit repudiandae. Officia, repellendus, iusto! Nulla, nihil.</p>
		</div>
	</div>

	<div class="primary container">
		<h1>BSP Archive</h1>
		<?php get_sidebar(); ?>
		<section class="content">
			<?php
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();

				/* Run the loop for the archives page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-archives.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'journal' );
			?>
		</section>
	</div>

</article>

<?php get_footer(); ?>
