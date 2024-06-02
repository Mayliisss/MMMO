
<!DOCTYPE html>
<head>
    <title>Sportify</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="sportify.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
    <script>
    
        function initMap() {
            var mapOptions = {
                center: { lat: 48.8566, lng: 2.3522 }, // Coordonées de Paris, modifiez selon votre besoin
                zoom: 12
            };
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);
        }
        </script>
</head>
<body>

     <?php
    $database = "projetpiscine";
    session_start();
    $User_Type=$_SESSION['User_Type'];
    /*
    if ($User_Type == Ad) {
        // code...
    }
    */

    $db_handle = mysqli_connect('localhost', 'root', 'root');
    $db_found = mysqli_select_db($db_handle, $database);

    $message = ""; // Variable pour stocker les messages à afficher
    $resultat_a_afficher = ""; // Variable pour stocker les résultats HTML
    $clientID = 3;
    $currentDate = date("Y-m-d");

    
    if (isset($_POST["button1"])) {
       
        if ($db_found) {
             // Remplacer par l'ID réel du client

            $sql = "SELECT * FROM rdv WHERE Numero_etudiant ='$clientID' OR ID_coach= '11' AND STR_TO_DATE(Date, '%Y-%m-%d') < CURDATE() ";
            $result = mysqli_query($db_handle, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $resultat_a_afficher .= "<div class='result-container'>";
                    $resultat_a_afficher .= "<p>Date: " . $row["Date"] . " - Horaire: " . $row["Horraire"] . " - Sport: " . $row["Sport"] . "</p>";
                    $resultat_a_afficher .= "</div>";
                }
            } else {
                $message = "Aucun rendez-vous trouvé.";
            }

            // Fermer la connexion
            mysqli_close($db_handle);
        } else {
            $message = "Erreur de connexion à la base de données.";
        }
    }elseif (isset($_POST['button2'])) {

        $sql = "SELECT * FROM rdv WHERE STR_TO_DATE(Date, '%Y-%m-%d') > CURDATE() AND (Numero_etudiant = '3' OR ID_coach = '11')";
        $result = mysqli_query($db_handle, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
           
            while ($row = mysqli_fetch_assoc($result)) {
                $resultat_a_afficher .= "<div class='result-container'>";
                $resultat_a_afficher .= "<p>Date: " . $row["Date"] . " - Horaire: " . $row["Horraire"] . " - Sport: " . $row["Sport"] . "</p>";
                $resultat_a_afficher .= "</div>";
            }
        } else {
            $message = "Aucun rendez-vous trouvé2.";
        }
    }

    // Si le bouton d'annulation est cliqué
    if (isset($_POST["button3"])) {
       
        if ($db_found) {
            $clientID = 3; // Remplacer par l'ID réel du client
            

            $sql = "DELETE FROM rdv WHERE ID_RDV = (
                    SELECT idToDelete FROM (
                        SELECT MAX(ID_RDV) as idToDelete 
                        FROM rdv 
                        WHERE Numero_etudiant = '3' OR ID_coach='10'
                    ) as subquery
                )";
             $result = mysqli_query($db_handle, $sql);

    if ($result) {
        $affectedRows = mysqli_affected_rows($db_handle);
        if ($affectedRows > 0) {
             $resultat_a_afficher="Le dernier rendez-vous a été supprimé avec succès.";
        } else {
            $resultat_a_afficher ="Pas de rendez-vous à supprimer.";
        }
    } else {
        echo "Erreur lors de la suppression : " . mysqli_error($db_handle);
    }
            

            // Fermer la connexion
            mysqli_close($db_handle);
        } 
    }
   
    ?>

<div id="mySidenav" class="sidenav">
  <a id="closeBtn" href="#" class="close">×</a>
  <ul>
    <li><a href="#">Accueil</a></li>
    <li><a href="#">Tout parcourir</a></li>
    <li><a href="#">Recherche</a></li>
    <li><a href="#">Rendez-vous</a></li>
    <li><a href="#">Votre compte</a></li>
  </ul>
