<footer>
    <nav class="footer-menu">
        <?php
        // Affiche le menu de pied de page WordPress
        wp_nav_menu([
            'theme_location' => 'footer-menu', // Spécifie l'emplacement du menu dans le thème
        ]);
        ?>
    </nav>
    <?php get_template_part('templates_part/modal-contact'); ?>

</footer>

<?php wp_footer(); ?>
</body>