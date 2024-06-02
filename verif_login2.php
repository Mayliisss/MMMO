<?php

	session_start();

	//identifier le nom de base de données
	$database = "projetpiscine";

	


	//connectez-vous dans votre BDD
	//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
	$db_handle = mysqli_connect('localhost', 'root', 'root' );
	$db_found = mysqli_select_db($db_handle, $database);
 	//si le BDD existe, faire le traitement
	if ($db_found) 
	{

		if(isset($_POST['button1']))
		{
			if(isset($_POST['user_type']) && isset($_POST['Login']) && isset($_POST['MDP'])) 
			{

				$UserType = isset($_POST["user_type"])? $_POST["user_type"] : "";
				$login = isset($_POST["Login"]) ? $_POST["Login"] : "";
		    	$MDP = isset($_POST["MDP"]) ? $_POST["MDP"] : "";
		    	$erreur = "" ;


		    	
		    	if(empty($UserType) || empty($login) || empty($MDP))
		    	{
		    		echo '<h1 style="background-color: #2E86C1; color: white; text-align: center; padding-top: 20px; padding-bottom: 20px; margin-left: 70px; margin-right: 70px; border-radius: 10px;">Informations manquantes</h1>';
		    	}
		    	else
		    	{

		    		if($UserType ==='Client') $sql = "SELECT * FROM Client WHERE Email='$login' AND Numero_etudiant='$MDP'";
		    		elseif ($UserType ==='Coach') $sql = "SELECT * FROM Coach WHERE Email='$login' AND MDP='$MDP'";
		    		else $sql = "SELECT * FROM Administrateur WHERE Email='$login' AND MDP='$MDP'";

		        		
		    		

		    		$result = mysqli_query($db_handle, $sql);
		        	$num_ligne = mysqli_num_rows($result);
		        	$row = mysqli_fetch_assoc($result);

			    	if($num_ligne > 0)
			    	{
	                    // Store user data in session
	                    $_SESSION['user_type'] = $UserType;
	                    $_SESSION['MDP'] = $MDP; // or another unique identifier
	                    $_SESSION['login'] = $login;
	                    $_SESSION['avatar_login'] = $row['Avatar'];
	                    $_SESSION['Nom_login'] = $row['Nom'];
	                    $_SESSION['Prenom_login'] = $row['Prenom'];


	                    // echo "<p>Utilisateur connecté en tant que ".$_SESSION['login']." (".$_SESSION['user_type']."), ID: ".$_SESSION['user_id']."</p>";



				        header("Location: resultat_creation.php?x=0");
				    }
				    else 
				    {
				        $erreur = "Adresse Mail ou Mots de passe incorrectes !";
				    }




		   		}
		   	}
	   	}
	}//end if
	//si le BDD n'existe pas
	else {
 		echo "Database not found";
	}//end else
	//fermer la connection
	mysqli_close($db_handle);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="sportify.css" rel="stylesheet" type="text/css"/>

    <title>Login</title>
    
</head>
<body>

    <div id="mySidenav" class="sidenav">
  		<a id="closeBtn" href="#" class="close">×</a>
	  	<ul>
		    <li><a href="accueil.php">Accueil</a></li>
		    <li><a href="#">Tout parcourir</a></li>
		    <li><a href="recherche.php">Recherche</a></li>
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
            <button type="button" class="MonButton" onclick="redirectToVerifLogin2()">Se connecter</button>

            <script>
            function redirectToVerifLogin2() {
                window.location.href = "verif_login2.php";
            }
            </script>


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

<!--Début navbar-->
<nav class="navbar navbar-expand-md">
    <!--<a class="navbar-brand" href="#">Logo</a>-->
    <center><a href="logo.png"><img src="img/logo.png" class="logo" alt="logo", height=150 width=150></a></center>
    <span class="navbar-toggler-icon"></span>
</nav>










	<div class="form_login">
    	<hr>
    
	    <h1>Connectez-vous !</h1>

	    <?php 
	       if(isset($erreur)){// si la variable $erreur existe , on affiche le contenu ;
	           echo "<p class= 'Erreur'>".$erreur."</p>"  ;
	       }
	    ?>

	    <form method="post">
	        <table border="1">




	            <tr>
	                <td>Type</td>
	                <td>
	                    <input type="radio" id="Client" name="user_type" value="Client" required>
	                    <label for="Client">Client</label>
	                    <input type="radio" id="Coach" name="user_type" value="Coach" required>
	                    <label for="Coach">Coach</label>
	                    <input type="radio" id="administrateur" name="user_type" value="administrateur" required>
	                    <label for="administrateur">Administrateur</label>
	                </td>
	            </tr>


	            <tr>
	                <td>Login</td>
	                <td><input type="text" name="Login" required></td>
	            </tr>
	            
	            <tr>
	                <td>Mot-de-passe</td>
	                <td><input type="password" name="MDP" required></td>
	            </tr>

	            
	            <tr>
	                <td colspan="2">
	                    <input type="submit" name="button1" value="Valider">
	                </td>
	            </tr>


	           


	        </table>
	    </form>

	    <a href="creation_compte.html">Inscription</a>


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
