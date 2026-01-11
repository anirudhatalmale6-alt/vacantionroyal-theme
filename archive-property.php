<?php
/**
 * Property Archive Template
 *
 * @package VacantionRoyal
 */

get_header();
?>

<div class="page-header">
    <div class="container">
        <h1><?php _e('Our Properties', 'vacantionroyal'); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Home', 'vacantionroyal'); ?></a>
            <span>/</span>
            <span><?php _e('Properties', 'vacantionroyal'); ?></span>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="properties-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
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
                                <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=400&h=300&fit=crop" alt="<?php the_title_attribute(); ?>">
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
                                €<?php echo esc_html(number_format($details['price'] ?: 0)); ?> <span>/ <?php _e('night', 'vacantionroyal'); ?></span>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="btn btn-secondary"><?php _e('View', 'vacantionroyal'); ?></a>
                        </div>
                    </div>
                </article>
            <?php
                endwhile;
            else :
            ?>
                <div class="text-center" style="grid-column: 1/-1;">
                    <p><?php _e('No properties found. Check back soon for our luxury vacation rentals!', 'vacantionroyal'); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <?php
        // Pagination
        the_posts_pagination(array(
            'prev_text' => '<i class="fas fa-chevron-left"></i>',
            'next_text' => '<i class="fas fa-chevron-right"></i>',
        ));
        ?>
    </div>
</section>

<?php get_footer(); ?>
