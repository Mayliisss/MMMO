<?php
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

			    	if($num_ligne > 0)
			    	{
				        header("Location: resultat_creation.html?x=0");
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
    <link href="css_creation_compte.css" rel="stylesheet" type="text/css"/>

    <title>Login</title>
    
</head>
<body>

    <!--entete, pas besoin de copier on prendra le code autre part -->
    <div>
        <!-- mettre logo -->
        <img src=".gif" alt="tout parcourir" height="100" width="300"> 
    </div>

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

    <!-- Footer avec navigation -->
    <footer>
        <div>
            <a href="accueil.html">retour à l'accueil</a> | 
        </div>
        <div>
            coordonnées?
        </div>
    </footer>
</body>
</html>
