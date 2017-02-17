<?php get_header(); ?>

<?php
	if ( have_posts() )
		the_post();
?>

<article role="main" class="page" id="news-archive">
	<div class="page-header">
		<div class="container">
			<?php 
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			?>
			<h1><?php echo $term->name; ?></h1>
		</div>
	</div>

	<div class="primary container">
		<section class="content">
			<div class="articles">
				<ul>
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
					while ( have_posts() ) : the_post();
					 	get_template_part( 'loop', 'news-item' );
				 	endwhile;
				?>
				</ul>
		</section>
	</div>

</article>

<?php get_template_part('billboard', 'submit') ?>

<?php get_footer(); ?>
