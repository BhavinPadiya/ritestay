<?php
/*******************************************
 * Template for displaying post entry header
 * 
 * @package RiteStay
 *******************************************/
$the_post_id = get_the_ID();
$has_post_thumbnail = get_the_post_thumbnail($the_post_id);
?>

<header class="entry-header">
    <?php
    //featured image
    if ($has_post_thumbnail) {
        ?>
        <div class="entry-image mb-4">
            <a href="<?php echo esc_url(get_permalink());?>">
              <?php the_post_custom_thumbnail($the_post_id, 
              'featured-image', 
              [
                'sizes' => '(max-width: 350px) 350px, 800px', 
                'class' => 'img-fluid']);
                 ?>  
            </a>
        </div>
        <?php
    }
    ?>
</header>