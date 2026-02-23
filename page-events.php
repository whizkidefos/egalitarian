<?php
/**
 * Template Name: Events Page
 * File: wp-content/themes/egalitarian-association/page-events.php
 */
get_header();

$events = new WP_Query([
  'post_type'      => 'ea_event',
  'posts_per_page' => 12,
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
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
      <span class="text-white/80"><?php esc_html_e('Events','egalitarian'); ?></span>
    </nav>
    <span class="inline-block text-teal text-xs font-bold uppercase tracking-widest mb-3"><?php esc_html_e('What\'s On','egalitarian'); ?></span>
    <h1 class="text-white font-extrabold text-4xl sm:text-5xl mb-4"><?php esc_html_e('Events','egalitarian'); ?></h1>
    <p class="text-white/70 text-lg max-w-2xl"><?php esc_html_e('Join us at our upcoming events — from community food distributions to public health talks and fundraisers.','egalitarian'); ?></p>
  </div>
</section>

<!-- Events grid -->
<section class="py-20 bg-warm">
  <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
    <?php if ($events->have_posts()) : ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php $i=0; while ($events->have_posts()) : $events->the_post(); $d=round($i*0.1,1).'s'; $i++; ?>
      <article class="ea-reveal bg-white rounded-2xl overflow-hidden shadow-card hover:shadow-card-hover hover:-translate-y-1.5 transition-all border border-gray-100 flex flex-col opacity-0" style="animation-delay:<?php echo esc_attr($d);?>">
        <?php if (has_post_thumbnail()) : ?>
        <div class="aspect-video overflow-hidden">
          <?php the_post_thumbnail('ea-card',['class'=>'w-full h-full object-cover hover:scale-105 transition-transform duration-500','alt'=>'']); ?>
        </div>
        <?php else : ?>
        <div class="aspect-video bg-gradient-to-br from-navy/10 to-teal/10 flex items-center justify-center">
          <span class="w-12 h-12 text-navy/20"><?php echo ea_icon('people'); ?></span>
        </div>
        <?php endif; ?>
        <div class="p-6 flex flex-col flex-1">
          <?php
          $event_date     = get_post_meta(get_the_ID(),'_ea_event_date',true);
          $event_location = get_post_meta(get_the_ID(),'_ea_event_location',true);
          ?>
          <?php if ($event_date) : ?>
          <div class="flex items-center gap-2 text-teal text-xs font-bold uppercase tracking-wide mb-3">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <?php echo esc_html($event_date); ?>
          </div>
          <?php endif; ?>
          <h3 class="text-navy font-bold text-lg leading-snug mb-3">
            <a href="<?php the_permalink(); ?>" class="hover:text-teal transition-colors"><?php the_title(); ?></a>
          </h3>
          <p class="text-gray-500 text-sm leading-relaxed flex-1 mb-4"><?php the_excerpt(); ?></p>
          <?php if ($event_location) : ?>
          <div class="flex items-center gap-2 text-gray-400 text-xs mb-4">
            <span class="w-3.5 h-3.5 flex-shrink-0"><?php echo ea_icon('location'); ?></span>
            <?php echo esc_html($event_location); ?>
          </div>
          <?php endif; ?>
          <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-1.5 text-navy font-semibold text-sm hover:text-teal transition-colors group">
            <?php esc_html_e('View details','egalitarian'); ?>
            <span class="w-4 h-4 group-hover:translate-x-1 transition-transform"><?php echo ea_icon('arrow'); ?></span>
          </a>
        </div>
      </article>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <?php else : ?>
    <div class="text-center py-20">
      <div class="w-20 h-20 rounded-full bg-navy/10 flex items-center justify-center mx-auto mb-6">
        <span class="w-10 h-10 text-navy/30"><?php echo ea_icon('people'); ?></span>
      </div>
      <h3 class="text-navy font-bold text-xl mb-3"><?php esc_html_e('No upcoming events right now','egalitarian'); ?></h3>
      <p class="text-gray-500 mb-8"><?php esc_html_e('Check back soon — we\'re always planning something new.','egalitarian'); ?></p>
      <a href="<?php echo esc_url(home_url('/get-involved')); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-navy text-white font-bold rounded-xl hover:bg-navy-light transition-all">
        <?php esc_html_e('Get Involved','egalitarian'); ?>
        <span class="w-4 h-4"><?php echo ea_icon('arrow'); ?></span>
      </a>
    </div>
    <?php endif; ?>
  </div>
</section>

<?php get_template_part('template-parts/cta'); ?>
<?php get_footer(); ?>
