<?php get_header(); ?>

<div class="container">
    <?php 
    $term = get_queried_object();
echo '<h1>Rooms: ' . esc_html( $term->name ) . '</h1>';
    ?>
    <div class="row">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-md-4">
                    <div class="card">
                        <?php the_post_thumbnail('medium', array('class' => 'img-fluid')); ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php the_title(); ?></h5>
                            <?php the_content(); ?>
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