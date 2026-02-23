<?php
/**
 * Egalitarian Association — functions.php
 * Theme setup, asset loading, menus, widgets, and helpers.
 */

defined( 'ABSPATH' ) || exit;

define( 'EA_VERSION', '1.0.0' );
define( 'EA_DIR',     get_template_directory() );
define( 'EA_URI',     get_template_directory_uri() );

/* =========================================================
   1. THEME SETUP
   ========================================================= */
add_action( 'after_setup_theme', function () {

    load_theme_textdomain( 'egalitarian', EA_DIR . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', [
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
    ] );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'editor-color-palette', [
        [ 'name' => __( 'Navy Blue', 'egalitarian' ),    'slug' => 'navy-blue',    'color' => '#1F3A93' ],
        [ 'name' => __( 'Golden Yellow', 'egalitarian' ), 'slug' => 'golden-yellow','color' => '#F5B041' ],
        [ 'name' => __( 'Teal Green', 'egalitarian' ),   'slug' => 'teal-green',   'color' => '#1ABC9C' ],
        [ 'name' => __( 'White', 'egalitarian' ),        'slug' => 'white',        'color' => '#FFFFFF' ],
    ] );

    // Image sizes
    add_image_size( 'ea-card',  600, 400, true );
    add_image_size( 'ea-hero', 1440, 600, true );
    add_image_size( 'ea-thumb', 80,   80, true );

    // Navigation menus
    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'egalitarian' ),
        'footer'  => __( 'Footer Navigation',  'egalitarian' ),
        'social'  => __( 'Social Links',        'egalitarian' ),
    ] );

    // Set content width
    $GLOBALS['content_width'] = 1280;
} );


/* =========================================================
   2. ENQUEUE ASSETS
   ========================================================= */
add_action( 'wp_enqueue_scripts', function () {

    // Google Fonts — Open Sans
    wp_enqueue_style(
        'ea-google-fonts',
        'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap',
        [],
        null
    );

    // Main CSS (compiled Tailwind)
    wp_enqueue_style(
        'ea-main',
        EA_URI . '/assets/css/main.css',
        [ 'ea-google-fonts' ],
        EA_VERSION
    );

    // Main JS
    wp_enqueue_script(
        'ea-main',
        EA_URI . '/assets/js/main.js',
        [],
        EA_VERSION,
        true   // footer
    );

    wp_localize_script( 'ea-main', 'eaData', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'ea_nonce' ),
        'siteUrl' => home_url(),
    ] );

    // Comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
} );

// Block editor styles
add_action( 'enqueue_block_editor_assets', function () {
    wp_enqueue_style(
        'ea-editor',
        EA_URI . '/assets/css/main.css',
        [],
        EA_VERSION
    );
    wp_enqueue_style(
        'ea-google-fonts',
        'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap',
        [],
        null
    );
} );


/* =========================================================
   3. WIDGET AREAS
   ========================================================= */
add_action( 'widgets_init', function () {
    $defaults = [
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-8">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title text-navy font-bold text-lg mb-4 pb-2 border-b-2 border-gold">',
        'after_title'   => '</h3>',
    ];

    register_sidebar( array_merge( $defaults, [
        'name'        => __( 'Sidebar',        'egalitarian' ),
        'id'          => 'sidebar-1',
        'description' => __( 'Main sidebar.',  'egalitarian' ),
    ] ) );

    register_sidebar( array_merge( $defaults, [
        'name'        => __( 'Footer Column 1', 'egalitarian' ),
        'id'          => 'footer-1',
        'description' => __( 'First footer column.', 'egalitarian' ),
    ] ) );

    register_sidebar( array_merge( $defaults, [
        'name'        => __( 'Footer Column 2', 'egalitarian' ),
        'id'          => 'footer-2',
        'description' => __( 'Second footer column.', 'egalitarian' ),
    ] ) );

    register_sidebar( array_merge( $defaults, [
        'name'        => __( 'Footer Column 3', 'egalitarian' ),
        'id'          => 'footer-3',
        'description' => __( 'Third footer column.', 'egalitarian' ),
    ] ) );
} );


