<?php
function wppm_register_project_category_taxonomy() {
    $args = array(
        'label'        => 'Project Categories',
        'public'       => true,
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite'      => array('slug' => 'project-category'),
    );
    register_taxonomy('project_category', 'project-experience', $args);
}
add_action('init', 'wppm_register_project_category_taxonomy');


function wppm_register_project_keywords_taxonomy() {
    $args = array(
        'label'             => 'Project Keywords',
        'public'            => true,
        'hierarchical'      => false, // False makes it like "Tags"
        'show_admin_column' => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'project-keywords'),
    );
    register_taxonomy('project_keywords', 'project-experience', $args);
}
add_action('init', 'wppm_register_project_keywords_taxonomy');
