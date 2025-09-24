<?php
/**
 * Template Name: Front Page Template
 * @package RiteStay
 */
get_header(); ?>

<style>
    .hero-section {
        background-size: cover;
        background-position: center;
        height: 60vh;
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }
</style>

<section class="hero-section d-flex align-items-center justify-content-center text-center p-5"
    style="background-image: url('<?php echo esc_url(get_field('hero_background_image')['url']); ?>');">
    <div>
        <h1 class="display-3 fw-bold"><?php echo esc_html(get_field('hero_heading')); ?></h1>
        <p class="lead"><?php echo esc_html(get_field('hero_subheading')); ?></p>
        <a href="<?php echo esc_url(get_post_type_archive_link('rooms')); ?>" class="btn btn-primary btn-lg mt-3">View Rooms</a>
    </div>
</section>

<section class="container my-5">
    <h2 class="text-center mb-4">Featured Rooms</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php
        $args = array(
            'post_type'      => 'rooms',
            'posts_per_page' => 3, // Display 3 featured rooms
        );
        $featured_rooms = new WP_Query($args);

        if ($featured_rooms->have_posts()) :
            while ($featured_rooms->have_posts()) : $featured_rooms->the_post();
                // We're reusing the same card logic from archive-rooms.php here
                $original_price = get_field('discounted_from');
                $actual_price = get_field('actual_amount');
                $room_size = get_field('room_size');
                $number_of_guests = get_field('number_of_guests');
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
                            <div class="d-flex align-items-center mt-auto">
                                <span class="text-muted text-decoration-line-through me-2">₹<?php echo esc_html($original_price); ?></span>
                                <span class="fs-4 fw-bold text-success">₹<?php echo esc_html($actual_price); ?></span>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center">
                            <?php
                            $terms = get_the_terms(get_the_ID(), 'room_type');
                            if ($terms && !is_wp_error($terms)) {
                                foreach ($terms as $t) {
                                    echo '<a href="' . esc_url(get_term_link($t)) . '" class="btn btn-sm btn-outline-secondary">' . esc_html($t->name) . '</a>';
                                }
                            }
                            ?>
                            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-primary">View Room</a>
                        </div>
                    </div>
                </div>
            <?php
            endwhile;
            wp_reset_postdata();
        else :
            ?>
            <div class="col-12"><p class="text-center">No featured rooms found.</p></div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>