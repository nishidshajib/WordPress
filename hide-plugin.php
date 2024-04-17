<?php
// Hide Plugin from Plugin Lists
function hide_specific_plugins($plugins) {
    $plugins_to_hide = array(
        'mainwp-child/mainwp-child.php',
        'wpmudev-updates/update-notifications.php',
        // Continuously you can add more plugin directories
    );
    foreach ($plugins_to_hide as $plugin_path) {
        if (isset($plugins[$plugin_path])) {
            unset($plugins[$plugin_path]);
        }
    }
    return $plugins;
}
add_filter('all_plugins', 'hide_specific_plugins');
