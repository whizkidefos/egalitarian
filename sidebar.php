<?php
/**
 * Sidebar template
 * File: wp-content/themes/egalitarian-association/sidebar.php
 */
if ( ! is_active_sidebar( 'sidebar-1' ) ) return;
?>
<aside class="ea-sidebar w-72 lg:w-80 flex-shrink-0 hidden lg:block" role="complementary" aria-label="<?php esc_attr_e('Sidebar','egalitarian'); ?>">
    <div class="sticky top-24 space-y-6">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
</aside>

<style>
.ea-sidebar .widget {
    background: #f8f7f4;
    border-radius: 1rem;
    padding: 1.5rem;
    border: 1px solid rgba(0,0,0,0.05);
}
.ea-sidebar .widget-title,
.ea-sidebar .wp-block-heading {
    font-size: 0.875rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #1a2b4a;
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid #2dd4bf;
}
.ea-sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.ea-sidebar ul li {
    padding: 0.5rem 0;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}
.ea-sidebar ul li:last-child {
    border-bottom: none;
}
.ea-sidebar ul li a {
    color: #4b5563;
    text-decoration: none;
    font-size: 0.875rem;
    transition: color 0.15s;
}
.ea-sidebar ul li a:hover {
    color: #2dd4bf;
}
.ea-sidebar .search-form {
    display: flex;
    gap: 0.5rem;
}
.ea-sidebar .search-field {
    flex: 1;
    padding: 0.625rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 0.75rem;
    font-size: 0.875rem;
    transition: border-color 0.15s;
}
.ea-sidebar .search-field:focus {
    outline: none;
    border-color: #1a2b4a;
}
.ea-sidebar .search-submit {
    padding: 0.625rem 1rem;
    background: #1a2b4a;
    color: white;
    border: none;
    border-radius: 0.75rem;
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: background 0.15s;
}
.ea-sidebar .search-submit:hover {
    background: #2a3b5a;
}
</style>
