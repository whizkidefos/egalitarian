<?php
/**
 * Template Name: Donate Page
 * File: wp-content/themes/egalitarian-association/page-donate.php
 */
get_header();
?>

<!-- Hero -->
<section class="relative py-20 sm:py-28 bg-navy overflow-hidden">
  <div class="absolute inset-0 overflow-hidden" aria-hidden="true">
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-gold/20 blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-teal/10 blur-3xl"></div>
  </div>
  <div class="absolute inset-0 bg-gradient-to-r from-navy/95 to-navy/60" aria-hidden="true"></div>
  <div class="relative z-10 max-w-site mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <span class="inline-block text-gold text-xs font-bold uppercase tracking-widest mb-3"><?php esc_html_e('Make a Difference','egalitarian'); ?></span>
    <h1 class="text-white font-extrabold text-4xl sm:text-5xl mb-4"><?php esc_html_e('Donate Today','egalitarian'); ?></h1>
    <p class="text-white/70 text-lg max-w-xl mx-auto"><?php esc_html_e('Your generosity directly funds food parcels, essential clothing, and life-changing health education for people in need.','egalitarian'); ?></p>
  </div>
</section>

<!-- Impact + Donate form -->
<section class="py-20 bg-warm">
  <div class="max-w-site mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">

      <!-- Left: Impact breakdown -->
      <div>
        <h2 class="ea-reveal text-navy font-extrabold text-2xl sm:text-3xl mb-8 opacity-0"><?php esc_html_e('Your Donation at Work','egalitarian'); ?></h2>
        <div class="space-y-4">
          <?php
          $impacts = [
            ['amount'=>'£5',  'icon'=>'food',  'color'=>'teal','desc'=>__('Provides a food parcel to feed a family for a day.','egalitarian')],
            ['amount'=>'£10', 'icon'=>'health','color'=>'navy','desc'=>__('Funds health education materials for 10 people.','egalitarian')],
            ['amount'=>'£25', 'icon'=>'coat',  'color'=>'gold','desc'=>__('Buys a warm winter coat for someone sleeping rough.','egalitarian')],
            ['amount'=>'£50', 'icon'=>'people','color'=>'teal','desc'=>__('Sponsors a public health talk reaching 50+ people.','egalitarian')],
          ];
          $ic = ['teal'=>'bg-teal/10 text-teal','gold'=>'bg-gold/10 text-gold-dark','navy'=>'bg-navy/10 text-navy'];
          foreach($impacts as $i=>$imp): $d=($i*0.1).'s'; ?>
          <div class="ea-reveal bg-white rounded-2xl p-5 shadow-card flex items-center gap-5 opacity-0" style="animation-delay:<?php echo esc_attr($d);?>">
            <div class="w-12 h-12 rounded-xl <?php echo esc_attr($ic[$imp['color']]); ?> flex items-center justify-center flex-shrink-0">
              <span class="w-6 h-6"><?php echo ea_icon($imp['icon']); ?></span>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-gray-600 text-sm"><?php echo esc_html($imp['desc']); ?></p>
            </div>
            <span class="text-navy font-extrabold text-lg flex-shrink-0"><?php echo esc_html($imp['amount']); ?></span>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="mt-8 p-5 bg-navy/5 border border-navy/10 rounded-2xl">
          <p class="text-gray-500 text-sm leading-relaxed">
            <?php esc_html_e('The Egalitarian Association is a registered CIO in England. All donations are used directly to further our charitable objects.','egalitarian'); ?>
          </p>
        </div>
      </div>

      <!-- Right: Donate widget / payment info -->
      <div class="ea-reveal opacity-0" style="animation-delay:.2s">
        <div class="bg-white rounded-3xl shadow-card-hover p-8 border border-gray-100">
          <h2 class="text-navy font-extrabold text-2xl mb-2"><?php esc_html_e('Make a Donation','egalitarian'); ?></h2>
          <p class="text-gray-500 text-sm mb-8"><?php esc_html_e('Choose an amount or enter your own.','egalitarian'); ?></p>

          <!-- Quick amounts -->
          <div class="grid grid-cols-4 gap-3 mb-6" role="group" aria-label="<?php esc_attr_e('Donation amounts','egalitarian'); ?>">
            <?php foreach(['£5','£10','£25','£50'] as $amt): ?>
            <button type="button"
                    class="ea-amount-btn py-3 border-2 border-gray-200 rounded-xl text-navy font-bold text-sm hover:border-navy hover:bg-navy hover:text-white transition-all"
                    data-amount="<?php echo esc_attr(ltrim($amt,'£')); ?>">
              <?php echo esc_html($amt); ?>
            </button>
            <?php endforeach; ?>
          </div>

          <!-- Custom amount -->
          <div class="mb-6">
            <label for="custom-amount" class="block text-sm font-semibold text-gray-700 mb-2"><?php esc_html_e('Or enter an amount (£)','egalitarian'); ?></label>
            <div class="relative">
              <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold">£</span>
              <input id="custom-amount" type="number" min="1" placeholder="0.00"
                     class="w-full pl-8 pr-4 py-3 border-2 border-gray-200 rounded-xl text-navy font-semibold focus:outline-none focus:border-navy transition-colors">
            </div>
          </div>

          <!-- Donation type -->
          <div class="mb-8 flex rounded-xl overflow-hidden border-2 border-gray-200">
            <button type="button" class="ea-freq-btn flex-1 py-2.5 text-sm font-semibold bg-navy text-white transition-all" data-freq="once"><?php esc_html_e('One-time','egalitarian'); ?></button>
            <button type="button" class="ea-freq-btn flex-1 py-2.5 text-sm font-semibold text-gray-500 hover:text-navy transition-all" data-freq="monthly"><?php esc_html_e('Monthly','egalitarian'); ?></button>
          </div>

          <?php
          $currency_symbol = get_theme_mod( 'ea_paypal_currency', 'GBP' ) === 'USD' ? '$' : ( get_theme_mod( 'ea_paypal_currency', 'GBP' ) === 'EUR' ? '€' : '£' );
          ?>
          <a href="<?php echo esc_url( ea_paypal_url() ); ?>"
             id="ea-donate-btn"
             class="flex items-center justify-center gap-2 w-full py-4 bg-gold text-navy font-extrabold rounded-xl text-base hover:bg-gold-light hover:shadow-lg hover:-translate-y-0.5 transition-all">
            <span class="w-5 h-5"><?php echo ea_icon('heart'); ?></span>
            <?php esc_html_e('Donate Securely via PayPal','egalitarian'); ?>
          </a>
          <?php if ( get_theme_mod('ea_paypal_mode','sandbox') === 'sandbox' ) : ?>
          <p class="text-center text-amber-600 text-xs font-semibold mt-3 bg-amber-50 rounded-lg py-2">
            ⚠️ <?php esc_html_e('Sandbox / Test mode — no real payments processed','egalitarian'); ?>
          </p>
          <?php endif; ?>
          <p class="text-center text-gray-400 text-xs mt-3"><?php esc_html_e('Secure payment via PayPal. You will be redirected to complete your donation.','egalitarian'); ?></p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_template_part('template-parts/cta'); ?>
