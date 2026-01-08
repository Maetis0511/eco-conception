<?php
session_start();
?>
<!DOCTYPE html>

<html lang="fr">
<head>
    <meta name="description" content="Video de la scirie">
    <title>Vidéos</title>
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
<main>
    <div style="text-align: center;">
        <iframe
                width="500"
                height="281"
                src="https://www.youtube.com/embed/dbHXPnhCicI?autoplay=1&mute=1"
                title="YouTube video player"
                frameborder="0"
                allow="autoplay; accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>
        </iframe>
    </div>
</main>

<!--*************** PIED DE PAGE ***************-->
<?php include "includes/footer.php"; ?>
<!--*************** PIED DE PAGE ***************-->

</body>

</html>