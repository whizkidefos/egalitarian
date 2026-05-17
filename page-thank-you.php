<?php
/**
 * Template Name: Thank You Page
 * File: wp-content/themes/egalitarian-association/page-thank-you.php
 * 
 * Shown after successful PayPal donation redirect
 */
get_header();
?>

<section class="relative py-20 sm:py-28 bg-navy overflow-hidden">
    <div class="absolute inset-0 overflow-hidden" aria-hidden="true">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-teal/15 blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-gold/10 blur-3xl"></div>
    </div>
    <div class="absolute inset-0 bg-gradient-to-r from-navy/95 to-navy/60" aria-hidden="true"></div>
    <div class="relative z-10 max-w-site mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="w-16 h-16 rounded-full bg-teal/20 border-2 border-teal flex items-center justify-center mx-auto mb-6">
            <span class="w-8 h-8 text-teal"><?php echo ea_icon('heart'); ?></span>
        </div>
        <h1 class="text-white font-extrabold text-4xl sm:text-5xl mb-4"><?php esc_html_e('Thank You!','egalitarian'); ?></h1>
        <p class="text-white/70 text-lg max-w-2xl mx-auto"><?php esc_html_e('Your generosity means the world to us. Your donation will directly impact the lives of those in need.','egalitarian'); ?></p>
    </div>
</section>

<div class="py-16 lg:py-20 bg-white">
    <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            
            <!-- Check receipt details if available -->
            <?php if ( ! empty( $_GET['tx'] ) ) : ?>
            <div class="mb-12 p-6 bg-teal/5 border border-teal/20 rounded-2xl">
                <h2 class="text-navy font-bold text-lg mb-3"><?php esc_html_e('Donation Details','egalitarian'); ?></h2>
                <p class="text-gray-600 mb-2"><strong><?php esc_html_e('Transaction ID:','egalitarian'); ?></strong> <code class="text-xs bg-gray-100 px-2 py-1 rounded"><?php echo esc_html($_GET['tx']); ?></code></p>
                <p class="text-gray-600 text-sm"><?php esc_html_e('A receipt has been sent to your email address on file with PayPal.','egalitarian'); ?></p>
            </div>
            <?php endif; ?>

            <!-- What happens next -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="text-center">
                    <div class="w-12 h-12 rounded-full bg-teal/10 border-2 border-teal flex items-center justify-center mx-auto mb-4">
                        <span class="text-lg">✓</span>
                    </div>
                    <h3 class="text-navy font-bold text-lg mb-2"><?php esc_html_e('Verified','egalitarian'); ?></h3>
                    <p class="text-gray-600 text-sm"><?php esc_html_e('Your donation has been securely processed through PayPal.','egalitarian'); ?></p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 rounded-full bg-gold/10 border-2 border-gold flex items-center justify-center mx-auto mb-4">
                        <span class="text-lg">📧</span>
                    </div>
                    <h3 class="text-navy font-bold text-lg mb-2"><?php esc_html_e('Email Sent','egalitarian'); ?></h3>
                    <p class="text-gray-600 text-sm"><?php esc_html_e('A confirmation and receipt will arrive shortly.','egalitarian'); ?></p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 rounded-full bg-navy/10 border-2 border-navy flex items-center justify-center mx-auto mb-4">
                        <span class="text-lg">💪</span>
                    </div>
                    <h3 class="text-navy font-bold text-lg mb-2"><?php esc_html_e('Impact','egalitarian'); ?></h3>
                    <p class="text-gray-600 text-sm"><?php esc_html_e('Your gift is now supporting our vital work.','egalitarian'); ?></p>
                </div>
            </div>

            <!-- CTA options -->
            <div class="prose prose-lg prose-navy max-w-none mb-12
                        prose-headings:font-bold prose-headings:text-navy
                        prose-a:text-teal prose-a:no-underline hover:prose-a:underline">
                <?php while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            </div>

            <!-- Next steps -->
            <div class="bg-warm rounded-2xl p-8">
                <h2 class="text-navy font-bold text-xl mb-4"><?php esc_html_e('What You Can Do Next','egalitarian'); ?></h2>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <span class="text-teal font-bold mt-1">→</span>
                        <div>
                            <strong class="text-navy"><?php esc_html_e('Share Our Work','egalitarian'); ?></strong>
                            <p class="text-gray-600 text-sm"><?php esc_html_e('Tell your friends and family about The Egalitarian Association on social media.','egalitarian'); ?></p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-teal font-bold mt-1">→</span>
                        <div>
                            <strong class="text-navy"><?php esc_html_e('Get Involved','egalitarian'); ?></strong>
                            <p class="text-gray-600 text-sm"><a href="<?php echo esc_url(home_url('/volunteer')); ?>" class="text-teal hover:underline"><?php esc_html_e('Volunteer with us','egalitarian'); ?></a> <?php esc_html_e('and make a hands-on difference.','egalitarian'); ?></p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-teal font-bold mt-1">→</span>
                        <div>
                            <strong class="text-navy"><?php esc_html_e('Learn About Our Causes','egalitarian'); ?></strong>
                            <p class="text-gray-600 text-sm"><a href="<?php echo esc_url(home_url('/causes')); ?>" class="text-teal hover:underline"><?php esc_html_e('Explore the causes','egalitarian'); ?></a> <?php esc_html_e('we're fighting for.','egalitarian'); ?></p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-teal font-bold mt-1">→</span>
                        <div>
                            <strong class="text-navy"><?php esc_html_e('Subscribe to Updates','egalitarian'); ?></strong>
                            <p class="text-gray-600 text-sm"><?php esc_html_e('Stay informed about our impact and upcoming events.','egalitarian'); ?></p>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Questions -->
            <div class="mt-12 pt-12 border-t border-gray-200">
                <h2 class="text-navy font-bold text-lg mb-3"><?php esc_html_e('Have Questions?','egalitarian'); ?></h2>
                <p class="text-gray-600 mb-4"><?php esc_html_e('If you have any questions about your donation or our work, please don't hesitate to reach out.','egalitarian'); ?></p>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-navy text-white font-semibold rounded-xl hover:bg-navy/90 hover:shadow-lg transition-all">
                    <span class="w-4 h-4"><?php echo ea_icon('email'); ?></span>
                    <?php esc_html_e('Contact Us','egalitarian'); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
