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
                    $terms = get_the_terms(get_the_ID(), 'categorie');
                    if ($terms && !is_wp_error($terms)) {
                        $categories = wp_list_pluck($terms, 'name');
                        echo esc_html(implode(', ', $categories));
                    } else {
                        echo 'Non classé';
                    }
                    ?>
                </p>
                <p>FORMAT : 
    <?php 
    $terms = get_the_terms(get_the_ID(), 'format');
    if ($terms && !is_wp_error($terms)) {
        $formats = wp_list_pluck($terms, 'name');
        echo esc_html(implode(', ', $formats));
    } else {
        echo 'Non spécifié';
    }
    ?>
</p>
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
    // Récupérer le premier et dernier post
    $first_post = get_posts(array(
        'numberposts' => 1,
        'order' => 'ASC',
        'post_type' => 'photo' // Remplace 'photo' par le type de ton post si nécessaire
    ));
    $last_post = get_posts(array(
        'numberposts' => 1,
        'order' => 'DESC',
        'post_type' => 'photo' // Remplace 'photo' par le type de ton post si nécessaire
    ));

    // Vérifier s'il y a un précédent, sinon boucler vers le dernier
    $prev_post = get_previous_post();
    if (!$prev_post) {
        $prev_post = $last_post[0]; // Si pas de précédent, le dernier post
    }
    ?>

    <?php if ($prev_post) : ?>
        <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="prev">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/left-arrow.png" alt="Précédent">
        </a>
    <?php endif; ?>

    <?php 
    // Vérifier s'il y a un suivant, sinon boucler vers le premier
    $next_post = get_next_post();
    if (!$next_post) {
        $next_post = $first_post[0]; // Si pas de suivant, le premier post
    }
    ?>

    <?php if ($next_post) : ?>
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