jQuery(document).ready(function($) {
    $('#project-category').select2({
        placeholder: "Select Project Categories",
        allowClear: true,
       width: 'resolve',
       allowHtml: true,
	 
			tags: true
    });
    $('#project-keywords').select2({
        placeholder: "Select Keywords",
        allowHtml: true,
			allowClear: true,
			tags: true,
       width: 'resolve'
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
