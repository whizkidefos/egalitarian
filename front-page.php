<?php
/**
 * Front page template
 * File: wp-content/themes/egalitarian-association/front-page.php
 */
get_header();
?>

<?php
// Hero
$hero_args = [
    'heading'   => get_theme_mod( 'ea_hero_heading', __( 'Serving Community,<br>Changing Lives', 'egalitarian' ) ),
    'subtext'   => get_theme_mod( 'ea_hero_subtext',  __( 'We provide food parcels, essential clothing and health education to those in need across England.', 'egalitarian' ) ),
    'cta_label' => get_theme_mod( 'ea_hero_cta_label', __( 'Donate Today', 'egalitarian' ) ),
    'cta_url'   => get_theme_mod( 'ea_hero_cta_url',   home_url( '/donate' ) ),
    'cta2_label'=> __( 'Learn More', 'egalitarian' ),
    'cta2_url'  => home_url( '/about' ),
    'image_id'  => (int) get_theme_mod( 'ea_hero_image', 0 ),
];
get_template_part( 'template-parts/hero', null, $hero_args );
?>

<?php get_template_part( 'template-parts/mission' ); ?>

<!-- ============================================================
     CAUSES GRID
     ============================================================ -->
<?php
$causes_query = new WP_Query( [
    'post_type'      => 'ea_cause',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
] );
if ( $causes_query->have_posts() ) :
?>
<section class="ea-causes py-20 lg:py-28" aria-labelledby="causes-heading">
    <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12">
            <div>
                <span class="ea-reveal block text-teal text-xs font-bold uppercase tracking-widest mb-2 opacity-0">
                    <?php esc_html_e( 'Get Involved', 'egalitarian' ); ?>
                </span>
                <h2 id="causes-heading" class="ea-reveal text-navy font-extrabold text-3xl sm:text-4xl opacity-0" style="animation-delay:0.1s;">
                    <?php esc_html_e( 'Our Causes', 'egalitarian' ); ?>
                </h2>
            </div>
            <a href="<?php echo esc_url( home_url( '/causes' ) ); ?>"
               class="ea-reveal inline-flex items-center gap-2 text-navy font-semibold text-sm hover:text-teal transition-colors opacity-0 group" style="animation-delay:0.2s;">
                <?php esc_html_e( 'View all causes', 'egalitarian' ); ?>
                <span class="w-4 h-4 group-hover:translate-x-1 transition-transform"><?php echo ea_icon( 'arrow' ); ?></span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            $delay_i = 0;
            while ( $causes_query->have_posts() ) :
                $causes_query->the_post();
                $delay = round( $delay_i * 0.1, 1 ) . 's';
                $delay_i++;
            ?>
            <article id="cause-<?php the_ID(); ?>"
                     class="ea-reveal ea-cause-card bg-white rounded-2xl overflow-hidden shadow-card hover:shadow-card-hover hover:-translate-y-1.5 transition-all duration-300 flex flex-col border border-gray-100 group opacity-0"
                     style="animation-delay: <?php echo esc_attr( $delay ); ?>">
                <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" class="block overflow-hidden aspect-video flex-shrink-0" tabindex="-1">
                    <?php the_post_thumbnail( 'ea-card', [
                        'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500',
                        'alt'   => '',
                    ] ); ?>
                </a>
                <?php else : ?>
                <div class="aspect-video bg-gradient-to-br from-navy/10 to-teal/10 flex items-center justify-center">
                    <span class="w-12 h-12 text-navy/30"><?php echo ea_icon( 'heart' ); ?></span>
                </div>
                <?php endif; ?>
                <div class="p-6 flex flex-col flex-1">
                    <h3 class="text-navy font-bold text-lg leading-snug mb-3">
                        <a href="<?php the_permalink(); ?>" class="hover:text-teal transition-colors"><?php the_title(); ?></a>
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed flex-1 mb-5"><?php the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>"
                       class="inline-flex items-center gap-1.5 text-teal font-semibold text-sm hover:text-navy transition-colors group/link">
                        <?php esc_html_e( 'Learn more', 'egalitarian' ); ?>
                        <span class="w-4 h-4 group-hover/link:translate-x-1 transition-transform"><?php echo ea_icon( 'arrow' ); ?></span>
                    </a>
                </div>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============================================================
     IMPACT NUMBERS BAND
     ============================================================ -->
