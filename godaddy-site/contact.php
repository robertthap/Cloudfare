<?php
declare(strict_types=1);

$pageTitle = 'Contact';
$current = 'contact';

require __DIR__ . '/includes/config.php';

$directionsUrl = 'https://www.google.com/maps/dir/?api=1&destination=' . rawurlencode(SITE_ADDRESS);
$showSuccess = isset($_GET['sent']) && $_GET['sent'] === '1';
$useWeb3 = web3forms_access_key() !== '';
$pub = public_site_url();
$redirectUrl = $pub !== '' ? $pub . url('contact.php?sent=1') : '';

ob_start();
?>
<script>
(function () {
    var msg = document.getElementById('messageField');
    var counter = document.getElementById('messageCounter');
    var max = msg ? parseInt(msg.getAttribute('maxlength') || '4000', 10) : 4000;
    function updateCounter() {
        if (!msg || !counter) return;
        counter.textContent = msg.value.length + ' / ' + max;
    }
    if (msg) {
        msg.addEventListener('input', updateCounter);
        updateCounter();
    }
    var form = document.getElementById('contactForm');
    var submitBtn = document.getElementById('submitButton');
    if (form && submitBtn) {
        form.addEventListener('submit', function () {
            if (form.checkValidity && !form.checkValidity()) return;
            submitBtn.setAttribute('aria-busy', 'true');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Sending...';
        });
    }
    var clearBtn = document.getElementById('clearButton');
    if (clearBtn && form) {
        clearBtn.addEventListener('click', function () { setTimeout(updateCounter, 0); });
    }
    document.querySelectorAll('[data-dismiss]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var banner = btn.closest('.error-banner, .success-banner');
            if (banner) banner.style.display = 'none';
        });
    });
    var successBanner = document.getElementById('successBanner');
    if (successBanner && new URLSearchParams(location.search).get('sent') === '1') {
        successBanner.style.display = '';
    }
    if (successBanner && successBanner.offsetParent !== null) {
        successBanner.scrollIntoView({ behavior: 'smooth', block: 'center' });
        successBanner.focus({ preventScroll: true });
    }
})();
</script>
<?php
$extraScripts = ob_get_clean();

require __DIR__ . '/includes/header.php';
?>

<section class="hero hero--photo" style="--hero-photo: url('<?php echo e(url('images/site/mediterranean-salad.jpg')); ?>');">
    <div class="container">
        <div class="hero-inner">
            <h1 class="hero-title">Contact Us</h1>
            <p class="hero-subtitle">We'd love to hear from you.</p>
        </div>
    </div>
</section>

