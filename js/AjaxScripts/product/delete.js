$(document).ready(function () {
    var id = $("#myIdProduct").attr("value");
    $('#deleteprod').click(function () {
        $.ajax({
            url: '../services/products/deleteFromAdmin.php?id=' + id,
            // type: 'post',
            // data:id,
            success: function (element) {
                alert("La suppression du produit s'est terminé correctement, vous allez être redirigé vers la liste des produits");
                window.location.href("product.php");
            },
            error: function () {
                alert("Une erreur est survenue, réessayez plus tard");
                window.location.href('product.php');
            }
        });
    })

});