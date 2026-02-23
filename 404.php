<?php
/**
 * 404 template
 * File: wp-content/themes/egalitarian-association/404.php
 */
get_header();
?>

<section class="min-h-[70vh] flex items-center justify-center py-20 bg-warm">
    <div class="max-w-lg mx-auto px-4 text-center">
        <!-- Decorative -->
        <div class="relative inline-flex mb-8" aria-hidden="true">
            <span class="text-[8rem] font-extrabold text-navy/10 leading-none select-none">404</span>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="w-20 h-20 text-teal"><?php echo ea_icon('heart'); ?></span>
            </div>
        </div>
        <h1 class="text-navy font-extrabold text-3xl sm:text-4xl mb-4">
            <?php esc_html_e("Page Not Found", "egalitarian"); ?>
        </h1>
        <p class="text-gray-500 text-lg leading-relaxed mb-8">
            <?php esc_html_e("The page you're looking for may have moved or no longer exists. But our mission — and our community — is still very much here.", "egalitarian"); ?>
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="<?php echo esc_url(home_url('/')); ?>"
               class="inline-flex items-center gap-2 px-7 py-3.5 bg-navy text-white font-bold rounded-xl hover:bg-navy-light hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                <?php esc_html_e("Go Home", "egalitarian"); ?>
            </a>
            <a href="<?php echo esc_url(home_url('/donate')); ?>"
               class="inline-flex items-center gap-2 px-7 py-3.5 bg-gold text-navy font-bold rounded-xl hover:bg-gold-light hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                <span class="w-5 h-5"><?php echo ea_icon('heart'); ?></span>
                <?php esc_html_e("Donate Instead", "egalitarian"); ?>
            </a>
        </div>
        <!-- Search -->
        <div class="mt-10">
            <?php get_search_form(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
