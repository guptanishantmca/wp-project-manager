<?php get_header(); ?>

<div class="project-details">
    <h1><?php the_title(); ?></h1>

    <p><strong>Project Location:</strong> <?php echo get_post_meta(get_the_ID(), '_project_location', true); ?></p>
    
    <p><strong>Keywords:</strong> <?php echo get_post_meta(get_the_ID(), '_project_keywords', true); ?></p>

    <div class="project-description"><?php the_content(); ?></div>

    <a href="<?php echo get_post_type_archive_link('project'); ?>" class="back-button">← Back to Project Experience</a>
</div>

<?php get_footer(); ?>
