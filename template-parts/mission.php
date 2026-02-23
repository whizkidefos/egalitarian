<?php
/**
 * Template part: Mission section
 * File: wp-content/themes/egalitarian-association/template-parts/mission.php
 */
?>
<section id="ea-mission" class="ea-mission py-20 lg:py-28 bg-warm" aria-labelledby="mission-heading">
    <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section label -->
        <div class="text-center mb-16">
            <span class="ea-reveal inline-block text-teal text-xs font-bold uppercase tracking-widest mb-3 opacity-0">
                <?php esc_html_e( 'Our Mission', 'egalitarian' ); ?>
            </span>
            <h2 id="mission-heading" class="ea-reveal text-navy font-extrabold text-3xl sm:text-4xl lg:text-5xl max-w-3xl mx-auto leading-tight opacity-0" style="animation-delay: 0.1s;">
                <?php esc_html_e( 'Combating Poverty, Protecting Health', 'egalitarian' ); ?>
            </h2>
            <div class="ea-reveal mt-4 mx-auto w-16 h-1.5 bg-gold rounded-full opacity-0" style="animation-delay: 0.2s;" aria-hidden="true"></div>
        </div>

        <!-- Three pillars -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
            <?php
            $pillars = [
                [
                    'icon'  => 'food',
                    'color' => 'teal',
                    'title' => __( 'Food Parcels', 'egalitarian' ),
                    'body'  => __( 'We distribute nutritious food parcels to individuals and families facing poverty, ensuring no one goes hungry in our communities.', 'egalitarian' ),
                    'delay' => '0.1s',
                ],
                [
                    'icon'  => 'coat',
                    'color' => 'gold',
                    'title' => __( 'Essential Items', 'egalitarian' ),
                    'body'  => __( 'From sleeping bags to winter coats, we provide the essential items that homeless people and vulnerable individuals urgently need to stay safe.', 'egalitarian' ),
                    'delay' => '0.2s',
                ],
                [
                    'icon'  => 'health',
                    'color' => 'navy',
                    'title' => __( 'Health Education', 'egalitarian' ),
                    'body'  => __( 'Through public health talks, literature and community outreach, we empower people with the knowledge to preserve and protect their health.', 'egalitarian' ),
                    'delay' => '0.3s',
                ],
            ];

            $bg_map    = [ 'teal' => 'bg-teal/10', 'gold' => 'bg-gold/10', 'navy' => 'bg-navy/10' ];
            $text_map  = [ 'teal' => 'text-teal',  'gold' => 'text-gold-dark', 'navy' => 'text-navy' ];
            $ring_map  = [ 'teal' => 'border-teal/30', 'gold' => 'border-gold/30', 'navy' => 'border-navy/30' ];

            foreach ( $pillars as $pillar ) :
                $bg   = $bg_map[ $pillar['color'] ]   ?? 'bg-gray-100';
                $text = $text_map[ $pillar['color'] ]  ?? 'text-gray-800';
                $ring = $ring_map[ $pillar['color'] ]  ?? 'border-gray-200';
            ?>
            <article class="ea-reveal ea-card bg-white rounded-2xl p-8 shadow-card hover:shadow-card-hover hover:-translate-y-1.5 transition-all duration-300 border border-gray-100 group opacity-0"
                     style="animation-delay: <?php echo esc_attr( $pillar['delay'] ); ?>">
                <div class="w-14 h-14 <?php echo esc_attr( $bg ); ?> border-2 <?php echo esc_attr( $ring ); ?> rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <span class="w-7 h-7 <?php echo esc_attr( $text ); ?>"><?php echo ea_icon( $pillar['icon'] ); ?></span>
                </div>
                <h3 class="text-navy font-bold text-xl mb-3"><?php echo esc_html( $pillar['title'] ); ?></h3>
                <p class="text-gray-600 leading-relaxed text-sm"><?php echo esc_html( $pillar['body'] ); ?></p>
            </article>
            <?php endforeach; ?>
        </div>

        <!-- Mission statement pull-quote -->
        <blockquote class="ea-reveal mt-16 relative bg-navy rounded-2xl p-8 sm:p-10 overflow-hidden opacity-0" style="animation-delay: 0.4s;">
            <div class="absolute top-0 right-0 w-48 h-48 bg-teal/10 rounded-full -translate-y-1/2 translate-x-1/2" aria-hidden="true"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-gold/10 rounded-full translate-y-1/2 -translate-x-1/2" aria-hidden="true"></div>
            <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center gap-6">
                <span class="flex-shrink-0 w-12 h-12 bg-gold/20 rounded-xl flex items-center justify-center text-gold">
                    <?php echo ea_icon( 'quote' ); ?>
                </span>
                <div>
                    <p class="text-white/90 text-lg sm:text-xl font-medium leading-relaxed italic mb-3">
                        <?php esc_html_e( '"To prevent and relieve poverty and to preserve and protect the health of the public through education and community outreach."', 'egalitarian' ); ?>
                    </p>
                    <footer class="text-white/50 text-sm font-semibold not-italic">
                        <?php esc_html_e( '— Objects of The Egalitarian Association', 'egalitarian' ); ?>
                    </footer>
                </div>
            </div>
        </blockquote>

    </div>
</section>
