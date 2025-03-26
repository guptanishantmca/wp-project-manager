<?php get_header(); ?>

<div class="project-detail-container">

    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="<?php echo home_url(); ?>">Home</a> &gt; 
        <a href="<?php echo get_post_type_archive_link('project'); ?>">Project Experience</a> &gt; 
        <span><?php the_title(); ?></span>
    </nav>

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
    <div class="col-4">
    <div class="project-info">
        <p><strong>Project Location:</strong> <?php echo get_post_meta(get_the_ID(), '_project_location', true); ?></p>
        <p><strong>Keywords:</strong> <?php echo get_post_meta(get_the_ID(), '_project_keywords', true); ?></p>
        </div>
        </div>

    <!-- Project Description -->
    <div class="col-8">
    <div class="project-description">
        <?php the_content(); ?>
        </div>
        </div>
        </div>

    <!-- Back to Project Experience -->
    <a href="<?php echo get_post_type_archive_link('project'); ?>" class="back-button">← Back to Project Experience</a>

</div>

<?php get_footer(); ?>
