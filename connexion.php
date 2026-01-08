<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Connexion / Inscription</title>
    <meta name="description" content="Contact page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        /* --- PERSONALISATION SELON TA CHARTE (#54b454) --- */

        body {
            background-color: #f4f4f4; /* Fond gris très léger pour faire ressortir la carte */
        }

        .auth-card {
            margin-top: 50px;
            margin-bottom: 50px;
            border: none;
            border-radius: 0; /* On garde des angles un peu plus carrés comme ton design */
        }

        /* --- DESIGN DES ONGLETS (TABS) --- */
        .card-header {
            background-color: white;
            border-bottom: 1px solid #ddd;
        }

        .nav-tabs .nav-link {
            color: #333; /* Texte gris foncé par défaut */
            font-weight: 600;
            border: none;
            border-bottom: 3px solid transparent;
            transition: 0.3s;
        }

        .nav-tabs .nav-link:hover {
            color: #54b454; /* Ton vert au survol */
        }

        .nav-tabs .nav-link.active {
            color: #54b454; /* Ton vert pour l'actif */
            border-bottom: 3px solid #54b454; /* Soulignement vert */
            background-color: transparent;
        }

        /* --- DESIGN DES CHAMPS DE SAISIE --- */
        .input-group-text {
            background-color: white;
            border-right: none;
            color: #54b454; /* Icône en vert */
        }

        .form-control {
            border-left: none;
        }

        /* On vire le halo bleu moche de Bootstrap au focus */
        .form-control:focus {
            box-shadow: none;
            border-color: #54b454; /* Bordure verte au clic */
        }

        /* Quand on clique dans le champ, l'icone et la bordure changent */
        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control {
            border-color: #54b454;
        }

        /* --- BOUTONS (Même logique que ta navbar) --- */
        .btn-scierie {
            background-color: #54b454;
            border: 1px solid #54b454;
            color: black; /* ou white selon préférence, j'ai mis black car ton nav-link est black */
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.3s;
        }

        /* Si tu préfères le texte blanc par défaut sur le bouton vert : */
        .btn-scierie { color: white; }

        /* Au survol : Fond blanc, texte vert (comme ta navbar) */
        .btn-scierie:hover {
            background-color: white;
            color: #54b454;
            border-color: #54b454;
        }

    </style>
</head>

<body>

<?php include "includes/navbar.php"; ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">

            <div class="card shadow auth-card">
                <div class="card-header p-0">
                    <ul class="nav nav-tabs nav-fill" id="authTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="login-tab" data-toggle="tab" href="#loginPanel" role="tab" aria-controls="loginPanel" aria-selected="true">
                                <i class="fas fa-sign-in-alt"></i> Connexion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="register-tab" data-toggle="tab" href="#registerPanel" role="tab" aria-controls="registerPanel" aria-selected="false">
                                <i class="fas fa-user-plus"></i> Inscription
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body p-4">
                    <?php
                    if (isset($_SESSION['errCnx']) && !empty($_SESSION['errCnx'])): ?>
                        <div class="alert alert-danger text-center"><?= $_SESSION['errCnx']; ?></div>
                        <?php unset($_SESSION['errCnx']); ?>
                    <?php endif; ?>

                    <?php
                    if (isset($_SESSION['creationOk']) && !empty($_SESSION['creationOk'])): ?>
                        <div class="alert alert-success text-center"><?= $_SESSION['creationOk']; ?></div>
                        <?php unset($_SESSION['creationOk']); ?>
                    <?php endif; ?>

                    <?php
                    if (isset($_SESSION['creationNok']) && !empty($_SESSION['creationNok'])): ?>
                        <div class="alert alert-danger text-center"><?= $_SESSION['creationNok']; ?></div>
                        <?php unset($_SESSION['creationNok']); ?>
                    <?php endif; ?>

                    <?php
                    if (isset($_SESSION['errMdp']) && !empty($_SESSION['errMdp'])): ?>
                        <div class="alert alert-warning text-center"><?= $_SESSION['errMdp']; ?></div>
                        <?php unset($_SESSION['errMdp']); ?>
                    <?php endif; ?>

                    <?php
                    if (isset($_SESSION['errId']) && !empty($_SESSION['errId'])): ?>
                        <div class="alert alert-danger text-center"><?= $_SESSION['errId']; ?></div>
                        <?php unset($_SESSION['errId']); ?>
                    <?php endif; ?>


                    <div class="tab-content" id="authTabContent">

                        <div class="tab-pane fade show active" id="loginPanel" role="tabpanel" aria-labelledby="login-tab">
                            <h4 class="text-center mb-4 mt-2" style="color:#54b454;">Connexion</h4>

                            <form action="controleur/traitementFormConnexion.php" method="POST">
                                <div class="form-group">
                                    <label for="idUtil">Identifiant</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="idUtil" id="idUtil" placeholder="Votre nom d'utilisateur" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="mdpUtil">Mot de Passe</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control" name="mdpUtil" id="mdpUtil" placeholder="Votre mot de passe" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-scierie btn-block mt-4">
                                    Se connecter
                                </button>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="registerPanel" role="tabpanel" aria-labelledby="register-tab">
                            <h4 class="text-center mb-4 mt-2" style="color:#54b454;">Inscription</h4>

                            <form action="controleur/traitementFormInscription.php" method="POST">
                                <div class="form-group">
                                    <label for="idUtilCreation">Identifiant souhaité</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-plus"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="idUtilCreation" id="idUtilCreation" placeholder="Ex: JeanDupont" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pwdCreation">Mot de Passe</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password"
                                               class="form-control"
                                               name="pwdCreation"
                                               id="pwdCreation"
                                               placeholder="Mot de passe fort"
                                               pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}"
                                               title="Doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial."
                                               required>
                                    </div>
                                    <small class="form-text text-muted">
                                        Min. 8 car., 1 Maj, 1 Min, 1 Chiffre, 1 Spécial.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="pwdBis">Confirmation</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                        </div>
                                        <input type="password" class="form-control" name="pwdBis" id="pwdBis" placeholder="Répétez le mot de passe" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-scierie btn-block mt-4">
                                    S'inscrire
                                </button>
                            </form>
                        </div>

                    </div> </div> </div> </div>
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
    });
</script>

</body>
</html>