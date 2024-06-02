<?php
session_start();
$idcoach = $_SESSION['idcoach'];
$sport=$_SESSION['sport'];
// Identifiez le nom de la base de données
$database = "projetpiscine";


// Connectez-vous à votre BDD
// Rappel : votre serveur = localhost | votre login = root | votre mot de passe = ''
$db_handle = mysqli_connect('localhost', 'root', 'root');
$db_found = mysqli_select_db($db_handle, $database);


if ($db_found) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<script>console.log('Hello from PHP');</script>";
        // Récupérer les données du formulaire
        $date = isset($_POST['date']) ? $_POST['date'] : "";
        $time = isset($_POST['time']) ? $_POST['time'] : "";
        $duree = 1; // Durée par défaut : 1 heure, peut être modifié selon vos besoins
          write_to_console("Received date: " . $date);
        write_to_console("Received time: " . $time);

        // Construire la requête SQL
        $sql = "INSERT INTO rdv (Numero_etudiant, ID_coach, Date , Horraire,Sport,duree,digicode) VALUES ('3','$idcoach','$date', '$time','$sport','$duree','1458')";
            if (mysqli_query($db_handle, $sql)) {
            write_to_console("Appointment booked successfully!");
        } else {
            write_to_console("Error: " . mysqli_error($db_handle));
        }
        
        // Exécuter la requête
        

        // Fermer la connexion
        mysqli_close($db_handle);
    }
} else {
    echo "Database not found.";
}
?>
