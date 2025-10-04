<?php get_header(); ?>

<div class="container">
    <?php
    $term = get_queried_object();
    echo '<h1>Rooms: ' . esc_html($term->name) . '</h1>';
    ?>
    <div class="row">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php
                $description = get_field('room_description');
                $trimmed_description = wp_trim_words($description, 20, '...');
                ?>
                <div class="col-md-4">
                    <div class="card">
                        <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'room-card-thumb'); ?>" class="card-img-top" alt="<?php the_title_attribute(); ?>">
                            <?php else : ?>
                                <img src="https://via.placeholder.com/400x300.png?text=Room+Image+Placeholder" class="card-img-top" alt="Placeholder Room Image">
                            <?php endif; ?>
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?php the_title(); ?></h5>
                            <?php if ($description) : ?>
                                <div class="card-text text-muted mb-3">
                                    <?php echo wp_kses_post($trimmed_description); ?>
                                </div>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">View Room</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <p>No rooms found for this category.</p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>