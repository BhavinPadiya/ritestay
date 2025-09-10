<?php
get_header();
?>
<div class="primary">
    <main id="main" class="site-main mt-5" role="main">
        <?php if ( have_posts() ) : ?>
            <div class="container">
                <?php
                if ( is_home() && !is_front_page() ) {
                    ?>
                    <header class="mb-5">
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>
                    <?php
                }

                $index = 0;
                $no_of_columns = 3;

                // Loop through posts
                while ( have_posts() ) : the_post();

                    // Open a new row if index is divisible by number of columns
                    if ( $index % $no_of_columns === 0 ) {
                        if ( $index > 0 ) {
                            // Close previous row if not the first post
                            echo '</div>';
                        }
                        echo '<div class="row">';
                    }
                    ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <article <?php post_class(); ?>>
                            <h2 class="entry-title"><?php the_title(); ?></h2>
                            <div class="entry-content">
                                <?php the_excerpt(); ?>
                            </div>
                        </article>
                    </div>
                    <?php
                    $index++;

                endwhile;

                // Close the last row after loop ends
                if ( $index > 0 ) {
                    echo '</div>';
                }
                ?>
            </div>
        <?php else : ?>
            <?php get_template_part( 'template-parts/content', 'none' ); ?>
        <?php endif; ?>
    </main>
</div>
<?php
get_footer();
?>
