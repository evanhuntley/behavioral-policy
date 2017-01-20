<?php $firstClass = 'first-post'; ?>

<div class="articles">
	<div class="displayed-results">
		<h2>
			<?php
				global $searchandfilter;
				$sf_current_query = $searchandfilter->get(13596)->current_query()->get_array();

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
<?php while ( have_posts() ) : the_post(); ?>
	<?php /* How to display standard posts and search results */ ?>

        <article class="journal-article <?php echo $firstClass; ?>" id="post-<?php the_ID(); ?>">
			<?php $firstClass = ""; ?>
			<?php
				$terms = get_the_terms($post, 'areas-of-focus');
				if ($terms) {
					$list = implode("", $terms);
					echo $list;
				}
			 ?>
                <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
                	<h3><?php the_title(); ?></h3>
                </a>
				<div class="authors">
					<?php
						echo 'by ' . types_render_field('article-author', array("separator" => ", "));
					?>
				</div>
				<div class="options">
					<a href="<?php echo types_render_field('article-file', array("raw" => true)); ?>" class="download" title="Download">
						<i class="fa fa-download"></i>
					</a>
				</div>
				<img src="<?= the_post_thumbnail_url('event-highlight'); ?>" />
		</article>

<?php endwhile; // End the loop. Whew. ?>
</div>

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
