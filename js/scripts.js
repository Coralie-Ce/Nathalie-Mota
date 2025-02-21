// Modale de contact
document.addEventListener("DOMContentLoaded", function () {
    
    console.log("Script chargé"); 
    
    const modal = document.getElementById("maModal");
    const openModal = document.querySelector(".open-modal"); 
    const closeModal = document.querySelector(".close");

    if (openModal) {
        openModal.addEventListener("click", function () {
            console.log("Le bouton 'CONTACT' a été cliqué !"); 

            modal.style.display = "flex";
        });
    }

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

jQuery(document).ready(function ($) {
    $('#openContactModal').click(function () {
        var refPhoto = $(this).data('reference');
        $('#contactModal input[name="ref_photo"]').val(refPhoto);
        $('#contactModal').fadeIn();
    });

    $('.modal-close').click(function () {
        $('#contactModal').fadeOut();
    });
});
