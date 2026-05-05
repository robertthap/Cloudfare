<?php
declare(strict_types=1);

$pageTitle = 'Reviews';
$current = 'reviews';

require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/testimonials.php';
require __DIR__ . '/includes/header.php';
?>

<section class="hero hero--photo" style="--hero-photo: url('<?php echo e(url('images/site/double-whammy.jpg')); ?>');">
    <div class="container">
        <div class="hero-inner">
            <h1 class="hero-title">Reviews &amp; Gallery</h1>
            <p class="hero-subtitle">Kind words from our guests — plus photos from our kitchen.</p>
        </div>
    </div>
</section>

<section class="section section-white">
    <div class="container gmp-reviews-page-wrap">
        <h2 class="section-title section-title-center">What diners say</h2>
        <?php render_testimonials(testimonials_reviews(), 2); ?>
        <div class="text-center" style="margin-top: 1.5rem;">
            <a href="<?php echo e(GOOGLE_MAPS_REVIEWS); ?>" target="_blank" rel="noopener" class="btn btn-outline">See Google reviews</a>
        </div>
    </div>
</section>

<section class="section section-muted">
    <div class="container">
        <h2 class="section-title">Photo Gallery</h2>
        <div class="gallery">
            <div class="gallery-item"><img src="<?php echo e(url('images/site/momo.png')); ?>" alt="Steamed momos" loading="lazy" /></div>
            <div class="gallery-item"><img src="<?php echo e(url('images/site/whole-chicken-chips-rice.jpg')); ?>" alt="Himalayan curry" loading="lazy" /></div>
            <div class="gallery-item"><img src="<?php echo e(url('images/site/aussie-beef-burger.jpg')); ?>" alt="House burger" loading="lazy" /></div>
            <div class="gallery-item"><img src="<?php echo e(url('images/site/whole-chicken-meal.jpg')); ?>" alt="Tandoori chicken" loading="lazy" /></div>
            <div class="gallery-item"><img src="<?php echo e(url('images/site/chowmein.png')); ?>" alt="Chowmein noodles" loading="lazy" /></div>
            <div class="gallery-item"><img src="<?php echo e(url('images/site/whole-chicken-chips-rice.jpg')); ?>" alt="Biryani rice" loading="lazy" /></div>
            <div class="gallery-item"><img src="<?php echo e(url('images/site/vegetarian-pizza.jpg')); ?>" alt="Garlic naan" loading="lazy" /></div>
            <div class="gallery-item"><img src="<?php echo e(url('images/site/large-fries.jpg')); ?>" alt="Crispy samosa" loading="lazy" /></div>
        </div>
    </div>
</section>

<?php
require __DIR__ . '/includes/footer.php';
