
<footer role="contentinfo">
	<div class="container">
		<div class="org-info">
			<div>
				<h4>Contact Information</h4>
				<p>PO Box 51336<br />
				Durham, NC 27717<br />
				USA<br />
				+1 (919) 681-5932<br />
				<a href="mailto:BSPA@behavioralpolicy.org">BSPA@behavioralpolicy.org</a></p>
				<a class="newsletter-button button" href="https://behavioralpolicy.org/#subscribe">Sign up for our E-newsletter</a>
			</div>
			<div>
				<h4>Global Community</h4>
				<p>The Behavioral Science &amp; Policy Association (BSPA) is a global community of behavioral science researchers, policy analysts, and practitioners. Our mission is to promote the application of rigorous behavioral science research to concrete policy solutions that serve the public interest. We do this through a variety of activities, including conferences and briefings, networking activities, creation and maintenance of an online information resource, and publication of our flagship journal, Behavioral Science &amp; Policy. BSPA is a nonprofit 501(c)3 organization.</p>
			</div>
			<div>
				<?php if( is_active_sidebar('footer-widgets') ) { ?>
				    <?php dynamic_sidebar('footer-widgets'); ?>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="copyright">
		<div class="container">
			<p>&copy;<?php echo date("Y"); ?>  Behavioral Science &amp; Policy Association | All rights reserved</p>
			<ul class="social">
				<li>
					<a href="https://twitter.com/BeSciPol"><i class="fa fa-twitter"></i><span class="screen-reader-text">Twitter</span></a>
				</li>
				<li>
					<a href="https://www.linkedin.com/company/3114545"><i class="fa fa-linkedin"></i><span class="screen-reader-text">Linkedin</span></a>
				</li>
				<li>
					<a href="http://behavioralpolicy.org/feed"><i class="fa fa-rss"></i><span class="screen-reader-text">RSS</span></a>
				</li>
				<li>
					<a href="mailto:bspa@behavioralpolicy.org"><i class="fa fa-envelope-o"></i><span class="screen-reader-text">Email</span></a>
				</li>
			</ul>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

<script src="<?php echo bloginfo('template_directory'); ?>/assets/js/scripts.min.js"></script>

<?php if ( is_singular() ) wp_print_scripts( 'comment-reply' ); ?>
</body>
</html>
