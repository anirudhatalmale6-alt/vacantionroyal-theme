<?php
/**
 * Single Property Template
 *
 * @package VacantionRoyal
 */

get_header();

$details = vacantionroyal_get_property_details();
$amenities = vacantionroyal_get_amenities();
$locations = get_the_terms(get_the_ID(), 'property_location');
$location_name = $locations && !is_wp_error($locations) ? $locations[0]->name : '';
?>

<div class="page-header">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Home', 'vacantionroyal'); ?></a>
            <span>/</span>
            <a href="<?php echo esc_url(home_url('/properties/')); ?>"><?php _e('Properties', 'vacantionroyal'); ?></a>
            <span>/</span>
            <span><?php the_title(); ?></span>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- Property Gallery -->
        <div class="property-gallery">
            <div class="property-gallery-main">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large'); ?>
                <?php else : ?>
                    <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=800&h=500&fit=crop" alt="<?php the_title_attribute(); ?>">
                <?php endif; ?>
            </div>
            <div class="property-gallery-thumbs">
                <div class="property-gallery-thumb">
                    <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=400&h=240&fit=crop" alt="Property Image">
                </div>
                <div class="property-gallery-thumb">
                    <img src="https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=400&h=240&fit=crop" alt="Property Image">
                </div>
            </div>
        </div>

        <!-- Property Details -->
        <div class="property-details">
            <div class="property-info">
                <?php if ($location_name) : ?>
                    <div class="property-location mb-2">
                        <i class="fas fa-map-marker-alt"></i>
                        <span><?php echo esc_html($location_name); ?></span>
                        <?php if ($details['address']) : ?>
                            - <?php echo esc_html($details['address']); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <h1><?php the_title(); ?></h1>

                <div class="property-meta">
                    <?php if ($details['bedrooms']) : ?>
                        <div class="property-meta-item">
                            <i class="fas fa-bed"></i>
                            <span><?php echo esc_html($details['bedrooms']); ?> <?php _e('Bedrooms', 'vacantionroyal'); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if ($details['bathrooms']) : ?>
                        <div class="property-meta-item">
                            <i class="fas fa-bath"></i>
                            <span><?php echo esc_html($details['bathrooms']); ?> <?php _e('Bathrooms', 'vacantionroyal'); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if ($details['guests']) : ?>
                        <div class="property-meta-item">
                            <i class="fas fa-users"></i>
                            <span><?php echo esc_html($details['guests']); ?> <?php _e('Guests', 'vacantionroyal'); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if ($details['sqft']) : ?>
                        <div class="property-meta-item">
                            <i class="fas fa-ruler-combined"></i>
                            <span><?php echo esc_html(number_format($details['sqft'])); ?> <?php _e('sq ft', 'vacantionroyal'); ?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="property-description">
                    <h3><?php _e('Description', 'vacantionroyal'); ?></h3>
                    <?php the_content(); ?>
                </div>

                <?php if (!empty($amenities)) : ?>
                <div class="property-amenities">
                    <h3><?php _e('Amenities', 'vacantionroyal'); ?></h3>
                    <div class="amenities-grid">
                        <?php
                        $amenity_icons = array(
                            'wifi' => 'fa-wifi',
                            'pool' => 'fa-swimming-pool',
                            'parking' => 'fa-parking',
                            'air conditioning' => 'fa-snowflake',
                            'ac' => 'fa-snowflake',
                            'kitchen' => 'fa-utensils',
                            'tv' => 'fa-tv',
                            'washer' => 'fa-tshirt',
                            'dryer' => 'fa-wind',
                            'gym' => 'fa-dumbbell',
                            'spa' => 'fa-spa',
                            'jacuzzi' => 'fa-hot-tub',
                            'fireplace' => 'fa-fire',
                            'garden' => 'fa-leaf',
                            'balcony' => 'fa-building',
                            'sea view' => 'fa-water',
                            'mountain view' => 'fa-mountain',
                        );
                        foreach ($amenities as $amenity) :
                            $icon = 'fa-check';
                            $amenity_lower = strtolower($amenity);
                            foreach ($amenity_icons as $key => $icon_class) {
                                if (strpos($amenity_lower, $key) !== false) {
                                    $icon = $icon_class;
                                    break;
                                }
                            }
                        ?>
                            <div class="amenity-item">
                                <i class="fas <?php echo esc_attr($icon); ?>"></i>
                                <span><?php echo esc_html($amenity); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- House Rules -->
                <div class="property-rules mt-4">
                    <h3><?php _e('House Rules', 'vacantionroyal'); ?></h3>
                    <ul style="list-style: disc; padding-left: 20px; color: var(--text-light);">
                        <li><?php _e('No smoking inside the property', 'vacantionroyal'); ?></li>
                        <li><?php _e('No unregistered guests', 'vacantionroyal'); ?></li>
                        <li><?php _e('Flexible check-in/check-out times (please specify in booking)', 'vacantionroyal'); ?></li>
                        <li><?php _e('Clean dishes and empty fridge before checkout', 'vacantionroyal'); ?></li>
                    </ul>
                </div>
            </div>

            <!-- Booking Sidebar -->
            <div class="property-sidebar">
                <div class="booking-box">
                    <div class="booking-box-price">
                        <span class="price">€<?php echo esc_html(number_format($details['price'] ?: 500)); ?></span>
                        <span>/ <?php _e('night', 'vacantionroyal'); ?></span>
                    </div>

                    <form id="booking-form" class="booking-inquiry-form">
                        <input type="hidden" name="action" value="vacantionroyal_booking">
                        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('vacantionroyal_nonce'); ?>">
                        <input type="hidden" name="property" value="<?php the_title(); ?>">

                        <div class="form-group">
                            <label for="booking-checkin"><?php _e('Check In', 'vacantionroyal'); ?></label>
                            <input type="date" id="booking-checkin" name="checkin" required>
                        </div>

                        <div class="form-group">
                            <label for="booking-checkout"><?php _e('Check Out', 'vacantionroyal'); ?></label>
                            <input type="date" id="booking-checkout" name="checkout" required>
                        </div>

                        <div class="form-group">
                            <label for="booking-guests"><?php _e('Guests', 'vacantionroyal'); ?></label>
                            <select id="booking-guests" name="guests">
                                <?php for ($i = 1; $i <= ($details['guests'] ?: 10); $i++) : ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?> <?php echo $i === 1 ? __('Guest', 'vacantionroyal') : __('Guests', 'vacantionroyal'); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="booking-name"><?php _e('Your Name', 'vacantionroyal'); ?> *</label>
                            <input type="text" id="booking-name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="booking-email"><?php _e('Email', 'vacantionroyal'); ?> *</label>
                            <input type="email" id="booking-email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="booking-phone"><?php _e('Phone', 'vacantionroyal'); ?></label>
                            <input type="tel" id="booking-phone" name="phone">
                        </div>

                        <div class="form-group">
                            <label for="booking-message"><?php _e('Message', 'vacantionroyal'); ?></label>
                            <textarea id="booking-message" name="message" rows="3" style="width: 100%; padding: 14px; border: 1px solid var(--border-color); border-radius: 4px;"></textarea>
                        </div>

                        <div id="booking-form-message"></div>

                        <button type="submit" class="btn btn-primary">
                            <span class="btn-text"><?php _e('Request Booking', 'vacantionroyal'); ?></span>
                            <span class="btn-loading" style="display: none;"><span class="loading"></span></span>
                        </button>
                    </form>

                    <p style="text-align: center; margin-top: 15px; font-size: 13px; color: var(--text-light);">
                        <?php _e('You won\'t be charged yet', 'vacantionroyal'); ?>
                    </p>
                </div>
            </div>
        </div>

        <?php endwhile; endif; ?>
    </div>
