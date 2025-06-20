<?php
function wppm_register_project_category_taxonomy() {
    $args = array(
        'label'        => 'Markets',
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

function wppm_register_project_market_keywords_taxonomy() {
    $args = array(
        'label'             => 'Services',
        'public'            => true,
        'hierarchical'      => false, // False makes it like "Tags"
        'show_admin_column' => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'project-market-keywords'),
    );
    register_taxonomy('project_market_keywords', 'project-experience', $args);
}
add_action('init', 'wppm_register_project_market_keywords_taxonomy');

function add_project_market_category_field($taxonomy) {
    $terms = get_terms('project_category', array('hide_empty' => false));
    ?>
    <div class="form-field">
        <label for="related_project_categories">Related Project Categories</label>
        <select name="related_project_categories[]" multiple style="min-width: 250px; height: 100px;">
            <?php foreach ($terms as $term) : ?>
                <option value="<?php echo esc_attr($term->term_id); ?>">
                    <?php echo esc_html($term->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <p class="description">Select related project categories for this market keyword.</p>
    </div>
    <?php
}
add_action('project_market_keywords_add_form_fields', 'add_project_market_category_field');

function edit_project_market_category_field($term, $taxonomy) {
    $selected = get_term_meta($term->term_id, 'related_project_categories', true);
    $selected = is_array($selected) ? $selected : [];

    $terms = get_terms('project_category', array('hide_empty' => false));
    ?>
    <tr class="form-field">
        <th scope="row"><label for="related_project_categories">Related Project Categories</label></th>
        <td>
            <select name="related_project_categories[]" multiple style="min-width: 250px; height: 100px;">
                <?php foreach ($terms as $project_term) : ?>
                    <option value="<?php echo esc_attr($project_term->term_id); ?>" <?php selected(in_array($project_term->term_id, $selected)); ?>>
                        <?php echo esc_html($project_term->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <p class="description">Select related project categories for this market keyword.</p>
        </td>
    </tr>
    <?php
}
add_action('project_market_keywords_edit_form_fields', 'edit_project_market_category_field', 10, 2);


function save_project_market_category_meta($term_id) {
    if (isset($_POST['related_project_categories']) && is_array($_POST['related_project_categories'])) {
        update_term_meta($term_id, 'related_project_categories', array_map('intval', $_POST['related_project_categories']));
    } else {
        delete_term_meta($term_id, 'related_project_categories');
    }
}
add_action('created_project_market_keywords', 'save_project_market_category_meta');
add_action('edited_project_market_keywords', 'save_project_market_category_meta');
