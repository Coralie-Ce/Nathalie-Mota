<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Site photographe freelance">
    <meta name="keywords" content="Photo event">

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">

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

    // Inclure fichier template formulaire contact 
    </nav>

</header>

</body>

</html>