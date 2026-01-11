<?php
/**
 * Vacantion Royal Theme Functions
 *
 * @package VacantionRoyal
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function vacantionroyal_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'vacantionroyal'),
        'footer'  => __('Footer Menu', 'vacantionroyal'),
    ));

    // Add image sizes
    add_image_size('property-card', 400, 300, true);
    add_image_size('property-large', 800, 600, true);
    add_image_size('destination-card', 400, 400, true);
}
add_action('after_setup_theme', 'vacantionroyal_setup');

/**
 * Enqueue Scripts and Styles
 */
function vacantionroyal_scripts() {
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap', array(), null);

    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');

    // Theme Stylesheet
    wp_enqueue_style('vacantionroyal-style', get_stylesheet_uri(), array(), '1.0.0');

    // Theme JavaScript
    wp_enqueue_script('vacantionroyal-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);

    // Localize script for AJAX
    wp_localize_script('vacantionroyal-main', 'vacantionroyal_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('vacantionroyal_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'vacantionroyal_scripts');

/**
 * Register Custom Post Types
 */
function vacantionroyal_register_post_types() {
    // Properties Post Type
    register_post_type('property', array(
        'labels' => array(
            'name'               => __('Properties', 'vacantionroyal'),
            'singular_name'      => __('Property', 'vacantionroyal'),
            'add_new'            => __('Add New Property', 'vacantionroyal'),
            'add_new_item'       => __('Add New Property', 'vacantionroyal'),
            'edit_item'          => __('Edit Property', 'vacantionroyal'),
            'new_item'           => __('New Property', 'vacantionroyal'),
            'view_item'          => __('View Property', 'vacantionroyal'),
            'search_items'       => __('Search Properties', 'vacantionroyal'),
            'not_found'          => __('No properties found', 'vacantionroyal'),
            'not_found_in_trash' => __('No properties found in trash', 'vacantionroyal'),
        ),
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-building',
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite'       => array('slug' => 'properties'),
        'show_in_rest'  => true,
    ));

    // Destinations Post Type
    register_post_type('destination', array(
        'labels' => array(
            'name'               => __('Destinations', 'vacantionroyal'),
            'singular_name'      => __('Destination', 'vacantionroyal'),
            'add_new'            => __('Add New Destination', 'vacantionroyal'),
            'add_new_item'       => __('Add New Destination', 'vacantionroyal'),
            'edit_item'          => __('Edit Destination', 'vacantionroyal'),
            'new_item'           => __('New Destination', 'vacantionroyal'),
            'view_item'          => __('View Destination', 'vacantionroyal'),
            'search_items'       => __('Search Destinations', 'vacantionroyal'),
            'not_found'          => __('No destinations found', 'vacantionroyal'),
            'not_found_in_trash' => __('No destinations found in trash', 'vacantionroyal'),
        ),
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-location-alt',
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite'       => array('slug' => 'destinations'),
        'show_in_rest'  => true,
    ));
}
add_action('init', 'vacantionroyal_register_post_types');

/**
 * Register Custom Taxonomies
 */
function vacantionroyal_register_taxonomies() {
    // Property Location Taxonomy
    register_taxonomy('property_location', 'property', array(
        'labels' => array(
            'name'          => __('Locations', 'vacantionroyal'),
            'singular_name' => __('Location', 'vacantionroyal'),
            'search_items'  => __('Search Locations', 'vacantionroyal'),
            'all_items'     => __('All Locations', 'vacantionroyal'),
            'edit_item'     => __('Edit Location', 'vacantionroyal'),
            'add_new_item'  => __('Add New Location', 'vacantionroyal'),
        ),
        'hierarchical' => true,
        'public'       => true,
        'rewrite'      => array('slug' => 'location'),
        'show_in_rest' => true,
    ));

    // Property Type Taxonomy
    register_taxonomy('property_type', 'property', array(
        'labels' => array(
            'name'          => __('Property Types', 'vacantionroyal'),
            'singular_name' => __('Property Type', 'vacantionroyal'),
            'search_items'  => __('Search Property Types', 'vacantionroyal'),
            'all_items'     => __('All Property Types', 'vacantionroyal'),
            'edit_item'     => __('Edit Property Type', 'vacantionroyal'),
            'add_new_item'  => __('Add New Property Type', 'vacantionroyal'),
        ),
        'hierarchical' => true,
        'public'       => true,
        'rewrite'      => array('slug' => 'property-type'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'vacantionroyal_register_taxonomies');

/**
 * Add Meta Boxes for Properties
 */
function vacantionroyal_add_meta_boxes() {
    add_meta_box(
        'property_details',
        __('Property Details', 'vacantionroyal'),
        'vacantionroyal_property_details_callback',
        'property',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vacantionroyal_add_meta_boxes');

/**
 * Property Details Meta Box Callback
 */
function vacantionroyal_property_details_callback($post) {
    wp_nonce_field('vacantionroyal_property_details', 'vacantionroyal_property_details_nonce');

    $price = get_post_meta($post->ID, '_property_price', true);
    $bedrooms = get_post_meta($post->ID, '_property_bedrooms', true);
    $bathrooms = get_post_meta($post->ID, '_property_bathrooms', true);
    $guests = get_post_meta($post->ID, '_property_guests', true);
    $sqft = get_post_meta($post->ID, '_property_sqft', true);
    $amenities = get_post_meta($post->ID, '_property_amenities', true);
    $address = get_post_meta($post->ID, '_property_address', true);
    ?>
    <style>
        .property-meta-row { margin-bottom: 15px; }
        .property-meta-row label { display: block; font-weight: bold; margin-bottom: 5px; }
        .property-meta-row input[type="text"],
        .property-meta-row input[type="number"],
        .property-meta-row textarea { width: 100%; padding: 8px; }
    </style>
    <div class="property-meta-row">
        <label for="property_price"><?php _e('Price per Night (€)', 'vacantionroyal'); ?></label>
        <input type="number" id="property_price" name="property_price" value="<?php echo esc_attr($price); ?>" step="0.01">
    </div>
    <div class="property-meta-row">
        <label for="property_bedrooms"><?php _e('Bedrooms', 'vacantionroyal'); ?></label>
        <input type="number" id="property_bedrooms" name="property_bedrooms" value="<?php echo esc_attr($bedrooms); ?>">
    </div>
    <div class="property-meta-row">
        <label for="property_bathrooms"><?php _e('Bathrooms', 'vacantionroyal'); ?></label>
        <input type="number" id="property_bathrooms" name="property_bathrooms" value="<?php echo esc_attr($bathrooms); ?>">
    </div>
    <div class="property-meta-row">
        <label for="property_guests"><?php _e('Max Guests', 'vacantionroyal'); ?></label>
        <input type="number" id="property_guests" name="property_guests" value="<?php echo esc_attr($guests); ?>">
    </div>
    <div class="property-meta-row">
        <label for="property_sqft"><?php _e('Square Feet', 'vacantionroyal'); ?></label>
        <input type="number" id="property_sqft" name="property_sqft" value="<?php echo esc_attr($sqft); ?>">
    </div>
    <div class="property-meta-row">
        <label for="property_address"><?php _e('Address', 'vacantionroyal'); ?></label>
        <input type="text" id="property_address" name="property_address" value="<?php echo esc_attr($address); ?>">
    </div>
    <div class="property-meta-row">
        <label for="property_amenities"><?php _e('Amenities (comma-separated)', 'vacantionroyal'); ?></label>
        <textarea id="property_amenities" name="property_amenities" rows="3"><?php echo esc_textarea($amenities); ?></textarea>
        <p class="description"><?php _e('Enter amenities separated by commas (e.g., WiFi, Pool, Parking, Air Conditioning, Kitchen)', 'vacantionroyal'); ?></p>
    </div>
    <?php
}

/**
 * Save Property Meta Box Data
 */
function vacantionroyal_save_property_meta($post_id) {
    if (!isset($_POST['vacantionroyal_property_details_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['vacantionroyal_property_details_nonce'], 'vacantionroyal_property_details')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'property_price'     => '_property_price',
        'property_bedrooms'  => '_property_bedrooms',
        'property_bathrooms' => '_property_bathrooms',
        'property_guests'    => '_property_guests',
        'property_sqft'      => '_property_sqft',
        'property_address'   => '_property_address',
        'property_amenities' => '_property_amenities',
    );

    foreach ($fields as $field => $meta_key) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_property', 'vacantionroyal_save_property_meta');

/**
 * Handle Booking Form Submission (AJAX)
 */
function vacantionroyal_handle_booking() {
    check_ajax_referer('vacantionroyal_nonce', 'nonce');

    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $checkin = sanitize_text_field($_POST['checkin']);
    $checkout = sanitize_text_field($_POST['checkout']);
    $guests = intval($_POST['guests']);
    $property = sanitize_text_field($_POST['property']);
    $message = sanitize_textarea_field($_POST['message']);

    // Validate required fields
    if (empty($name) || empty($email) || empty($checkin) || empty($checkout)) {
        wp_send_json_error(array('message' => __('Please fill in all required fields.', 'vacantionroyal')));
    }

    // Prepare email content
    $admin_email = get_option('admin_email');
    $site_name = get_bloginfo('name');

    $subject = sprintf(__('New Booking Inquiry - %s', 'vacantionroyal'), $property);

    $email_body = sprintf(
        __("New Booking Inquiry\n\n" .
        "Property: %s\n\n" .
        "Guest Details:\n" .
        "Name: %s\n" .
        "Email: %s\n" .
        "Phone: %s\n\n" .
        "Booking Details:\n" .
        "Check-in: %s\n" .
        "Check-out: %s\n" .
        "Number of Guests: %d\n\n" .
        "Additional Message:\n%s\n\n" .
        "---\n" .
        "This inquiry was submitted via %s", 'vacantionroyal'),
        $property,
        $name,
        $email,
        $phone,
        $checkin,
        $checkout,
        $guests,
        $message,
        $site_name
    );

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $site_name . ' <' . $admin_email . '>',
        'Reply-To: ' . $name . ' <' . $email . '>',
    );

    // Send email to admin
    $sent = wp_mail($admin_email, $subject, $email_body, $headers);

    // Also send to office@vacantionroyal.com
    wp_mail('office@vacantionroyal.com', $subject, $email_body, $headers);

    if ($sent) {
        // Send confirmation email to guest
        $guest_subject = sprintf(__('Booking Inquiry Received - %s', 'vacantionroyal'), $site_name);
        $guest_body = sprintf(
            __("Dear %s,\n\n" .
            "Thank you for your booking inquiry at %s.\n\n" .
            "We have received your request for:\n" .
            "Property: %s\n" .
            "Check-in: %s\n" .
            "Check-out: %s\n" .
            "Guests: %d\n\n" .
            "Our team will review your request and contact you shortly.\n\n" .
            "Best regards,\n" .
            "Vacantion Royal Team", 'vacantionroyal'),
            $name,
            $site_name,
            $property,
            $checkin,
            $checkout,
            $guests
        );
        wp_mail($email, $guest_subject, $guest_body, $headers);

        wp_send_json_success(array('message' => __('Thank you! Your booking inquiry has been submitted. We will contact you shortly.', 'vacantionroyal')));
    } else {
        wp_send_json_error(array('message' => __('There was an error sending your inquiry. Please try again or contact us directly.', 'vacantionroyal')));
    }
}
add_action('wp_ajax_vacantionroyal_booking', 'vacantionroyal_handle_booking');
add_action('wp_ajax_nopriv_vacantionroyal_booking', 'vacantionroyal_handle_booking');

/**
 * Handle Contact Form Submission (AJAX)
 */
function vacantionroyal_handle_contact() {
    check_ajax_referer('vacantionroyal_nonce', 'nonce');

    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $subject_text = sanitize_text_field($_POST['subject']);
    $message = sanitize_textarea_field($_POST['message']);

    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error(array('message' => __('Please fill in all required fields.', 'vacantionroyal')));
    }

    $admin_email = get_option('admin_email');
    $site_name = get_bloginfo('name');

    $subject = sprintf(__('Contact Form: %s', 'vacantionroyal'), $subject_text);

    $email_body = sprintf(
        __("New Contact Form Message\n\n" .
        "Name: %s\n" .
        "Email: %s\n" .
        "Subject: %s\n\n" .
        "Message:\n%s\n\n" .
        "---\n" .
        "Sent via %s", 'vacantionroyal'),
        $name,
        $email,
        $subject_text,
        $message,
        $site_name
    );

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $site_name . ' <' . $admin_email . '>',
        'Reply-To: ' . $name . ' <' . $email . '>',
    );

    $sent = wp_mail($admin_email, $subject, $email_body, $headers);
    wp_mail('office@vacantionroyal.com', $subject, $email_body, $headers);

    if ($sent) {
        wp_send_json_success(array('message' => __('Thank you for your message! We will get back to you soon.', 'vacantionroyal')));
    } else {
        wp_send_json_error(array('message' => __('There was an error sending your message. Please try again.', 'vacantionroyal')));
    }
}
add_action('wp_ajax_vacantionroyal_contact', 'vacantionroyal_handle_contact');
add_action('wp_ajax_nopriv_vacantionroyal_contact', 'vacantionroyal_handle_contact');

/**
 * Register Widget Areas
 */
function vacantionroyal_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Widget 1', 'vacantionroyal'),
        'id'            => 'footer-1',
        'description'   => __('Footer widget area 1', 'vacantionroyal'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Sidebar', 'vacantionroyal'),
        'id'            => 'sidebar-1',
        'description'   => __('Main sidebar', 'vacantionroyal'),
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'vacantionroyal_widgets_init');

/**
 * Theme Customizer Settings
 */
function vacantionroyal_customize_register($wp_customize) {
    // Contact Information Section
    $wp_customize->add_section('vacantionroyal_contact', array(
        'title'    => __('Contact Information', 'vacantionroyal'),
        'priority' => 30,
    ));

    // Address
    $wp_customize->add_setting('vacantionroyal_address', array(
        'default'           => '12 Rue Bani Marine, Marrakesh 40000, Maroc',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('vacantionroyal_address', array(
        'label'   => __('Address', 'vacantionroyal'),
        'section' => 'vacantionroyal_contact',
        'type'    => 'textarea',
    ));

    // Email
    $wp_customize->add_setting('vacantionroyal_email', array(
        'default'           => 'office@vacantionroyal.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('vacantionroyal_email', array(
        'label'   => __('Email', 'vacantionroyal'),
        'section' => 'vacantionroyal_contact',
        'type'    => 'email',
    ));

    // Phone
    $wp_customize->add_setting('vacantionroyal_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('vacantionroyal_phone', array(
        'label'   => __('Phone', 'vacantionroyal'),
        'section' => 'vacantionroyal_contact',
        'type'    => 'text',
    ));

    // Social Media Section
    $wp_customize->add_section('vacantionroyal_social', array(
        'title'    => __('Social Media', 'vacantionroyal'),
        'priority' => 35,
    ));

    $social_networks = array('facebook', 'instagram', 'twitter', 'linkedin');
    foreach ($social_networks as $network) {
        $wp_customize->add_setting('vacantionroyal_' . $network, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control('vacantionroyal_' . $network, array(
            'label'   => ucfirst($network) . ' URL',
            'section' => 'vacantionroyal_social',
            'type'    => 'url',
        ));
    }
}
add_action('customize_register', 'vacantionroyal_customize_register');

/**
 * Helper Functions
 */

// Get property price
function vacantionroyal_get_property_price($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    return get_post_meta($post_id, '_property_price', true);
}

// Get property details
function vacantionroyal_get_property_details($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    return array(
        'price'     => get_post_meta($post_id, '_property_price', true),
        'bedrooms'  => get_post_meta($post_id, '_property_bedrooms', true),
        'bathrooms' => get_post_meta($post_id, '_property_bathrooms', true),
        'guests'    => get_post_meta($post_id, '_property_guests', true),
        'sqft'      => get_post_meta($post_id, '_property_sqft', true),
        'address'   => get_post_meta($post_id, '_property_address', true),
        'amenities' => get_post_meta($post_id, '_property_amenities', true),
    );
}

// Get amenities array
function vacantionroyal_get_amenities($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $amenities = get_post_meta($post_id, '_property_amenities', true);
    if (empty($amenities)) {
        return array();
    }
    return array_map('trim', explode(',', $amenities));
}

/**
 * Flush rewrite rules on theme activation
 */
function vacantionroyal_rewrite_flush() {
    vacantionroyal_register_post_types();
    vacantionroyal_register_taxonomies();
    flush_rewrite_rules();

    // Create default destinations/locations
    vacantionroyal_create_default_locations();
}
add_action('after_switch_theme', 'vacantionroyal_rewrite_flush');

/**
 * Create default location taxonomy terms
 */
function vacantionroyal_create_default_locations() {
    $locations = array(
        'Greece' => 'Stunning islands & ancient wonders',
        'Netherlands' => 'Charming canals & countryside estates',
        'Spain' => 'Mediterranean paradise & vibrant culture',
        'Switzerland' => 'Alpine luxury & scenic retreats',
        'France' => 'Châteaux & Riviera villas',
        'Italy' => 'Tuscan estates & coastal gems',
        'Portugal' => 'Atlantic coast & historic charm',
    );

    foreach ($locations as $name => $description) {
        if (!term_exists($name, 'property_location')) {
            wp_insert_term($name, 'property_location', array(
                'description' => $description,
                'slug' => sanitize_title($name),
            ));
        }
    }
}
