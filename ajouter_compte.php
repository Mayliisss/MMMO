<?php
	//identifier le nom de base de données
	$database = "projetpiscine";
	//connectez-vous dans votre BDD
	//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
	$db_handle = mysqli_connect('localhost', 'root', 'root' );
	$db_found = mysqli_select_db($db_handle, $database);
 	//si le BDD existe, faire le traitement
	if ($db_found) {

		$Prenom = isset($_POST["Prenom"])? $_POST["Prenom"] : "";
		$Nom = isset($_POST["Nom"]) ? $_POST["Nom"] : "";
    	$Email = isset($_POST["Email"]) ? $_POST["Email"] : "";
    	$Numero_etudiant = isset($_POST["Numero_etudiant"]) ? $_POST["Numero_etudiant"] : "";
    	$Adresse = isset($_POST["Adresse"]) ? $_POST["Adresse"] : "";
    	$Avatar = isset($_POST["Avatar"]) ? $_POST["Avatar"] : "";

    	if(empty($Prenom) || empty($Nom) || empty($Email) || empty($Numero_etudiant) || empty($Adresse))
    	{
    		echo '<h1 style="background-color: #2E86C1; color: white; text-align: center; padding-top: 20px; padding-bottom: 20px; margin-left: 70px; margin-right: 70px; border-radius: 10px;">Informations manquantes</h1>';
    	}
    	else
    	{

    		$x=0;
    		$sql ="SELECT Numero_etudiant FROM Client";
    		$result = mysqli_query($db_handle, $sql);
    		while ($data = mysqli_fetch_assoc($result))
    		{
    			if ($data['Numero_etudiant'] === $Numero_etudiant) $x +=1;
    		}


    		if ($x===0) 
    		{
    			    		


				$sql = "INSERT INTO Client (Nom, Prenom, Email, Adresse, Numero_etudiant, Avatar)VALUES ('$Nom', '$Prenom', '$Email', '$Adresse' , '$Numero_etudiant' , '$Avatar')";
				$result = mysqli_query($db_handle, $sql);



	    		echo '<h1 style="background-color: #2E86C1; color: white; text-align: center; padding-top: 20px; padding-bottom: 20px; margin-left: 70px; margin-right: 70px; border-radius: 10px;">Add succesfull.</h1>';

	    		echo '<h1 style="background-color: black; color: white; text-align: center; padding-top: 20px; padding-bottom: 20px; margin-left: 70px; margin-right: 70px; border-radius: 10px;">Informations sur le livre ajouté</h1>';


		        
		    }
		    else
		    {
		    	echo '<h1 style="background-color: #2E86C1; color: white; text-align: center; padding-top: 20px; padding-bottom: 20px; margin-left: 70px; margin-right: 70px; border-radius: 10px;">Book already exists. Duplicates not allowed.</h1>';
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
