<?php
/**
 * Template part: Hero section
 * File: wp-content/themes/egalitarian-association/template-parts/hero.php
 *
 * Accepts:
 *   $args['heading']    — H1 text
 *   $args['subtext']    — Paragraph text
 *   $args['cta_label']  — Primary CTA label
 *   $args['cta_url']    — Primary CTA URL
 *   $args['cta2_label'] — Secondary CTA label
 *   $args['cta2_url']   — Secondary CTA URL
 *   $args['image_id']   — Featured image attachment ID
 */

$heading   = $args['heading']   ?? __( 'Serving Community,<br>Changing Lives', 'egalitarian' );
$subtext   = $args['subtext']   ?? __( 'We provide food parcels, essential clothing and health education to those in need across England.', 'egalitarian' );
$cta_label = $args['cta_label'] ?? __( 'Donate Today', 'egalitarian' );
$cta_url   = $args['cta_url']   ?? '#donate';
$cta2_label= $args['cta2_label']?? __( 'Learn More', 'egalitarian' );
$cta2_url  = $args['cta2_url']  ?? home_url( '/about' );
$image_id  = $args['image_id']  ?? 0;
?>

<section class="ea-hero relative min-h-[88vh] flex items-center overflow-hidden bg-navy-dark" aria-labelledby="hero-heading">

    <!-- Background image -->
    <?php if ( $image_id ) :
        $src = wp_get_attachment_image_url( $image_id, 'ea-hero' );
    ?>
    <div class="absolute inset-0 z-0">
        <img src="<?php echo esc_url( $src ); ?>"
             alt=""
             role="presentation"
             class="w-full h-full object-cover object-center opacity-25">
    </div>
    <?php else : ?>
    <!-- Decorative SVG background pattern when no image is set -->
    <div class="absolute inset-0 z-0 overflow-hidden" aria-hidden="true">
        <!-- Mesh gradient -->
        <div class="absolute -top-32 -right-32 w-[600px] h-[600px] rounded-full bg-teal/20 blur-3xl"></div>
        <div class="absolute -bottom-32 -left-32 w-[500px] h-[500px] rounded-full bg-gold/15 blur-3xl"></div>
        <div class="absolute top-1/2 left-1/3 w-[400px] h-[400px] rounded-full bg-navy-light/30 blur-3xl -translate-y-1/2"></div>
        <!-- Dot pattern -->
        <svg class="absolute inset-0 w-full h-full opacity-5" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="hero-dots" x="0" y="0" width="32" height="32" patternUnits="userSpaceOnUse">
                    <circle cx="2" cy="2" r="1.5" fill="white"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#hero-dots)"/>
        </svg>
    </div>
    <?php endif; ?>

    <!-- Overlay gradient -->
    <div class="absolute inset-0 z-[1] bg-gradient-to-r from-navy-dark/90 via-navy-dark/70 to-navy-dark/30" aria-hidden="true"></div>

    <!-- Content -->
    <div class="relative z-[2] max-w-site mx-auto px-4 sm:px-6 lg:px-8 w-full py-20">
        <div class="max-w-2xl">

            <!-- Tag line -->
            <div class="ea-reveal inline-flex items-center gap-2 bg-teal/20 border border-teal/30 rounded-full px-4 py-1.5 mb-8 opacity-0">
                <span class="w-2 h-2 rounded-full bg-teal animate-pulse2"></span>
                <span class="text-teal text-xs font-bold uppercase tracking-widest">
                    <?php esc_html_e( 'Registered Charity · England', 'egalitarian' ); ?>
                </span>
            </div>

            <!-- Heading -->
            <h1 id="hero-heading"
                class="ea-reveal text-white font-extrabold leading-tight mb-6 opacity-0"
                style="font-size: clamp(2.4rem, 5vw, 3.75rem); animation-delay: 0.1s;">
                <?php echo wp_kses_post( $heading ); ?>
            </h1>

            <!-- Subtext -->
            <p class="ea-reveal text-white/75 text-lg sm:text-xl leading-relaxed mb-10 max-w-xl opacity-0" style="animation-delay: 0.2s;">
                <?php echo esc_html( $subtext ); ?>
            </p>

            <!-- CTAs -->
            <div class="ea-reveal flex flex-wrap gap-4 opacity-0" style="animation-delay: 0.3s;">
                <a href="<?php echo esc_url( $cta_url ); ?>"
                   class="inline-flex items-center gap-2 px-7 py-3.5 bg-gold text-navy font-bold rounded-xl text-base hover:bg-gold-light hover:shadow-xl hover:-translate-y-1 transition-all duration-200">
                    <span class="w-5 h-5"><?php echo ea_icon( 'heart' ); ?></span>
                    <?php echo esc_html( $cta_label ); ?>
                </a>
                <a href="<?php echo esc_url( $cta2_url ); ?>"
                   class="inline-flex items-center gap-2 px-7 py-3.5 border-2 border-white/40 text-white font-semibold rounded-xl text-base hover:border-white hover:bg-white/10 transition-all duration-200">
                    <?php echo esc_html( $cta2_label ); ?>
                    <span class="w-5 h-5"><?php echo ea_icon( 'arrow' ); ?></span>
                </a>
            </div>

        </div>

        <!-- Stats strip -->
        <div class="ea-reveal mt-16 sm:mt-20 opacity-0 grid grid-cols-2 sm:grid-cols-4 gap-4 max-w-2xl" style="animation-delay: 0.45s;">
            <?php
            $stats = [
                [ 'value' => get_theme_mod( 'ea_stat1_value', '2,500+' ), 'label' => get_theme_mod( 'ea_stat1_label', __( 'Food Parcels Delivered', 'egalitarian' ) ) ],
                [ 'value' => get_theme_mod( 'ea_stat2_value', '1,200+' ), 'label' => get_theme_mod( 'ea_stat2_label', __( 'People Helped', 'egalitarian' ) ) ],
                [ 'value' => get_theme_mod( 'ea_stat3_value', '150+'   ), 'label' => get_theme_mod( 'ea_stat3_label', __( 'Volunteers', 'egalitarian' ) ) ],
                [ 'value' => get_theme_mod( 'ea_stat4_value', '50+'    ), 'label' => get_theme_mod( 'ea_stat4_label', __( 'Health Talks', 'egalitarian' ) ) ],
            ];
            foreach ( $stats as $stat ) :
            ?>
            <div class="bg-white/10 backdrop-blur-sm border border-white/15 rounded-xl p-4 text-center">
                <p class="text-gold font-extrabold text-2xl sm:text-3xl leading-none mb-1">
                    <?php echo esc_html( $stat['value'] ); ?>
                </p>
                <p class="text-white/60 text-xs leading-snug">
                    <?php echo esc_html( $stat['label'] ); ?>
                </p>
            </div>
            <?php endforeach; ?>
        </div>

    </div>

    <!-- Scroll indicator -->
    <a href="#ea-mission"
       class="absolute bottom-8 left-1/2 -translate-x-1/2 z-[2] flex flex-col items-center gap-1 text-white/40 hover:text-white/70 transition-colors"
       aria-label="<?php esc_attr_e( 'Scroll down', 'egalitarian' ); ?>">
        <svg class="w-6 h-6 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </a>

</section>