/* =========================================================
   4. CUSTOM POST TYPES
   ========================================================= */

// "Causes" CPT
add_action( 'init', function () {
    register_post_type( 'ea_cause', [
        'labels' => [
            'name'               => __( 'Causes',          'egalitarian' ),
            'singular_name'      => __( 'Cause',            'egalitarian' ),
            'add_new_item'       => __( 'Add New Cause',    'egalitarian' ),
            'edit_item'          => __( 'Edit Cause',       'egalitarian' ),
            'new_item'           => __( 'New Cause',        'egalitarian' ),
            'view_item'          => __( 'View Cause',       'egalitarian' ),
            'search_items'       => __( 'Search Causes',    'egalitarian' ),
            'not_found'          => __( 'No causes found.', 'egalitarian' ),
            'not_found_in_trash' => __( 'No causes in trash.', 'egalitarian' ),
            'menu_name'          => __( 'Causes',           'egalitarian' ),
        ],
        'public'            => true,
        'has_archive'       => true,
        'rewrite'           => [ 'slug' => 'causes' ],
        'supports'          => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
        'menu_icon'         => 'dashicons-heart',
        'show_in_rest'      => true,
    ] );

    // "Events" CPT
    register_post_type( 'ea_event', [
        'labels' => [
            'name'               => __( 'Events',           'egalitarian' ),
            'singular_name'      => __( 'Event',             'egalitarian' ),
            'add_new_item'       => __( 'Add New Event',     'egalitarian' ),
            'edit_item'          => __( 'Edit Event',        'egalitarian' ),
            'new_item'           => __( 'New Event',         'egalitarian' ),
            'view_item'          => __( 'View Event',        'egalitarian' ),
            'search_items'       => __( 'Search Events',     'egalitarian' ),
            'not_found'          => __( 'No events found.',  'egalitarian' ),
            'not_found_in_trash' => __( 'No events in trash.', 'egalitarian' ),
            'menu_name'          => __( 'Events',            'egalitarian' ),
        ],
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => [ 'slug' => 'events' ],
        'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
        'menu_icon'    => 'dashicons-calendar-alt',
        'show_in_rest' => true,
    ] );

    // "Testimonials" CPT
    register_post_type( 'ea_testimonial', [
        'labels' => [
            'name'          => __( 'Testimonials',    'egalitarian' ),
            'singular_name' => __( 'Testimonial',     'egalitarian' ),
            'add_new_item'  => __( 'Add Testimonial', 'egalitarian' ),
            'menu_name'     => __( 'Testimonials',    'egalitarian' ),
        ],
        'public'            => false,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'supports'          => [ 'title', 'editor', 'thumbnail' ],
        'menu_icon'         => 'dashicons-format-quote',
    ] );
} );


/* =========================================================
   5. CUSTOM TAXONOMIES
   ========================================================= */
add_action( 'init', function () {
    register_taxonomy( 'cause_category', [ 'ea_cause' ], [
        'labels'       => [
            'name'          => __( 'Cause Categories', 'egalitarian' ),
            'singular_name' => __( 'Cause Category',   'egalitarian' ),
        ],
        'hierarchical' => true,
        'rewrite'      => [ 'slug' => 'cause-category' ],
        'show_in_rest' => true,
    ] );
} );


/* =========================================================
   6. BODY CLASSES
   ========================================================= */
add_filter( 'body_class', function ( $classes ) {
    $classes[] = 'ea-theme';
    if ( is_front_page() ) $classes[] = 'is-front-page';
    return $classes;
} );


/* =========================================================
   7. EXCERPT
   ========================================================= */
add_filter( 'excerpt_length', fn() => 25 );
add_filter( 'excerpt_more',   fn() => '&hellip;' );


/* =========================================================
   8. HELPER FUNCTIONS
   ========================================================= */

/**
 * Render the site logo.
 */
function ea_logo( string $variant = 'horizontal', string $classes = '' ): void {
    $src = EA_URI . '/assets/images/logo-' . esc_attr( $variant ) . '.png';
    $alt = get_bloginfo( 'name' );
    printf(
        '<img src="%s" alt="%s" class="%s" loading="eager">',
        esc_url( $src ),
        esc_attr( $alt ),
        esc_attr( $classes )
    );
}

