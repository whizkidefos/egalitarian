<?php
/**
 * Template Name: Volunteer Page
 * File: wp-content/themes/egalitarian-association/page-volunteer.php
 *
 * Alias for Get Involved — same content, allows /volunteer slug.
 */

// Redirect to get-involved if that page exists
$get_involved = get_page_by_path('get-involved');
if ($get_involved) {
    wp_redirect(get_permalink($get_involved->ID), 301);
    exit;
}

// Fallback: render get-involved template directly
get_header();
include get_template_directory() . '/page-get-involved.php';
