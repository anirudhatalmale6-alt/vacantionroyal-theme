<?php
/**
 * Main Index Template
 *
 * @package VacantionRoyal
 */

get_header();
?>

<div class="page-header">
    <div class="container">
        <h1><?php _e('Blog', 'vacantionroyal'); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Home', 'vacantionroyal'); ?></a>
            <span>/</span>
            <span><?php _e('Blog', 'vacantionroyal'); ?></span>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="properties-grid">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article class="property-card">
                    <div class="property-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('property-card'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="property-content">
                        <div class="property-location">
                            <i class="fas fa-calendar"></i>
                            <span><?php echo get_the_date(); ?></span>
                        </div>
                        <h3 class="property-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        <div class="property-footer">
                            <a href="<?php the_permalink(); ?>" class="btn btn-secondary"><?php _e('Read More', 'vacantionroyal'); ?></a>
                        </div>
                    </div>
                </article>
            <?php endwhile; else : ?>
                <p><?php _e('No posts found.', 'vacantionroyal'); ?></p>
            <?php endif; ?>
        </div>

        <?php the_posts_pagination(); ?>
    </div>
</section>

<?php get_footer(); ?>
