<?php
/**
 * Fallback index template
 * File: wp-content/themes/egalitarian-association/index.php
 */
get_header();
?>
<div class="py-16 lg:py-24 bg-warm">
    <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-navy font-extrabold text-3xl sm:text-4xl mb-10">
            <?php
            if ( is_home() && ! is_front_page() ) {
                esc_html_e( 'Latest News', 'egalitarian' );
            } else {
                esc_html_e( 'Posts', 'egalitarian' );
            }
            ?>
        </h1>
        <?php if ( have_posts() ) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'template-parts/card-post' ); ?>
            <?php endwhile; ?>
        </div>
        <?php ea_pagination(); ?>
        <?php else : ?>
        <p class="text-gray-500 text-lg"><?php esc_html_e( 'Nothing found. Check back soon!', 'egalitarian' ); ?></p>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
