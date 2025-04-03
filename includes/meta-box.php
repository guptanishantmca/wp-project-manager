<?php 
function wppm_add_project_gallery_meta_box() {
    add_meta_box(
        'wppm_project_gallery',
        'Project Gallery',
        'wppm_project_gallery_callback',
        'project-experience',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'wppm_add_project_gallery_meta_box');

function wppm_project_gallery_callback($post) {
    $gallery_images = get_post_meta($post->ID, '_project_gallery', true);
    ?>
    <div id="project-gallery-container">
        <ul>
            <?php if (!empty($gallery_images)) :
                foreach ($gallery_images as $image_url) : ?>
                    <li>
                        <img src="<?php echo esc_url($image_url); ?>" width="100">
                        <input type="hidden" name="project_gallery[]" value="<?php echo esc_url($image_url); ?>">
                        <button class="remove-image">Remove</button>
                    </li>
                <?php endforeach;
            endif; ?>
        </ul>
    </div>
    
    <button id="add-gallery-images" class="button">Add Images</button>

    <script>
        jQuery(document).ready(function($) {
            $('#add-gallery-images').click(function(e) {
                e.preventDefault();
                var mediaUploader = wp.media({
                    title: 'Select Images',
                    button: { text: 'Add to Gallery' },
                    multiple: true
                }).on('select', function() {
                    var images = mediaUploader.state().get('selection');
                    images.each(function(image) {
                        var imageURL = image.toJSON().url;
                        $('#project-gallery-container ul').append(
                            '<li><img src="'+imageURL+'" width="100">' +
                            '<input type="hidden" name="project_gallery[]" value="'+imageURL+'">' +
                            '<button class="remove-image">Remove</button></li>'
                        );
                    });
                }).open();
            });

            $(document).on('click', '.remove-image', function(e) {
                e.preventDefault();
                $(this).parent().remove();
            });
        });
    </script>
    <?php
}

// Save the gallery images
function wppm_save_project_gallery($post_id) {
    if (isset($_POST['project_gallery'])) {
        update_post_meta($post_id, '_project_gallery', $_POST['project_gallery']);
    } else {
        delete_post_meta($post_id, '_project_gallery');
    }
}
add_action('save_post', 'wppm_save_project_gallery');
