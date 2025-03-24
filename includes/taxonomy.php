<?php
function wppm_register_project_category_taxonomy() {
    $args = array(
        'label'        => 'Project Categories',
        'public'       => true,
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite'      => array('slug' => 'project-category'),
    );
    register_taxonomy('project_category', 'project', $args);
}
add_action('init', 'wppm_register_project_category_taxonomy');
