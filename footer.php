<?php
/**
 * Footer template
 * File: wp-content/themes/egalitarian-association/footer.php
 */
?>
</main><!-- /#main-content -->

<!-- ============================================================
     NEWSLETTER BAND
     ============================================================ -->
<section class="ea-newsletter bg-navy py-16 px-4">
    <div class="max-w-site mx-auto text-center">
        <p class="text-teal uppercase tracking-widest text-xs font-bold mb-3"><?php esc_html_e( 'Stay Connected', 'egalitarian' ); ?></p>
        <h2 class="text-white text-2xl sm:text-3xl font-bold mb-4">
            <?php esc_html_e( 'Join Our Community', 'egalitarian' ); ?>
        </h2>
        <p class="text-white/70 mb-8 max-w-xl mx-auto">
            <?php esc_html_e( 'Get updates on our work, upcoming events, and ways you can help make a difference.', 'egalitarian' ); ?>
        </p>
        <?php
        // Newsletter feedback messages
        $newsletter_status = isset( $_GET['newsletter'] ) ? sanitize_text_field( $_GET['newsletter'] ) : '';
        if ( $newsletter_status ) :
            $messages = [
                'success' => [ 'text' => __( 'Thank you for subscribing! We\'ll be in touch soon.', 'egalitarian' ), 'class' => 'bg-teal/20 border-teal text-teal' ],
                'exists'  => [ 'text' => __( 'You\'re already subscribed to our newsletter.', 'egalitarian' ), 'class' => 'bg-gold/20 border-gold text-gold' ],
                'invalid' => [ 'text' => __( 'Please enter a valid email address.', 'egalitarian' ), 'class' => 'bg-red-500/20 border-red-400 text-red-300' ],
                'error'   => [ 'text' => __( 'Something went wrong. Please try again.', 'egalitarian' ), 'class' => 'bg-red-500/20 border-red-400 text-red-300' ],
            ];
            if ( isset( $messages[ $newsletter_status ] ) ) :
        ?>
        <div class="mb-6 px-4 py-3 rounded-xl border <?php echo esc_attr( $messages[ $newsletter_status ]['class'] ); ?> max-w-lg mx-auto">
            <?php echo esc_html( $messages[ $newsletter_status ]['text'] ); ?>
        </div>
        <?php endif; endif; ?>

        <?php if ( function_exists( 'mc4wp_show_form' ) ) : ?>
            <?php mc4wp_show_form(); ?>
        <?php else : ?>
        <form class="flex flex-col sm:flex-row gap-3 justify-center max-w-lg mx-auto"
              action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"
              method="post"
              novalidate>
            <input type="hidden" name="action" value="ea_newsletter_signup">
            <?php wp_nonce_field( 'ea_newsletter_nonce', 'ea_nonce' ); ?>
            <label for="newsletter-email" class="sr-only"><?php esc_html_e( 'Email address', 'egalitarian' ); ?></label>
            <input id="newsletter-email"
                   type="email"
                   name="email"
                   required
                   placeholder="<?php esc_attr_e( 'Your email address', 'egalitarian' ); ?>"
                   class="flex-1 px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-gold focus:border-transparent transition-all text-sm">
            <button type="submit"
                    class="px-6 py-3 bg-gold text-navy font-bold rounded-xl hover:bg-gold-light transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 text-sm whitespace-nowrap">
                <?php esc_html_e( 'Subscribe', 'egalitarian' ); ?>
            </button>
        </form>
        <?php endif; ?>
    </div>
</section>

<!-- ============================================================
     MAIN FOOTER
     ============================================================ -->
