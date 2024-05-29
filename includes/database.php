<?php
function cf_create_database_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cf_submissions';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name tinytext NOT NULL,
        email varchar(100) NOT NULL,
        message text NOT NULL,
        submitted_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    if ($wpdb->last_error) {
        error_log('Database error: ' . $wpdb->last_error);
    }
}

function cf_save_submission( $data ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cf_submissions';

    $result = $wpdb->insert(
        $table_name,
        [
            'name' => sanitize_text_field( $data['cf_name'] ),
            'email' => sanitize_email( $data['cf_email'] ),
            'message' => sanitize_textarea_field( $data['cf_message'] ),
        ]
    );

    if ($result === false) {
        error_log('Database error: ' . $wpdb->last_error);
    }
}


function cf_delete_submission( $id ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cf_submissions';

    $wpdb->delete( $table_name, [ 'id' => intval( $id ) ] );

    if ($wpdb->last_error) {
        error_log('Database error: ' . $wpdb->last_error);
    }
}

if ( isset( $_POST['cf_delete_submission'] ) ) {
    cf_delete_submission( $_POST['submission_id'] );
}
