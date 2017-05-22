<?php
/*
    Template Name: About Page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page about" id="post-<?php the_ID(); ?>">
        <div class="billboard light who">
            <div class="container">
                <h2>Who We Are</h2>
                <h3>we are a global community of public and private sector decision makers, behavioral science researchers, policy analysts, and practitioners with a bold mission to promote the application of rigorous behavioral science research that serve the public interest. we serve as an information hub, and community builder- connecting individuals and organizations through our conferences, spotlight workshops, taskforces, and the publication of newsletters and behavioral science &amp; policy.</h3>
            </div>
        </div>
        <div class="billboard philosophy">
            <div class="container">
                <h2>Our Philosophy</h2>
                <h3>the impact of public and private sector policies depends critically on the behavior of individuals, groups, and organizations. we believe a clear understanding of the power of behavioral science research and interventions can provide innovative solutions for addressing challenges faced by policymakers and other practitioners.</h3>
            </div>
        </div>
        <div class="billboard light community">
            <div class="container">
                <h2>Our Community</h2>
                <h3>bspa is a global hub where behavioral scientists, policymakers, and other practitioners interact via conferences, workshops, briefings,and our membership portal. in addition, our membership services facilitate information exchange and collaboration to promote thoughtful application of behavioral science research in ways that serve the public interest. we actively collaborate with a number of behavioral policy oriented organizations and direct our members to their activities and services.</h3>
            </div>
        </div>

        <div class="primary container">
            <?php get_sidebar(); ?>
            <section class="content">
                <div class="team" id="team">
                    <h1>Meet Our Team</h1>
                    <ul class="grid-filters">
                        <li class="active" data-filter="*">All</li>
                        <?php
                            $terms = get_terms( array(
                                'taxonomy' => 'team-roles',
                                'include' => array(4, 5, 6, 7),
                                'orderby' => 'name',
                                'order' => 'ASC'
                            ) );

                            foreach($terms as $term) :
                        ?>
                        <li data-filter=".<?php echo $term->slug; ?>">
                            <?php 
                                $str = str_replace("-", " ", $term->slug);
                                echo $str;
                            ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <ul class="grid">
                    <?php
                        $args = array(
                            'post_type' => 'people',
                            'posts_per_page' => -1,
                            'order' => 'ASC',
                            'orderby' => 'title',
                            'tax_query' => array(
                        		array(
                        			'taxonomy' => 'team-roles',
                        			'field'    => 'slug',
                        			'terms'    => array( 'bspa-team', 'advisory-board', 'executive-committee' ),
                        		),
                        	),                            
                        );
                        $people = new WP_Query( $args);

                        while ( $people->have_posts() ) : $people->the_post();

                        $roles = get_the_terms($post, 'team-roles');

                        $role_slugs = '';
                        foreach($roles as $role) {
                            $role_slugs .= $role->slug . ' ';
                        }

                    ?>
                        <li class="grid-item <?php echo $role_slugs; ?>">
                            <a href="<?php echo get_the_permalink(); ?>">
                                <img src="<?php the_post_thumbnail_url('bio-thumb'); ?>" alt="<?php echo get_the_title(); ?>" />
                            </a>
                            <h1><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            <p>
                                <?php
                                    $i = 1;
                                    foreach($roles as $role) {
                                        echo '<span>' . $role->name;
                                        if ( $i < sizeof($roles)) {
                                            echo ',';
                                        }
                                        echo '</span>';
                                        $i++;
                                    }
                                ?>
                            </p>
                        </li>
                    <?php endwhile; wp_reset_query(); ?>
                    </ul>

                </div>
            </section>
        </div>
        
        <div class="leadership-council">
            <div class="container">
                <div class="content">
                    <h2>Leadership Council</h2>
                    <?= types_render_field("leadership-council-content"); ?>
                </div>
            </div>
        </div>
        
        <?php get_template_part('areas-block') ?>
        
        <div class="block faq" id="faq">
            <div class="container">
                <div class="faq-list">
                    <h1>frequently asked questions</h1>
                    <ul class="expand-list">
                        <li class="faq-item">
                            <div class="faq-title expand-title">What is 'Behavioral Science'?</div>
                            <div class="faq-description expand-description">BSPA takes a broad view of Behavioral Science, describing it as the cross-disciplinary science of understanding the causes of individual, group and organizational behavior across different levels. Behavioral Science encompasses the social sciences, and brings together insights and methods from a variety of fields and disciplines, for example judgement and decision-making, behavioral economics, organizational behavior, neuroscience, and social and cognitive psychology. Under the umbrella of Behavioral Science, these disciplines, which separately do not provide a complete picture of human behavior, offer a comprehensive toolkit to bridge the gap between economic models and everyday reality to shape both private- and public-sector policy and practice.</div>
                        </li>
                        <li class="faq-item">
                            <div class="faq-title expand-title">Why does BSPA exist?</div>
                            <div class="faq-description expand-description">BSPA is a 501(c)3 nonprofit, bi-partisan organization promoting public understanding of how empirically validated insights from behavioral science can provide innovative and effective policy solutions. A membership organization, BSPA fosters engagement between the behavioral science and policy communities, helps link existing organizations in the space, aggregates resource and event information, prioritizes, vets, and promotes new research, and facilitates the spread and implementation of actionable insights within the field through matchmaking and other activities.</div>
                        </li>
                        <li class="faq-item">
                            <div class="faq-title expand-title">Is BSPA linked with any particular political ideology?</div>
                            <div class="faq-description expand-description">BSPA is a nonpartisan, independent organization, free from political bias or an obligation to favor members of a particular institution. We instead focus on promoting collaboration across individuals, disciplines, and organizations – publicizing work of merit, regardless of the source.</div>
                        </li>
                        <li class="faq-item">
                            <div class="faq-title expand-title">How is BSPA funded?</div>
                            <div class="faq-description expand-description">BSPA relies on dues from individual members, grants, sales of our publication Behavioral Science &amp; Policy, and the generosity of foundations and philanthropists to fund our operations.</div>
                        </li>
                        <li class="faq-item">
                            <div class="faq-title expand-title">How can I participate?</div>
                            <div class="faq-description expand-description">
                                <p>We are constantly looking to partner with others, and would love to have you join us, as a paid member, or a volunteer! To stay up-to-date on our activities and opportunities, sign up for our monthly newsletter which features calls for papers, participation in work groups, and highlights BSPA events as well as our other community members.</p>
                                <p>Have an idea for ways that we can add further value to the community? Send your thoughts to <a href="mailto:ideas@behavioralpolicy.org">ideas@behavioralpolicy.org</a></p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
