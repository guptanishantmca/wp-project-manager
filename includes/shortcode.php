<?php
function wppm_project_shortcode()
{
    ob_start(); ?>
    <form id="project-filter">
        <div class="row">
            <div class="col-12 col-md-5">
                <select id="project-category" name="project_category[]" multiple style="width: 45%">
                    <option value="">Select Project Categories</option>
                    <?php
                    $terms = get_terms(array('taxonomy' => 'project_category', 'hide_empty' => false));
                    foreach ($terms as $term) {
                        echo '<option value="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
                    }
                    ?>
                </select>
            </div>

            <!-- Multi-Select Keywords -->
            <div class="col-12 col-md-5">
                <select id="project-keywords" name="keywords[]" multiple style="width: 45%">
                    <option value="">Select Keywords</option>
                    <?php
                    $keywords = get_terms(array('taxonomy' => 'project_keywords', 'hide_empty' => false));
                    foreach ($keywords as $keyword) {
                        echo '<option value="' . esc_attr($keyword->slug) . '">' . esc_html($keyword->name) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-12 col-md-2">
                <button type="submit" id="filter-btn">Filter</button>
            </div>
        </div>
    </form>

    <div id="project-results">
        <?php include plugin_dir_path(__FILE__) . '../templates/project-list.php'; ?>
    </div>

    <script>
        jQuery(document).ready(function($) {
            $('#project-filter').on('submit', function(e) {
                e.preventDefault();
                var category = $('#project-category').val();
                var search = $('#project-search').val();

                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'wppm_filter_projects',
                        category: category,
                        search: search
                    },
                    success: function(response) {
                        $('#project-results').html(response);
                    }
                });
            });
        });
    </script>
<?php
    return ob_get_clean();
}
add_shortcode('project_list', 'wppm_project_shortcode');
