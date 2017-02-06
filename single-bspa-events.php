
<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    
    <?php
        $terms = get_the_terms($post->ID, 'event-types');
        if ($terms) {
            $term = array_shift( $terms );
            $event_type = $term->slug;
        } else {
            $event_type = '';
        }
        
        $date = get_post_meta($post->ID, 'wpcf-event-date', true);
        
        if ($event_type == 'conference') :
    ?>
    
    <article role="main" class="page single-conference" id="post-<?php the_ID(); ?>">

        <div class="page-header">
            <div class="container">
                <h1>BSPA Annual Conference</h1>
                <p>BSPA hosts a range of annual events aimed at fostering networking within the behavioral science and policy communities. Spotlight workshops bring policymakers, practitioners and scientists together to brainstorm various research 'best practices' and topic areas.</p>
            </div>
        </div>

        <div class="primary container">
            <section class="content">
                <?php if ($date > time()) : ?>
                    <div class="current-conference">
                        <?php 
                            $date = types_render_field("event-date", array("format" => "M j, Y"));
                            $weekday = types_render_field("event-date", array("format" => "D"));
                            $month = types_render_field("event-date", array("format" => "M"));
                            $day = types_render_field("event-date", array("format" => "d"));
                            $year = types_render_field("event-date", array("format" => "Y"));
                        ?>
                        <div class="event-date">
                            <span class="month"><?= $month; ?></span>
                            <span class="day"><?= $day; ?></span>
                            <span class="year"><?= $year; ?></span>
                        </div>
                        <h1><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                        <hr />
                        <h2>About the BSPA Annual Conference</h2>
                        <img class="about-conference" src="<?php echo get_template_directory_uri(); ?>/assets/img/g_conference.png" alt="BSPA Conference" />
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, quam harum? Quisquam iusto sint quibusdam totam aliquam enim aliquid reiciendis tempore, ullam, qui dolorum dicta repudiandae provident laborum harum. Quaerat?</p>
                        <hr />
                        <h3>Check out Photos, Videos and More from Our Past Conferences</h3>
                        <?php // loop through events, tax query for conference, check dates, display buttons ?>
                        <?php 
                            $args = array(
                                'post_type' => 'bspa-events',
                                'posts_per_page' => -1,
                                'meta_query' => array(
                                    array(
                                        'key'	  	=> 'wpcf-event-date',
                                        'value'	  	=> time(),
                                        'compare' 	=> '<',
                                    )
                                ),
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'event-types',
                                        'field'    => 'slug',
                                        'terms'    => 'conference',
                                    ),
                                )
                            );

                            $events = new WP_Query( $args);

                            while ( $events->have_posts() ) : $events->the_post(); 
                        ?>
                            <a class="button" href="<?php echo get_the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <h1><?php the_title(); ?></h1>
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
                                    <a href="<?= $vid_url; ?>" data-lity><img src="<?php echo get_the_post_thumbnail_url($video->ID, 'event-highlight'); ?>" /></a>
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
                <?php endif; ?>
            </section>
        </div>

        <?php get_template_part('billboard', 'join') ?>

    </article>
    
    <?php else : ?>
    
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

        <div class="primary container" id="event-info">
            <section class="content">
                <?php the_content(); ?>
            </section>
            <section role="complementary" class="secondary-content">
                <nav class="subnav">
                    <li><a href="#event-info">Event Information</a></li>
                    <li><a href="#location-details">Location</a></li>
                    <li><a href="#program-highlights">Program Highlights</a></li>
                    <li><a href="#speakers">Speakers</a></li>
                    <li><a href="#submissions">Submissions</a></li>
                </nav>
            </section>
        </div>

        <div class="location-details" id="location-details">
            <div class="primary container">
                <div class="content">
                    <h2>Location</h2>
                    <?php echo types_render_field('event-location-details'); ?>
                </div>
            </div>
        </div>
        
        <div class="program-highlights" id="program-highlights">
            <div class="primary container">
                <div class="content">
                    <h2>Program Highlights</h2>
                    <?php echo types_render_field('event-program-highlights'); ?>    
                </div>
            </div>
        </div>
        
        <div class="speakers" id="speakers">
            <div class="primary container">
                <div class="content">
                    <h2>Speakers</h2>
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
            </div> 
        </div>
        
        <div class="submission-info" id="submissions">
            <div class="primary container">
                <div class="content">
                    <h2>Submissions</h2>
                    <?php echo types_render_field('event-submission-info'); ?>      
                    <hr />
                    <h3>Suggested Events</h3>
                    <?php
                        $args = array(
                            'post_type' => 'bspa-events',
                            'posts_per_page' => 3,
                            'order' => 'RAND',
                            'meta_query' => array(
                                array(
                                    'key'	  	=> 'wpcf-event-date',
                                    'value'	  	=> time(),
                                    'compare' 	=> '<',
                                )
                            )
                        );

                        $events = new WP_Query( $args);

                        if ( $events->have_posts() ) :
                    ?>
                        <ul class="events-list">
                            <?php while ( $events->have_posts() ) : $events->the_post();

                                $date = types_render_field("event-date", array("format" => "M j, Y"));
                                $weekday = types_render_field("event-date", array("format" => "D"));
                                $month = types_render_field("event-date", array("format" => "M"));
                                $day = types_render_field("event-date", array("format" => "d"));
                                $location = types_render_field("event-location", array("raw" => true));
                            ?>
                                <li class="event">
                                    <div class="event-date">
                                        <span class="weekday"><?= $weekday; ?></span>
                                        <span class="month"><?= $month; ?></span>
                                        <span class="day"><?= $day; ?></span>
                                    </div>
                                    <div class="event-details">
                                        <h2><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <div class="location"><?= $location; ?></div>
                                        <?= $date; ?>
                                    </div>
                                    <div class="description">
                                        <?php the_content(); ?>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php get_template_part('billboard', 'conference') ?>

    </article>
    
    <?php endif; ?>
    
<?php endwhile; ?>

<?php get_footer(); ?>
