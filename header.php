<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Site photographe freelance">
    <meta name="keywords" content="Photo event">

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="scripts.js"></script> -->

    <?php wp_head(); ?>

</head>

<body>

<header class="site-header">
    <div class="container">
        <div class="logo">
            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.png" alt="<?php bloginfo('name'); ?>">
            </a>
        </div>

        <nav class="main-nav">
            <?php
                wp_nav_menu(['theme_location' => 'main-menu',
            ]);
            ?>
        </nav>

        <!-- Bouton menu mobile -->
         <div class="menu-burger">
            <span class="line1"></span>
            <span class="line2"></span>
            <span class="line3"></span>
        </div>
        <div class="mobile-menu">
        <?php
            wp_nav_menu([
            'theme_location' => 'main-menu',
            'container' => false, // Empêche WP d’ajouter un div inutile
        ]);
        ?>
        </div>

    </div>

    <!-- Image du header sous la navigation -->
    <?php if (is_front_page()) : ?>
        <!-- Image du header, affichée uniquement sur la page d'accueil -->
    <div class="header-image">  
        <?php
        // Récupérer une image aléatoire depuis la médiathèque
        $args = array(
            'post_type'      => 'attachment',
            'post_mime_type' => 'image',
            'post_status'    => 'inherit',
            'posts_per_page' => -1, // Récupérer toutes les images
        );

        $query = new WP_Query($args);
        $random_image = get_template_directory_uri() . "/assets/header.jpeg"; // Image par défaut

        if ($query->have_posts()) {
            $images = array();
            while ($query->have_posts()) {
                $query->the_post();
                $image_url = wp_get_attachment_url(get_the_ID());

                if ($image_url) {
                    // Vérifier si l'image est en mode paysage (largeur > hauteur)
                    $image_size = getimagesize($image_url); // Récupérer les dimensions de l'image

                    if ($image_size[0] > $image_size[1]) { // Si la largeur est plus grande que la hauteur
                        $images[] = $image_url; // Ajouter l'image à la liste des images valides
                    }
                }
            }

        // Sélectionner une image aléatoire si la médiathèque contient des images
        if (!empty($images)) {
        $random_image = $images[array_rand($images)];
    }

    wp_reset_postdata();
}
?>

<div class="header-image">
    <img src="<?php echo esc_url($random_image); ?>" alt="Header Image">
    <div class="header-title">PHOTOGRAPHE EVENT</div>
</div>
    </div>
    <?php endif; ?>
</header>

<?php wp_footer(); ?>
</body>

</html>