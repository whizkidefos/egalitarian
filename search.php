<?php
/**
 * Search results template
 * File: wp-content/themes/egalitarian-association/search.php
 */
get_header();
$query = get_search_query();
?>

<section class="py-16 bg-navy">
    <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-white font-extrabold text-3xl">
            <?php
            printf(
                esc_html__( 'Search results for: %s', 'egalitarian' ),
                '<span class="text-gold">' . esc_html( $query ) . '</span>'
            );
            ?>
        </h1>
        <p class="text-white/60 mt-2">
            <?php printf( esc_html__( '%d result(s) found', 'egalitarian' ), $wp_query->found_posts ); ?>
        </p>
    </div>
</section>

<div class="py-16 bg-warm">
    <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
        <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/card-post'); ?>
            <?php endwhile; ?>
        </div>
        <?php ea_pagination(); ?>
        <?php else : ?>
        <div class="text-center py-16">
            <p class="text-gray-500 text-lg mb-6"><?php esc_html_e("No results found. Try different keywords.", "egalitarian"); ?></p>
            <?php get_search_form(); ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
