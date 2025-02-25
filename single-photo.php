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
<?php
if (has_post_thumbnail()) {
    echo '✅ Image trouvée pour ' . get_the_title();
} else {
    echo '❌ Aucune image mise en avant pour ' . get_the_title();
}
?>

    <?php
    // Récupération des catégories de la photo actuelle
    $categories = get_the_terms(get_the_ID(), 'categorie'); // Vérifie que 'categorie' est bien le slug correct

    if ($categories && !is_wp_error($categories)) {
        $category_ids = wp_list_pluck($categories, 'term_id'); // Récupère les IDs des catégories

        // WP_Query pour récupérer 2 autres photos de la même catégorie
        $args = array(
            'post_type'      => 'photos', // Vérifie que c'est bien le post type utilisé
            'posts_per_page' => 2, // On veut 2 photos apparentées
            'post__not_in'   => array(get_the_ID()), // Exclut la photo actuelle
            'tax_query'      => array(
                array(
                    'taxonomy' => 'categorie',
                    'field'    => 'term_id',
                    'terms'    => $category_ids,
                ),
            ),
        );

        $related_photos = new WP_Query($args);

        if ($related_photos->have_posts()) : ?>
            <div class="related-photos">
                <div class="photo-container">
                    <?php while ($related_photos->have_posts()) : $related_photos->the_post(); ?>
                        <div class="photo-item">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('large'); ?>
                            </a>
                            <div class="photo-hover-icons">
                                <a href="<?php the_permalink(); ?>" class="icon-eye">👁</a>
                                <a href="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" class="icon-fullscreen">⛶</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif;

        wp_reset_postdata(); // Reset WP Query
    }
    ?>
</div>



    

</main>


<?php
get_footer();
?>