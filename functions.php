<?php

function theme_enqueue_styles() {
    wp_enqueue_style('nathaliemota-style', get_stylesheet_directory_uri() . '/style.css', array(), '6.7.2');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

// Menu Principal
function register_my_menu() {
    register_nav_menu( 'main-menu', __( 'Menu principal', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_my_menu' );

// Menu pied de page
function register_footer_menu() {
    register_nav_menu( 'footer-menu', __( 'Menu du pied de page', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_footer_menu' );

// Modale
function nathaliemota_enqueue_scripts() {
    wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/js/scripts.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'nathaliemota_enqueue_scripts');

// Chargement photos AJAX

function load_more_photos() {
    // Vérifie qu'une page a été envoyée en AJAX
    if (isset($_POST['page'])) {
        $paged = $_POST['page'];

        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 8,
            'orderby' => 'date',
            'order' => 'DESC',
            'paged' => $paged,
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>

                <div class="photo-item">
                    <?php the_post_thumbnail('large'); ?>
                    <div class="overlay">
                        <a href="<?php the_permalink(); ?>" class="icon-eye-link">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icon_eye.png" alt="Voir" class="icon-eye">
                        </a>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icon_fullscreen.png" alt="Agrandir" class="icon-fullscreen">
                    </div>
                </div>

            <?php endwhile;
        endif;

        wp_reset_postdata();
    }

    die();
}
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos'); // Pour les visiteurs non connectés

// Inclure script.js et définir ajax_url 

function enqueue_custom_scripts() {
    wp_enqueue_script('custom-ajax', get_template_directory_uri() . '/assets/script.js', array('jquery'), null, true);
    wp_localize_script('custom-ajax', 'ajax_url', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// Récupérer les photos filtrées

function filter_photos() {
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
    $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';
    $sort = isset($_POST['sort']) ? sanitize_text_field($_POST['sort']) : 'date';

    $args = array(
        'post_type'      => 'photo',
        'posts_per_page' => 8,
        'orderby'        => 'date',
        'order'          => ($sort === 'oldest') ? 'ASC' : 'DESC',
        'tax_query'      => array('relation' => 'AND'),
    );

    if (!empty($category)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field'    => 'slug',
            'terms'    => $category,
        );
    }

    if (!empty($format)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field'    => 'slug',
            'terms'    => $format,
        );
    }

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
            <div class="photo-item">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('large'); ?>
                    <div class="overlay">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icon_eye.png" alt="Voir" class="icon-eye">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icon_fullscreen.png" alt="Agrandir" class="icon-fullscreen">
                    </div>
                </a>
            </div>
        <?php endwhile;
    else :
        echo '<p>Aucune photo disponible.</p>';
    endif;

    wp_reset_postdata();

    $response = ob_get_clean();
    echo $response;
    wp_die();
}

add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');


// Lightbox 

//function enqueue_lightbox_script() {
    //wp_enqueue_script('scripts-js', get_template_directory_uri() . '/js/scripts.js', array(), null, true);
//}
//add_action('wp_enqueue_scripts', 'enqueue_lightbox_script');
