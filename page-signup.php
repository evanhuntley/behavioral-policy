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
                    <?php if(!rcp_is_active()) : ?>
                    <div class="sub-login">
                        <span>Already a Member?</span>
                        <a class="button" href="/login">Login</a>
                    </div>
                    <?php endif; ?>
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
                <ul class="option-list">
                    <li class="option">
                        <h3>bspa individual subscription (online-only)</h3>
                        <div class="price">
                            <span class="currency">$</span>
                            <span class="integer-part">30</span>
                            <sup class="decimal-part">00</sup>
                            <span class="time">/ year</span>
                        </div>
                        <ul>
                            <li>Non-Member</li>
                            <li>Online Subscription to Behavioral Science &amp; Policy</li>
                            <li>--</li>
                        </ul>
                        <a class="button light" href="/signup/bspa-indiv-online">Select</a>
                    </li>
                    <li class="option">
                        <h3>bspa individual subscription (online and print)</h3>
                        <div class="price">
                            <span class="currency">$</span>
                            <span class="integer-part">45</span>
                            <sup class="decimal-part">00</sup>
                            <span class="time">/ year</span>
                        </div>
                        <ul>
                            <li>Non-Member</li>
                            <li>Online Subscription to Behavioral Science &amp; Policy</li>
                            <li>Print edition mailed to you</li>
                        </ul>
                        <a class="button light" href="http://muse.jhu.edu/cgi-bin/single_title_subscription.cgi?year=2017">Select</a>
                    </li>
                    <li class="option">
                        <h3>bsp institutional subscription (online only)</h3>
                        <div class="price">
                            <span class="currency">$</span>
                            <span class="integer-part">225</span>
                            <sup class="decimal-part">00</sup>
                            <span class="time">/ year</span>
                        </div>
                        <ul>
                            <li>Non-Member</li>
                            <li>Online Subscription to Behavioral Science &amp; Policy</li>
                            <li>--</li>
                        </ul>
                        <a class="button light" href="http://muse.jhu.edu/cgi-bin/single_title_subscription.cgi?year=2016">Select</a>
                    </li>
                    <li class="option">
                        <h3>bsp institutional subscription (online and print)</h3>
                        <div class="price">
                            <span class="currency">$</span>
                            <span class="integer-part">255</span>
                            <sup class="decimal-part">00</sup>
                            <span class="time">/ year</span>
                        </div>
                        <ul>
                            <li>Non-Member</li>
                            <li>Online Subscription to Behavioral Science &amp; Policy</li>
                            <li>--</li>
                        </ul>
                        <a class="button light" href="http://muse.jhu.edu/cgi-bin/single_title_subscription.cgi?year=2016">Select</a>
                    </li>
                </ul>
            </div>
        </div>

    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