/**
 * Wrap SVG icon inline (fallback: emoji text).
 */
function ea_icon( string $name ): string {
    $icons = [
        'heart'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ea-icon"><path d="M12 21.593c-.525-.438-3.32-2.853-5.127-4.81C4.516 14.275 3 11.918 3 9.5A5.5 5.5 0 0 1 12 5.572 5.5 5.5 0 0 1 21 9.5c0 2.418-1.516 4.775-3.873 7.283C15.32 18.74 12.525 21.155 12 21.593z"/></svg>',
        'food'     => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ea-icon"><path d="M18.06 22.99h1.66c.84 0 1.53-.64 1.63-1.46L23 5.05h-5V1h-1.97v4.05h-4.97l.3 2.34c1.71.47 3.31 1.32 4.27 2.26 1.44 1.42 2.43 2.89 2.43 5.29v8.05zM1 21.99V21h15.03v.99c0 .55-.45 1-1.01 1H2.01c-.56 0-1.01-.45-1.01-1zm15.03-7c0-2.21-1.79-4-4-4H4c-2.21 0-4 1.79-4 4v1h15.03v-1z"/></svg>',
        'health'   => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ea-icon"><path d="M19 3H5c-1.1 0-1.99.9-1.99 2L3 19c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-1 11h-4v4h-4v-4H6v-4h4V6h4v4h4v4z"/></svg>',
        'people'   => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ea-icon"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>',
        'coat'     => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ea-icon"><path d="M13 2.05V4h2c1.1 0 2 .9 2 2v1.17l2.7 1.35A2 2 0 0 1 21 10.29V19c0 1.1-.9 2-2 2H5a2 2 0 0 1-2-2v-8.71a2 2 0 0 1 1.3-1.87L7 7.17V6c0-1.1.9-2 2-2h2V2.05C9.86 2.28 8 4.28 8 6v2l-3 1.5V19h14V9.5L16 8V6c0-1.72-1.86-3.72-3-3.95z"/></svg>',
        'quote'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ea-icon"><path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z"/></svg>',
        'arrow'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ea-icon"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/></svg>',
        'menu'     => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ea-icon"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>',
        'close'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ea-icon"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>',
        'facebook' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ea-icon"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>',
        'twitter'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ea-icon"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>',
        'linkedin' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ea-icon"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>',
        'email'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ea-icon"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"/></svg>',
        'phone'    => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ea-icon"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>',
        'location' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ea-icon"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>',
    ];

    return $icons[ $name ] ?? '';
}

/**
 * Pagination.
 */
function ea_pagination(): void {
    $links = paginate_links( [
        'type'      => 'array',
        'prev_text' => '&larr;',
        'next_text' => '&rarr;',
    ] );
    if ( ! $links ) return;

    echo '<nav class="ea-pagination flex items-center justify-center gap-2 mt-12" aria-label="' . esc_attr__( 'Posts pagination', 'egalitarian' ) . '">';
    foreach ( $links as $link ) {
        echo '<span class="ea-page-item">' . $link . '</span>';
    }
    echo '</nav>';
}

/**
 * Format post date.
 */
function ea_post_date(): string {
    return get_the_date( 'j M Y' );
}

/**
 * Get reading time estimate.
 */
function ea_reading_time(): string {
    $words  = str_word_count( strip_tags( get_the_content() ) );
    $mins   = max( 1, (int) ceil( $words / 200 ) );
    return sprintf( _n( '%d min read', '%d min read', $mins, 'egalitarian' ), $mins );
}


/* =========================================================
   9. NAV WALKERS
   ========================================================= */

/**
 * Desktop nav walker — supports one level of dropdowns.
 */
