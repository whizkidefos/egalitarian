<?php
/**
 * Archive / Blog template
 * File: wp-content/themes/egalitarian-association/archive.php
 */
get_header();

// Strip the <span> wrapper WordPress adds around the post type name
$archive_title = wp_strip_all_tags( get_the_archive_title() );
$archive_desc  = get_the_archive_description();
?>

<section class="ea-archive-hero py-16 sm:py-20 bg-navy relative overflow-hidden">
    <div class="absolute inset-0 overflow-hidden" aria-hidden="true">
        <div class="absolute -top-20 -right-20 w-80 h-80 rounded-full bg-teal/15 blur-3xl"></div>
    </div>
    <div class="absolute inset-0 bg-gradient-to-r from-navy/95 to-navy/70" aria-hidden="true"></div>
    <div class="relative z-10 max-w-site mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="mb-4 flex items-center gap-2 text-white/50 text-sm">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Home','egalitarian'); ?></a>
            <span>/</span>
            <span class="text-white/80"><?php echo esc_html($archive_title); ?></span>
        </nav>
        <h1 class="text-white font-extrabold text-3xl sm:text-4xl"><?php echo esc_html($archive_title); ?></h1>
        <?php if ($archive_desc) : ?>
        <p class="text-white/70 mt-3 max-w-xl"><?php echo wp_kses_post($archive_desc); ?></p>
        <?php endif; ?>
    </div>
</section>

<div class="py-16 lg:py-24 bg-warm">
    <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
        <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/card-post'); ?>
            <?php endwhile; ?>
        </div>
        <?php ea_pagination(); ?>
        <?php else : ?>
        <div class="text-center py-20">
            <p class="text-gray-400 text-lg"><?php esc_html_e('No posts found.','egalitarian'); ?></p>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="mt-6 inline-flex items-center gap-2 px-6 py-3 bg-navy text-white font-semibold rounded-xl hover:bg-navy-light transition-colors">
                <?php esc_html_e('Go Home','egalitarian'); ?>
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>