<?php get_footer(); ?>

<script>
const paypalBase = '<?php echo esc_js( ea_paypal_url() ); ?>';
const donateBtn  = document.getElementById('ea-donate-btn');

function buildPayPalUrl(amount, recurring) {
  const url = new URL(paypalBase);
  if (amount) url.searchParams.set('amount', parseFloat(amount).toFixed(2));
  if (recurring) {
    url.searchParams.set('cmd', '_xclick-subscriptions');
    url.searchParams.set('a3', parseFloat(amount || 0).toFixed(2));
    url.searchParams.set('p3', '1');
    url.searchParams.set('t3', 'M');
    url.searchParams.set('src', '1');
    url.searchParams.delete('amount');
  } else {
    url.searchParams.set('cmd', '_donations');
  }
  return url.toString();
}

let selectedAmount = 0;
let isRecurring    = false;

// Quick amount selector
document.querySelectorAll('.ea-amount-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.ea-amount-btn').forEach(b => {
      b.classList.remove('border-navy','bg-navy','text-white');
      b.classList.add('border-gray-200');
    });
    btn.classList.add('border-navy','bg-navy','text-white');
    btn.classList.remove('border-gray-200');
    selectedAmount = btn.dataset.amount;
    document.getElementById('custom-amount').value = selectedAmount;
    if (donateBtn) donateBtn.href = buildPayPalUrl(selectedAmount, isRecurring);
  });
});

// Custom amount input
document.getElementById('custom-amount')?.addEventListener('input', e => {
  selectedAmount = e.target.value;
  document.querySelectorAll('.ea-amount-btn').forEach(b => {
    b.classList.remove('border-navy','bg-navy','text-white');
    b.classList.add('border-gray-200');
  });
  if (donateBtn) donateBtn.href = buildPayPalUrl(selectedAmount, isRecurring);
});

// Frequency toggle
document.querySelectorAll('.ea-freq-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.ea-freq-btn').forEach(b => {
      b.classList.remove('bg-navy','text-white');
      b.classList.add('text-gray-500');
    });
    btn.classList.add('bg-navy','text-white');
    btn.classList.remove('text-gray-500');
    isRecurring = btn.dataset.freq === 'monthly';
    if (donateBtn) donateBtn.href = buildPayPalUrl(selectedAmount, isRecurring);
  });
});
</script>
