// Modale de contact
document.addEventListener("DOMContentLoaded", function () {
    
    console.log("Script chargé"); 
    
    const modal = document.getElementById("maModal");
    const openModal = document.getElementById("open-modal"); // Sélectionne le lien Contact
    const closeModal = document.querySelector(".close");

    if (openModal) {
        openModal.addEventListener("click", function () {
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