</div>

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
            <img src='img/avatar/userGray.png' width="38" style="cursor: pointer;" onclick="afficherDivModal('divUserContainer');" />
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
            <img src="img/avatar/userGray.png" width="38"/>
            <br>Tu es connecté en tant que <b>Utilisateur</b><br>
            <button type="button" class="MonButton" onclick="afficherDiv(this,'formUser')">Se connecter</button>
            <div id="formUser" style="display:none;">
                <br>Connecte-toi ou crée un nouveu compte !<br>
                <label for="username">Pseudo (3-10) :</label>
                <input type="text" id="username" name="username" pattern=".{3,10}" required>
                <br>
                <label for="password">Password (3-10) :</label>
                <input type="password" id="password" name="password" pattern=".{3,10}" required>
                <br>
                <div class="divThemeBoxChoice">
                    <!-- Avatar selection loop -->
                    <label>
                        <img src='img/avatar/1.png' width="50">
                        <input type="radio" name="avatar" value="1" required>
                    </label>
                    <label>
                        <img src='img/avatar/2.png' width="50">
                        <input type="radio" name="avatar" value="2" required>
                    </label>
                    <label>
                        <img src='img/avatar/3.png' width="50">
                        <input type="radio" name="avatar" value="3" required>
                    </label>
                    <label>
                        <img src='img/avatar/4.png' width="50">
                        <input type="radio" name="avatar" value="4" required>
                    </label>
                    <label>
                        <img src='img/avatar/5.png' width="50">
                        <input type="radio" name="avatar" value="5" required>
                    </label>
                    <label>
                        <img src='img/avatar/6.png' width="50">
                        <input type="radio" name="avatar" value="6" required>
                    </label>
                    <label>
                        <img src='img/avatar/7.png' width="50">
                        <input type="radio" name="avatar" value="7" required>
                    </label>                                            
                    <!-- Add more avatar options as needed -->
                </div>
                <button type="button" class="MonButton" onclick="submitForm()">Login</button>
            </div>
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
    
            function submitForm() {
                // Récupérer les valeurs du formulaire
                var username = document.getElementById('username').value;
                var password = document.getElementById('password').value;
                var avatar = document.querySelector("input[name='avatar']:checked").value;

                // Vérifier si les champs sont bien renseignés
                if (!avatar) {
                    alert("Veuillez choisir un avatar !");
                    return;
                }

                // Vérifier la taille du nom d'utilisateur
                if (username.length < 3 || username.length > 10) {
                    alert("Le pseudo doit avoir entre 3 et 10 caractères.");
                    return;
                }

                // Vérifier la taille du mot de passe
                if (password.length < 3 || password.length > 10) {
                    alert("Le mot de passe doit avoir entre 3 et 10 caractères.");
                    return;
                }

                // Envoyer les données au script PHP via AJAX
                $.ajax({
                    type: "POST",
                    url: "login.php",
                    data: { username: username, password: password, avatar: avatar },
                    success: function(response) {
                        // Afficher la réponse du serveur (peut être un message de succès ou d'erreur)
                        alert(response);
                        window.location.href = "";
                    }
                });
            }
        </script>
    </div>
    
</div>
</div>
<!--fin burger menu et login  début navbar-->

    <nav class="navbar navbar-expand-md">
        
        <!--<a class="navbar-brand" href="#">Logo</a>-->
        <center><a href="logo.png"><img src="img/logo.png" class="logo" alt="logo", height=150 width=150></a></center>
        <span class="navbar-toggler-icon"></span>
        </button>
        
    </nav>
<hr>



 <form  action="" method="post" >
<table class ="tableau">
        
            
        <tr>
            <td>
               <input type="submit" name="button1" value="Historique de mes Rendez-vous">
            </td>
        </tr>
        <tr>
            <input type="submit" name="button2" value="Mon prochain rendez vous">
        </tr>
           
        <tr>
            <td>
                <input type="submit" name="button3" value="Annuler un rendez vous">
            </td>
        </tr>
        
</table>
</form>
<?php 
if (!empty($message)) {
        echo "<p>$message</p>";
    }

echo $resultat_a_afficher;
 ?>
 <!-- texte page -->
<center><h2> Voici vos prochains rendez-vous: </h2></center>
<h4>mettre futur rdv de la personne à aller chercher dans la base de données</h4>
 
<hr>
    <!-- Footer -->
    <footer>
        
    </footer>
<script src="sportify.js"></script>
</BODY>
</html>
