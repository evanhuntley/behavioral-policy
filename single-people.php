<?php get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

        <article role="main" class="single-post single-people" id="post-<?php the_ID(); ?>">
            <div class="page-header">
				<div class="container">
					<h1><?php the_title(); ?></h1>
					<?php 
						$terms = get_the_terms($post->ID, 'team-roles');		
					?>
					<span class="role">
						<?php 
							$subtitle = types_render_field("person-subtitle", array("raw" => true));
						
							if ($subtitle) {
								echo $subtitle;
							} else {
								$terms = get_the_terms($post->ID, 'team-roles');
								$roles = [];
								foreach($terms as $term) {
									$roles[] = $term->name;
								}
								echo join(",", $roles);
							}
						?>
					</span>
				</div>
            </div>
			
			<div class="primary container">
				<div class="content">
					
					<div class="contact">
						<?php 
							$email = types_render_field('person-email', array("raw" => true));
							$twitter = types_render_field('person-twitter', array("raw" => true));
						 ?>
						 <?php if ($email) : ?>
							 <a href="<?= $email ?>"><i class="fa fa-envelope-o"></i></a>
						 <?php endif; ?>
						 <?php if ($twitter) : ?>
							 <a href="<?= $twitter ?>"><i class="fa fa-twitter"></i></a>
						 <?php endif; ?>
					</div>
					
					<div class="post-content">
						<?php the_content(); ?>
						<?php the_post_thumbnail('full');?>
					</div>
				</div>
			</div>

            <?php endwhile; // end of the loop. ?>
        </article>

<?php get_footer(); ?>
