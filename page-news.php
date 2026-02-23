<?php
/**
 * Template Name: News Page
 * File: wp-content/themes/egalitarian-association/page-news.php
 */
get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$news = new WP_Query([
  'post_type'      => 'post',
  'posts_per_page' => 9,
  'post_status'    => 'publish',
  'paged'          => $paged,
]);
?>

<!-- Hero -->
<section class="relative py-20 sm:py-28 bg-navy overflow-hidden">
  <div class="absolute inset-0 overflow-hidden" aria-hidden="true">
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-teal/15 blur-3xl"></div>
  </div>
  <div class="absolute inset-0 bg-gradient-to-r from-navy/95 to-navy/60" aria-hidden="true"></div>
  <div class="relative z-10 max-w-site mx-auto px-4 sm:px-6 lg:px-8">
    <nav class="mb-4 flex items-center gap-2 text-white/50 text-sm">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Home','egalitarian'); ?></a>
      <span>/</span>
      <span class="text-white/80"><?php esc_html_e('News','egalitarian'); ?></span>
    </nav>
    <span class="inline-block text-teal text-xs font-bold uppercase tracking-widest mb-3"><?php esc_html_e('Latest','egalitarian'); ?></span>
    <h1 class="text-white font-extrabold text-4xl sm:text-5xl mb-4"><?php esc_html_e('News & Stories','egalitarian'); ?></h1>
    <p class="text-white/70 text-lg max-w-2xl"><?php esc_html_e('Updates from our work, stories from the community, and news about The Egalitarian Association.','egalitarian'); ?></p>
  </div>
</section>

<!-- Posts grid -->
<section class="py-20 bg-warm">
  <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
    <?php if ($news->have_posts()) : ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php while ($news->have_posts()) : $news->the_post(); ?>
        <?php get_template_part('template-parts/card-post'); ?>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>

    <!-- Pagination -->
    <?php if ($news->max_num_pages > 1) : ?>
    <nav class="flex items-center justify-center gap-2 mt-12">
      <?php
      echo paginate_links([
        'total'     => $news->max_num_pages,
        'current'   => $paged,
        'prev_text' => '&larr;',
        'next_text' => '&rarr;',
        'type'      => 'list',
        'before_page_number' => '<span class="inline-flex items-center justify-center min-w-[2.5rem] h-10 rounded-xl border-2 border-gray-200 bg-white text-navy text-sm font-semibold hover:bg-navy hover:border-navy hover:text-white transition-all">',
        'after_page_number'  => '</span>',
      ]);
      ?>
    </nav>
    <?php endif; ?>
    <?php else : ?>
    <div class="text-center py-20">
      <p class="text-gray-400 text-lg mb-6"><?php esc_html_e('No posts yet — check back soon!','egalitarian'); ?></p>
    </div>
    <?php endif; ?>
  </div>
</section>

<?php get_template_part('template-parts/cta'); ?>
<?php get_footer(); ?>
