<!-- Ouverture modale -->

<button id="open-modal">CONTACT</button>

<!-- Modale -->

<div id="maModal" class="modal">
    <div class="modal-content">
        <span class="close">X</span>
        <!--insérer image contact-->
        <img src="<?php echo esc_url(nathaliemota/assets/images/contact-modal.png); ?> alt="contact" />
        <?php echo do_shortcode('[contact-form-7 id="7fcb14e" title="Formulaire de contact"]'); ?>
    </div>
</div>