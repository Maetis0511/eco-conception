<?php
session_start();
?>

<!DOCTYPE html>

<html lang="fr">

<head>
    <title>Accueil</title>

    <meta name="description" content="Index de la scierie">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
<!--*************** MENU ***************-->
<?php include "includes/navbar.php"; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {

        $('.menu').click(function () {

            $('ul').toggleClass('active');
        })
    })

</script>
<!--*************** END MENU ***************-->
<section>
    <?php
    include "includes/slider.php";
    ?>
</section>
<main>
    <?php
    include "controleur/initIndex.php";
    ?>
</main>
<!--*************** PIED DE PAGE ***************-->
<?php include "includes/footer.php"; ?>
<!--*************** PIED DE PAGE ***************-->
<script type="text/javascript" src="scripts/slider.js"></script>

</body>

</html>