<footer id="site-footer" class="bg-navy-dark text-white" role="contentinfo">
    <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">

            <!-- Col 1 — Org info -->
            <div class="lg:col-span-1">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-block mb-5" aria-label="<?php bloginfo( 'name' ); ?>">
                    <?php ea_logo( 'vertical', 'h-20 w-auto brightness-0 invert' ); ?>
                </a>
                <p class="text-white/60 text-sm leading-relaxed mb-5">
                    <?php echo esc_html( get_bloginfo( 'description' ) ?: __( 'A Charitable Incorporated Organisation committed to poverty relief and public health education in England.', 'egalitarian' ) ); ?>
                </p>
                <!-- Social -->
                <div class="flex items-center gap-3">
                    <?php
                    $socials = [
                        'facebook'  => get_theme_mod( 'ea_social_facebook',  '' ),
                        'twitter'   => get_theme_mod( 'ea_social_twitter',   '' ),
                        'linkedin'  => get_theme_mod( 'ea_social_linkedin',  '' ),
                        'email'     => 'mailto:' . get_theme_mod( 'ea_email', 'info@theegalitarianassociation.org' ),
                    ];
                    foreach ( $socials as $name => $url ) :
                        if ( ! $url || $url === '#' ) continue;
                    ?>
                    <a href="<?php echo esc_url( $url ); ?>"
                       class="w-9 h-9 rounded-lg bg-white/10 hover:bg-teal flex items-center justify-center transition-all duration-200 hover:scale-110"
                       aria-label="<?php echo esc_attr( ucfirst( $name ) ); ?>"
                       <?php echo $name !== 'email' ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                        <span class="w-4 h-4 text-white"><?php echo ea_icon( $name ); ?></span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Col 2 — Quick links -->
            <div>
                <h3 class="text-white font-bold text-sm uppercase tracking-widest mb-5 pb-2 border-b border-white/10">
                    <?php esc_html_e( 'Quick Links', 'egalitarian' ); ?>
                </h3>
                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-1' ); ?>
                <?php else : ?>
                <ul class="space-y-2.5">
                    <?php
                    $quick_links = [
                        __( 'About Us',    'egalitarian' ) => home_url( '/about' ),
                        __( 'Our Causes',  'egalitarian' ) => home_url( '/causes' ),
                        __( 'Events',      'egalitarian' ) => home_url( '/events' ),
                        __( 'News',        'egalitarian' ) => home_url( '/news' ),
                        __( 'Volunteer','egalitarian' ) => home_url( '/volunteer' ),
                        __( 'Donate',      'egalitarian' ) => home_url( '/donate' ),
                    ];
                    foreach ( $quick_links as $label => $url ) :
                    ?>
                    <li>
                        <a href="<?php echo esc_url( $url ); ?>"
                           class="text-white/60 hover:text-white text-sm flex items-center gap-2 transition-colors duration-150 hover:translate-x-1 group">
                            <span class="w-3 h-3 text-teal opacity-0 group-hover:opacity-100 transition-opacity"><?php echo ea_icon( 'arrow' ); ?></span>
                            <?php echo esc_html( $label ); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>

            <!-- Col 3 — Our Work -->
            <div>
                <h3 class="text-white font-bold text-sm uppercase tracking-widest mb-5 pb-2 border-b border-white/10">
                    <?php esc_html_e( 'Our Work', 'egalitarian' ); ?>
                </h3>
                <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-2' ); ?>
                <?php else : ?>
                <ul class="space-y-2.5">
                    <?php
                    // Dynamically fetch actual cause posts
                    $causes_query = new WP_Query( [
                        'post_type'      => 'ea_cause',
                        'posts_per_page' => 5,
                        'orderby'        => 'menu_order',
                        'order'          => 'ASC',
                        'post_status'    => 'publish',
                    ] );
                    if ( $causes_query->have_posts() ) :
                        while ( $causes_query->have_posts() ) : $causes_query->the_post();
                    ?>
                    <li>
                        <a href="<?php the_permalink(); ?>"
                           class="text-white/60 hover:text-white text-sm flex items-center gap-2 transition-colors duration-150 hover:translate-x-1 group">
                            <span class="w-3 h-3 text-teal opacity-0 group-hover:opacity-100 transition-opacity"><?php echo ea_icon( 'arrow' ); ?></span>
                            <?php the_title(); ?>
                        </a>
                    </li>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        // Fallback: link to main causes page
                    ?>
                    <li>
                        <a href="<?php echo esc_url( home_url( '/causes' ) ); ?>"
                           class="text-white/60 hover:text-white text-sm flex items-center gap-2 transition-colors duration-150 hover:translate-x-1 group">
                            <span class="w-3 h-3 text-teal opacity-0 group-hover:opacity-100 transition-opacity"><?php echo ea_icon( 'arrow' ); ?></span>
                            <?php esc_html_e( 'View All Causes', 'egalitarian' ); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
                <?php endif; ?>
            </div>

            <!-- Col 4 — Contact -->
            <div>
                <h3 class="text-white font-bold text-sm uppercase tracking-widest mb-5 pb-2 border-b border-white/10">
                    <?php esc_html_e( 'Contact', 'egalitarian' ); ?>
                </h3>
                <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-3' ); ?>
                <?php else : ?>
                <ul class="space-y-4">
                    <?php if ( $addr = get_theme_mod( 'ea_address', '15 Aqueduct Way, Manchester, M30 0YU' ) ) : ?>
                    <li class="flex items-start gap-3 text-white/60 text-sm">
                        <span class="w-5 h-5 text-teal mt-0.5 flex-shrink-0"><?php echo ea_icon( 'location' ); ?></span>
                        <span><?php echo wp_kses_post( $addr ); ?></span>
                    </li>
                    <?php endif; ?>
                    <?php if ( $phone = get_theme_mod( 'ea_phone', '' ) ) : ?>
                    <li>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"
                           class="flex items-center gap-3 text-white/60 hover:text-white text-sm transition-colors">
                            <span class="w-5 h-5 text-teal flex-shrink-0"><?php echo ea_icon( 'phone' ); ?></span>
                            <?php echo esc_html( $phone ); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php $email = get_theme_mod( 'ea_email', 'info@theegalitarianassociation.org' ); ?>
                    <li>
                        <a href="mailto:<?php echo esc_attr( $email ); ?>"
                           class="flex items-center gap-3 text-white/60 hover:text-white text-sm transition-colors">
                            <span class="w-5 h-5 text-teal flex-shrink-0"><?php echo ea_icon( 'email' ); ?></span>
                            <?php echo esc_html( $email ); ?>
                        </a>
                    </li>
                </ul>
                <?php endif; ?>

                <!-- Charity reg -->
                <?php if ( $reg = get_theme_mod( 'ea_charity_number', '1216794' ) ) : ?>
                <div class="mt-6 p-3 rounded-lg bg-white/5 border border-white/10">
                    <p class="text-white/40 text-xs">
                        <?php esc_html_e( 'Registered Charity', 'egalitarian' ); ?><br>
                        <span class="text-white/70 font-semibold"><?php echo esc_html( $reg ); ?></span>
                    </p>
                </div>
                <?php endif; ?>
            </div>

        </div><!-- /.grid -->
    </div><!-- /.max-w-site -->

    <!-- Footer bottom bar -->
    <div class="border-t border-white/10">
        <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-white/40 text-xs text-center sm:text-left">
                &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>.
                <?php esc_html_e( 'All rights reserved. Registered in England.', 'egalitarian' ); ?>
            </p>
            <nav class="flex items-center gap-4" aria-label="<?php esc_attr_e( 'Legal', 'egalitarian' ); ?>">
                <?php
                wp_nav_menu( [
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'     => 'flex items-center gap-4',
                    'fallback_cb'    => function() {
                        $legal = [
                            __( 'Privacy Policy', 'egalitarian' ) => home_url( '/privacy-policy' ),
                            __( 'Cookie Policy',  'egalitarian' ) => home_url( '/cookie-policy' ),
                        ];
                        echo '<ul class="flex items-center gap-4">';
                        foreach ( $legal as $label => $url ) {
                            echo '<li><a href="' . esc_url( $url ) . '" class="text-white/40 hover:text-white/70 text-xs transition-colors">' . esc_html( $label ) . '</a></li>';
                        }
                        echo '</ul>';
                    },
                    'depth'          => 1,
                    'add_li_class'   => 'text-white/40 hover:text-white/70 text-xs transition-colors',
                ] );
                ?>
            </nav>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>