<?php
/**
 * Single post template
 * File: wp-content/themes/egalitarian-association/single.php
 */
get_header();

while ( have_posts() ) : the_post();
    $cats      = get_the_category();
    $thumbnail = get_the_post_thumbnail_url( null, 'ea-hero' );
?>

<!-- Post hero -->
<section class="ea-post-hero relative py-16 sm:py-24 bg-navy overflow-hidden">
    <?php if ( $thumbnail ) : ?>
    <div class="absolute inset-0 z-0"><img src="<?php echo esc_url($thumbnail); ?>" alt="" class="w-full h-full object-cover opacity-25"></div>
    <?php else : ?>
    <div class="absolute inset-0 overflow-hidden" aria-hidden="true">
        <div class="absolute -top-20 -right-20 w-96 h-96 rounded-full bg-teal/15 blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-gold/10 blur-3xl"></div>
    </div>
    <?php endif; ?>
    <div class="absolute inset-0 z-[1] bg-gradient-to-r from-navy/95 to-navy/70" aria-hidden="true"></div>
    <div class="relative z-[2] max-w-site mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
        <!-- Breadcrumb -->
        <nav class="mb-5 flex items-center gap-2 text-white/50 text-sm flex-wrap">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Home','egalitarian'); ?></a>
            <span aria-hidden="true">/</span>
            <a href="<?php echo esc_url( home_url('/news') ); ?>" class="hover:text-white transition-colors"><?php esc_html_e('News','egalitarian'); ?></a>
            <span aria-hidden="true">/</span>
            <span class="text-white/80 truncate" aria-current="page"><?php the_title(); ?></span>
        </nav>
        <?php if ($cats) : ?>
        <a href="<?php echo esc_url( get_category_link($cats[0]->term_id) ); ?>"
           class="inline-block bg-teal/20 border border-teal/30 text-teal text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-4 hover:bg-teal hover:text-white transition-colors">
            <?php echo esc_html($cats[0]->name); ?>
        </a>
        <?php endif; ?>
        <h1 class="text-white font-extrabold text-3xl sm:text-4xl lg:text-5xl leading-tight mb-5"><?php the_title(); ?></h1>
        <div class="flex flex-wrap items-center gap-4 text-white/60 text-sm">
            <span class="flex items-center gap-2">
                <img src="<?php echo esc_url( EA_URI . '/assets/images/icon.png' ); ?>" alt="" class="w-7 h-7 rounded-full object-contain bg-white/10" aria-hidden="true">
                <span><?php esc_html_e( 'The Egalitarian Editorial Team', 'egalitarian' ); ?></span>
            </span>
            <span aria-hidden="true">·</span>
            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(ea_post_date()); ?></time>
            <span aria-hidden="true">·</span>
            <span><?php echo esc_html(ea_reading_time()); ?></span>
        </div>
    </div>
</section>

