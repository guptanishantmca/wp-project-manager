jQuery(document).ready(function($) {
    $('#project-category, #project-keywords').select2({
        placeholder: "Select Project Categories",
        allowClear: true,
       width: 'resolve'
    });

    $('#filter-btn').on('click', function(e) {
        e.preventDefault();
        var categories = $('#project-category').val();
        var keywords = $('#project-keywords').val();

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'wppm_filter_projects',
                category: categories,
                keywords: keywords
            },
            success: function(response) {
                $('#project-results').html(response);
            }
        });
    });
});
