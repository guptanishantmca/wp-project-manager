<?php
$args = array('post_type' => 'project', 'posts_per_page' => -1);
$query = new WP_Query($args);
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post(); ?>
        <div class="project-item">
            <h3><?php the_title(); ?></h3>
            <div><?php the_excerpt(); ?></div>
        </div>
    <?php }
} else {
    echo '<p>No projects found.</p>';
}
wp_reset_postdata();
?>
