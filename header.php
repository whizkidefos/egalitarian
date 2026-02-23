<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class( 'font-sans text-gray-800 bg-white antialiased' ); ?>>
<?php wp_body_open(); ?>

<!-- Skip to content -->
<a href="#main-content"
   class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-[9999] focus:px-4 focus:py-2 focus:bg-navy focus:text-white focus:rounded-lg focus:font-semibold">
    <?php esc_html_e( 'Skip to content', 'egalitarian' ); ?>
</a>

<!-- ============================================================
     ANNOUNCEMENT BAR (optional — remove if not needed)
     ============================================================ -->
<?php if ( get_theme_mod( 'ea_announcement', '' ) ) : ?>
<div class="ea-announcement bg-teal text-white text-sm text-center py-2 px-4">
    <?php echo wp_kses_post( get_theme_mod( 'ea_announcement', '' ) ); ?>
</div>
<?php endif; ?>

<!-- ============================================================
     SITE HEADER
     ============================================================ -->
<header id="site-header"
        class="ea-header sticky top-0 z-50 bg-white/95 backdrop-blur-sm shadow-nav transition-all duration-300">
    <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-18 lg:h-22">

            <!-- Logo -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
               class="ea-logo-link flex-shrink-0"
               aria-label="<?php bloginfo( 'name' ); ?> — <?php esc_attr_e( 'Home', 'egalitarian' ); ?>">
                <?php ea_logo( 'horizontal', 'h-10 lg:h-12 w-auto' ); ?>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center gap-1" aria-label="<?php esc_attr_e( 'Primary', 'egalitarian' ); ?>">
                <?php
                wp_nav_menu( [
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'flex items-center gap-1',
                    'fallback_cb'    => 'ea_fallback_menu',
                    'walker'         => new EA_Nav_Walker(),
                ] );
                ?>
            </nav>

            <!-- Desktop CTA -->
            <div class="hidden lg:flex items-center gap-3">
                <a href="<?php echo esc_url( get_page_link( get_page_by_path( 'donate' ) ) ?: '#donate' ); ?>"
                   class="ea-btn-primary inline-flex items-center gap-2 px-5 py-2.5 bg-gold text-navy font-bold rounded-xl hover:bg-gold-dark transition-all duration-200 hover:shadow-md hover:-translate-y-0.5">
                    <span class="w-4 h-4"><?php echo ea_icon( 'heart' ); ?></span>
                    <?php esc_html_e( 'Donate', 'egalitarian' ); ?>
                </a>
                <a href="<?php echo esc_url( get_page_link( get_page_by_path( 'volunteer' ) ) ?: '#volunteer' ); ?>"
                   class="ea-btn-outline inline-flex items-center gap-2 px-5 py-2.5 border-2 border-navy text-navy font-semibold rounded-xl hover:bg-navy hover:text-white transition-all duration-200">
                    <?php esc_html_e( 'Volunteer', 'egalitarian' ); ?>
                </a>
            </div>

            <!-- Mobile menu toggle -->
            <button id="ea-mobile-toggle"
                    class="lg:hidden flex items-center justify-center w-10 h-10 rounded-lg text-navy hover:bg-navy/10 transition-colors"
                    aria-expanded="false"
                    aria-controls="ea-mobile-menu"
                    aria-label="<?php esc_attr_e( 'Toggle menu', 'egalitarian' ); ?>">
                <span class="icon-menu w-6 h-6"><?php echo ea_icon( 'menu' ); ?></span>
                <span class="icon-close w-6 h-6 hidden"><?php echo ea_icon( 'close' ); ?></span>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div id="ea-mobile-menu"
         class="lg:hidden hidden border-t border-gray-100 bg-white"
         role="dialog"
         aria-label="<?php esc_attr_e( 'Mobile navigation', 'egalitarian' ); ?>">
        <div class="max-w-site mx-auto px-4 py-4">
            <?php
            wp_nav_menu( [
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'ea-mobile-nav flex flex-col gap-1',
                'fallback_cb'    => 'ea_fallback_menu',
                'walker'         => new EA_Mobile_Nav_Walker(),
            ] );
            ?>
            <div class="flex flex-col gap-3 mt-4 pt-4 border-t border-gray-100">
                <a href="#donate"
                   class="flex items-center justify-center gap-2 py-3 bg-gold text-navy font-bold rounded-xl text-center hover:bg-gold-dark transition-colors">
                    <span class="w-5 h-5"><?php echo ea_icon( 'heart' ); ?></span>
                    <?php esc_html_e( 'Donate Now', 'egalitarian' ); ?>
                </a>
                <a href="#volunteer"
                   class="flex items-center justify-center py-3 border-2 border-navy text-navy font-semibold rounded-xl text-center hover:bg-navy hover:text-white transition-colors">
                    <?php esc_html_e( 'Volunteer', 'egalitarian' ); ?>
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Main content landmark -->
<main id="main-content" tabindex="-1">