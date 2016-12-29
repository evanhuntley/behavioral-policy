<?php
/*
    Template Name: Jobs Page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page about" id="post-<?php the_ID(); ?>">

        <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="container">
                <h1><?php the_title(); ?></h1>
                <?php echo types_render_field("page-short-description"); ?>
            </div>
        </div>

        <div class="primary container">
            <?php get_sidebar(); ?>
            <section class="content">

                <div id="jobs-section">
                    <h2 class="jobs-section-title">jobs &amp; calls</h2>
        				<div class="job-filters">
        					<?php
        						$job_terms = get_terms( array(
        						    'taxonomy' => 'job-category',
        						    'hide_empty' => false,
        						    'orderby' => 'count',
        						    'order' => 'ASC'
        						) );

        						$call_terms = get_terms( array(
        						    'taxonomy' => 'call-category',
        						    'hide_empty' => false,
        						) );
        					?>
        					<ul class="job-categories">
        							<li><a href="/jobs-and-calls#jobs-section">Most Recent</a></li>
        						<?php foreach($job_terms as $term) : ?>
        							<li><a href="<?php echo add_query_arg('jobs-cat', $term->slug, '/jobs-and-calls#jobs-section'); ?>"><?php echo $term->name; ?></a><span><?php echo ' [' . $term->count . ']'; ?></span></li>
        						<?php endforeach; ?>
        					</ul>

        					<ul class="call-categories">
        						<?php foreach($call_terms as $term) : ?>
        							<li><a href="<?php echo add_query_arg('calls-cat', $term->slug, '/jobs-and-calls#jobs-section'); ?>"><?php echo $term->name; ?></a><span><?php echo ' [' . $term->count . ']'; ?></span></li>
        						<?php endforeach; ?>
        					</ul>
        				</div>

        				<?php
        					$jobs_category = get_query_var('jobs-cat') ? get_query_var('jobs-cat') : '';
        					$calls_category = get_query_var('calls-cat') ? get_query_var('calls-cat') : '';

        					if ( $jobs_category == '' && $calls_category == '') {
        						$args = array(
        				            'post_type' => 'jobs-calls',
        				            'posts_per_page' => -1,
        				        );
        					} elseif ( $calls_category == '' ) {
        						$args = array(
        				            'post_type' => 'jobs-calls',
        				            'posts_per_page' => -1,
        							'tax_query' => array(
        								array(
        									'taxonomy' => 'job-category',
        									'field'    => 'slug',
        									'terms'    => $jobs_category,
        								),
        							),
        				        );
        					} else {
        						$args = array(
        				            'post_type' => 'jobs-calls',
        				            'posts_per_page' => -1,
        							'tax_query' => array(
        								array(
        									'taxonomy' => 'call-category',
        									'field'    => 'slug',
        									'terms'    => $calls_category,
        								),
        							),
        				        );
        					}

        			        $jobs = new WP_Query( $args);
        			    ?>

        			    <?php if ( $jobs->have_posts() ) : ?>
        			    <ul class="jobs-list expand-list content-block">

        			        <?php while ( $jobs->have_posts() ) : $jobs->the_post(); ?>
        			        <li class="job">
        			        	<?php
        				        	$role = types_render_field("job-role", array("raw" => true));
        				        	$company = types_render_field("job-company", array("raw" => true));			        							$location = types_render_field("job-location", array("raw" => true));
        							$salary = types_render_field("job-salary", array("raw" => true));										$type = types_render_field("job-position-type", array("raw" => true));									$posted = types_render_field("job-posted", array("raw" => true));		        							$closes = types_render_field("job-closes", array("raw" => true));
        							$link = types_render_field("job-link", array("raw" => true));
        							$description = types_render_field("job-description", array("html" => true));
        				        ?>
        				        <?php if ($company) : ?>
        			            <div class="job-title expand-title"><?php echo $role . ': ' . $company; ?></div>
        			            <?php else : ?>
        			            <div class="job-title expand-title"><?php echo $role; ?></div>
        			            <?php endif; ?>
        			            <div class="job-description expand-description">
        			            	<?php if ( $location ) : ?>
        			            		<h4>Location</h4>
        			            		<p><?php echo $location; ?></p>
        			            	<?php endif; ?>
        			            	<?php if ( $salary ) : ?>
        			            		<h4>Salary</h4>
        			            		<p><?php echo $salary; ?></p>
        			            	<?php endif; ?>
        			            	<?php if ( $type ) : ?>
        			            		<h4>Position Type</h4>
        			            		<p><?php echo $type; ?></p>
        			            	<?php endif; ?>
        			            	<?php if ( $posted ) : ?>
        			            		<h4>Posted</h4>
        			            		<p><?php echo $posted; ?></p>
        			            	<?php endif; ?>
        			            	<?php if ( $closes ) : ?>
        			            		<h4>Closes</h4>
        			            		<p><?php echo $closes; ?></p>
        			            	<?php endif; ?>
        			            	<?php if ( $description ) : ?>
        			            		<?php echo $description; ?>
        			            	<?php endif; ?>
        			            	<?php if ( $link ) : ?>
        			            		<p><a href="<?php echo $link; ?>" target="_blank">Click here for more information</a></p>
        			            	<?php endif; ?>
        			            </div>
        			        </li>
        			        <?php endwhile; wp_reset_query(); ?>
        			    </ul>
    			    <?php else : ?>
    				<p>Sorry, there are no items in the category you selected.</p>
    				<?php endif; ?>
                </div>
            </section>
        </div>

        <div id="job-posting">
            <div class="container">
                <div class="jobs-column">
                    <div class="jobs-form equal">
                        <h3>Hear About Jobs Via Email</h3>
                        <p>Want to have access to the latest jobs, hot off the press? Sign up here and we will ensure that the latest job alerts arrive straight in your inbox.</p>
                        <?php echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="true"]'); ?>
                    </div>
                </div>
                <div class="jobs-column">
                    <div class="jobs-form equal">
                        <h3>Share a Job or Opportunity</h3>
                        <p>Recruiters – wanting to hire a behavioral science candidate? Let us know by submitting the form below or emailing your job opportunity to <a href="mailto:bspa@behavioralpolicy.org">bspa@behavioralpolicy.org</a>.</p>
                        <?php echo do_shortcode('[gravityform id="3" title="false" description="false" ajax="true"]'); ?>
                    </div>
                </div>
            </div>
        </div>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
