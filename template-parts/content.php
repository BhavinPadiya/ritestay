<?php   
/*******************************************
 * Template part for displaying posts
 * @package RiteStay
 *******************************************/
?>


<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
    <article <?php post_class(); ?>>
        <h2 class="entry-title"><?php the_title(); ?></h2>
        <div class="entry-content">
            <?php the_excerpt(); ?>
        </div>
    </article>
</div>