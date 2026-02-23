<?php
/**
 * Template Name: Volunteer Page
 * File: wp-content/themes/egalitarian-association/page-volunteer.php
 *
 * Main volunteer/get-involved page template.
 */
get_header();
?>

<!-- Hero -->
<section class="relative py-20 sm:py-28 bg-navy overflow-hidden">
  <div class="absolute inset-0 overflow-hidden" aria-hidden="true">
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-teal/20 blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-gold/10 blur-3xl"></div>
  </div>
  <div class="absolute inset-0 bg-gradient-to-r from-navy/95 to-navy/60" aria-hidden="true"></div>
  <div class="relative z-10 max-w-site mx-auto px-4 sm:px-6 lg:px-8">
    <nav class="mb-4 flex items-center gap-2 text-white/50 text-sm">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Home','egalitarian'); ?></a>
      <span>/</span>
      <span class="text-white/80"><?php esc_html_e('Volunteer','egalitarian'); ?></span>
    </nav>
    <span class="inline-block text-teal text-xs font-bold uppercase tracking-widest mb-3"><?php esc_html_e('Join Us','egalitarian'); ?></span>
    <h1 class="text-white font-extrabold text-4xl sm:text-5xl mb-4"><?php esc_html_e('Volunteer','egalitarian'); ?></h1>
    <p class="text-white/70 text-lg max-w-2xl"><?php esc_html_e('There are many ways to support our mission — volunteering your time, donating, or simply spreading the word.','egalitarian'); ?></p>
  </div>
</section>

