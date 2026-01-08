$(document).ready(function () {

    function getXMLHttpRequest() {
        var xhr = null;
        if (window.XMLHttpRequest || window.ActiveXObject) {
            if (window.ActiveXObject) {
                try {
                    xhr = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
            } else {
                xhr = new XMLHttpRequest();
            }
        } else {
            alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
            return null;
        }
        return xhr;
    }

    var xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            document.getElementById("listeProduitsBody").innerHTML = xhr.responseText;
        }
    };

    xhr.open("POST", "controleur/initListeProduit.php", true);
    xhr.send(null);


    $(document).on('click', '.btn-edit', function () {
        var id = $(this).data('id');
        var titre = $(this).data('titre');
        var descr = $(this).data('descr');
        var img = $(this).data('img');

        $('#idProduit').val(id);
        $('#lbProduit').val(titre);
        $('#lbDescr').val(descr);
        $('#lbImg').val(img);

        $('#btnSave').html('<i class="fa fa-save"></i> Modifier le produit').removeClass('btn-success').addClass('btn-warning');

        $('html, body').animate({
            scrollTop: $("#formProduit").offset().top - 100
        }, 500);
    });

    $('#btnReset').click(function () {
        $('#formProduit')[0].reset();
        $('#idProduit').val('');
        $('#btnSave').html('<i class="fa fa-plus-circle"></i> Ajouter / Enregistrer').removeClass('btn-warning').addClass('btn-success');
    });

    $('.menu').click(function () {
        $('ul').toggleClass('active');
    });

});