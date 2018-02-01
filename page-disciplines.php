<?php
/*
    Template Name: Disciplines
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page" id="post-<?php the_ID(); ?>">
        
        <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="container">
                <h1>Disciplines</h1>
                <?php echo types_render_field("page-short-description"); ?>
            </div>
        </div>

        <div class="primary container">
            <?php get_sidebar(); ?>
            <section class="content">
                <?php the_content(); ?>
                <?php 
                    $disciplinary_list = get_terms( array(
                        'taxonomy' => 'areas-of-focus',
                        'hide_empty' => false,
                        'meta_query' => array(
                            array(
                                'key'	  	=> 'wpcf-area-type',
                                'value'	  	=> 'disciplinary',
                                'compare' 	=> '=',
                            )
                        ),
                    ) );    
                ?>
                <ul class="areas-list disciplinary">
                    <?php foreach($disciplinary_list as $item) : ?>
                        <li class="equal">
                            <a href="/areas-of-focus/<?php echo $item->slug; ?>">
                                <svg class="icon">
                                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/svg/sprite.svg#<?php echo $item->slug; ?>"></use>
                                </svg>                                
                                <h3><?php echo $item->name; ?></h3>
                                <p><?php echo $item->description; ?></p>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        </div>
    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