if ( ! class_exists( 'EA_Nav_Walker' ) ) :
class EA_Nav_Walker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="ea-dropdown absolute top-full left-0 min-w-[220px] bg-white rounded-xl shadow-card-hover border border-gray-100 py-2 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-y-2 group-hover:translate-y-0">';
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes   = empty( $item->classes ) ? [] : (array) $item->classes;
        $has_child = in_array( 'menu-item-has-children', $classes );

        if ( $depth === 0 ) {
            $output .= '<li class="relative ' . ( $has_child ? 'group' : '' ) . '">';
            $link_class = 'flex items-center gap-1 px-4 py-2 text-sm font-semibold text-gray-700 rounded-lg hover:text-navy hover:bg-navy/5 transition-colors duration-150'
                        . ( in_array( 'current-menu-item', $classes ) || in_array( 'current-menu-ancestor', $classes ) ? ' text-navy bg-navy/5' : '' );
        } else {
            $output .= '<li>';
            $link_class = 'block px-4 py-2 text-sm text-gray-700 hover:text-navy hover:bg-navy/5 transition-colors duration-150';
        }

        $atts = [
            'href'         => ! empty( $item->url )    ? $item->url    : '#',
            'target'       => ! empty( $item->target ) ? $item->target : '',
            'rel'          => ! empty( $item->xfn )    ? $item->xfn    : '',
            'class'        => $link_class,
            'aria-current' => in_array( 'current-menu-item', $classes ) ? 'page' : '',
        ];

        $attr_str = '';
        foreach ( $atts as $k => $v ) {
            if ( $v ) $attr_str .= ' ' . esc_attr( $k ) . '="' . esc_attr( $v ) . '"';
        }

        $title   = apply_filters( 'the_title', $item->title, $item->ID );
        $chevron = $has_child && $depth === 0
            ? '<svg class="w-3 h-3 ml-0.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>'
            : '';

        $output .= "<a{$attr_str}>{$title}{$chevron}</a>";
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= '</li>';
    }
}
endif;

/**
 * Mobile nav walker — flat list, sub-items indented.
 */
if ( ! class_exists( 'EA_Mobile_Nav_Walker' ) ) :
class EA_Mobile_Nav_Walker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="pl-4 mt-1 space-y-1 border-l-2 border-gold/40">';
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes    = empty( $item->classes ) ? [] : (array) $item->classes;
        $is_current = in_array( 'current-menu-item', $classes ) || in_array( 'current-menu-ancestor', $classes );
        $link_class = 'block px-3 py-2.5 rounded-lg text-sm font-semibold transition-colors duration-150 '
                    . ( $is_current ? 'text-navy bg-navy/5' : 'text-gray-700 hover:text-navy hover:bg-navy/5' );

        $output .= '<li>';
        $output .= '<a href="' . esc_url( $item->url ) . '" class="' . esc_attr( $link_class ) . '">'
                 . esc_html( $item->title )
                 . '</a>';
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= '</li>';
    }
}
endif;

/**
 * Fallback menu when no menu is assigned to 'primary' location.
 */
function ea_fallback_menu(): void {
    echo '<ul class="flex items-center gap-1">';
    $pages = get_pages( [ 'sort_column' => 'menu_order' ] );
    foreach ( $pages as $page ) {
        $current = is_page( $page->ID ) ? 'aria-current="page" ' : '';
        printf(
            '<li><a %shref="%s" class="px-4 py-2 text-sm font-semibold text-gray-700 rounded-lg hover:text-navy hover:bg-navy/5 transition-colors">%s</a></li>',
            $current,
            esc_url( get_permalink( $page->ID ) ),
            esc_html( $page->post_title )
        );
    }
    echo '</ul>';
}


/* =========================================================
   10. PAGE TEMPLATE REGISTRATION
   ========================================================= */

/**
 * Register custom page templates so they appear in the
 * WordPress "Page Attributes > Template" dropdown.
 */
add_filter( 'theme_page_templates', function ( $templates ) {
    $templates['page-about.php']       = __( 'About Page',       'egalitarian' );
    $templates['page-causes.php']      = __( 'Causes Page',      'egalitarian' );
    $templates['page-events.php']      = __( 'Events Page',      'egalitarian' );
    $templates['page-news.php']        = __( 'News Page',        'egalitarian' );
    $templates['page-donate.php']      = __( 'Donate Page',      'egalitarian' );
    $templates['page-get-involved.php']= __( 'Get Involved Page','egalitarian' );
    $templates['page-legal.php']       = __( 'Legal Page',       'egalitarian' );
    return $templates;
} );


