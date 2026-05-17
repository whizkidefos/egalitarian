<?php
/**
 * Single cause post template
 * File: wp-content/themes/egalitarian-association/single-ea_cause.php
 */
get_header();

while ( have_posts() ) : the_post();
    $start_date = get_post_meta( get_the_ID(), '_ea_cause_start_date', true );
    $end_date   = get_post_meta( get_the_ID(), '_ea_cause_end_date',   true );
    $locations  = get_post_meta( get_the_ID(), '_ea_cause_locations',  true );
    $thumbnail  = get_the_post_thumbnail_url( null, 'ea-hero' );
    $subtitle   = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_the_content() ), 24, '...' );
?>

<!-- Cause hero -->
<section class="ea-cause-hero relative py-16 sm:py-24 bg-navy overflow-hidden">
    <?php if ( $thumbnail ) : ?>
    <div class="absolute inset-0 z-0"><img src="<?php echo esc_url($thumbnail); ?>" alt="" class="w-full h-full object-cover opacity-25"></div>
    <?php else : ?>
    <div class="absolute inset-0 overflow-hidden" aria-hidden="true">
        <div class="absolute -top-20 -right-20 w-96 h-96 rounded-full bg-teal/15 blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-gold/10 blur-3xl"></div>
    </div>
    <?php endif; ?>
    <div class="absolute inset-0 z-[1] bg-gradient-to-r from-navy/95 to-navy/70" aria-hidden="true"></div>
    <div class="relative z-[2] mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
        <!-- Breadcrumb -->
        <nav class="mb-5 flex items-center gap-2 text-white/50 text-sm flex-wrap">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Home','egalitarian'); ?></a>
            <span aria-hidden="true">/</span>
            <a href="<?php echo esc_url( home_url('/causes') ); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Causes','egalitarian'); ?></a>
            <span aria-hidden="true">/</span>
            <span class="text-white/80 truncate" aria-current="page"><?php the_title(); ?></span>
        </nav>
        <h1 class="text-white font-extrabold text-3xl sm:text-4xl lg:text-5xl leading-tight mb-5"><?php the_title(); ?></h1>
        <p class="text-white text-lg leading-relaxed opacity-90"><?php echo esc_html( $subtitle ); ?></p>
    </div>
</section>

<!-- Cause body -->
<div class="ea-cause-body py-16 lg:py-20">
    <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            
            <!-- Metadata cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-12 p-6 bg-warm rounded-2xl border border-gray-200">
                <?php if ( $start_date ) : ?>
                <div>
                    <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide mb-1"><?php esc_html_e( 'Start Date', 'egalitarian' ); ?></p>
                    <p class="text-navy font-bold flex items-center gap-2">
                        <span class="w-5 h-5 text-teal"><?php echo ea_icon( 'calendar' ); ?></span>
                        <?php echo esc_html( date_i18n( 'j F Y', strtotime( $start_date ) ) ); ?>
                    </p>
                </div>
                <?php endif; ?>
                
                <?php if ( $end_date ) : ?>
                <div>
                    <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide mb-1"><?php esc_html_e( 'End Date', 'egalitarian' ); ?></p>
                    <p class="text-navy font-bold flex items-center gap-2">
                        <span class="w-5 h-5 text-gold"><?php echo ea_icon( 'calendar' ); ?></span>
                        <?php echo esc_html( date_i18n( 'j F Y', strtotime( $end_date ) ) ); ?>
                    </p>
                </div>
                <?php elseif ( $start_date ) : ?>
                <div>
                    <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide mb-1"><?php esc_html_e( 'Status', 'egalitarian' ); ?></p>
                    <p class="text-teal font-bold"><?php esc_html_e( 'Ongoing', 'egalitarian' ); ?></p>
                </div>
                <?php endif; ?>

                <?php if ( $locations ) : ?>
                <div>
                    <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide mb-1"><?php esc_html_e( 'Locations', 'egalitarian' ); ?></p>
                    <p class="text-navy font-bold flex items-center gap-2">
                        <span class="w-5 h-5 text-teal"><?php echo ea_icon( 'location' ); ?></span>
                        <?php echo esc_html( $locations ); ?>
                    </p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Main content -->
            <div class="prose prose-lg prose-navy max-w-none
                        prose-headings:font-bold prose-headings:text-navy
                        prose-a:text-teal prose-a:no-underline hover:prose-a:underline
                        prose-img:rounded-2xl prose-img:shadow-card
                        prose-blockquote:border-l-4 prose-blockquote:border-gold prose-blockquote:pl-6">
                <?php the_content(); ?>
            </div>

            <!-- Photo gallery -->
            <?php get_template_part( 'template-parts/cause-gallery' ); ?>

            <!-- CTA -->
            <div class="mt-12 p-8 bg-navy rounded-2xl text-center">
                <h3 class="text-white font-bold text-xl mb-3"><?php esc_html_e( 'Support This Cause', 'egalitarian' ); ?></h3>
                <p class="text-white/70 mb-6"><?php esc_html_e( 'Your donation directly funds this cause. Every contribution makes a difference.', 'egalitarian' ); ?></p>
                <a href="<?php echo esc_url( home_url( '/donate' ) ); ?>"
                   class="inline-flex items-center gap-2 px-8 py-4 bg-gold text-navy font-bold rounded-xl hover:bg-gold-light hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                    <span class="w-5 h-5"><?php echo ea_icon( 'heart' ); ?></span>
                    <?php esc_html_e( 'Donate Now', 'egalitarian' ); ?>
                </a>
            </div>

            <!-- Related causes -->
            <?php
            $related = new WP_Query( [
                'post_type'      => 'ea_cause',
                'posts_per_page' => 3,
                'post__not_in'   => [ get_the_ID() ],
                'orderby'        => 'rand',
            ] );
            if ( $related->have_posts() ) :
            ?>
            <div class="mt-16 pt-12 border-t border-gray-200">
                <h3 class="text-navy font-bold text-2xl mb-6"><?php esc_html_e( 'Other Causes', 'egalitarian' ); ?></h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                        <?php get_template_part( 'template-parts/card-post' ); ?>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
