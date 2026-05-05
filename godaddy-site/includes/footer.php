</main>

<?php if (!($hideNav ?? false)): ?>
<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-grid">
            <div>
                <div class="footer-brand-title"><?php echo e(SITE_DISPLAY_NAME); ?></div>
                <p class="footer-brand-text">
                    <?php echo e(SITE_TAGLINE); ?>. Modern Australian &amp; Himalayan cuisine, crafted with passion in Pennant Hills.
                </p>
            </div>

            <div>
                <div class="footer-heading">Contact</div>
                <ul class="footer-list">
                    <li><a href="<?php echo e(SITE_PHONE_TEL); ?>"><?php echo e(SITE_PHONE_DISPLAY); ?></a></li>
                    <li><a href="<?php echo e(mailto_support()); ?>"><?php echo e(SITE_EMAIL); ?></a></li>
                    <li><?php echo e(SITE_ADDRESS); ?></li>
                </ul>
            </div>

            <div>
                <div class="footer-heading">Quick Links</div>
                <ul class="footer-list">
                    <li><a href="<?php echo e(url('menu.php')); ?>">Menu</a></li>
                    <li><a href="<?php echo e(url('about.php')); ?>">About Us</a></li>
                    <li><a href="<?php echo e(url('reviews.php')); ?>">Reviews</a></li>
                    <li><a href="<?php echo e(url('order.php')); ?>">Order Online</a></li>
                    <li><a href="<?php echo e(url('contact.php')); ?>">Contact</a></li>
                </ul>
            </div>

            <div>
                <div class="footer-heading">Hours</div>
                <ul class="footer-list">
                    <li>Monday: Closed</li>
                    <li>Tue – Sun: 11:30 AM – 8:30 PM</li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; <?php echo (int) date('Y'); ?> <?php echo e(SITE_LEGAL_NAME); ?>. All rights reserved.
        </div>
    </div>
</footer>

<script>
(function () {
    var toggle = document.getElementById('mobileNavToggle');
    var menu = document.getElementById('mobileNav');
    if (!toggle || !menu) return;
    toggle.addEventListener('click', function () {
        var open = menu.classList.toggle('open');
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
})();
</script>
<?php endif; ?>

<?php echo $extraScripts ?? ''; ?>

</body>
</html>
