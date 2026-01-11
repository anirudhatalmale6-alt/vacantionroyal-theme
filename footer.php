<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-about">
                <div class="footer-logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="<?php bloginfo('name'); ?>">
                </div>
                <p><?php _e('We are among the top luxury vacation home rental experts globally, offering a portfolio of exquisite properties across the world\'s most sought-after destinations.', 'vacantionroyal'); ?></p>
            </div>

            <div class="footer-links-col">
                <h4 class="footer-title"><?php _e('Quick Links', 'vacantionroyal'); ?></h4>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Home', 'vacantionroyal'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/properties/')); ?>"><?php _e('Properties', 'vacantionroyal'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/destinations/')); ?>"><?php _e('Destinations', 'vacantionroyal'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/about/')); ?>"><?php _e('About Us', 'vacantionroyal'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php _e('Contact', 'vacantionroyal'); ?></a></li>
                </ul>
            </div>

            <div class="footer-links-col">
                <h4 class="footer-title"><?php _e('Legal', 'vacantionroyal'); ?></h4>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/terms-and-conditions/')); ?>"><?php _e('Terms & Conditions', 'vacantionroyal'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>"><?php _e('Privacy Policy', 'vacantionroyal'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/long-term-rental/')); ?>"><?php _e('Long Term Rental', 'vacantionroyal'); ?></a></li>
                </ul>
            </div>

            <div class="footer-contact-col">
                <h4 class="footer-title"><?php _e('Contact Us', 'vacantionroyal'); ?></h4>
                <div class="footer-contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span><?php echo esc_html(get_theme_mod('vacantionroyal_address', '12 Rue Bani Marine, Marrakesh 40000, Maroc')); ?></span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-envelope"></i>
                    <span><a href="mailto:<?php echo esc_attr(get_theme_mod('vacantionroyal_email', 'office@vacantionroyal.com')); ?>"><?php echo esc_html(get_theme_mod('vacantionroyal_email', 'office@vacantionroyal.com')); ?></a></span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-envelope"></i>
                    <span><a href="mailto:longterm@vacantionroyal.com">longterm@vacantionroyal.com</a></span>
                </div>
                <?php if (get_theme_mod('vacantionroyal_phone')) : ?>
                <div class="footer-contact-item">
                    <i class="fas fa-phone"></i>
                    <span><?php echo esc_html(get_theme_mod('vacantionroyal_phone')); ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php _e('Vacantion Royale Sarl. All rights reserved.', 'vacantionroyal'); ?></p>
            <div class="social-links">
                <?php if (get_theme_mod('vacantionroyal_facebook')) : ?>
                    <a href="<?php echo esc_url(get_theme_mod('vacantionroyal_facebook')); ?>" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <?php endif; ?>
                <?php if (get_theme_mod('vacantionroyal_instagram')) : ?>
                    <a href="<?php echo esc_url(get_theme_mod('vacantionroyal_instagram')); ?>" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <?php endif; ?>
                <?php if (get_theme_mod('vacantionroyal_twitter')) : ?>
                    <a href="<?php echo esc_url(get_theme_mod('vacantionroyal_twitter')); ?>" target="_blank" rel="noopener" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <?php endif; ?>
                <?php if (get_theme_mod('vacantionroyal_linkedin')) : ?>
                    <a href="<?php echo esc_url(get_theme_mod('vacantionroyal_linkedin')); ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
