<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

$logoFsPath = dirname(__DIR__) . '/assets/logo.png';
$showNavLogo = is_file($logoFsPath);

/** @var string $pageTitle */
/** @var string $current slug: index|menu|about|reviews|order|contact */
/** @var bool $noIndex set true on error pages */
/** @var string|null $canonicalHref absolute URL override */
/** @var string|null $metaDesc meta description override */
/** @var string|null $ogTitle Open Graph title override */
/** @var string|null $ogDescription Open Graph description override */
/** @var string|null $ogImage absolute image URL override */
$hideNav = $hideNav ?? false;
$bodyClass = $bodyClass ?? '';
$noIndex = $noIndex ?? false;

$metaDesc = $metaDesc ?? (SITE_LEGAL_NAME . ' — ' . SITE_TAGLINE . '. Modern Australian & Himalayan cuisine in Pennant Hills, NSW.');
$scriptBase = basename($_SERVER['SCRIPT_NAME'] ?? 'index.php');
if (!isset($canonicalHref)) {
    $canonicalHref = absolute_url($scriptBase === 'index.php' ? '' : $scriptBase);
}
$ogTitle = $ogTitle ?? ($pageTitle . ' — ' . SITE_DISPLAY_NAME);
$ogDescription = $ogDescription ?? $metaDesc;
$ogImage = $ogImage ?? absolute_url('images/site/hero.jpg');

$canonicalIsAbsolute = str_starts_with((string) $canonicalHref, 'http');
$ogImageIsAbsolute = str_starts_with((string) $ogImage, 'http');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo e($pageTitle); ?> - <?php echo e(SITE_LEGAL_NAME); ?></title>
    <meta name="description" content="<?php echo e($metaDesc); ?>" />
<?php if ($noIndex): ?>
    <meta name="robots" content="noindex, follow" />
<?php endif; ?>
<?php if ($canonicalIsAbsolute): ?>
    <link rel="canonical" href="<?php echo e($canonicalHref); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo e($ogTitle); ?>" />
    <meta property="og:description" content="<?php echo e($ogDescription); ?>" />
    <meta property="og:url" content="<?php echo e($canonicalHref); ?>" />
<?php if ($ogImageIsAbsolute): ?>
    <meta property="og:image" content="<?php echo e($ogImage); ?>" />
<?php endif; ?>
    <meta name="twitter:card" content="<?php echo $ogImageIsAbsolute ? 'summary_large_image' : 'summary'; ?>" />
    <meta name="twitter:title" content="<?php echo e($ogTitle); ?>" />
    <meta name="twitter:description" content="<?php echo e($ogDescription); ?>" />
<?php if ($ogImageIsAbsolute): ?>
    <meta name="twitter:image" content="<?php echo e($ogImage); ?>" />
<?php endif; ?>
<?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(url('css/site.css')); ?>" />
</head>
<body<?php echo $bodyClass !== '' ? ' class="' . e($bodyClass) . '"' : ''; ?>>
<a href="#main-content" class="skip-link">Skip to main content</a>

<?php if (!$hideNav): ?>
<nav class="top-nav" aria-label="Primary">
    <div class="nav-container">
        <a href="<?php echo e(url('index.php')); ?>" class="nav-logo" aria-label="<?php echo e(SITE_DISPLAY_NAME); ?> home">
            <?php if ($showNavLogo): ?>
                <img src="<?php echo e(url('assets/logo.png')); ?>" alt="" class="nav-logo-img" />
            <?php endif; ?>
            <span class="nav-logo-text"><?php echo e(SITE_DISPLAY_NAME); ?></span>
        </a>

        <div class="nav-links">
            <?php
            $nav = [
                ['index.php', 'Home', 'index'],
                ['menu.php', 'Menu', 'menu'],
                ['about.php', 'About', 'about'],
                ['reviews.php', 'Reviews', 'reviews'],
                ['order.php', 'Order', 'order'],
                ['contact.php', 'Contact', 'contact'],
            ];
            foreach ($nav as [$href, $label, $slug]):
                $active = ($current ?? '') === $slug ? ' active' : '';
                $aria = ($current ?? '') === $slug ? ' aria-current="page"' : '';
                ?>
                <a href="<?php echo e(url($href)); ?>" class="<?php echo trim($active); ?>"<?php echo $aria; ?>><?php echo e($label); ?></a>
            <?php endforeach; ?>
        </div>

        <button type="button" class="nav-mobile-toggle" aria-label="Toggle menu" aria-expanded="false" aria-controls="mobileNav" id="mobileNavToggle">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" /></svg>
        </button>
    </div>

    <div class="nav-mobile" id="mobileNav">
        <?php foreach ($nav as [$href, $label, $slug]):
            $active = ($current ?? '') === $slug ? ' active' : '';
            $aria = ($current ?? '') === $slug ? ' aria-current="page"' : '';
            ?>
            <a href="<?php echo e(url($href)); ?>" class="<?php echo trim($active); ?>"<?php echo $aria; ?>><?php echo e($label); ?></a>
        <?php endforeach; ?>
    </div>
</nav>
<?php endif; ?>

<main role="main" id="main-content">
