<?php
/*
Plugin Name: Contact Form
Description: A custom contact form plugin with an admin dashboard, shortcode, and database saving functionality.
Version: 1.0
Author: Alfian
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Include necessary files
include_once plugin_dir_path( __FILE__ ) . 'includes/admin-dashboard.php';
include_once plugin_dir_path( __FILE__ ) . 'includes/shortcode.php';
include_once plugin_dir_path( __FILE__ ) . 'includes/database.php';

// Create database table on plugin activation
register_activation_hook( __FILE__, 'cf_create_database_table' );