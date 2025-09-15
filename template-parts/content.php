<?php   
/*******************************************
 * Template part for displaying posts
 * @package RiteStay
 *******************************************/
?>


<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
    <article id="post-<?php the_ID()?>" <?php post_class('mb-5'); ?>>
        <?php
            get_template_part('template-parts/components/blog/entry-header');
            get_template_part('template-parts/components/blog/entry-meta');
            get_template_part('template-parts/components/blog/entry-content');
            get_template_part('template-parts/components/blog/entry-footer');
        ?>
    </article>
</div>