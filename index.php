<?php get_header(); ?>
	<div role="main" class="blog">
		<div class="page-header">
			<div class="container">
				<h1>Policyshop Blog</h1>
				<p>news and insights from behavioral science and policy -- content produced in partnership with the behavioral scientist</p>
			</div>
		</div>

		<div class="primary container">
			<section class="content">
				<?php get_template_part( 'loop', 'index' ); ?>
			</section>
			<?php get_sidebar('blog'); ?>
		</div>
	</div>
<?php get_footer(); ?>
