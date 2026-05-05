<?php
declare(strict_types=1);

$pageTitle = 'Order Online';
$current = 'order';

require __DIR__ . '/includes/config.php';

$ogImage = absolute_url('images/site/whole-chicken-meal.jpg');

require __DIR__ . '/includes/header.php';
?>

<div class="page-order" style="--page-order-photo: url('<?php echo e(url('images/site/chicken-pizza.jpg')); ?>');">
<section class="hero hero--photo" style="--hero-photo: url('<?php echo e(url('images/site/whole-chicken-meal.jpg')); ?>');">
    <div class="container">
        <div class="hero-inner">
            <h1 class="hero-title">Order Online</h1>
            <p class="hero-subtitle">Choose your preferred way to order.</p>
        </div>
    </div>
</section>

<section class="section section-white section-order-main">
    <div class="container" style="max-width: 820px;">
        <div class="form-card order-card-elevated" style="text-align: center;">
            <h2 class="section-title section-title-center" style="margin-bottom: 0.5rem;">Order on Our Website</h2>
            <p class="muted mb-8">Place your order directly and we'll have it ready for you.</p>
            <a href="<?php echo e(ORDER_UP_URL); ?>" target="_blank" rel="noopener" class="btn btn-primary">Order Now</a>
        </div>
    </div>
</section>

<section class="section section-muted section-order-partners">
    <div class="container">
        <h2 class="section-title section-title-center">Order via Our Partners</h2>
        <div class="grid grid-2">
            <a href="<?php echo e(UBER_EATS_URL); ?>" target="_blank" rel="noopener" class="info-card card-hover" style="text-decoration: none; text-align: center;">
                <div class="info-icon" aria-hidden="true" style="margin: 0 auto 1rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
                <h3 class="info-title">Uber Eats</h3>
                <p class="muted">Fast delivery across Pennant Hills and nearby suburbs.</p>
                <p class="brand bold" style="margin-top: 0.75rem;">Open Uber Eats →</p>
            </a>

            <a href="<?php echo e(DOORDASH_URL); ?>" target="_blank" rel="noopener" class="info-card card-hover" style="text-decoration: none; text-align: center;">
                <div class="info-icon" aria-hidden="true" style="margin: 0 auto 1rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                </div>
                <h3 class="info-title">DoorDash</h3>
                <p class="muted">Order through DoorDash for delivery or pickup.</p>
                <p class="brand bold" style="margin-top: 0.75rem;">Open DoorDash →</p>
            </a>
        </div>

        <div class="text-center" style="margin-top: 2rem;">
            <p class="muted" style="margin-bottom: 1rem;">Prefer to phone it in?</p>
            <a href="<?php echo e(SITE_PHONE_TEL); ?>" class="btn btn-outline">Call <?php echo e(SITE_PHONE_DISPLAY); ?></a>
        </div>
    </div>
</section>
</div>

<?php
require __DIR__ . '/includes/footer.php';
