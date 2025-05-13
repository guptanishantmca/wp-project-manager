<?php
$args = array('post_type' => 'project-experience', 'posts_per_page' => -1);
$query = new WP_Query($args);

if ($query->have_posts()) {
    echo '<div class="project-grid">';
    while ($query->have_posts()) {
        $query->the_post();
        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium'); // Get Featured Image
        ?>
        <div class="project-item">
            <div class="project-image">
                <a href="<?php the_permalink(); ?>">
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>">
                </a>
            </div>
            <div class="project-info">
                <h3 style="display:inline;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>                <a href="<?php the_permalink(); ?>" class=" more">Read&nbsp;More&nbsp;→</a></p>
            </div>
        </div>
        <?php
    }
    echo '</div>';
} else {
    echo '<p>No projects found.</p>';
}
wp_reset_postdata();
?>

                <!-- <p><?php echo wp_trim_words(get_the_excerpt(), 15); ?>
		<a href="<?php the_permalink(); ?>" class=" more">Read More →</a> -->