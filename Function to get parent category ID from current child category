<?php>
// Function to get parent category ID from current child category
function get_parent_category_id_shortcode() {
    // Get the current category object
    $current_category = get_queried_object();

    // Initialize variable to store parent category ID
    $parent_category_id = '';

    // Check if it's a valid category object
    if ($current_category instanceof WP_Term) {
        // Get the parent category ID
        $parent_category_id = $current_category->parent;
    }

    // Return the parent category ID
    return $parent_category_id;
}

// Register shortcode
add_shortcode('parent_category_id', 'get_parent_category_id_shortcode');
