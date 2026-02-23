<?php
/**
 * Template Name: Legal Page
 * File: wp-content/themes/egalitarian-association/page-legal.php
 *
 * Used for Privacy Policy, Cookie Policy, and similar pages.
 */
get_header();
?>

<!-- Hero -->
<section class="relative py-16 sm:py-20 bg-navy overflow-hidden">
  <div class="absolute inset-0 overflow-hidden" aria-hidden="true">
    <div class="absolute -top-20 -right-20 w-80 h-80 rounded-full bg-teal/10 blur-3xl"></div>
  </div>
  <div class="absolute inset-0 bg-gradient-to-r from-navy/95 to-navy/70" aria-hidden="true"></div>
  <div class="relative z-10 max-w-site mx-auto px-4 sm:px-6 lg:px-8">
    <nav class="mb-4 flex items-center gap-2 text-white/50 text-sm">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Home','egalitarian'); ?></a>
      <span>/</span>
      <span class="text-white/80"><?php the_title(); ?></span>
    </nav>
    <h1 class="text-white font-extrabold text-3xl sm:text-4xl"><?php the_title(); ?></h1>
    <p class="text-white/50 text-sm mt-3">
      <?php
      printf(
        esc_html__('Last updated: %s','egalitarian'),
        esc_html(get_the_modified_date('j F Y'))
      );
      ?>
    </p>
  </div>
</section>

<!-- Content -->
<div class="py-16 lg:py-20 bg-white">
  <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
      <?php while (have_posts()) : the_post(); ?>
      <div class="ea-prose prose prose-lg max-w-none
                  prose-headings:text-navy prose-headings:font-bold
                  prose-a:text-teal hover:prose-a:underline
                  prose-blockquote:border-l-4 prose-blockquote:border-gold">
        <?php the_content(); ?>
      </div>
      <?php endwhile; ?>

      <!-- Back link -->
      <div class="mt-12 pt-8 border-t border-gray-100">
        <a href="<?php echo esc_url(home_url('/')); ?>"
           class="inline-flex items-center gap-2 text-navy font-semibold text-sm hover:text-teal transition-colors">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
          <?php esc_html_e('Back to Home','egalitarian'); ?>
        </a>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
