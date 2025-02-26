<?php
/**
 * Modèle de page : Accueil
 * Description : Modèle de page pour l'accueil du site.
 */

get_header();
?>

<div class="hero">

<?php
// WP_Query pour récupérer une image aléatoire de la bibliothèque
$args = array(
    'post_type'      => 'attachment', // On cible les médias
    'posts_per_page' => 1, // On veut une seule image
    'orderby'        => 'rand' // Sélection aléatoire
);

$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $image_url = wp_get_attachment_url(get_the_ID());

        if ($image_url) {
            echo "<style>.hero { background-image: url('$image_url'); }</style>";
        } else {
            echo "<p>Aucune image trouvée.</p>";
        }
    }
} else {
    echo "<p>Aucune image disponible dans la médiathèque.</p>";
}

// Réinitialisation de la requête
wp_reset_postdata();
?>


</div>

<?php
get_footer();
?>