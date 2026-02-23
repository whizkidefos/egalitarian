<?php
/**
 * Sidebar template
 * File: wp-content/themes/egalitarian-association/sidebar.php
 */
if ( ! is_active_sidebar( 'sidebar-1' ) ) return;
?>
<aside class="sidebar w-72 lg:w-80 flex-shrink-0" role="complementary" aria-label="<?php esc_attr_e('Sidebar','egalitarian'); ?>">
    <?php dynamic_sidebar('sidebar-1'); ?>
</aside>
