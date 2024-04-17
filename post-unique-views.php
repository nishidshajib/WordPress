<?php
// Function to count post views by session
function count_post_views() {
    if (is_single()) {
        global $post;
        $post_id = $post->ID;
        
        // Check if the post ID is stored in the session
        $viewed_posts = isset($_SESSION['viewed_posts']) ? $_SESSION['viewed_posts'] : array();
        
        // If the post ID is not in the session, count the view and store the post ID in the session
        if (!in_array($post_id, $viewed_posts)) {
            $views = get_post_meta($post_id, 'post_views', true);
            $views = $views ? $views : 0;
            $views++;
            update_post_meta($post_id, 'post_views', $views);
            
            // Store the post ID in the session
            $_SESSION['viewed_posts'][] = $post_id;
        }
    }
}

// Initialize session
function start_session() {
    if (!session_id()) {
        session_start();
    }
}

// Create post views meta if not exists
function create_post_views_meta() {
    global $wpdb;
    $query = "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'post_views'";
    $post_ids = $wpdb->get_col($query);
    if (empty($post_ids)) {
        $posts = get_posts(array('post_type' => 'post', 'numberposts' => -1));
        foreach ($posts as $post) {
            add_post_meta($post->ID, 'post_views', 0, true);
        }
    }
}

// Hook into WordPress actions
add_action('init', 'start_session');
add_action('init', 'create_post_views_meta');
add_action('wp_head', 'count_post_views');
