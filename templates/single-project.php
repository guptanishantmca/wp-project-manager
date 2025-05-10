<?php get_header('project-detail'); ?>
<style>
    .parallax-background{
        background-image: url("/wp-content/uploads/2020/01/about4.jpg")!important;
    }
</style>

<div class="project-detail-container">

    <!-- Breadcrumb -->
    <!-- <nav class="breadcrumb">
        <a href="<?php echo home_url(); ?>">Home</a> &gt; 
        <a href="<?php echo get_post_type_archive_link('project'); ?>">Project Experience</a> &gt; 
        <span><?php the_title(); ?></span>
    </nav> -->

    <!-- Project Title -->
    <h1 class="project-title"><?php the_title(); ?></h1>

    <!-- Project Images (Slider) -->
  
        <?php
$gallery_images = get_post_meta(get_the_ID(), '_project_gallery', true);

if (!empty($gallery_images)) : ?>
    <div class="project-slider">
        <?php foreach ($gallery_images as $image_url) : ?>
            <div><img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>"></div>
        <?php endforeach; ?>
    </div>
 

    <?php elseif (has_post_thumbnail()): ?>
        <div class="project-image">
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="<?php the_title(); ?>">
        </div>
    <?php endif; ?>

    <!-- Project Details -->
    <div class="row">
    <div class="col-md-4 col-sm-12">
    <div class="project-info">
    <p style="padding-bottom:15px;"><strong>PROJECT LOCATION:</strong> <br>
    <?php 
        $project_location = get_field('project_location'); // Fetch ACF field
        echo (!empty($project_location)) ? esc_html($project_location) : 'Not Available'; 
        ?>
    </p>

    <p><strong>KEY WORDS:</strong> <br>
        <?php 
        $keywords = get_the_terms(get_the_ID(), 'project_keywords');
        if (!empty($keywords) && !is_wp_error($keywords)) {
            $keyword_list = wp_list_pluck($keywords, 'name'); 
            echo implode(', ', $keyword_list); 
        } else {
            echo 'Not Available';
        }
        ?>
    </p>
</div>

        </div>

    <!-- Project Description -->
    <div class="col-md-8 col-sm-12">
    <div class="project-description">
        <?php the_content(); ?>
        </div>
        </div>
        </div>

    <!-- Back to Project Experience -->
    <a href="<?php echo site_url('/project-experiences/'); ?>" class="back-button">< Back to Project Experience</a>

</div>

<?php get_footer(); ?>
