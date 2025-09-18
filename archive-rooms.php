<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
    <header><h1>Rooms</h1></header>

    <div class="rooms-grid">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <a href="<?php the_permalink(); ?>">
                <?php if ( has_post_thumbnail() ) the_post_thumbnail('medium'); ?>
                <h2><?php the_title(); ?></h2>
            </a>

            <?php
            $terms = get_the_terms( get_the_ID(), 'room_type' );
            if ( $terms && ! is_wp_error( $terms ) ) {
                echo '<div class="room-types">';
                foreach ( $terms as $t ) {
                    echo '<a href="' . esc_url( get_term_link( $t ) ) . '">' . esc_html( $t->name ) . '</a> ';
                }
                echo '</div>';
            }
            ?>

            <div class="excerpt"><?php the_excerpt(); ?></div>
        </article>
    <?php endwhile; ?>
    </div>

    <?php the_posts_pagination(); ?>
<?php else: ?>
    <p>No rooms found.</p>
<?php endif; ?>

<?php get_footer(); ?>
