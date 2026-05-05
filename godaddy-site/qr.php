<?php
declare(strict_types=1);

$pageTitle = 'Menu';
$hideNav = true;
$bodyClass = 'has-sticky-bar';

require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/header.php';

$menuFull = absolute_url('menu.php');
?>

<section class="hero hero--photo hero--photo-strong" style="padding: 2.5rem 0; --hero-photo: url('<?php echo e(url('images/site/vegetarian-pizza.jpg')); ?>');">
    <div class="container">
        <div class="hero-inner">
            <h1 class="hero-title" style="font-size: 2rem;"><?php echo e(SITE_DISPLAY_NAME); ?></h1>
            <p class="hero-subtitle" style="margin-bottom: 1.25rem;"><?php echo e(SITE_TAGLINE); ?></p>
            <div class="btn-group btn-group-center">
                <a href="<?php echo e(ORDER_UP_URL); ?>" target="_blank" rel="noopener" class="btn btn-primary">Order on Website</a>
                <a href="<?php echo e(SITE_PHONE_TEL); ?>" class="btn btn-outline">Call to Order</a>
            </div>
        </div>
    </div>
</section>

<section class="section section-white" style="padding: 1.5rem 0 2rem;">
    <div class="container">

        <div class="menu-card">
            <div class="menu-section">
                <h2>House Specials</h2>
                <div class="menu-item"><div><div class="menu-item-name">Whole Chicken Meal</div><div class="menu-item-description">Whole chicken, basmati rice, chips &amp; salad.</div></div><div class="menu-item-price">$34.99</div></div>
                <div class="menu-item"><div><div class="menu-item-name">Half Chicken</div><div class="menu-item-description">Comes with rice / chips / salad.</div></div><div class="menu-item-price">$12.99</div></div>
                <div class="menu-item"><div><div class="menu-item-name">Gym Junkies</div><div class="menu-item-description">Peri peri chicken breast, basmati rice, bacon, pineapple &amp; coconut chilli sauce.</div></div><div class="menu-item-price">$17.99</div></div>
                <div class="menu-item"><div><div class="menu-item-name">Himalayan Curry</div><div class="menu-item-description">Homemade curry with basmati rice.</div></div><div class="menu-item-price">$14.99</div></div>
            </div>

            <div class="menu-section">
                <h2>Burgers</h2>
                <div class="menu-item"><div class="menu-item-name">Peri Peri Chicken</div><div class="menu-item-price">$9.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Aussie Beef</div><div class="menu-item-price">$9.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Schnitzel</div><div class="menu-item-price">$11.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Deluxe Beef</div><div class="menu-item-price">$12.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Hawaiian Beef</div><div class="menu-item-price">$12.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Supreme Beef</div><div class="menu-item-price">$14.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Burger + Chips + Drink Combo</div><div class="menu-item-price">+ $6.99</div></div>
            </div>

            <div class="menu-section">
                <h2>Pizza (Regular / Large)</h2>
                <div class="menu-item"><div class="menu-item-name">Margherita</div><div class="menu-item-price">$12.99 / $14.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Pepperoni</div><div class="menu-item-price">$14.99 / $16.99</div></div>
                <div class="menu-item"><div class="menu-item-name">BBQ Chicken</div><div class="menu-item-price">$14.99 / $16.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Hawaiian</div><div class="menu-item-price">$14.99 / $16.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Supreme</div><div class="menu-item-price">$16.99 / $19.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Meat Lovers</div><div class="menu-item-price">$16.99 / $19.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Veggies</div><div class="menu-item-price">$15.99 / $17.99</div></div>
                <div class="menu-item"><div class="menu-item-name">2 Large Pizzas + Chips + 2 Drinks</div><div class="menu-item-price">$39.99</div></div>
            </div>

            <div class="menu-section">
                <h2>Himalayan</h2>
                <div class="menu-item"><div><div class="menu-item-name">Chicken Momo (Steam)</div><div class="menu-item-description">Juicy chicken dumplings with chilli dipping sauce.</div></div><div class="menu-item-price">$12.99</div></div>
                <div class="menu-item"><div><div class="menu-item-name">Chicken Momo (Jhol)</div><div class="menu-item-description">Steamed momo in a tangy sesame-tomato broth.</div></div><div class="menu-item-price">$14.99</div></div>
                <div class="menu-item"><div><div class="menu-item-name">Chicken Momo (Fried)</div><div class="menu-item-description">Crispy fried chicken dumplings.</div></div><div class="menu-item-price">$13.99</div></div>
                <div class="menu-item"><div><div class="menu-item-name">Veg Momo (Steam / Fried / Jhol)</div></div><div class="menu-item-price">$11.99 / $12.99 / $13.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Chicken Chowmein</div><div class="menu-item-price">$14.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Veg Chowmein</div><div class="menu-item-price">$12.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Egg Chowmein</div><div class="menu-item-price">$13.99</div></div>
            </div>

            <div class="menu-section">
                <h2>Sides &amp; Snacks</h2>
                <div class="menu-item"><div class="menu-item-name">Chips (R / L / F)</div><div class="menu-item-price">$4.99 / $7.99 / $11.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Sweet Potato Fries (R / L / F)</div><div class="menu-item-price">$5.99 / $10.99 / $13.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Chicken Wings (6 / 10)</div><div class="menu-item-price">$5.99 / $9.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Garlic Bread</div><div class="menu-item-price">$6.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Samosa Matar</div><div class="menu-item-price">$10.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Chana Anda</div><div class="menu-item-price">$8.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Wai Wai Sadheko</div><div class="menu-item-price">$7.99</div></div>
            </div>

            <div class="menu-section">
                <h2>Drinks &amp; Smoothies</h2>
                <div class="menu-item"><div class="menu-item-name">Can of Drink</div><div class="menu-item-price">$2.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Bottled Water</div><div class="menu-item-price">$2.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Thai Redbull</div><div class="menu-item-price">$3.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Mango Smoothie</div><div class="menu-item-price">$6.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Vanilla Smoothie</div><div class="menu-item-price">$6.99</div></div>
                <div class="menu-item"><div class="menu-item-name">Chocolate Smoothie</div><div class="menu-item-price">$6.99</div></div>
            </div>
        </div>

        <p class="muted text-center" style="margin-top: 1rem; font-size: 0.9rem;">
            Full menu available at <a href="<?php echo e(url('menu.php')); ?>" class="brand bold"><?php echo e($menuFull); ?></a>
        </p>
    </div>
</section>

<div class="sticky-bottom-bar">
    <div class="btn-group">
        <a href="<?php echo e(ORDER_UP_URL); ?>" target="_blank" rel="noopener" class="btn btn-primary btn-sm">Website</a>
        <a href="<?php echo e(UBER_EATS_URL); ?>" target="_blank" rel="noopener" class="btn btn-outline btn-sm">Uber Eats</a>
        <a href="<?php echo e(DOORDASH_URL); ?>" target="_blank" rel="noopener" class="btn btn-outline btn-sm">DoorDash</a>
        <a href="<?php echo e(SITE_PHONE_TEL); ?>" class="btn btn-primary btn-sm">Call</a>
    </div>
</div>

<?php
require __DIR__ . '/includes/footer.php';