</section>

<!-- Related Properties -->
<section class="section bg-light">
    <div class="container">
        <div class="section-title">
            <h2><?php _e('Similar Properties', 'vacantionroyal'); ?></h2>
        </div>

        <div class="properties-grid">
            <?php
            $related = new WP_Query(array(
                'post_type'      => 'property',
                'posts_per_page' => 3,
                'post__not_in'   => array(get_the_ID()),
                'orderby'        => 'rand',
            ));

            if ($related->have_posts()) :
                while ($related->have_posts()) : $related->the_post();
                    $details = vacantionroyal_get_property_details();
                    $locations = get_the_terms(get_the_ID(), 'property_location');
                    $location_name = $locations && !is_wp_error($locations) ? $locations[0]->name : '';
            ?>
                <article class="property-card">
                    <div class="property-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('property-card'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="property-content">
                        <?php if ($location_name) : ?>
                            <div class="property-location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span><?php echo esc_html($location_name); ?></span>
                            </div>
                        <?php endif; ?>
                        <h3 class="property-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <div class="property-features">
                            <?php if ($details['bedrooms']) : ?>
                                <span class="property-feature"><i class="fas fa-bed"></i> <?php echo esc_html($details['bedrooms']); ?> Beds</span>
                            <?php endif; ?>
                            <?php if ($details['bathrooms']) : ?>
                                <span class="property-feature"><i class="fas fa-bath"></i> <?php echo esc_html($details['bathrooms']); ?> Baths</span>
                            <?php endif; ?>
                        </div>
                        <div class="property-footer">
                            <div class="property-price">
                                €<?php echo esc_html(number_format($details['price'])); ?> <span>/ night</span>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="btn btn-secondary">View</a>
                        </div>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
