<?php
session_start();

if ((!(isset($_SESSION['id'])) || empty($_SESSION['id'])) && $_SESSION['role'] != "admin") {
    header("Location:connexion.php");
    exit();
}

require_once("metier/DB_connector.php");
require_once("metier/Produit.php");
require_once("Dao/ProduitDao.php");

$cnx = new DB_Connector();
$jeton = $cnx->openConnexion();
$produitManager = new ProduitDao($jeton);
$produits = $produitManager->getList();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Administration</title>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="content/administration.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        .admin-container { margin-top: 30px; margin-bottom: 50px; }
        .card-header { background-color: #343a40; color: white; }
        .btn-action { margin: 0 5px; }
        .table img { max-width: 50px; height: auto; }
    </style>
</head>

<body>

<?php include "includes/navbar.php"; ?>
<div class="container-fluid admin-container">

    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <?php if (isset($_SESSION['msgOk'])): ?>
                <div class="alert alert-success"><?= $_SESSION['msgOk']; ?></div>
                <?php $_SESSION['msgOk'] = ""; ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['msgNok'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['msgNok']; ?></div>
                <?php $_SESSION['msgNok'] = ""; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fa fa-edit"></i> Gestion Produit</h5>
                </div>
                <div class="card-body">
                    <form id="formProduit" action="controleur/actionProduit.php" method="post">

                        <input type="hidden" id="idProduit" name="idProduit" value="">

                        <div class="form-group">
                            <label for="lbProduit">Titre du produit</label>
                            <input type="text" class="form-control" id="lbProduit" name="lbProduit" placeholder="Ex: Chaise Deluxe" required>
                        </div>

                        <div class="form-group">
                            <label for="lbDescr">Description</label>
                            <textarea class="form-control" id="lbDescr" name="lbDescr" rows="3" placeholder="Description du produit..." required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="lbImg">Nom de l'image</label>
                            <input type="text" class="form-control" id="lbImg" name="lbImg" placeholder="Ex: chaise.jpg" required>
                        </div>

                        <hr>

                        <button type="submit" id="btnSave" name="action" value="save" class="btn btn-success btn-block">
                            <i class="fa fa-plus-circle"></i> Ajouter / Enregistrer
                        </button>
                        <button type="button" id="btnReset" class="btn btn-secondary btn-block">
                            <i class="fa fa-eraser"></i> Effacer / Nouveau
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fa fa-list"></i> Liste des Produits actuels</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th>Image</th>
                                <th>Titre</th>
                                <th>Description</th>
                                <th class="text-center" style="width: 150px;">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($produits as $prod): ?>
                                <tr>
                                    <td>
                                        <img src="img/<?= $prod->getImage() ?>" alt="Img" class="img-thumbnail">
                                    </td>
                                    <td class="font-weight-bold"><?= $prod->getTitre() ?></td>
                                    <td><?= substr($prod->getDescription(), 0, 50) ?>...</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary btn-action btn-edit"
                                                data-id="<?= $prod->getId() ?>"
                                                data-titre="<?= htmlspecialchars($prod->getTitre()) ?>"
                                                data-descr="<?= htmlspecialchars($prod->getDescription()) ?>"
                                                data-img="<?= htmlspecialchars($prod->getImage()) ?>"
                                                title="Modifier">
                                            <i class="fa fa-pen"></i>
                                        </button>

                                        <form action="controleur/actionProduit.php" method="POST" style="display:inline-block;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                            <input type="hidden" name="idProduit" value="<?= $prod->getId() ?>">
                                            <button type="submit" name="action" value="delete" class="btn btn-sm btn-danger btn-action" title="Supprimer">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <?php if(empty($produits)): ?>
                                <tr><td colspan="4" class="text-center">Aucun produit trouvé.</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function(){

        $('.menu').click(function(){
            $('ul').toggleClass('active');
        });

        $('.btn-edit').click(function() {
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

        $('#btnReset').click(function() {
            $('#formProduit')[0].reset();
            $('#idProduit').val('');
            $('#btnSave').html('<i class="fa fa-plus-circle"></i> Ajouter / Enregistrer').removeClass('btn-warning').addClass('btn-success');
        });

    });
</script>

</body>
</html>