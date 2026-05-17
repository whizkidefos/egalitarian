# PayPal Donation System — Complete Analysis & Setup Guide

## Executive Summary

Your PayPal integration is **well-architected but incomplete**. The URL builder and frontend form are solid, but you're missing:

1. ✅ **IPN Handler** — Now implemented to log donations
2. ✅ **Donation Logging Table** — Now added with automatic creation
3. ✅ **Thank-You Page** — Created and registered
4. ✅ **Subscription Parameters** — Fixed with required `no_shipping` flag
5. ⚠️ **Sender Email Notifications** — Needs implementation (optional)

---

## What's Working Well

### 1. Customizer Settings (Robust)
**File**: [functions.php](functions.php#L720-L780)
- Mode toggle: Sandbox (testing) vs Live (production)
- Email fields: Separate sandbox & live credentials
- Currency selection: GBP (default), USD, EUR
- Clean sanitization and validation

### 2. Helper Functions (Correct)
**File**: [functions.php](functions.php#L795-L860)

```php
ea_paypal_email()        // Returns active email based on mode
ea_paypal_base_url()     // Returns sandbox.paypal.com or paypal.com
ea_paypal_url()          // Builds complete donation URL with parameters
ea_paypal_configured()   // Validates setup
```

### 3. URL Builder (Complete)
**File**: [functions.php](functions.php#L815-L860)
- One-time donations: Uses `cmd=_donations`
- Monthly recurring: Uses `cmd=_xclick-subscriptions` ✅ NOW WITH `no_shipping=2`
- Proper parameter formatting with `http_build_query()`
- Return & cancel URLs configured
- IPN notify endpoint configured

### 4. Frontend Donate Page (Excellent UX)
**File**: [page-donate.php](page-donate.php#L80-L240)
- Impact breakdown cards (£5 = food parcel, £10 = health materials, etc.)
- Quick amount buttons (£5, £10, £25, £50)
- Custom amount input
- One-time vs Monthly toggle
- Dynamic button URL updates
- Sandbox warning badge when testing
- Responsive design

### 5. JavaScript Interactivity (Solid)
**File**: [page-donate.php](page-donate.php#L200-L240)
```javascript
// Dynamically builds PayPal URL based on user selection
// Updates button href when amount/frequency changes
// Validates amount is positive
```

---

## What Was Missing (Now Fixed)

### ✅ IPN Handler (Just Added)
**File**: [functions.php](functions.php#L850-L980)
- Listens for PayPal POST callbacks at `/?ea_paypal_ipn=1`
- Verifies transaction signature with PayPal's servers
- Validates email matches configured account
- Logs donation to database with full details
- Sends admin notification email
- Deduplicates if IPN arrives twice
- Comprehensive error logging for debugging

### ✅ Donation Logging Table (Just Added)
**File**: [functions.php](functions.php#L865-L895)
- Created automatically on theme activation or first load
- Stores: transaction_id, payer_email, amount, currency, type, status, date, IP
- Indexed for fast queries
- Raw IPN data stored for debugging
- Tracks one-time vs recurring vs subscription donations

### ✅ Thank-You Page (Just Created)
**File**: [page-thank-you.php](page-thank-you.php)
- Displays after PayPal redirect (return URL)
- Shows transaction ID if available
- Explains what happens next
- Provides next-step CTAs (volunteer, explore causes, share)
- Registered in template selector

### ✅ Subscription Parameters (Just Fixed)
**File**: [functions.php](functions.php#L855-L862)
```php
$args['no_shipping'] = '2';  // NEW: Required for subscriptions
$args['modify']      = '0';  // NEW: Signals new subscription
```

---

## Step-by-Step Setup Instructions

### Phase 1: Initial Configuration (5 minutes)

1. **Go to WordPress Customizer**
   - Admin → Customize → Egalitarian Association → PayPal Donations

2. **Create a PayPal Account (if you don't have one)**
   - **For Testing (Sandbox)**: Create free account at https://developer.paypal.com
   - **For Production (Live)**: Use your real PayPal Business account

3. **Get Your Sandbox Email**
   - Visit https://developer.paypal.com → Dashboard → Sandbox → Accounts
   - Create a "Business" account (or use the default one)
   - Copy that email address

4. **Configure in Customizer**
   - Set **PayPal Mode** → "Sandbox (Testing)"
   - Set **Sandbox Email** → Your sandbox business email
   - Keep **Live Email** empty for now
   - Choose currency (GBP recommended for UK charity)
   - Save changes

### Phase 2: Testing in Sandbox (10 minutes)

1. **Visit Your Donate Page**
   - Navigate to `/donate` on your site
   - You should see a blue "Sandbox Mode" warning badge
   - Select an amount (e.g., £10)

2. **Click "Donate Securely via PayPal"**
   - You should be taken to `sandbox.paypal.com`
   - Log in with your **buyer** account (created automatically when you made sandbox business account)
   - Complete the test donation

3. **Verify Return Flow**
   - After checkout, you're redirected to `/thank-you`
   - Page displays "Thank You!" message
   - URL includes `?tx=XXXXX` (your transaction ID)

4. **Check Admin Notification**
   - Admin email (from Settings → General) receives donation notification
   - Email shows: Amount, payer email, transaction ID, donation type

5. **Verify Database Logging**
   - In WordPress, you can query the donations table:
   ```sql
   SELECT * FROM wp_ea_donations ORDER BY donation_date DESC;
   ```
   - You should see your test donation logged

### Phase 3: Production Setup (10 minutes)

1. **Update Customizer**
   - **PayPal Mode** → "Live (Production)"
   - **Live Email** → Your real PayPal business account email
   - Save changes

2. **Test with Real Small Donation** (optional)
   - Go to `/donate`
   - Sandbox warning badge should disappear
   - Select amount (try £1)
   - Proceed to `paypal.com` (not sandbox!)
   - Make a real donation to verify flow

3. **Monitor First Week**
   - Watch for IPN callbacks and database logging
   - Check admin email for notifications
   - Verify donors see the thank-you page

---

## Configuration Checklist

**Before Going Live:**
- [ ] PayPal Business account created
- [ ] Customizer mode set to "Live"
- [ ] Live PayPal email configured
- [ ] `/thank-you` page created and published
- [ ] Email notifications enabled (admin receives emails)
- [ ] Tested with real small donation
- [ ] Verified database logging works

---

## File Reference

| File | Purpose | Status |
|------|---------|--------|
| [functions.php](functions.php#L715-L860) | Settings, URL builder, IPN handler, logging | ✅ Complete |
| [page-donate.php](page-donate.php) | Donation form & amounts | ✅ Complete |
| [page-thank-you.php](page-thank-you.php) | Post-donation landing page | ✅ NEW |
| `wp_ea_donations` table | Donation history logging | ✅ Auto-created |

---

## How It Works (Flow Diagram)

```
User visits /donate
    ↓
Selects amount & frequency (one-time or monthly)
    ↓
Clicks "Donate via PayPal"
    ↓
JavaScript builds PayPal URL from settings
    ↓
Redirected to PayPal (sandbox or live)
    ↓
User logs in & completes donation
    ↓
PayPal redirects back to /thank-you
    ↓
PayPal sends IPN callback to /?ea_paypal_ipn=1
    ↓
IPN handler verifies & logs donation
    ↓
Admin receives email notification
    ↓
Donor info stored in wp_ea_donations table
```

---

## Troubleshooting

### "No Sandbox Mode Badge"
- Check Customizer: PayPal Mode should be "Sandbox (Testing)"
- Clear browser cache
- Verify `ea_paypal_mode` value with: `echo get_theme_mod( 'ea_paypal_mode' );`

### "IPN Not Being Logged"
- Check WordPress logs (if enabled): `/wp-content/debug.log`
- Verify PayPal is sending to correct notify URL: `home_url( '/?ea_paypal_ipn=1' )`
- In PayPal account settings, confirm IPN endpoint is enabled
- Check wp_ea_donations table exists: `SHOW TABLES LIKE '%ea_donations%';`

### "Thank-You Page Shows 404"
- Create a page with slug `/thank-you`
- Assign it template "Thank You Page" from page template dropdown
- Publish the page
- Verify return URL in customizer points to correct site (no trailing slash issues)

### "Email Notifications Not Arriving"
- Check WordPress email is configured (Settings → General → Admin Email)
- Verify your hosting supports `wp_mail()`
- Check spam/junk folder
- Enable WordPress debug logging to see mail errors

---

## Advanced: Enabling Donor Emails (Future Enhancement)

Currently, only admin gets an email. To send thank-you emails to donors:

```php
// Add to IPN handler after logging donation
wp_mail(
    $payer_email,
    __( 'Thank You for Your Donation', 'egalitarian' ),
    sprintf(
        __( "Dear Donor,\n\nThank you for your %s donation to The Egalitarian Association.\nYour generosity will directly help those in need.\n\nBest regards,\nThe Team", 'egalitarian' ),
        $currency . $amount
    )
);
```

---

## Next Steps

1. **Immediate**: Follow Phase 1-2 above to test in sandbox
2. **This Week**: Get live credentials and go production
3. **Next Week**: Monitor donations, verify logging, watch for IPN issues
4. **Future**: Consider donor email receipts and admin dashboard

---

## Support Resources

- **PayPal IPN Docs**: https://developer.paypal.com/docs/classic/products/instant-payment-notification/
- **Sandbox Testing**: https://developer.paypal.com/docs/classic/lifecycle/sb_about/
- **WP Mail Debugging**: https://wordpress.org/plugins/wp-mail-logging/ (recommended plugin)

---

**All files updated**: ✅ functions.php, ✅ page-donate.php, ✅ page-thank-you.php (new)