/* =========================================================
   11. EVENT POST META BOXES
   ========================================================= */

add_action( 'add_meta_boxes', function () {
    add_meta_box(
        'ea_event_details',
        __( 'Event Details', 'egalitarian' ),
        'ea_event_meta_box',
        'ea_event',
        'side',
        'high'
    );
} );

function ea_event_meta_box( WP_Post $post ): void {
    wp_nonce_field( 'ea_event_meta', 'ea_event_nonce' );
    $date     = get_post_meta( $post->ID, '_ea_event_date',     true );
    $location = get_post_meta( $post->ID, '_ea_event_location', true );
    $time     = get_post_meta( $post->ID, '_ea_event_time',     true );
    ?>
    <p style="margin-bottom:8px">
        <label for="ea_event_date" style="font-weight:600;display:block;margin-bottom:4px"><?php esc_html_e( 'Date', 'egalitarian' ); ?></label>
        <input type="text" id="ea_event_date" name="ea_event_date" value="<?php echo esc_attr( $date ); ?>"
               placeholder="e.g. Saturday 15 March 2025" style="width:100%">
    </p>
    <p style="margin-bottom:8px">
        <label for="ea_event_time" style="font-weight:600;display:block;margin-bottom:4px"><?php esc_html_e( 'Time', 'egalitarian' ); ?></label>
        <input type="text" id="ea_event_time" name="ea_event_time" value="<?php echo esc_attr( $time ); ?>"
               placeholder="e.g. 10:00am – 2:00pm" style="width:100%">
    </p>
    <p>
        <label for="ea_event_location" style="font-weight:600;display:block;margin-bottom:4px"><?php esc_html_e( 'Location', 'egalitarian' ); ?></label>
        <input type="text" id="ea_event_location" name="ea_event_location" value="<?php echo esc_attr( $location ); ?>"
               placeholder="e.g. Community Hall, London" style="width:100%">
    </p>
    <?php
}

add_action( 'save_post_ea_event', function ( int $post_id ) {
    if ( ! isset( $_POST['ea_event_nonce'] ) || ! wp_verify_nonce( $_POST['ea_event_nonce'], 'ea_event_meta' ) ) return;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    foreach ( [ 'ea_event_date', 'ea_event_time', 'ea_event_location' ] as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }
} );


/* =========================================================
   12. ARCHIVE TITLE — strip <span> wrapper
   ========================================================= */
add_filter( 'get_the_archive_title', function ( string $title ): string {
    return wp_strip_all_tags( $title );
} );


/* =========================================================
   13. PAYPAL DONATION — Customizer settings + handler
   ========================================================= */
