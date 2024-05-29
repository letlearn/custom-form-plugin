#Custom Form Plugin for WordPress
This plugin allows users to create and manage custom forms on their WordPress site. It is designed to be flexible and easy to integrate, providing a robust solution for form handling.

#Features
*Shortcode Support: Use shortcodes to embed forms anywhere on your site.

#Installation
*Download the plugin files.
Upload the plugin to your WordPress /wp-content/plugins/custom-form
*Activate the plugin through the 'Plugins' menu in WordPress.
Usage
To use the plugin, include the following PHP script in your theme or plugin files where you want to display the form:

php
Copy code
<?php
echo do_shortcode('[custom_form]');
?>
You can also customize the form by editing the contact-form.php file located in the includes directory. Here, you can define the form structure, field types, and validation rules.

#Support
For any issues or feature requests, please create an issue in the GitHub repository.

