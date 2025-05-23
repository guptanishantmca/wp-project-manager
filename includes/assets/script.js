jQuery(document).ready(function($) {
    // $('#project-category').select2({
    //     placeholder: "&nbsp;",
    //     allowClear: true,
    //    width: 'resolve'
    // });
    // $('#project-keywords').select2({
    //     placeholder: "&nbsp;",
    //     allowClear: true,
    //    width: 'resolve'
    // });

    $("#project-category").select2({
        closeOnSelect : false,
        placeholder : "Select Market",
        allowHtml: true,
        allowClear: true,
        width: 'resolve',
        tags: true //  
    });

    $("#project-keywords").select2({
        closeOnSelect : false,
        placeholder : "Select Service",
        allowHtml: true,
        allowClear: true,
        width: 'resolve',
        tags: true //   
    });
    // $('#filter-btn').on('click', function(e) {
    //     e.preventDefault();
    //     var categories = $('#project-category').val();
    //     var keywords = $('#project-keywords').val();

    //     $.ajax({
    //         url: wppm_ajax.ajaxurl, // Use the localized AJAX URL

    //         type: 'POST',
    //         data: {
    //             action: 'wppm_filter_projects',
    //             category: categories,
    //             keywords: keywords
    //         },
    //         success: function(response) {
    //             $('#project-results').html(response);
    //         }
    //     });
    // });

    
        function filterProjects() {
            let category = $('#project-category').val();
            let keywords = $('#project-keywords').val();
    
            $.ajax({
                url: wppm_ajax.ajaxurl, // WordPress AJAX URL
                type: 'POST',
                data: {
                    action: 'wppm_filter_projects',
                    category: category,
                    keywords: keywords
                },
                beforeSend: function() {
                    $('#project-results').html('<p>Loading projects...</p>');
                },
                success: function(response) {
                    $('#project-results').html(response); // Update project grid
                }
            });
        }
    
        $('#project-category, #project-keywords').on('change', function() {
            filterProjects();
        });
  
    
});
