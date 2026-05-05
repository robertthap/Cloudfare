<?php
declare(strict_types=1);

$pageTitle = 'About';
$current = 'about';

require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/testimonials.php';
require __DIR__ . '/includes/header.php';
?>

<section class="hero hero--photo" style="--hero-photo: url('<?php echo e(url('images/site/hero.jpg')); ?>');">
    <div class="container">
        <div class="hero-inner">
            <h1 class="hero-title">About Us</h1>
            <p class="hero-subtitle">Our story, our flavours, and the people behind <?php echo e(SITE_DISPLAY_NAME); ?>.</p>
        </div>
    </div>
</section>

<section class="section section-white">
    <div class="container">
        <div class="split-image" style="height: 380px;">
            <img src="<?php echo e(url('images/site/hero.jpg')); ?>" alt="Inside the Namuna Foods restaurant" loading="lazy" />
        </div>
    </div>
</section>

<section class="section section-muted section--photo-soft" style="--section-soft-photo: url('<?php echo e(url('images/site/large-fries.jpg')); ?>');">
    <div class="container" style="max-width: 800px;">
        <h2 class="section-title">Our Story</h2>
        <div class="muted" style="display: flex; flex-direction: column; gap: 1.25rem; font-size: 1.05rem; line-height: 1.7;">
            <p>
                Namuna Foods was born from a simple idea: combine the warmth of Himalayan home cooking
                with the freshness of modern Australian cuisine under one roof. Our founders grew up
                between Nepal and Australia, and wanted to create a dining experience that celebrates
                both cultures.
            </p>
            <p>
                What began as a passion project has grown into a family-run restaurant in Pennant Hills.
                We pride ourselves on fresh local ingredients, authentic spices, and the kind of
                friendly service that makes every guest feel at home.
            </p>
            <p>
                Every dish tells a story — from our hand-folded momos made fresh daily to our
                crowd-favourite burgers and stone-baked pizzas. Whether you're trying Himalayan food
                for the first time or craving familiar Aussie comfort, you'll find something to love.
            </p>
            <p>
                Good food brings people together. Thank you for being part of our journey.
            </p>
        </div>
    </div>
</section>

<section class="section section-white">
    <div class="container">
        <h2 class="section-title section-title-center">Our Values</h2>
        <div class="grid grid-3">
            <div class="value-card">
                <span class="value-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </span>
                <h3 class="value-title">Quality Ingredients</h3>
                <ul class="value-list">
                    <li>Fresh produce sourced daily</li>
                    <li>Local Australian suppliers when possible</li>
                    <li>No compromise on flavour or freshness</li>
                    <li>Halal chicken options available</li>
                </ul>
            </div>

            <div class="value-card">
                <span class="value-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </span>
                <h3 class="value-title">Authentic Flavours</h3>
                <ul class="value-list">
                    <li>Traditional Himalayan recipes</li>
                    <li>Modern Australian favourites</li>
                    <li>Handcrafted momos, made fresh daily</li>
                    <li>Balanced spicing — never over the top</li>
                </ul>
            </div>

            <div class="value-card">
                <span class="value-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </span>
                <h3 class="value-title">Friendly Service</h3>
                <ul class="value-list">
                    <li>Warm welcome for every guest</li>
                    <li>Happy to recommend dishes</li>
                    <li>Dine-in, takeaway &amp; delivery</li>
                    <li>Your satisfaction is our priority</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section section-muted">
    <div class="container">
        <h2 class="section-title section-title-center">What diners say</h2>
        <?php render_testimonials(testimonials_home(), 3); ?>
        <div style="margin-top: 1.5rem; text-align: center;">
            <a href="<?php echo e(url('reviews.php')); ?>" class="btn btn-primary">Reviews &amp; gallery →</a>
        </div>
    </div>
</section>

<?php
require __DIR__ . '/includes/footer.php';
