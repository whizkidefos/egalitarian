<?php
/**
 * Template part: Call-to-Action section
 * File: wp-content/themes/egalitarian-association/template-parts/cta.php
 */
?>
<section class="ea-cta py-20 bg-gradient-to-br from-teal to-teal-dark relative overflow-hidden" aria-labelledby="cta-heading">
    <!-- Background shapes -->
    <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/3" aria-hidden="true"></div>
    <div class="absolute bottom-0 left-0 w-52 h-52 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/3" aria-hidden="true"></div>

    <div class="relative z-10 max-w-site mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 id="cta-heading" class="ea-reveal text-white font-extrabold text-3xl sm:text-4xl mb-4 opacity-0">
            <?php esc_html_e( 'Ready to Make a Difference?', 'egalitarian' ); ?>
        </h2>
        <p class="ea-reveal text-white/80 text-lg max-w-xl mx-auto mb-10 opacity-0" style="animation-delay: 0.1s;">
            <?php esc_html_e( 'Every donation, every volunteer hour, every shared story helps us reach more people who need our support.', 'egalitarian' ); ?>
        </p>
        <div class="ea-reveal flex flex-col sm:flex-row items-center justify-center gap-4 opacity-0" style="animation-delay: 0.2s;">
            <a href="<?php echo esc_url( home_url( '/donate' ) ); ?>"
               class="inline-flex items-center gap-2 px-8 py-4 bg-white text-teal-dark font-bold rounded-xl text-base hover:bg-gold hover:text-navy hover:shadow-xl hover:-translate-y-1 transition-all duration-200 min-w-[180px] justify-center">
                <span class="w-5 h-5"><?php echo ea_icon( 'heart' ); ?></span>
                <?php esc_html_e( 'Donate Now', 'egalitarian' ); ?>
            </a>
            <a href="<?php echo esc_url( home_url( '/volunteer' ) ); ?>"
               class="inline-flex items-center gap-2 px-8 py-4 border-2 border-white text-white font-semibold rounded-xl text-base hover:bg-white/10 transition-all duration-200 min-w-[180px] justify-center">
                <span class="w-5 h-5"><?php echo ea_icon( 'people' ); ?></span>
                <?php esc_html_e( 'Volunteer', 'egalitarian' ); ?>
            </a>
        </div>
    </div>
</section>
