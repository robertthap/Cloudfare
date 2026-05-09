<?php
declare(strict_types=1);

$pageTitle = 'Page not found';
$current = '';

require __DIR__ . '/includes/config.php';

if (!CF_STATIC_BUILD && PHP_SAPI !== 'cli') {
    http_response_code(404);
}

$noIndex = true;

require __DIR__ . '/includes/header.php';
?>

<section class="section section-white">
    <div class="container" style="max-width: 640px; text-align: center; padding-top: 2rem; padding-bottom: 3rem;">
        <h1 class="hero-title" style="font-size: 1.75rem;">Page not found</h1>
        <p class="muted mb-8">That page does not exist or may have moved.</p>
        <div class="btn-group btn-group-center">
            <a href="<?php echo e(url('index.php')); ?>" class="btn btn-primary">Home</a>
            <a href="<?php echo e(url('menu.php')); ?>" class="btn btn-outline">Menu</a>
            <a href="<?php echo e(url('contact.php')); ?>" class="btn btn-outline">Contact</a>
        </div>
    </div>
</section>

<?php
require __DIR__ . '/includes/footer.php';
