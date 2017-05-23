<?php
/*
    Template Name: Member Portal
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page portal">
        
        <?php 
            global $current_user;
            get_currentuserinfo();
            $full_name = $current_user->display_name;
            $arr = explode(" ", $full_name, 2);
            $first = $arr[0];
        ?>

        <div class="page-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="container">
                <h1>Hi, <?= $first; ?>! Welcome to the BSPA Member Portal!</h1>
                <?php echo types_render_field("page-short-description"); ?>
            </div>
        </div>

        <div class="primary container">
            <section class="content">
                <ul class="tab-nav">
                    <li><a class="active" href="#tab-1"><?= types_render_field('portal-tab1-name'); ?></a></li>
                    <li><a href="#tab-2"><?= types_render_field('portal-tab2-name'); ?></a></li>
                    <li><a href="/articles">BSP Archive</a></li>
                    <li><a href="#tab-4"><?= types_render_field('portal-tab4-name'); ?></a></li>
                </ul>
                <div class="tab-content active" id="tab-1">
                    <div class="primary">
                        <h1>News</h1>
                        <div class="segment">
                            <?= types_render_field('portal-segment-1'); ?>
                        </div>
                        <div class="segment">
                            <?= types_render_field('portal-segment-2'); ?>
                        </div>
                        <div class="segment">
                            <?= types_render_field('portal-segment-3'); ?>
                        </div>
                        <div class="suggested-news news-section">
                            <h2>Suggested News and Media</h2>
                            <?php 
                                $args = array(
                            		'post_type' => 'news',
                            		'posts_per_page' => 6,
                            		'order' => 'RAND'
                            	);              
                                
                                $suggested = new WP_Query($args);    
                                
                                if ($suggested->have_posts()) :
                             ?>
                                 <ul>
                                     <?php while ( $suggested->have_posts() ) : $suggested->the_post(); ?>
                                         <?php get_template_part('loop', 'newsitem') ?>
                                     <?php endwhile;  ?>
                                 </ul>
                             <?php endif; wp_reset_query(); ?>
                        </div>
                        <div class="portal-tweets">
                            <h2>Our Favorite Tweets This Week</h2>
                            <div class="row">
                                <div class="tweet">
                                    <?= types_render_field("portal-tweet-1"); ?>
                                </div>
                                <div class="tweet">
                                    <?= types_render_field("portal-tweet-2"); ?>
                                </div>
                                <div class="tweet">
                                    <?= types_render_field("portal-tweet-3"); ?>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="sidebar">
                        
                        <div class="calendar-widget">
                            <h3>Upcoming Events</h3>
                            <?php
                                $args = array(
                                    'post_type' => 'bspa-events',
                                    'posts_per_page' => -1,
                                    'orderby' => 'meta_value',
                                    'meta_key'  => 'wpcf-event-date',
                                    'order' => 'ASC',
                                    'meta_query' => array(
                                        array(
                                            'key' => 'wpcf-event-date',
                                            'value' => time(),
                                            'compare' => '>='
                                        )
                                    )                            
                                );

                                $events = new WP_Query( $args);

                                if ( $events->have_posts() ) :
                            ?>
                                <ul class="cal-list">
                                    <?php while ( $events->have_posts() ) : $events->the_post();

                                        $date = types_render_field("event-date", array("format" => "M j, Y"));
                                        $weekday = types_render_field("event-date", array("format" => "D"));
                                        $month = types_render_field("event-date", array("format" => "M"));
                                        $day = types_render_field("event-date", array("format" => "d"));
                                    ?>
                                        <li class="event">
                                            <div class="event-date">
                                                <?php if (types_render_field('event-external-url')) : ?>
                                                    <a href="<?php echo types_render_field('event-external-url', array("raw" => true)); ?>">
                                                        <span class="weekday"><?= $weekday; ?></span>
                                                        <span class="month"><?= $month; ?></span>
                                                        <span class="day"><?= $day; ?></span>
                                                    </a>
                                                <?php else : ?>
                                                    <a href="<?php echo get_the_permalink(); ?>">
                                                        <span class="weekday"><?= $weekday; ?></span>
                                                        <span class="month"><?= $month; ?></span>
                                                        <span class="day"><?= $day; ?></span>
                                                    </a>
                                                <?php endif; ?>                                                
                                            </div>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; wp_reset_query(); ?>
                            <div class="events-key">
                                <ul>
                                    <li class="bspa">bspa event</li>
                                    <li class="community">community event</li>
                                    <li class="spotlight">spotlight event</li>
                                </ul>
                                <a href="/bspa-events/#calendar">See Full Calendar</a> 
                            </div>
                        </div>                        
                        
                    </div>
                </div>
                <div class="tab-content" id="tab-2">
                    <?php 
                        $favs = get_user_favorites($user_id = null, $site_id = null, $filters = null); 
                        
                        $args = array(
                            'post_type' => array( 'articles' ),
                            'orderby' => 'ASC',
                            'post__in' => $favs
                        );
                        
                        $favorites = new WP_Query($args);
                    ?>
                        <?php while ( $favorites->have_posts() ) : $favorites->the_post(); ?>
                            <?php get_template_part( 'loop', 'journal' ); ?>
                        <?php endwhile; ?>
                </div>
                <div class="tab-content" id="tab-3"></div>
                <div class="tab-content" id="tab-4">
                    <?php echo do_shortcode('[subscription_details]'); ?>
                </div>
            </section>
        </div>
        
        <?php get_template_part('billboard', 'submit') ?>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
