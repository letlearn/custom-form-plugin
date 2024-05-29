<?php
function cf_add_admin_menu() {
    add_menu_page(
        'Contact Form Submissions',
        'Contact Form',
        'manage_options',
        'cf_submissions',
        'cf_display_submissions',
        'dashicons-email',
        6
    );
}
add_action( 'admin_menu', 'cf_add_admin_menu' );

function cf_display_submissions() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cf_submissions';
    $results = $wpdb->get_results( "SELECT * FROM $table_name" );

    if ($wpdb->last_error) {
        echo '<div class="error"><p>Database error: ' . $wpdb->last_error . '</p></div>';
        error_log('Database error: ' . $wpdb->last_error);
        return;
    }

    // Enqueue DataTables scripts and styles
    wp_enqueue_script('jquery');
    wp_enqueue_script('datatables', 'https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js', array('jquery'), null, true);
    wp_enqueue_style('datatables-css', 'https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css');

    echo '<div class="wrap"><h1>Contact Form Submissions</h1>';
    echo '<table id="cf_submissions_table" class="display">
          <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Date</th><th>Action</th></tr></thead><tbody>';

    foreach ( $results as $row ) {
        echo '<tr>';
        echo '<td>' . $row->id . '</td>';
        echo '<td>' . $row->name . '</td>';
        echo '<td>' . $row->email . '</td>';
        echo '<td>' . $row->message . '</td>';
        echo '<td>' . $row->submitted_at . '</td>';
        echo '<td><form method="post" action=""><input type="hidden" name="submission_id" value="' . $row->id . '"><input type="submit" name="cf_delete_submission" value="Delete"></form></td>';
        echo '</tr>';
    }

    echo '</tbody></table></div>';

    echo '<script>
    jQuery(document).ready(function($) {
        $("#cf_submissions_table").DataTable();
    });
    </script>';
}
