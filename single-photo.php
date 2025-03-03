<?php
/**
 * Template Name : Single Photo
 */

get_header();
?>

<main class="single-photo-container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="photo-content full-width-border">
            
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
                <p>FORMAT : <?php 
                $terms = get_the_terms(get_the_ID(), 'format');
    if ($terms && !is_wp_error($terms)) {
        $formats = wp_list_pluck($terms, 'name');
        echo esc_html(implode(', ', $formats));
    } else {
        echo 'Non spécifié';
    }?>
                </p>
                <p>TYPE : <?php echo esc_html(SCF::get('type')); ?></p>
                <p>ANNÉE : <?php
            $year = get_the_date('Y');
            echo esc_html($year) . '</p>';
            ?></p>      
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
        <div class="contact-section full-width-border">
                    <p>Cette photo vous intéresse ?</p>
                    <button id="openContactModal" data-reference="<?php echo esc_attr(SCF::get('reference')); ?>">Contact</button>

        <!-- Navigation entre les photos -->
        
    <div class="photo-navigation">
    <?php 
    // Récupérer le premier et dernier post
    $first_post = get_posts(array(
        'numberposts' => 1,
        'order' => 'ASC',
        'post_type' => 'photo' 
    ));
    $last_post = get_posts(array(
        'numberposts' => 1,
        'order' => 'DESC',
        'post_type' => 'photo' 
    ));

    // Vérifier s'il y a un précédent, sinon boucler vers le dernier
    $prev_post = get_previous_post();
    if (!$prev_post) {
        $prev_post = $last_post[0]; // Si pas de précédent, le dernier post
    }
    ?>

<?php if ($prev_post) : ?>
        <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="prev"
           data-thumbnail="<?php echo get_the_post_thumbnail_url($prev_post->ID, 'thumbnail'); ?>">
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
        <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="next"
           data-thumbnail="<?php echo get_the_post_thumbnail_url($next_post->ID, 'thumbnail'); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/right-arrow.png" alt="Suivant">
        </a>
    <?php endif; ?>
    
    <?php endwhile; endif; ?>
</div>

</div>

<div class="photos-related">
    <h2>VOUS AIMEREZ AUSSI</h2>
</div>


<div class="bloc-photos">
  <div class="photo-grid">
<?php
// 1. Récupère les termes de la catégorie de l'article actuel
$terms = get_the_terms($post->ID, 'categorie');
if ($terms && !is_wp_error($terms)) {
    $term_slugs = array();
    foreach ($terms as $term) {
        $term_slugs[] = $term->slug; // Récupère le slug de chaque terme
    }

    // 2. On définit les arguments pour la WP_Query
    $args = array(
        'post_type' => 'photo',
        'post__not_in' => array($post->ID), // Exclut la photo actuelle
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie', // Taxonomie à utiliser
                'field' => 'slug',
                'terms' => $term_slugs, // Utilise les slugs des termes récupérés
                'operator' => 'IN', // Inclut tous les termes correspondants
            ),
        ),
        'posts_per_page' => 2, // Limite à 2 photos
    );

    // 3. Exécute la WP Query
    $my_query = new WP_Query($args);

    // 4. Affiche les résultats
    if ($my_query->have_posts()) :
        while ($my_query->have_posts()) : $my_query->the_post();?>
        <div class="photo-item">
        <?php the_post_thumbnail('large'); ?>
        <div class="overlay">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/icon_eye.png" alt="Voir" class="icon-eye">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/icon_fullscreen.png" alt="Agrandir" class="icon-fullscreen">
        </div>
    </div>
        <?php endwhile;
    else :
        echo 'Aucune photo trouvée dans cette catégorie.';
    endif;

    // 5. Réinitialise la requête
    wp_reset_postdata();
}
?>


</div>
</div>


    

</main>


<?php
get_footer();
?>