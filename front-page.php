<?php
/**
 * Modèle de page : Accueil
 * Description : Modèle de page pour l'accueil du site.
 */

get_header();
?>
<div class="photos-filtres-accueil">
<!-- Section filtres -->
<div class="filter-bar">
    <div class="filter-left">
    <!-- Section catégorie-->
    <select id="category-filter">
            <option value="">CATÉGORIES</option>
            <?php
            $categories = get_terms(array('taxonomy' => 'categorie', 'hide_empty' => true));
            foreach ($categories as $category) {
                echo '<option value="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</option>';
            }
            ?>
    </select>
    <!-- Section format -->
    <select id="format-filter">
            <option value="">FORMATS</option>
            <?php
            $formats = get_terms(array('taxonomy' => 'format', 'hide_empty' => true));
            foreach ($formats as $format) {
                echo '<option value="' . esc_attr($format->slug) . '">' . esc_html($format->name) . '</option>';
            }
            ?>
    </select>
    </div>
    <div class="filter-right">
<!-- Section trier par -->
    <select id="sort-filter">
            <option value="date">TRIER PAR</option>
            <option value="recent">Les plus récents</option>
            <option value="oldest">Les plus anciens</option>
    </select>
    </div>
</div>

<div class="photo-grid">
        <?php
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 8, // Afficher toutes les photos
            'orderby' => 'date',
            'order' => 'DESC',
        );

        $query = new WP_Query($args);

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
            wp_reset_postdata();
        else :
            echo '<p>Aucune photo disponible.</p>';
        endif;
        ?>
    </div>


<!-- Bloc photos -->

<div class="container-photos">
<?php include get_template_directory() . '/template-parts/photo-block.php'; ?>
</div>

</div>

<div class="more-content">
<button class="bouton-charger-plus">Charger plus</button>
</div>

<?php
get_footer();
?>