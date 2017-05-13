<?php get_header(); ?>

<?php
	if ( have_posts() )
		the_post();
?>

<div role="main" class="blog">
	<div class="page-header">
		<div class="container">
			<h1>Policyshop Blog</h1>
		</div>
	</div>

	<div class="primary container">
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
				 get_template_part( 'loop', 'archive' );
			?>
		</section>
		<?php get_sidebar('blog'); ?>
	</div>
</div>

<?php get_footer(); ?>
