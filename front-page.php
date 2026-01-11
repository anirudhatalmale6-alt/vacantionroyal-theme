<?php
/**
 * Front Page Template
 *
 * @package VacantionRoyal
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1><?php _e('Discover Luxury Vacation Rentals', 'vacantionroyal'); ?></h1>
        <p><?php _e('Experience the finest properties in the world\'s most exclusive destinations. Your dream vacation awaits.', 'vacantionroyal'); ?></p>

        <!-- Booking Search Form -->
        <div class="booking-form-wrapper">
            <form class="booking-form" id="search-form" action="<?php echo esc_url(home_url('/properties/')); ?>" method="GET">
                <div class="form-group">
                    <label for="checkin"><?php _e('Check In', 'vacantionroyal'); ?></label>
                    <input type="date" id="checkin" name="checkin" required>
                </div>
                <div class="form-group">
                    <label for="checkout"><?php _e('Check Out', 'vacantionroyal'); ?></label>
                    <input type="date" id="checkout" name="checkout" required>
                </div>
                <div class="form-group">
                    <label for="guests"><?php _e('Guests', 'vacantionroyal'); ?></label>
                    <select id="guests" name="guests">
                        <option value="1">1 <?php _e('Guest', 'vacantionroyal'); ?></option>
                        <option value="2" selected>2 <?php _e('Guests', 'vacantionroyal'); ?></option>
                        <option value="3">3 <?php _e('Guests', 'vacantionroyal'); ?></option>
                        <option value="4">4 <?php _e('Guests', 'vacantionroyal'); ?></option>
                        <option value="5">5 <?php _e('Guests', 'vacantionroyal'); ?></option>
                        <option value="6">6+ <?php _e('Guests', 'vacantionroyal'); ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="destination"><?php _e('Destination', 'vacantionroyal'); ?></label>
                    <select id="destination" name="destination">
                        <option value=""><?php _e('All Destinations', 'vacantionroyal'); ?></option>
                        <?php
                        $locations = get_terms(array(
                            'taxonomy'   => 'property_location',
                            'hide_empty' => false,
                        ));
                        if (!is_wp_error($locations) && !empty($locations)) {
                            foreach ($locations as $location) {
                                echo '<option value="' . esc_attr($location->slug) . '">' . esc_html($location->name) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary"><?php _e('Search', 'vacantionroyal'); ?></button>
            </form>
        </div>
    </div>
</section>

<!-- Featured Properties Section -->
<section class="section featured-properties">
    <div class="container">
        <div class="section-title">
            <h2><?php _e('Featured Properties', 'vacantionroyal'); ?></h2>
            <p><?php _e('Explore our handpicked selection of luxury vacation homes', 'vacantionroyal'); ?></p>
        </div>

        <div class="properties-grid">
            <?php
            $properties = new WP_Query(array(
                'post_type'      => 'property',
                'posts_per_page' => 6,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ));

            if ($properties->have_posts()) :
                while ($properties->have_posts()) : $properties->the_post();
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
                        <?php else : ?>
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/property-placeholder.jpg" alt="<?php the_title_attribute(); ?>">
                            </a>
                        <?php endif; ?>
                        <span class="property-badge"><?php _e('Featured', 'vacantionroyal'); ?></span>
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
                                <span class="property-feature">
                                    <i class="fas fa-bed"></i> <?php echo esc_html($details['bedrooms']); ?> <?php _e('Beds', 'vacantionroyal'); ?>
                                </span>
                            <?php endif; ?>
                            <?php if ($details['bathrooms']) : ?>
                                <span class="property-feature">
                                    <i class="fas fa-bath"></i> <?php echo esc_html($details['bathrooms']); ?> <?php _e('Baths', 'vacantionroyal'); ?>
                                </span>
                            <?php endif; ?>
                            <?php if ($details['guests']) : ?>
                                <span class="property-feature">
                                    <i class="fas fa-users"></i> <?php echo esc_html($details['guests']); ?> <?php _e('Guests', 'vacantionroyal'); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="property-footer">
                            <div class="property-price">
                                €<?php echo esc_html(number_format($details['price'])); ?> <span>/ <?php _e('night', 'vacantionroyal'); ?></span>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="btn btn-secondary"><?php _e('View', 'vacantionroyal'); ?></a>
                        </div>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Show demo properties if none exist
                for ($i = 1; $i <= 6; $i++) :
            ?>
                <article class="property-card">
                    <div class="property-image">
                        <a href="#">
                            <img src="https://images.unsplash.com/photo-156601608<?php echo $i; ?>79-c3aad01a1c<?php echo $i; ?>d?w=400&h=300&fit=crop" alt="Luxury Villa <?php echo $i; ?>">
                        </a>
                        <span class="property-badge"><?php _e('Featured', 'vacantionroyal'); ?></span>
                    </div>
                    <div class="property-content">
                        <div class="property-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?php echo array('Marrakesh, Morocco', 'Paris, France', 'Santorini, Greece', 'Maldives', 'Swiss Alps', 'Bali, Indonesia')[$i-1]; ?></span>
                        </div>
                        <h3 class="property-title">
                            <a href="#"><?php echo array('Royal Palm Villa', 'Parisian Penthouse', 'Aegean Retreat', 'Ocean Paradise', 'Alpine Chalet', 'Tropical Haven')[$i-1]; ?></a>
                        </h3>
                        <div class="property-features">
                            <span class="property-feature"><i class="fas fa-bed"></i> <?php echo $i + 2; ?> Beds</span>
                            <span class="property-feature"><i class="fas fa-bath"></i> <?php echo $i + 1; ?> Baths</span>
                            <span class="property-feature"><i class="fas fa-users"></i> <?php echo ($i + 2) * 2; ?> Guests</span>
                        </div>
                        <div class="property-footer">
                            <div class="property-price">
                                €<?php echo number_format(500 + ($i * 200)); ?> <span>/ night</span>
                            </div>
                            <a href="#" class="btn btn-secondary">View</a>
                        </div>
                    </div>
                </article>
            <?php
                endfor;
            endif;
            ?>
        </div>

        <div class="text-center mt-4">
            <a href="<?php echo esc_url(home_url('/properties/')); ?>" class="btn btn-primary"><?php _e('View All Properties', 'vacantionroyal'); ?></a>
        </div>
    </div>
</section>

<!-- Destinations Section -->
<section class="section destinations bg-light">
    <div class="container">
        <div class="section-title">
            <h2><?php _e('Popular Destinations', 'vacantionroyal'); ?></h2>
            <p><?php _e('Discover our curated selection of world-class locations', 'vacantionroyal'); ?></p>
        </div>

        <div class="destinations-grid">
            <?php
            $destinations = new WP_Query(array(
                'post_type'      => 'destination',
                'posts_per_page' => 4,
            ));

            if ($destinations->have_posts()) :
                while ($destinations->have_posts()) : $destinations->the_post();
            ?>
                <a href="<?php the_permalink(); ?>" class="destination-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('destination-card'); ?>
                    <?php endif; ?>
                    <div class="destination-overlay">
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 8); ?></p>
                    </div>
                </a>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Demo destinations - Greece, Netherlands, Spain, Switzerland, France, Italy, Portugal
                $demo_destinations = array(
                    array('name' => 'Greece', 'desc' => 'Stunning islands & ancient wonders', 'img' => 'photo-1533105079780-92b9be482077'),
                    array('name' => 'France', 'desc' => 'Châteaux & Riviera villas', 'img' => 'photo-1502602898657-3e91760cbb34'),
                    array('name' => 'Italy', 'desc' => 'Tuscan estates & coastal gems', 'img' => 'photo-1534445867742-43195f401b6c'),
                    array('name' => 'Spain', 'desc' => 'Mediterranean paradise awaits', 'img' => 'photo-1543783207-ec64e4d95325'),
                );
                foreach ($demo_destinations as $dest) :
            ?>
                <a href="#" class="destination-card">
                    <img src="https://images.unsplash.com/<?php echo $dest['img']; ?>?w=400&h=400&fit=crop" alt="<?php echo esc_attr($dest['name']); ?>">
                    <div class="destination-overlay">
                        <h3><?php echo esc_html($dest['name']); ?></h3>
                        <p><?php echo esc_html($dest['desc']); ?></p>
                    </div>
                </a>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="section about-section">
    <div class="container">
        <div class="about-content">
            <div class="about-image">
                <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=600&h=450&fit=crop" alt="Luxury Villa">
            </div>
            <div class="about-text">
                <h2><?php _e('Your Trusted Luxury Rental Partner', 'vacantionroyal'); ?></h2>
                <p><?php _e('We are among the top luxury vacation home rental experts globally, offering a portfolio of over 4,000 exquisite properties across 50 of the world\'s most sought-after destinations.', 'vacantionroyal'); ?></p>
                <p><?php _e('We dedicate significant time to selecting unique and stunning locations to showcase our properties, ensuring they are nestled amidst breathtaking nature and picturesque landscapes.', 'vacantionroyal'); ?></p>
                <div class="about-features">
                    <div class="about-feature">
                        <div class="about-feature-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <div>
                            <strong>4,000+</strong>
                            <p><?php _e('Luxury Properties', 'vacantionroyal'); ?></p>
                        </div>
                    </div>
                    <div class="about-feature">
                        <div class="about-feature-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <div>
                            <strong>50+</strong>
                            <p><?php _e('Destinations', 'vacantionroyal'); ?></p>
                        </div>
                    </div>
                    <div class="about-feature">
                        <div class="about-feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <strong>10,000+</strong>
                            <p><?php _e('Happy Guests', 'vacantionroyal'); ?></p>
                        </div>
                    </div>
                    <div class="about-feature">
                        <div class="about-feature-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <strong>24/7</strong>
                            <p><?php _e('Support', 'vacantionroyal'); ?></p>
                        </div>
                    </div>
                </div>
                <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn btn-primary mt-3"><?php _e('Learn More', 'vacantionroyal'); ?></a>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="section services">
    <div class="container">
        <div class="section-title">
            <h2><?php _e('Our Services', 'vacantionroyal'); ?></h2>
            <p><?php _e('Everything you need for the perfect vacation experience', 'vacantionroyal'); ?></p>
        </div>

        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-concierge-bell"></i>
                </div>
                <h4><?php _e('Concierge Service', 'vacantionroyal'); ?></h4>
                <p><?php _e('24/7 dedicated concierge to handle all your requests and needs during your stay.', 'vacantionroyal'); ?></p>
            </div>
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-car"></i>
                </div>
                <h4><?php _e('Airport Transfers', 'vacantionroyal'); ?></h4>
                <p><?php _e('Luxury airport pickup and drop-off services for seamless travel experience.', 'vacantionroyal'); ?></p>
            </div>
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <h4><?php _e('Private Chef', 'vacantionroyal'); ?></h4>
                <p><?php _e('Enjoy gourmet meals prepared by experienced private chefs in your villa.', 'vacantionroyal'); ?></p>
            </div>
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-spa"></i>
                </div>
                <h4><?php _e('Spa & Wellness', 'vacantionroyal'); ?></h4>
                <p><?php _e('In-villa spa treatments and wellness services for ultimate relaxation.', 'vacantionroyal'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="hero" style="min-height: 400px; height: auto; padding: 80px 0;">
    <div class="hero-content">
        <h2 style="color: #fff; font-size: 2.5rem;"><?php _e('Ready to Book Your Dream Vacation?', 'vacantionroyal'); ?></h2>
        <p><?php _e('Contact us today and let us help you find the perfect luxury rental for your next getaway.', 'vacantionroyal'); ?></p>
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-white"><?php _e('Contact Us', 'vacantionroyal'); ?></a>
    </div>
</section>

<?php get_footer(); ?>
