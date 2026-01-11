<?php
/**
 * Default Page Template
 *
 * @package VacantionRoyal
 */

get_header();
?>

<div class="page-header">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Home', 'vacantionroyal'); ?></a>
            <span>/</span>
            <span><?php the_title(); ?></span>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="page-content" style="max-width: 900px; margin: 0 auto;">
                <?php the_content(); ?>
            </div>
        <?php endwhile; endif; ?>
    </div>
</section>

<?php get_footer(); ?>
