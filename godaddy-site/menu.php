<?php
declare(strict_types=1);

$pageTitle = 'Menu';
$current = 'menu';

require __DIR__ . '/includes/config.php';

$ogImage = absolute_url('images/site/vegetarian-pizza.jpg');

$extraScripts = '<script src="' . e(url('js/menu-tabs.js')) . '" defer></script>';

require __DIR__ . '/includes/header.php';

require __DIR__ . '/includes/partials/menu-main.inc.php';

require __DIR__ . '/includes/footer.php';
