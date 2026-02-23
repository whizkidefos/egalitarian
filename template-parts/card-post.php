<?php
/**
 * Template part: Post card
 * File: wp-content/themes/egalitarian-association/template-parts/card-post.php
 *
 * Usage: get_template_part( 'template-parts/card-post' );
 * Call within The Loop.
 */

$has_thumb = has_post_thumbnail();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'ea-card-post bg-white rounded-2xl overflow-hidden shadow-card hover:shadow-card-hover hover:-translate-y-1.5 transition-all duration-300 flex flex-col border border-gray-100' ); ?> aria-labelledby="post-title-<?php the_ID(); ?>">

    <?php if ( $has_thumb ) : ?>
    <a href="<?php the_permalink(); ?>" class="block overflow-hidden aspect-video flex-shrink-0" tabindex="-1" aria-hidden="true">
        <?php the_post_thumbnail( 'ea-card', [
            'class' => 'w-full h-full object-cover hover:scale-105 transition-transform duration-500',
            'alt'   => '',
        ] ); ?>
    </a>
    <?php endif; ?>

    <div class="p-6 flex flex-col flex-1">
        <!-- Meta -->
        <div class="flex items-center gap-3 mb-4 flex-wrap">
            <?php
            $cats = get_the_category();
            if ( $cats ) :
            ?>
            <a href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>"
               class="inline-block bg-teal/10 text-teal text-xs font-bold uppercase tracking-wide px-3 py-1 rounded-full hover:bg-teal hover:text-white transition-colors">
                <?php echo esc_html( $cats[0]->name ); ?>
            </a>
            <?php endif; ?>
            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" class="text-gray-400 text-xs">
                <?php echo esc_html( ea_post_date() ); ?>
            </time>
            <span class="text-gray-300 text-xs hidden sm:inline" aria-hidden="true">·</span>
            <span class="text-gray-400 text-xs hidden sm:inline"><?php echo esc_html( ea_reading_time() ); ?></span>
        </div>

        <!-- Title -->
        <h3 id="post-title-<?php the_ID(); ?>" class="text-navy font-bold text-lg leading-snug mb-3">
            <a href="<?php the_permalink(); ?>" class="hover:text-teal transition-colors">
                <?php the_title(); ?>
            </a>
        </h3>

        <!-- Excerpt -->
        <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 flex-1 mb-5">
            <?php the_excerpt(); ?>
        </p>

        <!-- Read more -->
        <a href="<?php the_permalink(); ?>"
           class="inline-flex items-center gap-1.5 text-navy font-semibold text-sm hover:text-teal transition-colors group">
            <?php esc_html_e( 'Read more', 'egalitarian' ); ?>
            <span class="w-4 h-4 group-hover:translate-x-1 transition-transform"><?php echo ea_icon( 'arrow' ); ?></span>
        </a>
    </div>
</article>
