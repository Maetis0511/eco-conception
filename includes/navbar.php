<nav class="navbar">
    <img src="./images/scierie.gif" alt='img' style="width:70px; margin:5px;">

    <li class="toggle">
        <ul class ="toggle-item"><i class="fa fa-bars menu" aria-hidden="true"> </i></ul>
    </li>
    <ul class="nav-links">
        <li class="nav-item"><a href="index.php">ACCUEIL</a></li>
        <li class="nav-item"><a href="produits.php">LES PRODUITS</a></li>
        <li class="nav-item"><a href="video.php">VIDEO</a></li>
        <li class="nav-item"><a href="contact.php">NOUS CONTACTER</a></li>
        <?php
        if (isset($_SESSION['id'])) {
            echo "<li class='nav-item'><a href='administration.php'>ADMINISTRATION</a></li>";
        }
        ?>
    </ul>

    <ul class="connexion">
        <?php
        if(isset($_SESSION['id'])) {
            echo "<li class='nav-item'><a href='deconnexion.php'>DECONNEXION</a></li>";
        }else{
            echo "<li class='nav-item'><a href='connexion.php'>CONNEXION</a></li>";
        }
        ?>
    </ul>
</nav>