add_action( 'customize_register', function ( WP_Customize_Manager $wp_customize ) {

    // Panel
    $wp_customize->add_panel( 'ea_settings', [
        'title'    => __( 'Egalitarian Association', 'egalitarian' ),
        'priority' => 30,
    ] );

    // ── Contact section ──────────────────────────────────
    $wp_customize->add_section( 'ea_contact', [
        'title' => __( 'Contact Details', 'egalitarian' ),
        'panel' => 'ea_settings',
    ] );
    foreach ( [
        'ea_email'   => [ 'label' => __( 'Email Address', 'egalitarian' ),   'default' => 'info@theegalitarianassociation.org' ],
        'ea_phone'   => [ 'label' => __( 'Phone Number',  'egalitarian' ),   'default' => '' ],
        'ea_address' => [ 'label' => __( 'Address',       'egalitarian' ),   'default' => '' ],
        'ea_charity_number' => [ 'label' => __( 'Charity Registration No.', 'egalitarian' ), 'default' => '' ],
    ] as $id => $args ) {
        $wp_customize->add_setting( $id, [ 'default' => $args['default'], 'sanitize_callback' => 'sanitize_text_field' ] );
        $wp_customize->add_control( $id, [ 'label' => $args['label'], 'section' => 'ea_contact', 'type' => 'text' ] );
    }

    // ── Social section ────────────────────────────────────
    $wp_customize->add_section( 'ea_social', [
        'title' => __( 'Social Media', 'egalitarian' ),
        'panel' => 'ea_settings',
    ] );
    foreach ( [
        'ea_social_facebook' => __( 'Facebook URL', 'egalitarian' ),
        'ea_social_twitter'  => __( 'Twitter / X URL', 'egalitarian' ),
        'ea_social_linkedin' => __( 'LinkedIn URL', 'egalitarian' ),
        'ea_social_instagram'=> __( 'Instagram URL', 'egalitarian' ),
    ] as $id => $label ) {
        $wp_customize->add_setting( $id, [ 'default' => '', 'sanitize_callback' => 'esc_url_raw' ] );
        $wp_customize->add_control( $id, [ 'label' => $label, 'section' => 'ea_social', 'type' => 'url' ] );
    }

    // ── PayPal section ────────────────────────────────────
    $wp_customize->add_section( 'ea_paypal', [
        'title'       => __( 'PayPal Donations', 'egalitarian' ),
        'panel'       => 'ea_settings',
        'description' => __( 'Configure PayPal donation settings. Use Sandbox for testing, Live for production.', 'egalitarian' ),
    ] );

    // Mode toggle
    $wp_customize->add_setting( 'ea_paypal_mode', [ 'default' => 'sandbox', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'ea_paypal_mode', [
        'label'   => __( 'PayPal Mode', 'egalitarian' ),
        'section' => 'ea_paypal',
        'type'    => 'select',
        'choices' => [
            'sandbox' => __( 'Sandbox (Testing)', 'egalitarian' ),
            'live'    => __( 'Live (Production)',  'egalitarian' ),
        ],
    ] );

    // Sandbox
    $wp_customize->add_setting( 'ea_paypal_sandbox_email', [ 'default' => '', 'sanitize_callback' => 'sanitize_email' ] );
    $wp_customize->add_control( 'ea_paypal_sandbox_email', [
        'label'       => __( 'Sandbox PayPal Email', 'egalitarian' ),
        'description' => __( 'Your PayPal sandbox business account email.', 'egalitarian' ),
        'section'     => 'ea_paypal',
        'type'        => 'email',
    ] );

    // Live
    $wp_customize->add_setting( 'ea_paypal_live_email', [ 'default' => '', 'sanitize_callback' => 'sanitize_email' ] );
    $wp_customize->add_control( 'ea_paypal_live_email', [
        'label'       => __( 'Live PayPal Email', 'egalitarian' ),
        'description' => __( 'Your real PayPal business account email.', 'egalitarian' ),
        'section'     => 'ea_paypal',
        'type'        => 'email',
    ] );

    // Currency
    $wp_customize->add_setting( 'ea_paypal_currency', [ 'default' => 'GBP', 'sanitize_callback' => 'sanitize_text_field' ] );
    $wp_customize->add_control( 'ea_paypal_currency', [
        'label'   => __( 'Currency Code', 'egalitarian' ),
        'section' => 'ea_paypal',
        'type'    => 'select',
        'choices' => [ 'GBP' => 'GBP (£)', 'USD' => 'USD ($)', 'EUR' => 'EUR (€)' ],
    ] );

    // Announcement bar
    $wp_customize->add_section( 'ea_announcement_sec', [
        'title' => __( 'Announcement Bar', 'egalitarian' ),
        'panel' => 'ea_settings',
    ] );
    $wp_customize->add_setting( 'ea_announcement', [ 'default' => '', 'sanitize_callback' => 'wp_kses_post' ] );
    $wp_customize->add_control( 'ea_announcement', [
        'label'   => __( 'Announcement text (leave blank to hide)', 'egalitarian' ),
        'section' => 'ea_announcement_sec',
        'type'    => 'textarea',
    ] );

    // Hero content
    $wp_customize->add_section( 'ea_hero_sec', [
        'title' => __( 'Homepage Hero', 'egalitarian' ),
        'panel' => 'ea_settings',
    ] );
    foreach ( [
        'ea_hero_heading'   => [ 'label' => __( 'Hero Heading', 'egalitarian' ),     'default' => 'Serving Community,<br>Changing Lives' ],
        'ea_hero_subtext'   => [ 'label' => __( 'Hero Subtext', 'egalitarian' ),     'default' => 'We provide food parcels, essential clothing and health education to those in need across England.' ],
        'ea_hero_cta_label' => [ 'label' => __( 'CTA Button Label', 'egalitarian' ), 'default' => 'Donate Today' ],
    ] as $id => $args ) {
        $wp_customize->add_setting( $id, [ 'default' => $args['default'], 'sanitize_callback' => 'wp_kses_post' ] );
        $wp_customize->add_control( $id, [ 'label' => $args['label'], 'section' => 'ea_hero_sec', 'type' => 'text' ] );
    }

    // Stats
    $wp_customize->add_section( 'ea_stats_sec', [
        'title' => __( 'Impact Statistics', 'egalitarian' ),
        'panel' => 'ea_settings',
    ] );
    for ( $n = 1; $n <= 4; $n++ ) {
        $wp_customize->add_setting( "ea_stat{$n}_value", [ 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ] );
        $wp_customize->add_setting( "ea_stat{$n}_label", [ 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ] );
        $wp_customize->add_control( "ea_stat{$n}_value", [ 'label' => "Stat {$n} Value (e.g. 2,500+)", 'section' => 'ea_stats_sec', 'type' => 'text' ] );
        $wp_customize->add_control( "ea_stat{$n}_label", [ 'label' => "Stat {$n} Label", 'section' => 'ea_stats_sec', 'type' => 'text' ] );
    }
} );


/* =========================================================
   14. PAYPAL HELPER FUNCTIONS
   ========================================================= */

/**
 * Get the active PayPal email based on current mode.
 */
function ea_paypal_email(): string {
    $mode = get_theme_mod( 'ea_paypal_mode', 'sandbox' );
    return $mode === 'live'
        ? (string) get_theme_mod( 'ea_paypal_live_email',    '' )
        : (string) get_theme_mod( 'ea_paypal_sandbox_email', '' );
}

/**
 * Get the PayPal base URL based on current mode.
 */
function ea_paypal_base_url(): string {
    $mode = get_theme_mod( 'ea_paypal_mode', 'sandbox' );
    return $mode === 'live'
        ? 'https://www.paypal.com/donate'
        : 'https://www.sandbox.paypal.com/donate';
}

/**
 * Build a complete PayPal donate URL.
 *
 * @param float  $amount   Pre-filled amount (0 = let donor choose).
 * @param string $item     Description shown on PayPal checkout.
 * @param bool   $recurring Whether to set up monthly giving.
 */
function ea_paypal_url( float $amount = 0, string $item = '', bool $recurring = false ): string {
    $email    = ea_paypal_email();
    $currency = get_theme_mod( 'ea_paypal_currency', 'GBP' );

    if ( ! $email ) {
        // No PayPal configured — fall back to donate page
        return home_url( '/donate' );
    }

    $args = [
        'business'      => $email,
        'item_name'     => $item ?: get_bloginfo( 'name' ) . ' — Donation',
        'currency_code' => $currency,
        'no_note'       => '0',
        'return'        => home_url( '/thank-you' ),
        'cancel_return' => home_url( '/donate' ),
        'notify_url'    => home_url( '/?ea_paypal_ipn=1' ),
    ];

    if ( $recurring ) {
        $args['cmd']           = '_xclick-subscriptions';
        $args['a3']            = $amount ?: '';
        $args['p3']            = '1';
        $args['t3']            = 'M'; // Monthly
        $args['src']           = '1'; // Recurring
        $args['sra']           = '1';
    } else {
        $args['cmd']           = '_donations';
        if ( $amount > 0 ) {
            $args['amount']    = number_format( $amount, 2, '.', '' );
        }
    }

    return ea_paypal_base_url() . '?' . http_build_query( $args );
}

/**
 * Is PayPal configured?
 */
function ea_paypal_configured(): bool {
    return ! empty( ea_paypal_email() );
}
