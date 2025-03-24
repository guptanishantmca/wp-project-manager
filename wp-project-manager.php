<?php
/**
 * Plugin Name: WP Project Manager
 * Plugin URI: https://iipnsolutions.com
 * Description: A custom plugin to manage projects with categories, filters, and extra fields.
 * Version: 1.0
 * Author: Nishant Gupta
 * Author URI: https://iipnsolutions.com
 * License: GPL v2 or later
 * Text Domain: wp-project-manager
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Include required files
require_once plugin_dir_path(__FILE__) . 'includes/post-type.php';
require_once plugin_dir_path(__FILE__) . 'includes/taxonomy.php';
require_once plugin_dir_path(__FILE__) . 'includes/meta-box.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';
function wppm_filter_projects() {
    $args = array(
        'post_type'      => 'project',
        'posts_per_page' => -1,
    );

    if (!empty($_POST['category'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'project_category',
                'field'    => 'slug',
                'terms'    => $_POST['category'],
            ),
        );
    }

    if (!empty($_POST['search'])) {
        $args['s'] = sanitize_text_field($_POST['search']);
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <div class="project-item">
                <h3><?php the_title(); ?></h3>
                <div><?php the_excerpt(); ?></div>
            </div>
            <?php
        }
    } else {
        echo '<p>No projects found.</p>';
    }
    wp_die();
}
add_action('wp_ajax_wppm_filter_projects', 'wppm_filter_projects');
add_action('wp_ajax_nopriv_wppm_filter_projects', 'wppm_filter_projects');

function wppm_enqueue_assets() {
    wp_enqueue_style('wppm-style', plugin_dir_url(__FILE__) . 'assets/style.css');
    wp_enqueue_script('wppm-script', plugin_dir_url(__FILE__) . 'assets/script.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'wppm_enqueue_assets');
