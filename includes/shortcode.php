<?php
// Create the contact form shortcode
function cf_contact_form_shortcode() {
    ob_start();
    ?>

    <form method="post" action="">
        <p>
            <label for="cf_name">Name</label>
            <input type="text" name="cf_name" required>
        </p>
        <p>
            <label for="cf_email">Email</label>
            <input type="email" name="cf_email" required>
        </p>
        <p>
            <label for="cf_message">Message</label>
            <textarea name="cf_message" required></textarea>
        </p>
        <p>
            <input type="submit" name="cf_submit" value="Send">
        </p>
    </form>

    <?php
    if ( isset( $_POST['cf_submit'] ) ) {
        cf_save_submission( $_POST );
    }

    return ob_get_clean();
}
add_shortcode( 'contact_form', 'cf_contact_form_shortcode' );
