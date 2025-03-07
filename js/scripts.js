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

document.addEventListener('DOMContentLoaded', function () {
    let thumbnailImage = document.createElement('img');
    thumbnailImage.classList.add('thumbnail-hover');
    document.body.appendChild(thumbnailImage);

    document.querySelectorAll('.prev, .next').forEach(link => {
        link.addEventListener('mouseover', function () {
            let imageSrc = this.getAttribute('data-thumbnail');
            if (imageSrc) {
                thumbnailImage.src = imageSrc;
                thumbnailImage.style.display = 'block';
            }
        });

        link.addEventListener('mousemove', function (e) {
            thumbnailImage.style.left = e.pageX + 10 + 'px';
            thumbnailImage.style.top = e.pageY + 10 + 'px';
        });

        link.addEventListener('mouseout', function () {
            thumbnailImage.style.display = 'none';
        });
    });
});


// Fonction pour récupérer l'URL de la miniature via un PHP script AJAX ou autre
function getThumbnailUrl(postId) {
    // Exemple d'appel pour obtenir la miniature via un AJAX ou une variable PHP.
    return '<?php echo get_the_post_thumbnail_url(postId, "thumbnail"); ?>';
}



// Ouverture popup avec jQuery 

jQuery(document).ready(function($) {
    // Sélectionne le bouton d'ouverture de la modale
    $("#openContactModal").on("click", function() {
        var reference = $(this).data("reference"); // Récupère la référence depuis data-reference
        console.log("Référence récupérée : " + reference);  // Vérifie si la référence est bien récupérée

        // Si la référence est récupérée, l'insérer dans le champ du formulaire
        if (reference) {
            $('input[name="ref-photo"]').val(reference);  // Assure-toi que le name du champ est correct
        }

        // Ouvrir la modale
        $(".contact-modal").fadeIn();
    });

    // Fermer la modale
    $(".close-modal").on("click", function() {
        $(".contact-modal").fadeOut();
    });
});

// Menu burger 

document.addEventListener("DOMContentLoaded", function () {
    const body = document.body;
    const menuBurger = document.querySelector(".menu-burger");
    const mobileMenu = document.querySelector(".mobile-menu");

    menuBurger.addEventListener("click", function () {
        mobileMenu.classList.toggle("open");
        menuBurger.classList.toggle("active");
        body.classList.toggle("no-scroll");
    });

    // Fermer le menu si on clique en dehors
    document.addEventListener("click", function (event) {
        if (
            !menuBurger.contains(event.target) &&
            !mobileMenu.contains(event.target)
        ) {
            mobileMenu.classList.remove("open");
            menuBurger.classList.remove("active");
            body.classList.remove("no-scroll");
        }
    });

    // Fermer le menu si on clique sur un lien du menu
    mobileMenu.querySelectorAll("a").forEach(link => {
        link.addEventListener("click", function () {
            mobileMenu.classList.remove("open");
            menuBurger.classList.remove("active");
            body.classList.remove("no-scroll");
        });
    });
});

// Script clic bouton Charger plus page d'accueil 

document.addEventListener("DOMContentLoaded", function () {
    let loadMoreBtn = document.getElementById("load-more");

    if (loadMoreBtn) {
        loadMoreBtn.addEventListener("click", function () {
            let currentPage = parseInt(loadMoreBtn.getAttribute("data-page"));
            let maxPage = parseInt(loadMoreBtn.getAttribute("data-max"));

            if (currentPage >= maxPage) {
                loadMoreBtn.style.display = "none";
                return;
            }

            let formData = new FormData();
            formData.append("action", "load_more_photos");
            formData.append("page", currentPage + 1);

            fetch(ajax_url, {
                method: "POST",
                body: formData,
            })
                .then((response) => response.text())
                .then((data) => {
                    let grid = document.querySelector(".photo-grid-homepage");
                    grid.insertAdjacentHTML("beforeend", data);

                    loadMoreBtn.setAttribute("data-page", currentPage + 1);

                    if (currentPage + 1 >= maxPage) {
                        loadMoreBtn.style.display = "none";
                    }
                })
                .catch((error) => console.error("Erreur AJAX :", error));
        });
    }
});


// Mise à jour dynamique de la galerie 

document.addEventListener("DOMContentLoaded", function () {
    const categoryFilter = document.getElementById("category-filter");
    const formatFilter = document.getElementById("format-filter");
    const sortFilter = document.getElementById("sort-filter");
    const photoContainer = document.getElementById("photo-container");

    function updatePhotos() {
        let formData = new FormData();
        formData.append("action", "filter_photos");
        formData.append("category", categoryFilter.value);
        formData.append("format", formatFilter.value);
        formData.append("sort", sortFilter.value);

        fetch(ajax_url, {
            method: "POST",
            body: formData,
        })
            .then((response) => response.text())
            .then((data) => {
                photoContainer.innerHTML = data;
            })
            .catch((error) => console.error("Erreur AJAX :", error));
    }

    categoryFilter.addEventListener("change", updatePhotos);
    formatFilter.addEventListener("change", updatePhotos);
    sortFilter.addEventListener("change", updatePhotos);
});

// Lightbox 


document.addEventListener("DOMContentLoaded", function() {
    const lightbox = document.getElementById("lightbox");
    const lightboxImage = document.getElementById("lightbox-image");
    const lightboxTitle = document.getElementById("lightbox-title");
    const closeButton = document.querySelector(".lightbox-close");
    const prevButton = document.querySelector(".lightbox-prev");
    const nextButton = document.querySelector(".lightbox-next");
    
    let currentIndex = 0;
    let images = [];

    // Fonction pour ouvrir la lightbox
    function openLightbox(imageSrc, title, index) {
        lightbox.style.display = "block";
        lightboxImage.src = imageSrc;
        lightboxTitle.textContent = title;
        currentIndex = index;
    }

    // Fonction pour fermer la lightbox
    function closeLightbox() {
        lightbox.style.display = "none";
    }

    // Afficher les photos avec boucle infinie

    function showPrev() {
        currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex - 1; // Si on est à la première image, on revient à la dernière
        updateLightboxContent();
    }

    function showNext() {
        currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex + 1; // Si on est à la dernière image, on revient à la première
        updateLightboxContent();
    }


    // Mettre à jour l'image et le titre
    function updateLightboxContent() {
        const { src, title } = images[currentIndex];
        lightboxImage.src = src;
        lightboxTitle.textContent = title;
    }

    // Ajouter les événements pour ouvrir et fermer la lightbox
    closeButton.addEventListener("click", closeLightbox);
    prevButton.addEventListener("click", showPrev);
    nextButton.addEventListener("click", showNext);

    // Récupérer toutes les images avec la classe 'icon-fullscreen' et ajouter un événement pour ouvrir la lightbox
    document.querySelectorAll(".icon-fullscreen").forEach((icon, index) => {
        icon.addEventListener("click", () => {
            const imageSrc = icon.getAttribute("data-fullsrc");
            const title = icon.getAttribute("data-title");
            
            // Créer un tableau d'images avec leurs informations
            images = [...document.querySelectorAll(".icon-fullscreen")].map(icon => ({
                src: icon.getAttribute("data-fullsrc"),
                title: icon.getAttribute("data-title"),
            }));
            
            openLightbox(imageSrc, title, index);
        });
    });

    // Fermer la lightbox en cliquant en dehors de l'image
    lightbox.addEventListener("click", (event) => {
        if (event.target === lightbox) {
            closeLightbox();
        }
    });
});



