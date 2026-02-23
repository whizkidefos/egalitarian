<?php
/**
 * Template Name: Causes Page
 * File: wp-content/themes/egalitarian-association/page-causes.php
 */
get_header();

$causes = new WP_Query([
  'post_type'      => 'ea_cause',
  'posts_per_page' => -1,
  'post_status'    => 'publish',
]);
?>

<!-- Hero -->
<section class="relative py-20 sm:py-28 bg-navy overflow-hidden">
  <div class="absolute inset-0 overflow-hidden" aria-hidden="true">
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-teal/15 blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-gold/10 blur-3xl"></div>
  </div>
  <div class="absolute inset-0 bg-gradient-to-r from-navy/95 to-navy/60" aria-hidden="true"></div>
  <div class="relative z-10 max-w-site mx-auto px-4 sm:px-6 lg:px-8">
    <nav class="mb-4 flex items-center gap-2 text-white/50 text-sm">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Home','egalitarian'); ?></a>
      <span>/</span>
      <span class="text-white/80"><?php esc_html_e('Causes','egalitarian'); ?></span>
    </nav>
    <span class="inline-block text-teal text-xs font-bold uppercase tracking-widest mb-3"><?php esc_html_e('Our Work','egalitarian'); ?></span>
    <h1 class="text-white font-extrabold text-4xl sm:text-5xl mb-4"><?php esc_html_e('Our Causes','egalitarian'); ?></h1>
    <p class="text-white/70 text-lg max-w-2xl"><?php esc_html_e('From food distribution to health education — here is how we are making a difference in communities across England.','egalitarian'); ?></p>
  </div>
</section>

<!-- Pillars intro -->
<section class="py-16 bg-white border-b border-gray-100">
  <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
      <?php
      $pillars = [
        ['icon'=>'food',  'color'=>'teal','label'=>__('Food & Essentials','egalitarian')],
        ['icon'=>'health','color'=>'navy','label'=>__('Health Education','egalitarian')],
        ['icon'=>'people','color'=>'gold','label'=>__('Community Support','egalitarian')],
      ];
      $ic = ['teal'=>'bg-teal/10 text-teal','navy'=>'bg-navy/10 text-navy','gold'=>'bg-gold/10 text-gold-dark'];
      foreach($pillars as $p): ?>
      <div class="flex items-center gap-4 p-5 bg-warm rounded-2xl">
        <div class="w-12 h-12 rounded-xl <?php echo esc_attr($ic[$p['color']]); ?> flex items-center justify-center flex-shrink-0">
          <span class="w-6 h-6"><?php echo ea_icon($p['icon']); ?></span>
        </div>
        <span class="text-navy font-bold"><?php echo esc_html($p['label']); ?></span>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Causes grid (CPT) or static fallback -->
<section class="py-20 bg-warm">
  <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
    <?php if ($causes->have_posts()) : ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php $i=0; while ($causes->have_posts()) : $causes->the_post(); $d=round($i*0.1,1).'s'; $i++; ?>
      <article class="ea-reveal bg-white rounded-2xl overflow-hidden shadow-card hover:shadow-card-hover hover:-translate-y-1.5 transition-all border border-gray-100 flex flex-col opacity-0" style="animation-delay:<?php echo esc_attr($d); ?>">
        <?php if (has_post_thumbnail()) : ?>
        <div class="aspect-video overflow-hidden">
          <?php the_post_thumbnail('ea-card',['class'=>'w-full h-full object-cover hover:scale-105 transition-transform duration-500','alt'=>'']); ?>
        </div>
        <?php else : ?>
        <div class="aspect-video bg-gradient-to-br from-navy/10 to-teal/10 flex items-center justify-center">
          <span class="w-14 h-14 text-navy/20"><?php echo ea_icon('heart'); ?></span>
        </div>
        <?php endif; ?>
        <div class="p-6 flex flex-col flex-1">
          <h3 class="text-navy font-bold text-lg leading-snug mb-3">
            <a href="<?php the_permalink(); ?>" class="hover:text-teal transition-colors"><?php the_title(); ?></a>
          </h3>
          <p class="text-gray-500 text-sm leading-relaxed flex-1 mb-5"><?php the_excerpt(); ?></p>
          <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-1.5 text-teal font-semibold text-sm hover:text-navy transition-colors group">
            <?php esc_html_e('Learn more','egalitarian'); ?>
            <span class="w-4 h-4 group-hover:translate-x-1 transition-transform"><?php echo ea_icon('arrow'); ?></span>
          </a>
        </div>
      </article>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>

    <?php else : // Static fallback cause cards ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php
      $static_causes = [
        ['title'=>__('Food Parcels','egalitarian'),       'icon'=>'food',  'color'=>'teal','body'=>__('We distribute nutritious food parcels to individuals and families facing poverty and food insecurity across England.','egalitarian'),                'slug'=>'food-parcels'],
        ['title'=>__('Winter Clothing','egalitarian'),    'icon'=>'coat',  'color'=>'gold','body'=>__('Sleeping bags, winter coats, and essential warm clothing for people who are homeless or unable to heat their homes.','egalitarian'),               'slug'=>'winter-clothing'],
        ['title'=>__('Health Education','egalitarian'),   'icon'=>'health','color'=>'navy','body'=>__('Public health talks, literature distribution, and community education programmes that empower people to protect their wellbeing.','egalitarian'), 'slug'=>'health-education'],
        ['title'=>__('Homeless Support','egalitarian'),   'icon'=>'people','color'=>'teal','body'=>__('Practical support, resources, and compassionate outreach for individuals experiencing homelessness in our communities.','egalitarian'),            'slug'=>'homeless-support'],
        ['title'=>__('Health Talks','egalitarian'),       'icon'=>'health','color'=>'navy','body'=>__('Regular public health talks delivered to community groups, schools, and organisations, covering key topics in preventive health.','egalitarian'),   'slug'=>'health-talks'],
      ];
      $ic = ['teal'=>'bg-teal/10 text-teal','gold'=>'bg-gold/10 text-gold-dark','navy'=>'bg-navy/10 text-navy'];
      foreach($static_causes as $j=>$c): $d=round($j*0.1,1).'s'; ?>
      <div class="ea-reveal bg-white rounded-2xl p-8 shadow-card hover:shadow-card-hover hover:-translate-y-1.5 transition-all border border-gray-100 flex flex-col opacity-0" style="animation-delay:<?php echo esc_attr($d); ?>">
        <div class="w-14 h-14 rounded-2xl <?php echo esc_attr($ic[$c['color']]); ?> flex items-center justify-center mb-6">
          <span class="w-7 h-7"><?php echo ea_icon($c['icon']); ?></span>
        </div>
        <h3 class="text-navy font-bold text-xl mb-3"><?php echo esc_html($c['title']); ?></h3>
        <p class="text-gray-500 text-sm leading-relaxed flex-1 mb-5"><?php echo esc_html($c['body']); ?></p>
        <a href="<?php echo esc_url(home_url('/causes/'.$c['slug'])); ?>" class="inline-flex items-center gap-1.5 text-teal font-semibold text-sm hover:text-navy transition-colors group">
          <?php esc_html_e('Learn more','egalitarian'); ?>
          <span class="w-4 h-4 group-hover:translate-x-1 transition-transform"><?php echo ea_icon('arrow'); ?></span>
        </a>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<?php get_template_part('template-parts/cta'); ?>
<?php get_footer(); ?>
