<!-- Ouverture modale -->

<button class="open-modal">CONTACT</button>

<!-- Modale -->

<div id="maModal" class="modal">
    <div class="modal-content">
        <span class="close">X</span>
        <!--insérer image contact-->
        <img class="img-formulaire" src="<?php echo get_template_directory_uri(); ?>/assets/contact-header.png" alt="contact" />
        <?php echo do_shortcode('[contact-form-7 id="805bb4e" title="Formulaire de contact"]'); ?>
    </div>
</div>