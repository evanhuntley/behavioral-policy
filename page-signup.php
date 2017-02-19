<?php
/*
    Template Name: Signup Page
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article role="main" class="type-page signup" id="post-<?php the_ID(); ?>">

        <div class="subscriptions-main">
            <div class="container">
                <div class="subtitle">Thank you for your interest in the</div>
                <h1>behavioral science &amp; policy association</h1>
                <div class="subscription-content">
                    <?php the_content(); ?>
                    <ul>
                        <li class="level">
                            <h3>bspa membership (professional)</h3>
                            <div class="price">
                                <span class="currency">$</span>
                                <span class="integer-part">150</span>
                                <sup class="decimal-part">00</sup>
                                <span class="time">/ year</span>
                            </div>
                            <a class="button" href="/signup/bspa-pro">Select</a>
                        </li>
                        <li class="level">
                            <h3>bspa membership (emeritus)</h3>
                            <div class="price">
                                <span class="currency">$</span>
                                <span class="integer-part">112</span>
                                <sup class="decimal-part">00</sup>
                                <span class="time">/ year</span>
                            </div>
                            <a class="button" href="/signup/bspa-emeritus">Select</a>
                        </li>
                        <li class="level">
                            <h3>bspa membership (student)</h3>
                            <div class="price">
                                <span class="currency">$</span>
                                <span class="integer-part">75</span>
                                <sup class="decimal-part">00</sup>
                                <span class="time">/ year</span>
                            </div>
                            <a class="button" href="/signup/bspa-student">Select</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="subscription-options">
            <div class="container">
                <h2>BSP Subscription Options (Non-Member)</h2>
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
        </div>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
