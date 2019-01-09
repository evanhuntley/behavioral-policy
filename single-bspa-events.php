
<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    
    <?php
    $currID = $post->ID;
    
    $terms = get_the_terms($post->ID, 'event-types');
    if ($terms) {
        $term = array_shift( $terms );
        $event_type = $term->slug;
    } else {
        $event_type = '';
    }
    
    $date = get_post_meta($post->ID, 'wpcf-event-date', true);
    
    // Past Conference Style
    if ($event_type == 'conference' && $date < time()) :
        ?>
        
        <article role="main" class="page single-conference" id="post-<?php the_ID(); ?>">
            
            <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
                <div class="container">
                    <h1>BSPA Annual Conference</h1>
                    <p>BSPA hosts a range of annual events aimed at fostering networking within the behavioral science and policy communities. Spotlight workshops bring policymakers, practitioners and scientists together to brainstorm various research 'best practices' and topic areas.</p>
                </div>
            </div>
            
            <div class="primary container">
                <section class="content">
                    
                    <div class="conference-nav">
                        <?php
                        $args = array(
                            'post_type' => 'bspa-events',
                            'posts_per_page' => -1,
                            'orderby' => 'meta_value',
                            'meta_key'  => 'wpcf-event-date',
                            'order' => 'ASC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'event-types',
                                    'field'    => 'slug',
                                    'terms'    => 'conference',
                                ),
                            ),  
                            'meta_query' => array(
                                array(
                                    'key' => 'wpcf-event-date',
                                    'value' => time(),
                                    'compare' => '<='
                                ),
                            ),    
                        );
                        
                        $confs = new WP_Query( $args);
                        
                        if ( $confs->have_posts() ) :
                            ?>
                            <ul class="conf-nav-list">
                                <?php while ( $confs->have_posts() ) : $confs->the_post(); ?>
                                    <?php $active = $currID == $post->ID ? 'active' : ''; ?>
                                    <li class="<?= $active; ?>">
                                        <a href="<?php echo get_the_permalink(); ?>"><?= types_render_field("event-date", array("style" => "text", "format" => "Y")); ?></a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; wp_reset_query(); ?>
                    </div>
                    
                    <ul class="tab-nav">
                        <li><a class="active" href="#tab-1">Photos</a></li>
                        <li><a href="#tab-2">Videos</a></li>
                        <li><a href="#tab-3">Speakers</a></li>
                        <li><a href="#tab-4">Schedule</a></li>
                    </ul>
                    <div class="tab-content active" id="tab-1">
                        <?= types_render_field('conference-photos'); ?>
                    </div>
                    <div class="tab-content" id="tab-2">
                        <?php $videos = types_child_posts("event-highlights") ?>
                        <ul class="event-highlight-list">
                            <?php foreach($videos as $video) : ?>
                                <li>
                                    <?php 
                                    $meta = get_post_meta($video->ID); 
                                    $vid_url = $meta['wpcf-event-highlight-vimeo-url'][0];
                                    $desc = $meta['wpcf-event-highlight-short-description'][0];
                                    ?>
                                    <a href="<?= $vid_url; ?>" data-lity>
                                        <img src="<?php echo get_the_post_thumbnail_url($video->ID, 'event-highlight'); ?>" />
                                        <svg class="icon">
                                            <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/svg/sprite.svg#video"></use>
                                        </svg>
                                    </a>
                                    <h3><a href="<?= $vid_url; ?>" data-lity><?php echo $video->post_title; ?></a></h3>
                                    <div class="description">
                                        <?php echo $desc; ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="tab-content" id="tab-3">
                        <?php $appearances = types_child_posts("appearances") ?>
                        <ul class="speaker-list">
                            <?php foreach($appearances as $appearance) : ?>
                                <?php 
                                $sp_id = wpcf_pr_post_get_belongs($appearance->ID, 'conference-speaker'); 
                                $speaker = get_post($sp_id);
                                ?>
                                <li>
                                    <img src="<?php echo get_the_post_thumbnail_url($speaker->ID, 'person'); ?>" />
                                    <h3>
                                        <?php echo $speaker->post_title; ?>
                                    </h3>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="tab-content" id="tab-4">
                        <?= types_render_field('conference-schedule'); ?>
                    </div>
                </section>
            </div>
            
            <?php get_template_part('billboard', 'join') ?>
            
        </article>
        
        <?php 
        // Base Single Events Template
        else : 
            ?>
            
            <article role="main" class="page single-event" id="post-<?php the_ID(); ?>">
                
                <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
                    <div class="container">
                        <?php
                        $date = types_render_field("event-date", array("format" => "M j, Y"));
                        $weekday = types_render_field("event-date", array("format" => "D"));
                        $month = types_render_field("event-date", array("format" => "M"));
                        $day = types_render_field("event-date", array("format" => "d"));
                        $location = types_render_field("event-location", array("raw" => true));
                        ?>
                        <div class="date">
                            <span class="month"><?php echo $month; ?></span>
                            <span class="day"><?php echo $day; ?></span>
                        </div>
                        <h1><?php the_title(); ?></h1>
                        <div class="location">
                            <?php echo $location; ?>
                        </div>
                    </div>
                </div>
                
                <div class="primary container">
                    <section class="content">
                        <?php 
                        $signup         = types_render_field("event-signup");
                        $event_info     = types_render_field("event-info");
                        $program        = types_render_field('event-program');
                        $location_info  = types_render_field('event-location-info');
                        $submissions    = types_render_field('event-submissions');
                        $cancellation   = types_render_field('event-cancellation');
                        $promo          = types_render_field('promo-images', array('size'=>'promo', 'separator' => '</li><li>'));
                        ?>
                        
                        <?php if ($promo): ?>
                            <div class="flexslider">
                                <ul class="slides">
                                    <li>
                                        <?= $promo; ?>
                                    </li>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($signup) : ?>
                            <div class="signup subsection" id="signup">
                                <?= $signup; ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($event_info) : ?>
                            <div class="event-info subsection" id="event-info">
                                <?= $event_info; ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php 
                        $appearances = types_child_posts("appearances");
                        if ( $appearances ) :
                            ?>
                            <div class="speakers subsection" id="speakers">
                                <h2>Speakers</h2>
                                <ul class="speaker-list">
                                    <?php foreach($appearances as $appearance) : ?>
                                        <?php 
                                        $sp_id = wpcf_pr_post_get_belongs($appearance->ID, 'conference-speaker'); 
                                        $speaker = get_post($sp_id);
                                        ?>
                                        <li>
                                            <img src="<?php echo get_the_post_thumbnail_url($speaker->ID, 'person'); ?>" />
                                            <h3>
                                                <?php echo $speaker->post_title; ?>
                                            </h3>
                                        </li>
                                    <?php endforeach; ?>                    
                                </ul>               
                            </div>      
                        <?php endif ;?>
                        
                        <?php if ($program) : ?>
                            <div class="program subsection" id="program">
                                <h2>Program</h2>
                                <?= $program; ?>
                            </div>   
                        <?php endif; ?>
                        
                        <?php if ($submissions) : ?>
                            <div class="submissions subsection" id="submissions">
                                <h2>Submissions</h2>
                                <?= $submissions; ?>      
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($location_info) : ?>
                            <div class="location subsection" id="location">
                                <h2>Location &amp; Accommodations</h2>
                                <?= $location_info; ?>      
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($cancellation) : ?>
                            <div class="cancellation subsection" id="cancellation">
                                <h2>Cancellation &amp; Refund Policy</h2>
                                <?= $cancellation; ?>
                            </div>
                        <?php endif; ?>
                        
                    </section>
                    <section role="complementary" class="secondary-content">
                        <nav class="subnav">
                            <?php if ($signup) : ?>
                                <li><a href="#signup">Signup</a></li>
                            <?php endif; ?>
                            <?php if ($event_info) : ?>
                                <li><a href="#event-info">Event Information</a></li>
                            <?php endif; ?>
                            <?php if ( $appearances) : ?>
                                <li><a href="#speakers">Speakers</a></li>
                            <?php endif; ?>
                            <?php if ($program) : ?>
                                <li><a href="#program">Program</a></li>
                            <?php endif; ?>
                            <?php if ($submissions) : ?>
                                <li><a href="#submissions">Submissions</a></li>
                            <?php endif; ?>
                            <?php if ($location_info) : ?>
                                <li><a href="#location">Location &amp; Accommodations</a></li>
                            <?php endif; ?>
                            <?php if ($cancellation) : ?>
                                <li><a href="#cancellation">Cancellation &amp; Refund Policy</a></li>
                            <?php endif; ?>
                        </nav>
                    </section>
                </div>
                
            </article>
            
        <?php endif; ?>
        
    <?php endwhile; ?>
    
    <?php get_footer(); ?>
