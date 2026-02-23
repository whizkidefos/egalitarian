<?php
/**
 * Template Name: About Page
 * File: wp-content/themes/egalitarian-association/page-about.php
 */
get_header();
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
      <span class="text-white/80"><?php esc_html_e('About Us','egalitarian'); ?></span>
    </nav>
    <span class="inline-block text-teal text-xs font-bold uppercase tracking-widest mb-3"><?php esc_html_e('Our Story','egalitarian'); ?></span>
    <h1 class="text-white font-extrabold text-4xl sm:text-5xl mb-4"><?php esc_html_e('About The Egalitarian Association','egalitarian'); ?></h1>
    <p class="text-white/70 text-lg max-w-2xl"><?php esc_html_e('A Charitable Incorporated Organisation dedicated to fighting poverty and promoting health in our communities.','egalitarian'); ?></p>
  </div>
</section>

<!-- Mission statement -->
<section class="py-20 bg-warm">
  <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
      <div>
        <span class="ea-reveal block text-teal text-xs font-bold uppercase tracking-widest mb-3 opacity-0"><?php esc_html_e('Who We Are','egalitarian'); ?></span>
        <h2 class="ea-reveal text-navy font-extrabold text-3xl sm:text-4xl mb-6 opacity-0" style="animation-delay:.1s"><?php esc_html_e('Serving Community, Changing Lives','egalitarian'); ?></h2>
        <div class="ea-reveal opacity-0 space-y-4 text-gray-600 leading-relaxed" style="animation-delay:.2s">
          <p><?php esc_html_e('The Egalitarian Association is a registered Charitable Incorporated Organisation based in England. We exist to prevent and relieve poverty, and to preserve and protect the health of the public through education and community outreach.','egalitarian'); ?></p>
          <p><?php esc_html_e('We provide food parcels and distribute essential items such as sleeping bags and winter coats to those who are homeless or in need. We also deliver public health talks, produce health literature, and run general health education programmes.','egalitarian'); ?></p>
          <p><?php esc_html_e('Our work is driven by volunteers and supporters who believe that everyone — regardless of their circumstances — deserves dignity, safety, and access to good health.','egalitarian'); ?></p>
        </div>
        <div class="ea-reveal mt-8 flex flex-wrap gap-4 opacity-0" style="animation-delay:.3s">
          <a href="<?php echo esc_url(home_url('/get-involved')); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-navy text-white font-bold rounded-xl hover:bg-navy-light hover:-translate-y-0.5 transition-all">
            <?php esc_html_e('Get Involved','egalitarian'); ?>
            <span class="w-4 h-4"><?php echo ea_icon('arrow'); ?></span>
          </a>
          <a href="<?php echo esc_url(home_url('/donate')); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-gold text-navy font-bold rounded-xl hover:bg-gold-light hover:-translate-y-0.5 transition-all">
            <span class="w-4 h-4"><?php echo ea_icon('heart'); ?></span>
            <?php esc_html_e('Donate','egalitarian'); ?>
          </a>
        </div>
      </div>
      <!-- Stat cards -->
      <div class="grid grid-cols-2 gap-4">
        <?php
        $stats = [
          ['value'=>'2,500+','label'=>__('Food Parcels Delivered','egalitarian'),'color'=>'teal'],
          ['value'=>'1,200+','label'=>__('People Helped','egalitarian'),          'color'=>'gold'],
          ['value'=>'150+',  'label'=>__('Volunteers',    'egalitarian'),          'color'=>'navy'],
          ['value'=>'50+',   'label'=>__('Health Talks',  'egalitarian'),          'color'=>'teal'],
        ];
        $bg = ['teal'=>'bg-teal','gold'=>'bg-gold','navy'=>'bg-navy'];
        foreach($stats as $i=>$s): $d = ($i*0.1).'s'; ?>
        <div class="ea-reveal bg-white rounded-2xl p-6 shadow-card text-center opacity-0" style="animation-delay:<?php echo esc_attr($d);?>">
          <p class="text-<?php echo esc_attr($s['color']); ?> font-extrabold text-3xl mb-1"><?php echo esc_html($s['value']); ?></p>
          <p class="text-gray-500 text-sm"><?php echo esc_html($s['label']); ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- Objects / legal basis -->
