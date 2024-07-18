<?php
// Create the shortcode function
function auto_device_redirect_shortcode() {
    $app_store_link = get_option('app_store_link');
    $google_play_link = get_option('google_play_link');

    ob_start();
    ?>
    <script>
      function redirectToStore() {
        // Get the user agent string
        var userAgent = navigator.userAgent || navigator.vendor || window.opera;

        // Check if the user is on an iOS device
        if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
          // Redirect to Apple App Store
          console.log('iOS device detected');
          window.location.href = "<?php echo esc_url($app_store_link); ?>";
        } 
        else if (/android/i.test(userAgent)) {
          // Redirect to Google Play Store
          console.log('Android device detected');
          window.location.href = "<?php echo esc_url($google_play_link); ?>";
        } 
      }

      // Call the function on page load
      window.onload = redirectToStore;
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('auto_device_redirect', 'auto_device_redirect_shortcode');

function app_store_badge_shortcode($atts) {
    $atts = shortcode_atts(array(
        'size' => 'sml',
        'apple_badge_color' => 'black'
    ), $atts, 'app_store_badge');

    $size_class = $atts['size'];
    $color = $atts['apple_badge_color'] === 'white' ? 'White' : 'Black';
    $app_store_link = get_option('app_store_link');

    if (empty($app_store_link)) {
        return '';
    }

    return '<div class="app-store-badges">
                <a href="' . esc_url($app_store_link) . '" class="app-store ' . esc_attr($size_class) . '">
                    <img src="' . esc_url(content_url() . '/plugins/app-store-redirect/badges/app_store/App_Store_Badge_' . $color . '.svg') . '" />
                </a>
            </div>';
}
add_shortcode('app_store_badge', 'app_store_badge_shortcode');

function google_play_badge_shortcode($atts) {
    $atts = shortcode_atts(array(
        'size' => 'sml'
    ), $atts, 'google_play_badge');

    $size_class = $atts['size'];
    $google_play_link = get_option('google_play_link');

    if (empty($google_play_link)) {
        return '';
    }

    return '<div class="app-store-badges">
                <a href="' . esc_url($google_play_link) . '" class="google-play ' . esc_attr($size_class) . '">
                    <img src="' . esc_url(content_url() . '/plugins/app-store-redirect/badges/play_store/Google_Play_Badge_Black.png') . '" />
                </a>
            </div>';
}
add_shortcode('google_play_badge', 'google_play_badge_shortcode');

function both_badges_shortcode($atts) {
    $atts = shortcode_atts(array(
        'size' => 'sml',
        'apple_badge_color' => 'black'
    ), $atts, 'both_badges');

    $size_class = $atts['size'];
    $color = $atts['apple_badge_color'] === 'white' ? 'White' : 'Black';
    $app_store_link = get_option('app_store_link');
    $google_play_link = get_option('google_play_link');

    $output = '<div class="app-store-badges">';

    if (!empty($google_play_link)) {
        $output .= '<a href="' . esc_url($google_play_link) . '" class="google-play ' . esc_attr($size_class) . '">
                        <img src="' . esc_url(content_url() . '/plugins/app-store-redirect/badges/play_store/Google_Play_Badge_Black.png') . '" />
                    </a>';
    }

    if (!empty($app_store_link)) {
        $output .= '<a href="' . esc_url($app_store_link) . '" class="app-store ' . esc_attr($size_class) . '">
                        <img src="' . esc_url(content_url() . '/plugins/app-store-redirect/badges/app_store/App_Store_Badge_' . $color . '.svg') . '" />
                    </a>';
    }

    $output .= '</div>';

    return $output;
}
add_shortcode('both_badges', 'both_badges_shortcode');
?>