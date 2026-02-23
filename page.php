<?php
/**
 * Generic page template
 * File: wp-content/themes/egalitarian-association/page.php
 */
get_header();

// Page hero
$title     = get_the_title();
$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'ea-hero' ) : '';
?>

<!-- Page hero band -->
<section class="ea-page-hero relative py-16 sm:py-24 bg-navy overflow-hidden" aria-labelledby="page-hero-title">
    <?php if ( $thumbnail ) : ?>
    <div class="absolute inset-0 z-0">
        <img src="<?php echo esc_url( $thumbnail ); ?>" alt="" class="w-full h-full object-cover opacity-20">
    </div>
    <?php else : ?>
    <div class="absolute inset-0 z-0 overflow-hidden" aria-hidden="true">
        <div class="absolute -top-20 -right-20 w-80 h-80 rounded-full bg-teal/15 blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-64 h-64 rounded-full bg-gold/10 blur-3xl"></div>
    </div>
    <?php endif; ?>
    <div class="absolute inset-0 z-[1] bg-gradient-to-r from-navy/95 to-navy/60" aria-hidden="true"></div>
    <div class="relative z-[2] max-w-site mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-4 flex items-center gap-2 text-white/50 text-sm" aria-label="<?php esc_attr_e( 'Breadcrumb', 'egalitarian' ); ?>">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-white transition-colors"><?php esc_html_e( 'Home', 'egalitarian' ); ?></a>
            <span aria-hidden="true">/</span>
            <span class="text-white/80" aria-current="page"><?php echo esc_html( $title ); ?></span>
        </nav>
        <h1 id="page-hero-title" class="text-white font-extrabold text-3xl sm:text-4xl lg:text-5xl">
            <?php echo esc_html( $title ); ?>
        </h1>
    </div>
</section>

<!-- Page content -->
<div class="ea-page-content py-16 lg:py-24">
    <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
        <div class="flex gap-12">
            <main class="flex-1 min-w-0">
        <?php else : ?>
        <main class="max-w-3xl mx-auto">
        <?php endif; ?>

            <?php while ( have_posts() ) : the_post(); ?>
            <div class="prose prose-lg prose-navy max-w-none
                        prose-headings:font-bold prose-headings:text-navy
                        prose-a:text-teal prose-a:no-underline hover:prose-a:underline
                        prose-img:rounded-2xl prose-img:shadow-card
                        prose-blockquote:border-l-4 prose-blockquote:border-gold prose-blockquote:pl-6 prose-blockquote:text-gray-600 prose-blockquote:italic">
                <?php the_content(); ?>
            </div>

            <?php
            wp_link_pages( [
                'before' => '<nav class="page-links flex flex-wrap gap-2 mt-8 pt-8 border-t border-gray-100" aria-label="' . esc_attr__( 'Page navigation', 'egalitarian' ) . '">',
                'after'  => '</nav>',
                'link_before' => '<span class="px-4 py-2 rounded-lg bg-navy/10 text-navy text-sm font-semibold hover:bg-navy hover:text-white transition-colors">',
                'link_after'  => '</span>',
            ] );
            ?>

            <?php endwhile; ?>

        </main><!-- /.page-main -->

        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
            <?php get_sidebar(); ?>
        </div><!-- /.flex -->
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
