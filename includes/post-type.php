<?php
function wppm_register_project_post_type() {
    $labels = array(
        'name'          => 'Projects',
        'singular_name' => 'Project',
        'menu_name'     => 'Projects',
        'all_items'     => 'All Projects',
        'add_new'       => 'Add New',
        'add_new_item'  => 'Add New Project',
        'edit_item'     => 'Edit Project',
        'new_item'      => 'New Project',
    );

    $args = array(
        'label'               => 'Projects',
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'supports'            => array('title', 'editor', 'thumbnail'),
        'menu_icon'           => 'dashicons-portfolio',
        'rewrite'             => array('slug' => 'project-experience'),
    );

    register_post_type('project-experience', $args);
}
add_action('init', 'wppm_register_project_post_type');
