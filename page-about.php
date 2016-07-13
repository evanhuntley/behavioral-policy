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
                <p>we are a global community of public and private sector decision makers, behavioral science researchers, policy analysts, and practitioners with a bold mission to promote the application of rigorous behavioral science research that serve the public interest. we serve as an information hub, and community builder- connecting individuals and organizations through our conferences, spotlight workshops, taskforces, and the publication of newsletters and behavioral science &amp; policy.</p>
            </div>
        </div>
        <div class="billboard philosophy">
            <div class="container">
                <h2>Our Philosophy</h2>
                <h3>the impact of public and private sector policies depends critically on the behavior of individuals, groups, and organizations.</h3>
                <p>we believe a clear understanding of the power of behavioral science research and interventions can provide innovative solutions for addressing challenges faced by policymakers and other practitioners.</p>
            </div>
        </div>
        <div class="billboard light community">
            <div class="container">
                <h2>Our Community</h2>
                <h3>bspa is a global hub where behavioral scientists, policymakers, and other practitioners interact via conferences, workshops, briefings,and our membership portal.</h3>
                <p>in addition, our membership services facilitate information exchange and collaboration to promote thoughtful application of behavioral science research in ways that serve the public interest.</p>
                <p>we actively collaborate with a number of behavioral policy oriented organizations and direct our members to their activities and services.</p>
            </div>
        </div>

        <div class="team">
            <ul class="grid">
            <?php
                $args = array(
                    'post_type' => 'people',
                    'posts_per_page' => -1,
                    'order' => 'ASC',
                    'orderby' => 'title'
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
                    <h1><?php the_title(); ?></h1>
                    <p>
                        <?php
                            foreach($roles as $role) {
                                echo $role->name;
                            }
                        ?>
                    </p>
                </li>
            <?php endwhile; wp_reset_query(); ?>
            </ul>

        </div>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