<section class="section section-white">
    <div class="container">
        <div class="split mb-8">
            <div class="map-frame" style="height: 400px;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3317.8638845740593!2d151.0718688!3d-33.73833569999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12a7214df40c8b%3A0x6ec60d03bd2ffef8!2sNamuna%20Foods!5e0!3m2!1sen!2sau!4v1769849305228!5m2!1sen!2sau" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Namuna Foods location"></iframe>
            </div>

            <div>
                <div class="contact-quick">
                    <h3>Get in Touch</h3>

                    <a href="<?php echo e(SITE_PHONE_TEL); ?>" class="contact-action">
                        <span class="contact-action-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                        </span>
                        <div>
                            <div class="contact-action-label">Call Us</div>
                            <div class="contact-action-value"><?php echo e(SITE_PHONE_DISPLAY); ?></div>
                        </div>
                    </a>

                    <a href="<?php echo e(mailto_support()); ?>" class="contact-action">
                        <span class="contact-action-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </span>
                        <div>
                            <div class="contact-action-label">Email Us</div>
                            <div class="contact-action-value"><?php echo e(SITE_EMAIL); ?></div>
                        </div>
                    </a>

                    <a href="<?php echo e($directionsUrl); ?>" target="_blank" rel="noopener" class="btn btn-primary btn-block" style="margin-top: 0.5rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" /></svg>
                        Get Directions
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-muted">
    <div class="container">
        <div class="grid grid-3">
            <div class="info-card">
                <span class="info-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                </span>
                <h3 class="info-title">Address</h3>
                <div class="info-body">
                    <p>84 – 86 Yarrara Road</p>
                    <p>Pennant Hills</p>
                    <p>NSW 2120, Australia</p>
                </div>
            </div>

            <div class="info-card">
                <span class="info-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                </span>
                <h3 class="info-title">Contact</h3>
                <div class="info-body">
                    <p><span class="bold">Phone:</span> <a href="<?php echo e(SITE_PHONE_TEL); ?>"><?php echo e(SITE_PHONE_DISPLAY); ?></a></p>
                    <p><span class="bold">Email:</span> <a href="<?php echo e(mailto_support()); ?>"><?php echo e(SITE_EMAIL); ?></a></p>
                </div>
            </div>

            <div class="info-card">
                <span class="info-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </span>
                <h3 class="info-title">Opening Hours</h3>
                <div class="info-body">
                    <div class="hours-row"><span>Monday</span><span class="brand bold">Closed</span></div>
                    <div class="hours-row"><span>Tuesday</span><span>11:30 AM – 8:30 PM</span></div>
                    <div class="hours-row"><span>Wednesday</span><span>11:30 AM – 8:30 PM</span></div>
                    <div class="hours-row"><span>Thursday</span><span>11:30 AM – 8:30 PM</span></div>
                    <div class="hours-row"><span>Friday</span><span>11:30 AM – 8:30 PM</span></div>
                    <div class="hours-row"><span>Saturday</span><span>11:30 AM – 8:30 PM</span></div>
                    <div class="hours-row"><span>Sunday</span><span>11:30 AM – 8:30 PM</span></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-white section--photo-soft" id="contact-form" style="--section-soft-photo: url('<?php echo e(url('images/site/hero.jpg')); ?>');">
    <div class="container" style="max-width: 720px;">
        <h2 class="section-title" style="margin-bottom: 0.5rem;">Send Us a Message</h2>
        <p class="muted mb-8">Have a question or feedback? We'd love to hear from you.</p>

        <div class="form-card">
            <div class="success-banner" role="status" aria-live="polite" tabindex="-1" id="successBanner"<?php echo $showSuccess ? '' : ' style="display: none;"'; ?>>
                <strong>Thanks for getting in touch!</strong>
                <p style="margin-top: 0.4rem; font-weight: 500;">
                    Your message has been sent to our team. We'll get back to you within 24 hours.
                </p>
                <div class="btn-group btn-group-center" style="margin-top: 1rem;">
                    <a href="<?php echo e(url('menu.php')); ?>" class="btn btn-outline btn-sm">Browse Menu</a>
                    <a href="<?php echo e(url('order.php')); ?>" class="btn btn-primary btn-sm">Order Now</a>
                </div>
            </div>

            <p class="muted" style="margin-bottom: 1rem; font-size: 0.9rem;">
                Fields marked with <span class="required-mark" aria-hidden="true">*</span> are required.
            </p>

            <?php if ($useWeb3): ?>
                <p class="muted" style="margin-bottom: 1rem; font-size: 0.85rem;">
                    Messages are delivered via Web3Forms (no mail server required on this hosting).
                </p>
                <form action="https://api.web3forms.com/submit" method="POST" id="contactForm" novalidate>
                    <input type="hidden" name="access_key" value="<?php echo e(web3forms_access_key()); ?>" />
                    <?php if ($redirectUrl !== ''): ?>
                        <input type="hidden" name="redirect" value="<?php echo e($redirectUrl); ?>" />
                    <?php endif; ?>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="wf-name">Name <span class="required-mark" aria-hidden="true">*</span></label>
                            <input id="wf-name" type="text" name="name" class="form-control" placeholder="Your name" autocomplete="name" required maxlength="120" aria-required="true" />
                        </div>
                        <div class="form-group">
                            <label for="wf-email">Email <span class="required-mark" aria-hidden="true">*</span></label>
                            <input id="wf-email" type="email" name="email" class="form-control" placeholder="your@email.com" autocomplete="email" inputmode="email" required aria-required="true" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="wf-phone">Phone</label>
                        <input id="wf-phone" type="tel" name="phone" class="form-control" placeholder="(02) 9446 7113" autocomplete="tel" inputmode="tel" maxlength="40" />
                        <span class="helper-text">Optional — only if you'd prefer a callback.</span>
                    </div>

                    <div class="form-group">
                        <label for="wf-subject">Subject</label>
                        <input id="wf-subject" type="text" name="subject" class="form-control" placeholder="How can we help?" maxlength="150" />
                    </div>

                    <div class="form-group">
                        <label for="messageField">Message <span class="required-mark" aria-hidden="true">*</span></label>
                        <textarea id="messageField" name="message" class="form-control" placeholder="Your message..." maxlength="4000" required aria-required="true" aria-describedby="messageCounter"></textarea>
                        <span class="helper-text char-counter" id="messageCounter" aria-live="polite">0 / 4000</span>
                    </div>

                    <div class="btn-group" style="margin-top: 0.5rem;">
                        <button type="submit" class="btn btn-primary" id="submitButton" style="flex: 1;">Send Message</button>
                        <button type="reset" class="btn btn-ghost" id="clearButton">Clear</button>
                    </div>
                </form>
            <?php else: ?>
                <div class="muted" style="padding: 1rem 0;">
                    <p style="margin-bottom: 1rem;">
                        Online messages use <a href="https://web3forms.com" target="_blank" rel="noopener">Web3Forms</a>.
                        Add <code class="brand">WEB3FORMS_ACCESS_KEY</code> and <code class="brand">PUBLIC_SITE_URL</code>
                        in <code class="brand">includes/config.php</code> or as server environment variables (for example on Render).
                    </p>
                    <p style="margin-bottom: 1rem;">Until then, reach us by phone or email:</p>
                    <div class="btn-group btn-group-center">
                        <a href="<?php echo e(SITE_PHONE_TEL); ?>" class="btn btn-primary"><?php echo e(SITE_PHONE_DISPLAY); ?></a>
                        <a href="<?php echo e(mailto_support()); ?>" class="btn btn-outline">Email <?php echo e(SITE_EMAIL); ?></a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section section-muted">
    <div class="container">
        <h2 class="section-title">Parking &amp; Accessibility</h2>
        <div class="grid grid-2">
            <div class="info-card">
                <div class="offer-head">
                    <span class="offer-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>
                    </span>
                    <h3 class="offer-title">Parking</h3>
                </div>
                <ul class="value-list">
                    <li>Free street parking available on Yarrara Road</li>
                    <li>Public car park a short walk away</li>
                    <li>Easy pickup for takeaway orders</li>
                </ul>
            </div>

            <div class="info-card">
                <div class="offer-head">
                    <span class="offer-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </span>
                    <h3 class="offer-title">Accessibility</h3>
                </div>
                <ul class="value-list">
                    <li>Step-free entry and dining area</li>
                    <li>Friendly staff happy to assist</li>
                    <li>Service animals welcome</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php
require __DIR__ . '/includes/footer.php';