<!-- Ways to help -->
<section class="py-20 bg-warm">
  <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <span class="ea-reveal block text-teal text-xs font-bold uppercase tracking-widest mb-3 opacity-0"><?php esc_html_e('How You Can Help','egalitarian'); ?></span>
      <h2 class="ea-reveal text-navy font-extrabold text-3xl sm:text-4xl opacity-0" style="animation-delay:.1s"><?php esc_html_e('Ways to Make a Difference','egalitarian'); ?></h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <?php
      $ways = [
        ['icon'=>'people','color'=>'teal','title'=>__('Volunteer','egalitarian'),     'body'=>__('Join our team of volunteers. Help distribute food parcels, assist at events, or contribute your professional skills to support our operations.','egalitarian'),'cta'=>__('Volunteer with us','egalitarian'),'href'=>'#volunteer-form'],
        ['icon'=>'heart', 'color'=>'gold','title'=>__('Donate','egalitarian'),        'body'=>__('Your financial contribution — however large or small — directly funds our work. Every pound makes a tangible difference to someone in need.','egalitarian'),'cta'=>__('Make a donation','egalitarian'),'href'=>home_url('/donate')],
        ['icon'=>'quote', 'color'=>'navy','title'=>__('Spread the Word','egalitarian'),'body'=>__('Share our mission with your friends, family, and colleagues. Follow us on social media and help us reach more people who need our support.','egalitarian'),'cta'=>__('Follow us','egalitarian'),'href'=>'#social'],
      ];
      $ic = ['teal'=>'bg-teal/10 text-teal','gold'=>'bg-gold/10 text-gold-dark','navy'=>'bg-navy/10 text-navy'];
      $btn = ['teal'=>'bg-teal text-white hover:bg-teal-dark','gold'=>'bg-gold text-navy hover:bg-gold-light','navy'=>'bg-navy text-white hover:bg-navy-light'];
      foreach($ways as $i=>$w): $d=($i*0.12).'s'; ?>
      <div class="ea-reveal bg-white rounded-2xl p-8 shadow-card hover:shadow-card-hover hover:-translate-y-1.5 transition-all flex flex-col opacity-0" style="animation-delay:<?php echo esc_attr($d);?>">
        <div class="w-14 h-14 rounded-2xl <?php echo esc_attr($ic[$w['color']]); ?> flex items-center justify-center mb-6">
          <span class="w-7 h-7"><?php echo ea_icon($w['icon']); ?></span>
        </div>
        <h3 class="text-navy font-bold text-xl mb-3"><?php echo esc_html($w['title']); ?></h3>
        <p class="text-gray-500 text-sm leading-relaxed flex-1 mb-6"><?php echo esc_html($w['body']); ?></p>
        <a href="<?php echo esc_url($w['href']); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 <?php echo esc_attr($btn[$w['color']]); ?> font-bold rounded-xl text-sm transition-all">
          <?php echo esc_html($w['cta']); ?>
          <span class="w-4 h-4"><?php echo ea_icon('arrow'); ?></span>
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Volunteer form -->
<section id="volunteer-form" class="py-20 bg-white">
  <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
      <div class="text-center mb-10">
        <span class="ea-reveal block text-teal text-xs font-bold uppercase tracking-widest mb-3 opacity-0"><?php esc_html_e('Volunteer','egalitarian'); ?></span>
        <h2 class="ea-reveal text-navy font-extrabold text-3xl sm:text-4xl opacity-0" style="animation-delay:.1s"><?php esc_html_e('Register Your Interest','egalitarian'); ?></h2>
        <p class="ea-reveal text-gray-500 mt-3 opacity-0" style="animation-delay:.2s"><?php esc_html_e('Fill in the form below and we will be in touch within 5 working days.','egalitarian'); ?></p>
      </div>

      <?php
      // Feedback messages
      $volunteer_status = isset( $_GET['volunteer'] ) ? sanitize_text_field( $_GET['volunteer'] ) : '';
      if ( $volunteer_status ) :
          $messages = [
              'success' => [ 'text' => __( 'Thank you for your application! We will be in touch within 5 working days.', 'egalitarian' ), 'class' => 'bg-teal/20 border-teal text-teal-dark' ],
              'invalid' => [ 'text' => __( 'Please fill in all required fields with valid information.', 'egalitarian' ), 'class' => 'bg-red-100 border-red-400 text-red-700' ],
              'error'   => [ 'text' => __( 'Something went wrong. Please try again.', 'egalitarian' ), 'class' => 'bg-red-100 border-red-400 text-red-700' ],
          ];
          if ( isset( $messages[ $volunteer_status ] ) ) :
      ?>
      <div class="mb-6 px-4 py-3 rounded-xl border <?php echo esc_attr( $messages[ $volunteer_status ]['class'] ); ?>">
          <?php echo esc_html( $messages[ $volunteer_status ]['text'] ); ?>
      </div>
      <?php endif; endif; ?>

      <?php
      // If a contact form plugin is active (CF7, WPForms etc.) its shortcode goes here.
      // Fallback: built-in form with database storage.
      if ( shortcode_exists('contact-form-7') && $cf7_id = get_theme_mod('ea_volunteer_cf7', '') ) {
        echo do_shortcode('[contact-form-7 id="' . esc_attr($cf7_id) . '"]');
      } elseif ( shortcode_exists('wpforms') && $wpf_id = get_theme_mod('ea_volunteer_wpf', '') ) {
        echo do_shortcode('[wpforms id="' . esc_attr($wpf_id) . '"]');
      } else { ?>
      <form class="ea-reveal bg-warm rounded-3xl p-8 space-y-5 opacity-0" style="animation-delay:.3s"
            action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"
            method="post">
        <input type="hidden" name="action" value="ea_volunteer_signup">
        <?php wp_nonce_field( 'ea_volunteer_form', 'ea_volunteer_nonce' ); ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="vol-first"><?php esc_html_e('First name','egalitarian'); ?> <span class="text-teal">*</span></label>
            <input id="vol-first" type="text" name="first_name" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:border-navy transition-colors bg-white">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="vol-last"><?php esc_html_e('Last name','egalitarian'); ?> <span class="text-teal">*</span></label>
            <input id="vol-last" type="text" name="last_name" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:border-navy transition-colors bg-white">
          </div>
        </div>
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="vol-email"><?php esc_html_e('Email address','egalitarian'); ?> <span class="text-teal">*</span></label>
          <input id="vol-email" type="email" name="email" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:border-navy transition-colors bg-white">
        </div>
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="vol-phone"><?php esc_html_e('Phone number','egalitarian'); ?></label>
          <input id="vol-phone" type="tel" name="phone" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:border-navy transition-colors bg-white">
        </div>
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2"><?php esc_html_e('How would you like to help?','egalitarian'); ?></label>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
            <?php
            $options = [
              __('Food parcel distribution','egalitarian'),
              __('Event support','egalitarian'),
              __('Health talks / outreach','egalitarian'),
              __('Admin / office support','egalitarian'),
              __('Fundraising','egalitarian'),
              __('Other','egalitarian'),
            ];
            foreach($options as $opt):
            ?>
            <label class="flex items-center gap-3 bg-white rounded-xl px-4 py-3 border-2 border-gray-200 cursor-pointer hover:border-teal transition-colors">
              <input type="checkbox" name="interests[]" value="<?php echo esc_attr($opt); ?>" class="w-4 h-4 rounded text-teal">
              <span class="text-sm text-gray-700"><?php echo esc_html($opt); ?></span>
            </label>
            <?php endforeach; ?>
          </div>
        </div>
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="vol-message"><?php esc_html_e('Anything else you want us to know?','egalitarian'); ?></label>
          <textarea id="vol-message" name="message" rows="4" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:border-navy transition-colors bg-white resize-none"></textarea>
        </div>
        <button type="submit" class="w-full py-4 bg-navy text-white font-bold rounded-xl text-base hover:bg-navy-light hover:-translate-y-0.5 hover:shadow-lg transition-all">
          <?php esc_html_e('Submit Application','egalitarian'); ?>
        </button>
      </form>
      <?php } ?>
    </div>
  </div>
</section>

<?php get_template_part('template-parts/cta'); ?>
<?php get_footer(); ?>
