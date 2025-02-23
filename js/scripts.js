// Modale de contact

document.addEventListener("DOMContentLoaded", function () {
    console.log("Script chargé"); 
    
    const modal = document.getElementById("maModal");
    const openModal = document.querySelector(".open-modal"); 
    const openContactModal = document.getElementById("openContactModal"); // Sélectionne le bouton de la section contact
    const closeModal = document.querySelector(".close");
    const referenceField = document.querySelector('input[name="réf-photo"]');

    // Ouvrir la modale depuis le menu
    if (openModal) {
        openModal.addEventListener("click", function () {
            console.log("Le bouton du menu a été cliqué !");
            modal.style.display = "flex";
        });
    }

    // Ouvrir la modale depuis le bouton de la section contact
    if (openContactModal) {
        openContactModal.addEventListener("click", function () {
            console.log("Le bouton de la section contact a été cliqué !");
            const reference = this.getAttribute("data-reference");
            modal.style.display = "flex";

        });
    }

    
    // Fermer la modale
    if (closeModal) {
        closeModal.addEventListener("click", function () {
            modal.style.display = "none";
        });
    }

    // Fermer la modale si on clique à l'extérieur
    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});


// Miniatures dynamiques 



// Ouverture popup avec jQuery 




jQuery(document).ready(function($) {
    // Récupère le bouton
    var button = document.getElementById("openContactModal");

    // Ajoute l'événement de clic
    button.addEventListener("click", function() {
        var reference = this.getAttribute("data-reference");
        console.log("Référence récupérée : " + reference);  // Vérifie si la référence est bien récupérée

        // Si la référence est récupérée, insère-la dans le champ du formulaire avec jQuery
        if (reference) {
            $("#photo-reference").val(reference);
        }

        // Ouvrir la modale
        $(".contact-modal").fadeIn();
    });

    // Fermer la modale
    $(".close-modal").on("click", function() {
        $(".contact-modal").fadeOut();
    });
});


