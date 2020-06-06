<?php
/*
    Template Name: Past Issues
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page past-issues" id="post-<?php the_ID(); ?>">
        
        <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="container">
                <h1>BSP Past Issues</h1>
                <?php echo types_render_field("page-short-description"); ?>
            </div>
        </div>

        <div class="primary container">
            <?php get_sidebar(); ?>
            <section class="content">
                <?php the_content(); ?>
                <?php 
                    $issue_list = get_terms( array(
                        'taxonomy' => 'journal_issue',
                        'hide_empty' => false,
                        'order' => 'DESC',
                        'meta_query' => array(
                            array(
                                'key'	  	=> 'wpcf-issue-current',
                                'value'	  	=> '1',
                                'compare' 	=> '!=',
                            )
                        ),
                    ));
                ?>
                    <div class="issue-list">
                        <?php foreach($issue_list as $issue) : ?>
                            <div class="issue">
                                <img src="<?php echo types_render_termmeta('issue-cover-image', array("term_id" => $issue->term_id, "raw" => true)); ?>" />
                                <h3><?php echo $issue->name; ?></h3>
                                <a class="button" target="_blank" href="<?php echo types_render_termmeta('issue-pdf', array("term_id" => $issue->term_id, "raw" => true)); ?>">Download</a>
                                <a class="button" data-lity target="_blank" href="<?php echo types_render_termmeta('issue-embed-url', array("term_id" => $issue->term_id, "raw" => true)); ?>">Read Online</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
            </section>
        </div>
    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
