<?php
function wppm_project_shortcode()
{
    ob_start(); ?>
    <form id="project-filter">
        <div class="row">
            <div class="col-12 col-md-5 p-1">
                <select id="project-category" name="project_category[]" multiple style="width: 45%" placeholder="Select Project Categories">
                    <option value="">Select Market(s)</option>
                    <?php
                    $terms = get_terms(array('taxonomy' => 'project_category', 'hide_empty' => false));
                    foreach ($terms as $term) {
                        echo '<option value="' . esc_attr($term->slug) . '" data-badge="">' . esc_html($term->name) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="    d-sm-block d-md-none" style="height: 5px;">&nbsp;</div>
            <!-- Multi-Select Keywords -->
            <div class="col-12 col-md-5 p-1">
                <select id="project-keywords" name="keywords[]" multiple style="width: 45%"  placeholder="Select Keywords">
                    <option value="">Select Key Word(s)</option>
                    <?php
                    $keywords = get_terms(array('taxonomy' => 'project_keywords', 'hide_empty' => false));
                    foreach ($keywords as $keyword) {
                        echo '<option value="' . esc_attr($keyword->slug) . '"  data-badge="">' . esc_html($keyword->name) . '</option>';
                    }
                    ?>
                </select>  
            </div>
            <!-- <div class="   d-sm-block d-md-none" style="height: 5px;">&nbsp;</div>
            <div class="col-12 col-md-2 p-1">
                <button type="submit" id="filter-btn">Filter</button>
            </div> -->
        </div>    
    </form>

    <div id="project-results">
        <?php include plugin_dir_path(__FILE__) . '../templates/project-list.php'; ?>
    </div>

    <script>
        jQuery(document).ready(function($) {
    // Existing submit handler remains
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

    // NEW: Auto-select filter from URL
    const urlParams = new URLSearchParams(window.location.search);
    const filterValue = urlParams.get('filter');

    if (filterValue) {
        // Set the value on the select
        $('#project-category').val([filterValue]);  // wrap in array for multiple select
        $('#project-category').trigger('change');   // in case you have any JS binding

        // Auto-submit the form
        $('#project-filter').submit();
    }
});

        // jQuery(document).ready(function($) {
        //     $('#project-filter').on('submit', function(e) {
        //         e.preventDefault();
        //         var category = $('#project-category').val();
        //         var search = $('#project-search').val();

        //         $.ajax({
        //             url: '<?php echo admin_url('admin-ajax.php'); ?>',
        //             type: 'POST',
        //             data: {
        //                 action: 'wppm_filter_projects',
        //                 category: category,
        //                 search: search
        //             },
        //             success: function(response) {
        //                 $('#project-results').html(response);
        //             }
        //         });
        //     });
        // });
    </script>
<?php
    return ob_get_clean();
}
add_shortcode('project_list', 'wppm_project_shortcode');
