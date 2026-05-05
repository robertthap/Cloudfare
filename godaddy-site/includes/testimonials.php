<?php
declare(strict_types=1);

if (!defined('NAMUNA_BOOT')) {
    http_response_code(403);
    exit;
}

/** @var list<array{quote:string,author:string,subtitle:string,seed:string}> */
function testimonials_home(): array
{
    return [
        [
            'quote' => "Hands down the best momos we've found outside Nepal — fresh, juicy, and that chilli dip is addictive.",
            'author' => 'Jessica M.',
            'subtitle' => 'Pennant Hills · dine-in guest',
            'seed' => 'jessica-m',
        ],
        [
            'quote' => 'Cracking burgers and genuinely friendly service. Great to have Himalayan flavours done properly in the Hills.',
            'author' => 'Ryan T.',
            'subtitle' => 'Local regular',
            'seed' => 'ryan-t',
        ],
        [
            'quote' => "Our family's go-to for Friday nights — the chowmein is packed with flavour and portions are generous.",
            'author' => 'Amelia K.',
            'subtitle' => 'Takeaway favourite',
            'seed' => 'amelia-k',
        ],
    ];
}

/** @var list<array{quote:string,author:string,subtitle:string,seed:string}> */
function testimonials_reviews(): array
{
    return array_merge(testimonials_home(), [
        [
            'quote' => "Vegetarian options aren't an afterthought here. Loved the veg momos and garlic naan.",
            'author' => 'Marcus L.',
            'subtitle' => 'Vegetarian diner',
            'seed' => 'marcus-l',
        ],
        [
            'quote' => "Ordered pizzas and chips for delivery — arrived hot and tasted fantastic. We'll order again.",
            'author' => 'Sophie & Dan',
            'subtitle' => 'Delivery',
            'seed' => 'sophie-dan',
        ],
        [
            'quote' => 'Warm, welcoming staff and food that feels homemade. Already planning our next visit.',
            'author' => 'Nina P.',
            'subtitle' => 'First-time visitor',
            'seed' => 'nina-p',
        ],
    ]);
}

function testimonial_avatar_url(string $seed): string
{
    $base = 'https://api.dicebear.com/9.x/avataaars/svg';

    return $base . '?seed=' . rawurlencode($seed);
}

/** @param list<array{quote:string,author:string,subtitle:string,seed:string}> $items */
function render_testimonials(array $items, int $columns): void
{
    $gridClass = $columns === 2 ? 'grid-2' : 'grid-3';
    echo '<div class="grid ' . e($gridClass) . ' mb-8">';
    foreach ($items as $t) {
        $src = testimonial_avatar_url($t['seed']);
        echo '<article class="testimonial testimonial--with-profile">';
        echo '<div class="testimonial-head">';
        echo '<img class="testimonial-avatar-img" src="' . e($src) . '" width="52" height="52" alt="" loading="lazy" decoding="async" referrerpolicy="no-referrer" />';
        echo '<div class="testimonial-head-text">';
        echo '<div class="testimonial-author">' . e($t['author']) . '</div>';
        echo '<div class="testimonial-date">' . e($t['subtitle']) . '</div>';
        echo '</div></div>';
        echo '<p class="testimonial-text">“' . e($t['quote']) . '”</p>';
        echo '</article>';
    }
    echo '</div>';
}
