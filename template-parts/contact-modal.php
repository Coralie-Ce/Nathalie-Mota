<!-- Ouverture modale -->

<button id="open-modal">CONTACT</button>

<!-- Modale -->

<div id="maModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">X</span>
        <!--insérer image contact-->
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/contact-modal.png" alt="contact" />
        <?php echo do_shortcode('[contact-form-7 id="805bb4e" title="Formulaire de contact"]'); ?>
    </div>
</div>