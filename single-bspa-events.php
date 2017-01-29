
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
                        <h1><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                        <hr />
                        <h2>About the BSPA Annual Conference</h2>
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
                                    <?php echo $video->post_title; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="tab-content" id="tab-3">
                        <?php $speakers = types_child_posts("conference-speakers") ?>
                        <?php foreach($speakers as $speaker) : ?>
                            <?php echo $speaker->post_title; ?>
                        <?php endforeach; ?>
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
                    <?php echo $month; ?>
                    <?php echo $day; ?>
                </div>
                <h1><?php the_title(); ?></h1>
                <div class="location">
                    <?php echo $location; ?>
                </div>
            </div>
        </div>

        <div class="primary container">
            <?php get_sidebar(); ?>
            <section class="content">

            </section>
        </div>

        <?php get_template_part('billboard', 'conference') ?>

    </article>
    
    <?php endif; ?>
    
<?php endwhile; ?>

<?php get_footer(); ?>
