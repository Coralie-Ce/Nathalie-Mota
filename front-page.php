<?php
/**
 * Modèle de page : Accueil
 * Description : Modèle de page pour l'accueil du site.
 */

get_header();
?>

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




<!-- Bloc photos -->

<div class="container-photos">
<?php include get_template_directory() . '/template-parts/photo-block.php'; ?>
</div>

<div class="more-content">
<button class="bouton-charger-plus">Charger plus</button>
</div>

<?php
get_footer();
?>