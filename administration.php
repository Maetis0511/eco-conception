<?php
session_start();

// Vérification admin
if ((!(isset($_SESSION['id'])) || empty($_SESSION['id'])) && $_SESSION['role'] != "admin") {
    header("Location:connexion.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Administration</title>
    <meta charset="UTF-8" name="description" content="Administration">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="content/administration.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

</head>

<body>

<?php include "includes/navbar.php"; ?>

<div class="container-fluid admin-container">
    <main>
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
            <div class="col-lg-4 col-12 mb-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fa fa-edit"></i> Gestion Produit</h5>
                    </div>
                    <div class="card-body">
                        <form id="formProduit" method="post">
                            <input type="hidden" id="idProduit" name="idProduit" value="">

                            <div class="form-group">
                                <label for="lbProduit">Titre du produit</label>
                                <input type="text" class="form-control" id="lbProduit" name="lbProduit"
                                       placeholder="Ex: Chaise Deluxe" required>
                            </div>
                            <div class="form-group">
                                <label for="lbDescr">Description</label>
                                <textarea class="form-control" id="lbDescr" name="lbDescr" rows="3"
                                          placeholder="Description du produit..." required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="lbImg">Nom de l'image</label>
                                <input type="text" class="form-control" id="lbImg" name="lbImg"
                                       placeholder="Ex: chaise.jpg" required>
                            </div>
                            <hr>
                            <button type="submit" id="btnSave" name="action" value="save"
                                    class="btn btn-success btn-block">
                                <i class="fa fa-plus-circle"></i> Ajouter / Enregistrer
                            </button>
                            <button type="button" id="btnReset" class="btn btn-secondary btn-block">
                                <i class="fa fa-eraser"></i> Effacer / Nouveau
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-12">
                <div class="card shadow">
                    <div class="card-header text-white">
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
                                <tbody id="listeProduitsBody">
                                <tr>
                                    <td colspan="4" class="text-center"><i class="fa fa-spinner fa-spin"></i>
                                        Chargement...
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include "includes/footer.php"; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="scripts/initAdminTable.js"></script>

</body>
</html>