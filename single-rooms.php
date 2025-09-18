<?php get_header(); ?>

<?php
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h1><?php the_title(); ?></h1>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="room-featured"><?php the_post_thumbnail('large'); ?></div>
            <?php endif; ?>

            <div class="room-meta">
                <?php
                $terms = get_the_terms( get_the_ID(), 'room_type' );
                if ( $terms && ! is_wp_error( $terms ) ) {
                    $links = array();
                    foreach ( $terms as $term ) {
                        $links[] = sprintf(
                            '<a href="%1$s">%2$s</a>',
                            esc_url( get_term_link( $term ) ),
                            esc_html( $term->name )
                        );
                    }
                    echo '<div class="room-types">Type: ' . implode( ', ', $links ) . '</div>';
                }
                ?>
            </div>

            <div class="room-content">
                <?php the_content(); ?>
            </div>

            <!-- Example meta field usage (if you later add price meta) -->
            <?php
            $price = get_post_meta( get_the_ID(), '_room_price', true );
            if ( $price ) {
                echo '<div class="room-price">Price: ₹' . esc_html( $price ) . '</div>';
            }
            ?>
        </article>

        <?php
    }
}
?>

<?php get_footer(); ?>
