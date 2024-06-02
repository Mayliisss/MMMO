<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="sportify.css" rel="stylesheet" type="text/css"/>

    <title>Création d'un compte</title>
    
</head>
<body>

    <!--Menu côté-->
<div id="mySidenav" class="sidenav">
    <a id="closeBtn" href="#" class="close">×</a>
    <ul>
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="#">Tout parcourir</a></li>
        <li><a href="#">Recherche</a></li>
        <li><a href="#">Rendez-vous</a></li>
        <li><a href="#">Votre compte</a></li>
    </ul>
</div>

<!--Burger menu et connexion-->
<a href="#" id="openBtn">
    <span class="burger-icon">
        <span></span>
        <span></span>
        <span></span>
    </span>
</a>

<div class="divScore" id="scoreDiv">
    <table border="0">
        <tr>
            <td valign="middle">
                <?php
                if(isset($_SESSION['login'])) {
                    // L'utilisateur est connecté, afficher son avatar
                    $avatar_path = ''; // Initialisez le chemin de l'avatar
                    if(isset($_SESSION['avatar_login'])) {
                        // Récupérer le chemin de l'avatar depuis la session
                        $avatar_path = $_SESSION['avatar_login'];
                    }
                    echo '<img src="' . $avatar_path . '" width="38" style="cursor: pointer;" onclick="afficherDivModal(\'divUserContainer\');" />';
                } else {
                    // L'utilisateur n'est pas connecté, afficher l'avatar par défaut
                    echo '<img src="img/avatar/userGray.png" width="38" style="cursor: pointer;" onclick="afficherDivModal(\'divUserContainer\');" />';
                }
                ?>
            </td>
        </tr>
    </table>
    <div class="divThemeContainer" id="divUserContainer">
        <div class="divThemeHeader">
            <table width="100%">
                <tr>
                    <td align="left"><b>Profil</b></td>
                    <td align="right" style="cursor: pointer;" onclick="document.getElementById('divUserContainer').style.display = 'none';">✖</td>
                </tr>
            </table>
        </div>
        <div class="divThemeBody">
        <form id="loginForm" action="login.php" method="post">
            <!-- Check if user is logged in -->
            <?php
                if(isset($_SESSION['login'])) {
                    // L'utilisateur est connecté, afficher son avatar
                    $avatar_path = ''; // Initialisez le chemin de l'avatar
                    if(isset($_SESSION['avatar_login'])) {
                        // Récupérer le chemin de l'avatar depuis la session
                        $avatar_path = $_SESSION['avatar_login'];
                    }

                    echo '<img src="' . $avatar_path . '" width="38"/>';
                    echo '<br>Tu es connecté en tant que <b>' . $_SESSION['Nom_login']. ' ' .$_SESSION['Prenom_login'].'</b><br>';
                } else {
                    // L'utilisateur n'est pas connecté, afficher l'avatar par défaut
                    echo '<img src="img/avatar/userGray.png" width="38"/>';
                    echo '<br><b>Tu n es pas connecté !!</b><br>';
                    echo '<button type="button" class="MonButton" onclick="redirectToVerifLogin2()">Se connecter</button>';
                }
                ?>


            <!-- <img src="img/avatar/userGray.png" width="38"/> -->
            <!-- <br>Tu es connecté en tant que <b>Utilisateur</b><br> -->
            <!-- <button type="button" class="MonButton" onclick="redirectToVerifLogin2()">Se connecter</button> -->

            <script>
            function redirectToVerifLogin2() {
                window.location.href = "verif_login2.php";
            }
            </script>


            
        </form>
        <script>
            function afficherDiv(button, divId) {
                var div = document.getElementById(divId);
                if (div.style.display === "none" || div.style.display === "") {
                    div.style.display = "block";
                } else {
                    div.style.display = "none";
                }
            }
            
            function afficherDivModal(divId) {
                var div = document.getElementById(divId);
                if (div.style.display === "none" || div.style.display === "") {
                    div.style.display = "block";
                } else {
                    div.style.display = "none";
                }
            }
    
            
        </script>
    </div>
    </div>
</div>
<!--Fin burger menu et connexion-->

<!--Début navbar-->
<nav class="navbar navbar-expand-md">
    <!--<a class="navbar-brand" href="#">Logo</a>-->
    <center><a href="logo.png"><img src="img/logo.png" class="logo" alt="logo", height=150 width=150></a></center>
    <span class="navbar-toggler-icon"></span>
</nav>





    <div class="form_login">
        <hr>
            <script>
            // Récupération de la variable depuis l'URL
            var urlParams = new URLSearchParams(window.location.search);
            var x = urlParams.get('x');

            // Vérification de la valeur de la variable et affichage conditionnel de h1
            if (x == 0) {
                document.write("<h1>L'opération a été réalisé avec succès.</h1>");
            } 
            else {
                document.write("<h1>L'opération n'a malheureusement pas abouti, merci de ressayer</h1>");

            }
            </script>
        

        <hr>   
    </div> 

    <!-- Footer avec navigation -->
    <footer>
        <div class="gros-texte">
          <center><b>Nous contacter:</b><br> </center></div>
          <div>
          <center><table>
          <tr><td>mail: sportify@ece.fr </td></tr><br>
          <tr><td>téléphone: 07 83 75 06 24</td></tr> <br>
          <tr><td>adresse: 10 Rue Sextius Michel, 75015 Paris </td></tr><br></table></center>
          <br>
          <br>
        </div>
        <div class="boutton_retour_accueil"><a href="accueil.php">retour à l'accueil</a></div>
        
    </footer>


    
<script src="sportify.js"></script>

</body>
</html>
