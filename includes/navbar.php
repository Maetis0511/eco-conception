<nav class="navbar">
    <img src="./images/scierie.gif" alt='img' style="width:70px; margin:5px;">

    <li class="toggle">
        <ul class="toggle-item"><i class="fa fa-bars menu" aria-hidden="true"></i></ul>
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

        <li class="nav-item mobile-auth">
            <?php
            if(isset($_SESSION['id'])) {
                echo "<a href='deconnexion.php' class='link-logout'>DECONNEXION</a>";
            } else {
                echo "<a href='connexion.php' class='link-login'>CONNEXION</a>";
            }
            ?>
        </li>
    </ul>

    <ul class="connexion desktop-auth">
        <?php
        if(isset($_SESSION['id'])) {
            echo "<li class='nav-item'><a href='deconnexion.php'>DECONNEXION</a></li>";
        } else {
            echo "<li class='nav-item'><a href='connexion.php'>CONNEXION</a></li>";
        }
        ?>
    </ul>
</nav>