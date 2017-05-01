
<footer role="contentinfo">
	<div class="container">
		<div class="org-info">
			<div class="contact">
				<h4>Contact Information</h4>
				<p>PO Box 51336<br />
				Durham, NC 27717<br />
				USA<br />
				+1 (919) 681-5932
			</div>
			<div class="footer-nav">
				<?php
					$args = array(
						'menu' => 'Main Nav',
						'container' => false,
						'items_wrap' => '<ul class="menu">%3$s</ul>',
						'depth' => 1
						);
					wp_nav_menu($args);
				?>
			</div>
			<div class="footer-newsletter">
				<h2>Sign Up for Our Weekly Newsletter</h2>
				<?php echo do_shortcode('[gravityform id="4" title="false" description="false" ajax="true"]'); ?>
			</div>
		</div>
	</div>
	<div class="copyright">
		<div class="container">
			<p>&copy;<?php echo date("Y"); ?>  Behavioral Science &amp; Policy Association | All rights reserved</p>
			<ul class="social">
				<li>
					<a target="_blank" href="https://twitter.com/BeSciPol"><i class="fa fa-twitter"></i><span class="screen-reader-text">Twitter</span></a>
				</li>
				<li>
					<a target="_blank" href="https://www.linkedin.com/company/3114545"><i class="fa fa-linkedin"></i><span class="screen-reader-text">Linkedin</span></a>
				</li>
				<li>
					<a target="_blank" href="http://behavioralpolicy.org/feed"><i class="fa fa-rss"></i><span class="screen-reader-text">RSS</span></a>
				</li>
				<li>
					<a target="_blank" href="mailto:bspa@behavioralpolicy.org"><i class="fa fa-envelope-o"></i><span class="screen-reader-text">Email</span></a>
				</li>
			</ul>
		</div>
	</div>
</footer>

<script src="<?php echo bloginfo('template_directory'); ?>/assets/js/scripts.min.js"></script>

<?php wp_footer(); ?>

<?php if ( is_singular() ) wp_print_scripts( 'comment-reply' ); ?>
</body>
</html>
