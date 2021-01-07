// $ = jQuery

$(document).ready(function() {

    // Les sélecteurs "#" pour sélectionne une balise par son id et "." par sa class
    var editbutton = $('#edit_profile');
    var modifForm = $('.modifForm');
    var previewMode = $('.previewMode');
    //var updateprod = $('#updateprod');
    var backbutton = $('#backbutton');

    // Quand le bouton d'édition du produit est cliqué il fait disparaitre les données du produits pour laisser apparaitre un formulaire de modification du produits
    // /!\ Penser à faire un bouton "cancel"

    editbutton.click(function () {

        previewMode.hide();
        editbutton.hide();
        modifForm.show();
        backbutton.show();

    });

});