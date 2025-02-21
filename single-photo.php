<?php
/**
 * Template Name : Single Photo
 */

get_header();
?>

<main class="single-photo-container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="photo-content">
            
            <!-- Infos à gauche -->
            <div class="photo-info">
                <h2><em><?php the_title(); ?></em></h2>
                
                <p>RÉFÉRENCE : <?php echo esc_html(SCF::get('reference')); ?></p>
                <p>CATÉGORIE : 
                    <?php 
                    $terms = get_the_terms(get_the_ID(), 'categorie_photo');
                    if ($terms && !is_wp_error($terms)) {
                        $categories = wp_list_pluck($terms, 'name');
                        echo esc_html(implode(', ', $categories));
                    } else {
                        echo 'Non classé';
                    }
                    ?>
                </p>
                <p>FORMAT : <?php echo get_the_term_list(get_the_ID(), 'format', '', ', '); ?></p>
                <p>TYPE : <?php echo esc_html(SCF::get('type')); ?></p>
                <p>ANNÉE : <?php echo esc_html(SCF::get('annee') ?: 'Non spécifiée'); ?></p>
                
                
            </div>

            <!-- Image à droite -->
            <div class="photo-display">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="photo-frame">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
        <div class="contact-section">
                    <p>Cette photo vous intéresse ?</p>
                    <button id="openContactModal" data-reference="<?php echo esc_attr(SCF::get('reference')); ?>">Contact</button>
        
        <!-- Navigation entre les photos -->
        <div class="photo-navigation">
    <?php 
    $prev_post = get_previous_post();
    $next_post = get_next_post();

    if ($prev_post) :
    ?>
        <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="prev">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/left-arrow.png" alt="Précédent">
        </a>
    <?php endif; ?>

    <?php if ($next_post) :
    ?>
        <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="next">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/right-arrow.png" alt="Suivant">
        </a>
    <?php endif; ?>
    </div>
</div>


    <?php endwhile; endif; ?>
</main>


<?php
get_footer();
?>