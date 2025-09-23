<?php get_header(); ?>

<div class="container my-5">
    <header>
        <h1 class="text-center">Rooms</h1>
    </header>

    <?php if (have_posts()) : ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php while (have_posts()) : the_post(); ?>
                <?php
                // Get custom fields using ACF functions
                $original_price = get_field('discounted_from');
                $actual_price = get_field('actual_amount');
                $room_size = get_field('room_size');
                $number_of_guests = get_field('number_of_guests');
                $description = get_field('room_description');
                $trimmed_description = wp_trim_words( $description, 20, '...' );
                ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'room-card-thumb'); ?>" class="card-img-top" alt="<?php the_title_attribute(); ?>">
                            <?php else : ?>
                                <img src="https://via.placeholder.com/400x300.png?text=Room+Image+Placeholder" class="card-img-top" alt="Placeholder Room Image">
                            <?php endif; ?>
                        </a>
                        <div class="card-body d-flex flex-column">
                            <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                <h5 class="card-title"><?php the_title(); ?></h5>
                            </a>
                            <?php if ($description) : ?>
                                <div class="card-text text-muted mb-3">
                                    <?php echo wp_kses_post($trimmed_description); ?>
                                </div>
                            <?php endif; ?>
                            <div class="d-flex mb-2 text-muted small">
                                <div class="me-3">
                                    <i class="fas fa-expand me-1"></i>
                                    <span><?php echo esc_html($room_size); ?> sq. ft</span>
                                </div>
                                <div>
                                    <i class="fas fa-users me-1"></i>
                                    <span><?php echo esc_html($number_of_guests); ?> Guests</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <span class="text-muted text-decoration-line-through me-2">₹<?php echo esc_html($original_price); ?></span>
                                <span class="fs-4 fw-bold text-success">₹<?php echo esc_html($actual_price); ?></span>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center">
                            <?php
                            $terms = get_the_terms(get_the_ID(), 'room_type');
                            if ($terms && ! is_wp_error($terms)) {
                                foreach ($terms as $t) {
                                    echo '<a href="' . esc_url(get_term_link($t)) . '" class="btn btn-sm btn-outline-secondary">' . esc_html($t->name) . '</a>';
                                }
                            }
                            ?>
                            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-primary">View Room</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="mt-5">
            <?php the_posts_pagination(); ?>
        </div>
    <?php else: ?>
        <p class="text-center">No rooms found.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>