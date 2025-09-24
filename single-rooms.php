<?php get_header(); ?>

<?php
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        
        // Retrieve all ACF fields
        $ac_nonac = get_field('ac_nonac');
        $room_size = get_field('room_size');
        $number_of_guests = get_field('number_of_guests');
        $amenities = get_field('amenities');
        $room_description = get_field('room_description');
        
        // Retrieve images from ACF
        $image1 = get_field('room_image_1');
        $image2 = get_field('room_image_2');
        $image3 = get_field('room_image_3');
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="mb-4 text-center"><?php the_title(); ?></h1>
            
            <div class="mb-4">
                <?php if ($image1 || $image2 || $image3) : ?>
                    <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php if ($image1) : ?>
                                <div class="carousel-item active">
                                    <img src="<?php echo esc_url($image1['url']); ?>" class="d-block w-100" alt="<?php echo esc_attr($image1['alt']); ?>">
                                </div>
                            <?php endif; ?>
                            <?php if ($image2) : ?>
                                <div class="carousel-item">
                                    <img src="<?php echo esc_url($image2['url']); ?>" class="d-block w-100" alt="<?php echo esc_attr($image2['alt']); ?>">
                                </div>
                            <?php endif; ?>
                            <?php if ($image3) : ?>
                                <div class="carousel-item">
                                    <img src="<?php echo esc_url($image3['url']); ?>" class="d-block w-100" alt="<?php echo esc_attr($image3['alt']); ?>">
                                </div>
                            <?php endif; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mb-3">About this room</h2>
                    <?php if ($room_description) : ?>
                        <div class="room-description">
                            <?php echo wp_kses_post($room_description); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6">
                    <h2 class="mb-3">Room Details</h2>
                    <ul class="list-group list-group-flush">
                        <?php if ($room_size) : ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-expand-alt me-2"></i> Room Size:</span>
                                <span><?php echo esc_html($room_size); ?> sq. ft</span>
                            </li>
                        <?php endif; ?>
                        <?php if ($number_of_guests) : ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-users me-2"></i> Guests:</span>
                                <span><?php echo esc_html($number_of_guests); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if ($ac_nonac) : ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-snowflake me-2"></i> Room Type:</span>
                                <span><?php echo esc_html($ac_nonac); ?></span>
                            </li>
                        <?php endif; ?>
                    </ul>

                    <?php if ($amenities) : ?>
                        <h3 class="mt-4 mb-2">Amenities</h3>
                        <div class="d-flex flex-wrap">
                            <?php foreach ($amenities as $amenity) : ?>
                                <span class="badge bg-secondary me-2 mb-2"><?php echo esc_html($amenity); ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    }
}
?>

<?php get_footer(); ?>