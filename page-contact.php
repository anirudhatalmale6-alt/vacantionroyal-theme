<?php
/**
 * Template Name: Contact Page
 *
 * @package VacantionRoyal
 */

get_header();
?>

<div class="page-header">
    <div class="container">
        <h1><?php _e('Contact Us', 'vacantionroyal'); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Home', 'vacantionroyal'); ?></a>
            <span>/</span>
            <span><?php _e('Contact', 'vacantionroyal'); ?></span>
        </div>
    </div>
</div>

<section class="section contact-section">
    <div class="container">
        <div class="contact-wrapper">
            <div class="contact-info">
                <h3><?php _e('Get in Touch', 'vacantionroyal'); ?></h3>
                <p><?php _e('If you are interested in exploring advertising opportunities with us, we invite you to get in touch via email. Please include comprehensive information about your property.', 'vacantionroyal'); ?></p>

                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-details">
                        <h5><?php _e('Our Address', 'vacantionroyal'); ?></h5>
                        <p><?php echo esc_html(get_theme_mod('vacantionroyal_address', '12 Rue Bani Marine, Marrakesh 40000, Maroc')); ?></p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contact-details">
                        <h5><?php _e('Email Address', 'vacantionroyal'); ?></h5>
                        <p><a href="mailto:office@vacantionroyal.com">office@vacantionroyal.com</a></p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="contact-details">
                        <h5><?php _e('Long Term Rental', 'vacantionroyal'); ?></h5>
                        <p><a href="mailto:longterm@vacantionroyal.com">longterm@vacantionroyal.com</a></p>
                    </div>
                </div>

                <?php if (get_theme_mod('vacantionroyal_phone')) : ?>
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="contact-details">
                        <h5><?php _e('Phone', 'vacantionroyal'); ?></h5>
                        <p><?php echo esc_html(get_theme_mod('vacantionroyal_phone')); ?></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="contact-form-container">
                <h3><?php _e('Send Us a Message', 'vacantionroyal'); ?></h3>
                <form id="contact-form" class="contact-form">
                    <input type="hidden" name="action" value="vacantionroyal_contact">
                    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('vacantionroyal_nonce'); ?>">

                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact-name"><?php _e('Your Name', 'vacantionroyal'); ?> *</label>
                            <input type="text" id="contact-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-email"><?php _e('Email', 'vacantionroyal'); ?> *</label>
                            <input type="email" id="contact-email" name="email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="contact-subject"><?php _e('Subject', 'vacantionroyal'); ?></label>
                        <input type="text" id="contact-subject" name="subject">
                    </div>

                    <div class="form-group">
                        <label for="contact-message"><?php _e('Message', 'vacantionroyal'); ?> *</label>
                        <textarea id="contact-message" name="message" rows="5" required></textarea>
                    </div>

                    <div id="contact-form-message"></div>

                    <button type="submit" class="btn btn-primary">
                        <span class="btn-text"><?php _e('Send Message', 'vacantionroyal'); ?></span>
                        <span class="btn-loading" style="display: none;"><span class="loading"></span></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Map Section (Optional - Replace with actual map embed) -->
<section class="map-section">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3396.7!2d-7.9892!3d31.6295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzHCsDM3JzQ2LjIiTiA3wrA1OSczMS4xIlc!5e0!3m2!1sen!2s!4v1234567890"
        width="100%"
        height="400"
        style="border:0;"
        allowfullscreen=""
        loading="lazy">
    </iframe>
</section>

<?php get_footer(); ?>
