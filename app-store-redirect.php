<?php
/*
Plugin Name: App Store Redirect
Description: Adds shortcodes for auto-redirecting users to the appropriate app store based on their device. And display Apple App Store and Google Play Store badges.
Version: 1.0
Author: Zakary Loney
*/

//Import shortcodes.php
require_once('shortcodes.php');

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Create the settings menu item and page
function device_redirect_menu() {
    add_menu_page(
        'App Links Settings',
        'App Links',
        'manage_options',
        'device-redirect-settings',
        'device_redirect_settings_page',
        'dashicons-admin-links',
        20
    );
}
add_action('admin_menu', 'device_redirect_menu');

// Display the settings page
function device_redirect_settings_page() {
    ?>
    <div class="wrap">
        <h1>App Links Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('device_redirect_settings_group');
            do_settings_sections('device-redirect-settings');
            submit_button();
            ?>
        </form>
        <h2>Available Shortcodes</h2>
        <p>Google Play and App Store badges are setup to follow the <a href="https://developer.apple.com/app-store/marketing/guidelines/">Apple Identity Guidelines</a> and <a href="https://partnermarketinghub.withgoogle.com/brands/google-play/visual-identity/badge-guidelines/">Google Play Brand Guidelines</a></p>
        <table class="widefat fixed" cellspacing="0">
  <thead>
    <tr>
      <th>Shortcode</th>
      <th>Attributes</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><code>[auto_device_redirect]</code></td>
      <td>N/A</td>
      <td>Automatically redirects users to the appropriate app store based on their device (iOS or Android). If the device is neither, it does nothing.</td>
    </tr>
    <tr>
      <td><code>[app_store_badge]</code></td>
      <td>
        <strong>size</strong> (default: 'sml')<br>
        <strong>apple_badge_color</strong> (default: 'black', options: 'black', 'white')
      </td>
      <td>Displays the Apple App Store badge.</td>
    </tr>
    <tr>
      <td><code>[google_play_badge]</code></td>
      <td>
        <strong>size</strong> (default: 'sml')
      </td>
      <td>Displays the Google Play Store badge.</td>
    </tr>
    <tr>
      <td><code>[both_badges]</code></td>
      <td>
        <strong>size</strong> (default: 'sml')<br>
        <strong>apple_badge_color</strong> (default: 'black', options: 'black', 'white')
      </td>
      <td>Displays both the Apple App Store and Google Play Store badges.</td>
    </tr>
  </tbody>
</table>

    </div>
    <?php
}

// Register and define the settings
function device_redirect_settings_init() {
    register_setting('device_redirect_settings_group', 'app_store_link');
    register_setting('device_redirect_settings_group', 'google_play_link');

    add_settings_section(
        'device_redirect_settings_section',
        '',
        null,
        'device-redirect-settings'
    );

    add_settings_field(
        'app_store_link',
        'App Store Link',
        'app_store_link_callback',
        'device-redirect-settings',
        'device_redirect_settings_section'
    );

    add_settings_field(
        'google_play_link',
        'Google Play Link',
        'google_play_link_callback',
        'device-redirect-settings',
        'device_redirect_settings_section'
    );
}
add_action('admin_init', 'device_redirect_settings_init');

function app_store_link_callback() {
    $app_store_link = get_option('app_store_link');
    echo '<input type="url" name="app_store_link" value="' . esc_attr($app_store_link) . '" class="regular-text">';
}

function google_play_link_callback() {
    $google_play_link = get_option('google_play_link');
    echo '<input type="url" name="google_play_link" value="' . esc_attr($google_play_link) . '" class="regular-text">';
}

function custom_styles_enqueue_style() {
    wp_enqueue_style('asb-custom-styles', plugins_url('style.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'custom_styles_enqueue_style');
?>