<section class="ea-impact py-16 bg-navy" aria-labelledby="impact-heading">
    <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
        <h2 id="impact-heading" class="sr-only"><?php esc_html_e( 'Our impact in numbers', 'egalitarian' ); ?></h2>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
            <?php
            $impact = [
                [ 'n' => get_theme_mod( 'ea_stat1_value', '2,500+' ), 'l' => get_theme_mod( 'ea_stat1_label', __( 'Food Parcels Delivered', 'egalitarian' ) ), 'c' => 'text-teal' ],
                [ 'n' => get_theme_mod( 'ea_stat2_value', '1,200+' ), 'l' => get_theme_mod( 'ea_stat2_label', __( 'People Helped', 'egalitarian' ) ),          'c' => 'text-gold' ],
                [ 'n' => get_theme_mod( 'ea_stat3_value', '150+'   ), 'l' => get_theme_mod( 'ea_stat3_label', __( 'Volunteers', 'egalitarian' ) ),              'c' => 'text-teal' ],
                [ 'n' => get_theme_mod( 'ea_stat4_value', '50+'    ), 'l' => get_theme_mod( 'ea_stat4_label', __( 'Health Talks Delivered', 'egalitarian' ) ),  'c' => 'text-gold' ],
            ];
            foreach ( $impact as $item ) :
            ?>
            <div class="ea-reveal opacity-0">
                <p class="<?php echo esc_attr( $item['c'] ); ?> font-extrabold mb-2"
                   style="font-size: clamp(2rem, 4vw, 3rem);">
                    <?php echo esc_html( $item['n'] ); ?>
                </p>
                <p class="text-white/60 text-sm font-medium"><?php echo esc_html( $item['l'] ); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================================
     LATEST NEWS
     ============================================================ -->
<?php
$news_query = new WP_Query( [
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
] );
if ( $news_query->have_posts() ) :
?>
<section class="ea-news py-20 lg:py-28 bg-white" aria-labelledby="news-heading">
    <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12">
            <div>
                <span class="ea-reveal block text-teal text-xs font-bold uppercase tracking-widest mb-2 opacity-0">
                    <?php esc_html_e( 'Latest', 'egalitarian' ); ?>
                </span>
                <h2 id="news-heading" class="ea-reveal text-navy font-extrabold text-3xl sm:text-4xl opacity-0" style="animation-delay:0.1s;">
                    <?php esc_html_e( 'News & Stories', 'egalitarian' ); ?>
                </h2>
            </div>
            <a href="<?php echo esc_url( home_url( '/news' ) ); ?>"
               class="ea-reveal inline-flex items-center gap-2 text-navy font-semibold text-sm hover:text-teal transition-colors opacity-0 group" style="animation-delay:0.2s;">
                <?php esc_html_e( 'View all news', 'egalitarian' ); ?>
                <span class="w-4 h-4 group-hover:translate-x-1 transition-transform"><?php echo ea_icon( 'arrow' ); ?></span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php
            while ( $news_query->have_posts() ) :
                $news_query->the_post();
                get_template_part( 'template-parts/card-post' );
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============================================================
     TESTIMONIALS
     ============================================================ -->
<?php
$testi_query = new WP_Query( [
    'post_type'      => 'ea_testimonial',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
] );
if ( $testi_query->have_posts() ) :
?>
<section class="ea-testimonials py-20 bg-warm" aria-labelledby="testi-heading">
    <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="ea-reveal block text-teal text-xs font-bold uppercase tracking-widest mb-2 opacity-0">
                <?php esc_html_e( 'Voices', 'egalitarian' ); ?>
            </span>
            <h2 id="testi-heading" class="ea-reveal text-navy font-extrabold text-3xl sm:text-4xl opacity-0" style="animation-delay:0.1s;">
                <?php esc_html_e( 'Lives Changed', 'egalitarian' ); ?>
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php
            $t_delay = 0;
            while ( $testi_query->have_posts() ) :
                $testi_query->the_post();
                $d = round( $t_delay * 0.12, 2 ) . 's';
                $t_delay++;
                $subtitle = get_post_meta( get_the_ID(), '_ea_testimonial_subtitle', true );
            ?>
            <figure class="ea-reveal ea-testi-card bg-white rounded-2xl p-8 shadow-card flex flex-col gap-5 border border-gray-100 opacity-0" style="animation-delay:<?php echo esc_attr($d);?>">
                <span class="w-8 h-8 text-gold"><?php echo ea_icon( 'quote' ); ?></span>
                <blockquote class="text-gray-700 text-sm leading-relaxed italic flex-1">
                    <?php the_content(); ?>
                </blockquote>
                <figcaption class="flex items-center gap-3 border-t border-gray-100 pt-5">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                        <?php the_post_thumbnail( 'ea-thumb', [ 'class' => 'w-full h-full object-cover', 'alt' => '' ] ); ?>
                    </div>
                    <?php else : ?>
                    <div class="w-10 h-10 rounded-full bg-navy/10 flex-shrink-0 flex items-center justify-center">
                        <span class="text-navy/40 font-bold text-sm"><?php echo esc_html( mb_substr( get_the_title(), 0, 1 ) ); ?></span>
                    </div>
                    <?php endif; ?>
                    <div>
                        <p class="text-navy font-bold text-sm"><?php the_title(); ?></p>
                        <?php if ( $subtitle ) : ?>
                        <p class="text-gray-400 text-xs"><?php echo esc_html( $subtitle ); ?></p>
                        <?php endif; ?>
                    </div>
                </figcaption>
            </figure>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============================================================
     CTA BAND
     ============================================================ -->
<?php get_template_part( 'template-parts/cta' ); ?>

<?php get_footer(); ?>