<!-- Post body -->
<div class="ea-post-body py-16 lg:py-20">
    <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="prose prose-lg prose-navy max-w-none
                        prose-headings:font-bold prose-headings:text-navy
                        prose-a:text-teal prose-a:no-underline hover:prose-a:underline
                        prose-img:rounded-2xl prose-img:shadow-card
                        prose-blockquote:border-l-4 prose-blockquote:border-gold prose-blockquote:pl-6">
                <?php the_content(); ?>
            </div>

            <!-- Tags -->
            <?php
            $tags = get_the_tags();
            if ($tags) :
            ?>
            <div class="mt-10 pt-8 border-t border-gray-100 flex flex-wrap gap-2">
                <?php foreach ($tags as $tag) : ?>
                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"
                   class="inline-block bg-gray-100 text-gray-600 text-xs font-semibold px-3 py-1.5 rounded-full hover:bg-navy hover:text-white transition-colors">
                    #<?php echo esc_html($tag->name); ?>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Author box -->
            <div class="mt-10 p-6 bg-warm rounded-2xl flex items-start gap-5 border border-gray-100">
                <div class="flex-shrink-0">
                    <img src="<?php echo esc_url( EA_URI . '/assets/images/icon.png' ); ?>" alt="" class="w-16 h-16 rounded-xl object-contain bg-white p-1 shadow-sm" aria-hidden="true">
                </div>
                <div>
                    <p class="text-navy font-bold mb-1"><?php esc_html_e( 'The Egalitarian Editorial Team', 'egalitarian' ); ?></p>
                    <p class="text-gray-500 text-sm leading-relaxed"><?php esc_html_e( 'Articles published by The Egalitarian Association — a CIO dedicated to poverty relief, health education, and community empowerment in the UK.', 'egalitarian' ); ?></p>
                </div>
            </div>

            <!-- Social share -->
            <?php
            $share_url   = urlencode( get_permalink() );
            $share_title = urlencode( get_the_title() );
            $networks = [
                'facebook'  => [
                    'url'   => 'https://www.facebook.com/sharer/sharer.php?u=' . $share_url,
                    'label' => __( 'Share on Facebook', 'egalitarian' ),
                    'color' => '#1877F2',
                    'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M24 12.073C24 5.405 18.627 0 12 0S0 5.405 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047V9.41c0-3.025 1.792-4.697 4.533-4.697 1.312 0 2.686.236 2.686.236v2.97h-1.513c-1.491 0-1.956.93-1.956 1.886v2.269h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z"/></svg>',
                ],
                'x'         => [
                    'url'   => 'https://x.com/intent/tweet?url=' . $share_url . '&text=' . $share_title,
                    'label' => __( 'Share on X', 'egalitarian' ),
                    'color' => '#000000',
                    'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.835L1.254 2.25H8.08l4.253 5.622 5.91-5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
                ],
                'linkedin'  => [
                    'url'   => 'https://www.linkedin.com/sharing/share-offsite/?url=' . $share_url,
                    'label' => __( 'Share on LinkedIn', 'egalitarian' ),
                    'color' => '#0A66C2',
                    'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
                ],
                'whatsapp'  => [
                    'url'   => 'https://api.whatsapp.com/send?text=' . $share_title . '%20' . $share_url,
                    'label' => __( 'Share on WhatsApp', 'egalitarian' ),
                    'color' => '#25D366',
                    'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>',
                ],
                'email'     => [
                    'url'   => 'mailto:?subject=' . $share_title . '&body=' . $share_url,
                    'label' => __( 'Share via Email', 'egalitarian' ),
                    'color' => '#6B7280',
                    'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>',
                ],
            ];
            ?>
            <div class="mt-8 pt-8 border-t border-gray-100">
                <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide mb-3"><?php esc_html_e( 'Share this article', 'egalitarian' ); ?></p>
                <div class="flex flex-wrap gap-2">
                    <?php foreach ( $networks as $key => $network ) : ?>
                    <a href="<?php echo esc_url( $network['url'] ); ?>"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="<?php echo esc_attr( $network['label'] ); ?>"
                       title="<?php echo esc_attr( $network['label'] ); ?>"
                       class="ea-share-btn inline-flex items-center gap-2 px-4 py-2.5 bg-gray-100 hover:text-white rounded-xl text-gray-600 text-sm font-medium transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md"
                       style="--share-color: <?php echo esc_attr( $network['color'] ); ?>">
                        <span class="w-4 h-4 flex-shrink-0"><?php echo $network['icon']; ?></span>
                        <span class="hidden sm:inline"><?php echo esc_html( ucfirst( $key ) ); ?></span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Prev / Next navigation -->
            <nav class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-4" aria-label="<?php esc_attr_e('Post navigation','egalitarian'); ?>">
                <?php
                $prev = get_previous_post();
                $next = get_next_post();
                if ($prev) :
                ?>
                <a href="<?php echo esc_url(get_permalink($prev->ID)); ?>"
                   class="group bg-white rounded-xl p-5 shadow-card hover:shadow-card-hover hover:-translate-y-0.5 transition-all border border-gray-100 flex items-center gap-3">
                    <svg class="w-5 h-5 text-navy/40 group-hover:text-teal transition-colors flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    <div class="min-w-0">
                        <p class="text-gray-400 text-xs mb-1"><?php esc_html_e('Previous','egalitarian'); ?></p>
                        <p class="text-navy font-semibold text-sm truncate"><?php echo esc_html($prev->post_title); ?></p>
                    </div>
                </a>
                <?php else: ?><div></div><?php endif; ?>
                <?php if ($next) : ?>
                <a href="<?php echo esc_url(get_permalink($next->ID)); ?>"
                   class="group bg-white rounded-xl p-5 shadow-card hover:shadow-card-hover hover:-translate-y-0.5 transition-all border border-gray-100 flex items-center justify-end gap-3 text-right">
                    <div class="min-w-0">
                        <p class="text-gray-400 text-xs mb-1"><?php esc_html_e('Next','egalitarian'); ?></p>
                        <p class="text-navy font-semibold text-sm truncate"><?php echo esc_html($next->post_title); ?></p>
                    </div>
                    <svg class="w-5 h-5 text-navy/40 group-hover:text-teal transition-colors flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                <?php endif; ?>
            </nav>

            <!-- Comments -->
            <?php if (comments_open() || get_comments_number()) : ?>
            <div class="mt-12">
                <?php comments_template(); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
