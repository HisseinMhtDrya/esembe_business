//Afficher la date et l'heure 
function AfficherDateHeure(){
var joursemaine = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
var maintenant = new Date();
var jour = joursemaine[maintenant.getDay()];
var annee = maintenant.getFullYear();
var heure = maintenant.getHours();
var minutes = miantenant.getminutes();
var secondes = maintenant.getSeconde();
}
//Actualiser la page toutes les seoondes
setTimeout(AfficherDateHeure, 1000);
(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Bouton pour revenir en haut de la pge
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Sidebar Toggler
    $('.sidebar-toggler').click(function () {
        $('.sidebar, .content').toggleClass("open");
        return false;
    });
    // Sidebar Toggler
    $('.sidebar-toggler-right').click(function () {
        $('.sidebar-right, .content').toggleClass("open-right");
        return false;
    });

    // Progress Bar
    $('.pg-bar').waypoint(function () {
        $('.progress .progress-bar').each(function () {
            $(this).css("width", $(this).attr("aria-valuenow") + '%');
        });
    }, {offset: '80%'});


    // Calendrier
    $('#calender').datetimepicker({
        inline: true,
        format: 'L'
    });


    // Témoignages carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        items: 1,
        dots: true,
        loop: true,
        nav : false
    });


    
})(jQuery);

