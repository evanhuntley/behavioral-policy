<?php get_header(); ?>

<?php
	if ( have_posts() )
		the_post();
?>

<article role="main" class="page" id="article-archive">
	<div class="page-header">
		<div class="container">
			<h1><img src="<?php echo get_template_directory_uri(); ?>/assets/img/l_bsp_small.png" alt="BSP" /></h1>
			<p><?= ot_get_option('article_archive_text'); ?></p>
		</div>
	</div>

	<div class="primary container">
		<h1>BSP Archive</h1>
		<?php get_sidebar(); ?>
		<section class="content">
			<div class="articles">
				<div class="displayed-results">
					
					<?php if( rcp_is_active() ) : ?>
					<h2>
						<?php
							global $searchandfilter;
							//$sf_current_query = $searchandfilter->get(13596)->current_query()->get_array();
							$sf_current_query = $searchandfilter->get(13950)->current_query()->get_array();
							if ($sf_current_query) {
								echo '<ul>';
								foreach($sf_current_query as $key) {
									echo '<li>' . $key['active_terms'][0]['name'] . '</li>';
								}
								echo '</ul>';
							} else {
							  echo 'All Articles';
							}
						?>
					</h2>
				</div>
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
					 	get_template_part( 'loop', 'journal' );
				 	endwhile;
				?>
			<?php else : ?>	
				<h2>Only BSPA Members can access the archive.  <a href="/signup">Join us</a> today for full access.</h2>
				<p>Already a member? <a href="/login">Login now</a></p>
			<?php endif; ?>				
		</section>
	</div>

</article>

<?php get_template_part('billboard', 'submit') ?>

<?php get_footer(); ?>
