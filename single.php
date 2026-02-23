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
                <?php echo get_avatar( get_the_author_meta('ID'), 28, '', '', ['class'=>'rounded-full'] ); ?>
                <span><?php the_author(); ?></span>
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
                    <?php echo get_avatar( get_the_author_meta('ID'), 64, '', '', ['class'=>'rounded-xl'] ); ?>
                </div>
                <div>
                    <p class="text-navy font-bold mb-1"><?php the_author(); ?></p>
                    <p class="text-gray-500 text-sm leading-relaxed"><?php the_author_meta('description') ?: esc_html_e('Team member at The Egalitarian Association.','egalitarian'); ?></p>
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
