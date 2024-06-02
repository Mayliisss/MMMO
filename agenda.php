<?php
//identifier le nom de base de données
$database = "projetpiscine";
session_start();

// Vérifiez si 'idcoach' est défini dans la session
if (!isset($_SESSION['idcoach'])) {
    die("Erreur : ID du coach non défini dans la session.");
}

$idcoach = $_SESSION['idcoach'];



$sport=$_SESSION['sport'];

//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
 $db_handle = mysqli_connect('localhost', 'root', 'root' );
  
$db_found = mysqli_select_db($db_handle, $database);

 //si le BDD existe, faire le traitement
if ($db_found) {

   

        $sql = "SELECT Date, Horraire, Sport, duree FROM rdv WHERE ID_coach= '$idcoach'" ; //numero etudiant est censé correspondre à la durée 
        $result = mysqli_query($db_handle, $sql);
        
        // Traitement des données
        if ($result) {
            // Crée un tableau pour stocker les données
            $data = array();
            
            // Parcourt les résultats de la requête et les ajoute au tableau
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            
            // Encode le tableau en JSON
            $json_data = json_encode($data);
            
            // Affiche les données JSON
            header('Content-Type: application/json');
            echo $json_data;
        } else {
            // Affiche un message d'erreur si la requête a échoué
            echo "Query failed: " . mysqli_error($db_handle);
        }
        
    // Fermer la connexion
    mysqli_close($db_handle);
        
        
        
        
    }
?>
