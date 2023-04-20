<?php
/**
 * Plugin Name: Custom Post Title 
 * Version: 1.0
 * Author: Marcial Hinojosa Esteva
 * Author URI: https://dmarkd.com 
 */

// Check if PHP version is 7.4 or higher, otherwise deactivate plugin
if (version_compare(PHP_VERSION, '7.4', '<')) {
    deactivate_plugins(plugin_basename(__FILE__));
    add_action('admin_notices', 'custom_post_title_php_version_notice');
    return;
}

// Display notice in admin about PHP version requirement
function custom_post_title_php_version_notice()
{
    $plugin_data = get_plugin_data(__FILE__);
    $plugin_name = $plugin_data['Name'];
    $required_php_version = '7.4';
    $installed_php_version = PHP_VERSION;
    $notice = sprintf(
        __('%1$s plugin requires PHP %2$s or higher to work, but your website is running PHP %3$s. Please upgrade your PHP version to at least %2$s.', 'custom-post-title'),
        $plugin_name,
        $required_php_version,
        $installed_php_version
    );
    echo '<div class="notice error"><p>' . $notice . '</p></div>';
}

// Add creation date of current post to post title
class Custom_Post_Title
{
    public function __construct()
    {
        add_filter('the_title', array($this, 'add_creation_date_to_title'), 10, 2);
    }

    public function add_creation_date_to_title($title, $post_id)
    {
        $post = get_post($post_id);
        $date_format = get_option('date_format'); // Get date format from WordPress settings
        $creation_date = date_i18n($date_format, strtotime($post->post_date));
        return $creation_date . ' - ' . $title;
    }
}

new Custom_Post_Title();