<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Site photographe freelance">
    <meta name="keywords" content="Photo event">

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    </div>

    <!-- Image du header sous la navigation -->
    <?php if (is_front_page()) : ?>
        <!-- Image du header, affichée uniquement sur la page d'accueil -->
    <div class="header-image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/header.jpeg" alt="Header Image">
        <div class="header-title"> PHOTOGRAPHE EVENT
        </div>
    </div>
    <?php endif; ?>
</header>

<?php wp_footer(); ?>
</body>

</html>