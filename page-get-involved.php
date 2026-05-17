<?php
/**
 * Template Name: Get Involved Page
 * File: wp-content/themes/egalitarian-association/page-get-involved.php
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
      <span class="text-white/80"><?php esc_html_e('Get Involved','egalitarian'); ?></span>
    </nav>
    <span class="inline-block text-teal text-xs font-bold uppercase tracking-widest mb-3"><?php esc_html_e('Make a Difference','egalitarian'); ?></span>
    <h1 class="text-white font-extrabold text-4xl sm:text-5xl mb-4"><?php esc_html_e('Get Involved','egalitarian'); ?></h1>
    <p class="text-white/70 text-lg max-w-2xl"><?php esc_html_e('There are many ways to support The Egalitarian Association. Whether through volunteering, donating, or spreading the word, your involvement matters.','egalitarian'); ?></p>
  </div>
</section>

<!-- Ways to get involved -->
<section class="py-20 bg-warm">
  <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Volunteer -->
      <article class="ea-reveal bg-white rounded-2xl p-8 shadow-card hover:shadow-card-hover hover:-translate-y-1.5 transition-all border border-gray-100 opacity-0">
        <div class="w-14 h-14 bg-teal/10 border-2 border-teal/30 rounded-2xl flex items-center justify-center mb-6">
          <span class="w-7 h-7 text-teal"><?php echo ea_icon('people'); ?></span>
        </div>
        <h3 class="text-navy font-bold text-xl mb-3"><?php esc_html_e('Volunteer','egalitarian'); ?></h3>
        <p class="text-gray-600 text-sm leading-relaxed mb-6"><?php esc_html_e('Join our team and donate your time. From food distribution to community outreach, we have roles for everyone.','egalitarian'); ?></p>
        <a href="<?php echo esc_url(home_url('/volunteer')); ?>" class="inline-flex items-center gap-1.5 text-teal font-semibold text-sm hover:text-navy transition-colors group">
          <?php esc_html_e('Learn more','egalitarian'); ?>
          <span class="w-4 h-4 group-hover:translate-x-1 transition-transform"><?php echo ea_icon('arrow'); ?></span>
        </a>
      </article>

      <!-- Donate -->
      <article class="ea-reveal bg-white rounded-2xl p-8 shadow-card hover:shadow-card-hover hover:-translate-y-1.5 transition-all border border-gray-100 opacity-0" style="animation-delay: 0.1s;">
        <div class="w-14 h-14 bg-gold/10 border-2 border-gold/30 rounded-2xl flex items-center justify-center mb-6">
          <span class="w-7 h-7 text-gold-dark"><?php echo ea_icon('heart'); ?></span>
        </div>
        <h3 class="text-navy font-bold text-xl mb-3"><?php esc_html_e('Donate','egalitarian'); ?></h3>
        <p class="text-gray-600 text-sm leading-relaxed mb-6"><?php esc_html_e('Every donation, large or small, directly funds our programmes. Support the causes that matter most to you.','egalitarian'); ?></p>
        <a href="<?php echo esc_url(home_url('/donate')); ?>" class="inline-flex items-center gap-1.5 text-teal font-semibold text-sm hover:text-navy transition-colors group">
          <?php esc_html_e('Donate now','egalitarian'); ?>
          <span class="w-4 h-4 group-hover:translate-x-1 transition-transform"><?php echo ea_icon('arrow'); ?></span>
        </a>
      </article>

      <!-- Share -->
      <article class="ea-reveal bg-white rounded-2xl p-8 shadow-card hover:shadow-card-hover hover:-translate-y-1.5 transition-all border border-gray-100 opacity-0" style="animation-delay: 0.2s;">
        <div class="w-14 h-14 bg-navy/10 border-2 border-navy/30 rounded-2xl flex items-center justify-center mb-6">
          <span class="w-7 h-7 text-navy"><?php echo ea_icon('share'); ?></span>
        </div>
        <h3 class="text-navy font-bold text-xl mb-3"><?php esc_html_e('Spread the Word','egalitarian'); ?></h3>
        <p class="text-gray-600 text-sm leading-relaxed mb-6"><?php esc_html_e('Share our work on social media and help us reach more people who need our support. Word of mouth makes a difference.','egalitarian'); ?></p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center gap-1.5 text-teal font-semibold text-sm hover:text-navy transition-colors group">
          <?php esc_html_e('Visit our page','egalitarian'); ?>
          <span class="w-4 h-4 group-hover:translate-x-1 transition-transform"><?php echo ea_icon('arrow'); ?></span>
        </a>
      </article>
    </div>
  </div>
</section>

<!-- Main content -->
<div class="py-16 lg:py-20 bg-white">
  <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto prose prose-lg prose-navy max-w-none
                prose-headings:font-bold prose-headings:text-navy
                prose-a:text-teal prose-a:no-underline hover:prose-a:underline
                prose-img:rounded-2xl prose-img:shadow-card
                prose-blockquote:border-l-4 prose-blockquote:border-gold prose-blockquote:pl-6">
      <?php while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; ?>
    </div>
  </div>
</div>

<?php get_template_part('template-parts/cta'); ?>
<?php get_footer(); ?>
