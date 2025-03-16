<div id="photo-container" class="photo-grid-homepage">
        <?php
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 8, // Afficher toutes les photos
            'orderby' => 'date',
            'order' => 'DESC',
            'paged' => 1,
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>

                <div class="photo-item">
                        <?php the_post_thumbnail('large'); ?>
                        <div class="overlay">
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icon_eye.png" alt="Voir" class="icon-eye">
                            </a> 
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icon_fullscreen.png" alt="Agrandir" class="icon-fullscreen" data-fullsrc="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" 
                            data-title="<?php the_title(); ?>"> 
                        </div>
                  
                </div>

            <?php endwhile;
            wp_reset_postdata();
        else :
            echo '<p>Aucune photo disponible.</p>';
        endif;
        ?>
    </div>