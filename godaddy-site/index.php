<?php
declare(strict_types=1);

$pageTitle = 'Home';
$current = 'index';
require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/testimonials.php';
require __DIR__ . '/includes/header.php';
?>

<section class="hero hero--photo" style="--hero-photo: url('<?php echo e(url('images/site/hero.jpg')); ?>');">
    <div class="container">
        <div class="hero-inner">
            <h1 class="hero-title">Modern Australian &amp;<br />Himalayan Flavours</h1>
            <p class="hero-subtitle">
                Experience the perfect fusion of traditional Himalayan spices and contemporary Australian cuisine — handcrafted fresh in Pennant Hills.
            </p>
            <div class="btn-group btn-group-center">
                <a href="<?php echo e(url('order.php')); ?>" class="btn btn-primary">Order Now</a>
                <a href="<?php echo e(url('menu.php')); ?>" class="btn btn-outline">View Menu</a>
            </div>
        </div>
    </div>
</section>

<section class="section section-white">
    <div class="container">
        <h2 class="section-title">Featured Dishes</h2>
        <div class="grid grid-3 mb-8">
            <article class="dish-card">
                <div class="dish-image"><img src="<?php echo e(url('images/site/momo.png')); ?>" alt="Traditional steamed momos" loading="lazy" /></div>
                <div class="dish-body">
                    <h3 class="dish-name">Traditional Momos</h3>
                    <p class="dish-desc">Steamed dumplings filled with spiced chicken or vegetables, served with our signature chilli-sesame sauce.</p>
                    <div class="dish-footer">
                        <span class="dish-price">From $12.99</span>
                        <a href="<?php echo e(url('menu.php')); ?>" class="btn btn-primary btn-sm">Order</a>
                    </div>
                </div>
            </article>
            <article class="dish-card">
                <div class="dish-image"><img src="<?php echo e(url('images/site/chowmein.png')); ?>" alt="Chicken chowmein noodles" loading="lazy" /></div>
                <div class="dish-body">
                    <h3 class="dish-name">Chicken Chowmein</h3>
                    <p class="dish-desc">Stir-fried noodles with tender chicken, mixed vegetables and bold Nepali spices.</p>
                    <div class="dish-footer">
                        <span class="dish-price">$14.99</span>
                        <a href="<?php echo e(url('menu.php')); ?>" class="btn btn-primary btn-sm">Order</a>
                    </div>
                </div>
            </article>
            <article class="dish-card">
                <div class="dish-image"><img src="<?php echo e(url('images/site/aussie-beef-burger.jpg')); ?>" alt="Supreme beef burger" loading="lazy" /></div>
                <div class="dish-body">
                    <h3 class="dish-name">Supreme Beef Burger</h3>
                    <p class="dish-desc">BBQ, lettuce, tomato, beetroot, bacon, egg, beef patty, pineapple and caramelised onion.</p>
                    <div class="dish-footer">
                        <span class="dish-price">$14.99</span>
                        <a href="<?php echo e(url('menu.php')); ?>" class="btn btn-primary btn-sm">Order</a>
                    </div>
                </div>
            </article>
        </div>
        <div class="text-center">
            <a href="<?php echo e(url('menu.php')); ?>" class="btn btn-primary">View Full Menu →</a>
        </div>
    </div>
</section>

<section class="section section-muted section--photo-soft" style="--section-soft-photo: url('<?php echo e(url('images/site/dish-08.jpg')); ?>');">
    <div class="container">
        <div class="split">
            <div>
                <h2 class="section-title">Our Story</h2>
                <p class="muted" style="margin-bottom: 1rem;">
                    Namuna Foods brings together the warmth of Himalayan home cooking and the freshness of modern Australian cuisine under one roof.
                </p>
                <p class="muted" style="margin-bottom: 1.5rem;">
                    Founded by a family passionate about both cultures, every dish is made with love, authentic spices and fresh local ingredients — from sizzling burgers and wood-style pizzas to hand-folded momos and aromatic chowmein.
                </p>
                <a href="<?php echo e(url('about.php')); ?>" class="btn btn-primary">Read More →</a>
            </div>
            <div class="split-image">
                <img src="<?php echo e(url('images/site/hero.jpg')); ?>" alt="Inside the Namuna Foods kitchen" loading="lazy" />
            </div>
        </div>
    </div>
</section>

<section class="section section-white">
    <div class="container">
        <h2 class="section-title" style="margin-bottom: 0.75rem;">What diners say</h2>
        <?php render_testimonials(testimonials_home(), 3); ?>
        <div class="text-center" style="margin-top: 2rem;">
            <a href="<?php echo e(url('reviews.php')); ?>" class="btn btn-primary">Reviews &amp; gallery →</a>
        </div>
    </div>
</section>

<section class="section section-muted section--photo-soft" style="--section-soft-photo: url('<?php echo e(url('images/site/whole-chicken-chips-rice.jpg')); ?>');">
    <div class="container">
        <h2 class="section-title">Visit Us</h2>
        <div class="split mb-8">
            <div class="map-frame">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3317.8638845740593!2d151.0718688!3d-33.73833569999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12a7214df40c8b%3A0x6ec60d03bd2ffef8!2sNamuna%20Foods!5e0!3m2!1sen!2sau!4v1769849305228!5m2!1sen!2sau" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Namuna Foods location"></iframe>
            </div>
            <div style="display: flex; flex-direction: column; justify-content: center; gap: 1.25rem;">
                <div style="display: flex; gap: 0.75rem; align-items: flex-start;">
                    <span class="info-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </span>
                    <div>
                        <div class="info-title">Address</div>
                        <p class="muted"><?php echo e(SITE_ADDRESS); ?></p>
                    </div>
                </div>
                <div style="display: flex; gap: 0.75rem; align-items: flex-start;">
                    <span class="info-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </span>
                    <div>
                        <div class="info-title">Hours</div>
                        <p class="muted">Monday: Closed</p>
                        <p class="muted">Tuesday – Sunday: 11:30 AM – 8:30 PM</p>
                    </div>
                </div>
                <div style="display: flex; gap: 0.75rem; align-items: flex-start;">
                    <span class="info-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                    </span>
                    <div>
                        <div class="info-title">Contact</div>
                        <p class="muted"><a href="<?php echo e(SITE_PHONE_TEL); ?>"><?php echo e(SITE_PHONE_DISPLAY); ?></a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <a href="<?php echo e(url('contact.php')); ?>" class="btn btn-primary">Get Directions →</a>
        </div>
    </div>
</section>

<?php
require __DIR__ . '/includes/footer.php';