<section class="py-20 bg-white">
  <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto text-center">
    <span class="ea-reveal block text-teal text-xs font-bold uppercase tracking-widest mb-3 opacity-0"><?php esc_html_e('Our Objects','egalitarian'); ?></span>
    <h2 class="ea-reveal text-navy font-extrabold text-3xl sm:text-4xl mb-8 opacity-0" style="animation-delay:.1s"><?php esc_html_e('What We Stand For','egalitarian'); ?></h2>
    <div class="ea-reveal grid grid-cols-1 sm:grid-cols-2 gap-6 text-left opacity-0" style="animation-delay:.2s">
      <?php
      $objects = [
        ['icon'=>'food',  'color'=>'teal','title'=>__('Poverty Relief','egalitarian'),     'body'=>__('Prevention and relief of poverty, including for those who are homeless, through provision of food parcels and essential items.','egalitarian')],
        ['icon'=>'coat',  'color'=>'gold','title'=>__('Essential Items','egalitarian'),    'body'=>__('Distribution of sleeping bags, winter coats, and other essential items to those who need them most.','egalitarian')],
        ['icon'=>'health','color'=>'navy','title'=>__('Health Education','egalitarian'),   'body'=>__('Preserving and protecting public health through talks, literature, and general health education programmes.','egalitarian')],
        ['icon'=>'people','color'=>'teal','title'=>__('Community Outreach','egalitarian'),'body'=>__('Reaching underserved communities across England with compassion, dignity, and practical support.','egalitarian')],
      ];
      $ic = ['teal'=>'bg-teal/10 text-teal','gold'=>'bg-gold/10 text-gold-dark','navy'=>'bg-navy/10 text-navy'];
      foreach($objects as $o): ?>
      <div class="bg-warm rounded-2xl p-6 flex gap-4">
        <div class="w-10 h-10 rounded-xl <?php echo esc_attr($ic[$o['color']]); ?> flex items-center justify-center flex-shrink-0">
          <span class="w-5 h-5"><?php echo ea_icon($o['icon']); ?></span>
        </div>
        <div>
          <h3 class="text-navy font-bold text-base mb-1"><?php echo esc_html($o['title']); ?></h3>
          <p class="text-gray-500 text-sm leading-relaxed"><?php echo esc_html($o['body']); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Trustees -->
<section class="py-20 bg-warm">
  <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <span class="ea-reveal block text-teal text-xs font-bold uppercase tracking-widest mb-3 opacity-0"><?php esc_html_e('Governance','egalitarian'); ?></span>
    <h2 class="ea-reveal text-navy font-extrabold text-3xl sm:text-4xl mb-4 opacity-0" style="animation-delay:.1s"><?php esc_html_e('Our Trustees','egalitarian'); ?></h2>
    <p class="ea-reveal text-gray-500 max-w-xl mx-auto mb-12 opacity-0" style="animation-delay:.2s"><?php esc_html_e('The Egalitarian Association is governed by a board of committed trustees who give their time voluntarily.','egalitarian'); ?></p>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-3xl mx-auto">
      <?php
      $trustees = [
        ['name'=>'Dr Victor Ilubaera', 'role'=>__('Trustee','egalitarian')],
        ['name'=>'John Gbajumo',        'role'=>__('Trustee','egalitarian')],
        ['name'=>'Joseph Uweri',        'role'=>__('Trustee','egalitarian')],
      ];
      foreach($trustees as $i=>$t): $d=($i*0.1).'s'; ?>
      <div class="ea-reveal bg-white rounded-2xl p-8 shadow-card text-center opacity-0" style="animation-delay:<?php echo esc_attr($d);?>">
        <div class="w-16 h-16 rounded-full bg-navy/10 flex items-center justify-center mx-auto mb-4">
          <span class="text-navy font-extrabold text-xl"><?php echo esc_html(mb_substr($t['name'],0,1)); ?></span>
        </div>
        <h3 class="text-navy font-bold text-lg"><?php echo esc_html($t['name']); ?></h3>
        <p class="text-teal text-sm font-semibold mt-1"><?php echo esc_html($t['role']); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php get_template_part('template-parts/cta'); ?>
<?php get_footer(); ?>
