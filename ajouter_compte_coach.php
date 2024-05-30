<?php
// Définissez le répertoire de destination pour les uploads
$target_dir = "image_coach/";

// Créez le répertoire s'il n'existe pas
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Récupérez les informations du formulaire
$Nom = isset($_POST["Nom"]) ? $_POST["Nom"] : "";
$Prenom = isset($_POST["Prenom"]) ? $_POST["Prenom"] : "";
$MDP = isset($_POST["MDP"]) ? $_POST["MDP"] : "";
$Email = isset($_POST["Email"]) ? $_POST["Email"] : "";
$specialite = isset($_POST["specialite"]) ? $_POST["specialite"] : "";

// Vérifiez si un fichier a été téléchargé
if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Vérifiez que le fichier est une image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // Vérifiez la taille du fichier (max 5MB)
        if ($_FILES["image"]["size"] <= 5000000) {
            // Autorisez certains formats de fichier
            if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif") {
                // Déplacez le fichier téléchargé vers le répertoire cible
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    // Connectez-vous à la base de données
                    $database = "projetpiscine";
                    $db_handle = mysqli_connect('localhost', 'root', 'root');
                    $db_found = mysqli_select_db($db_handle, $database);
                    
                    if ($db_found) {

                        $sql = "SELECT MAX(ID) AS max_id FROM Coach";
                        $result = mysqli_query($db_handle, $sql);

                        $row = mysqli_fetch_assoc($result);
                        $max_id = $row['max_id'];
                        $max_id += 1;




                        // Insérez les données dans la base de données
                        $sql = "INSERT INTO Coach (ID, Nom, Photo, Specialité, Video, CV, Email, MDP, Prenom) VALUES ('$max_id', '$Nom', '$target_file', '$specialite', 'aucune', 'aucune', '$Email', '$MDP', '$Prenom')";
                        if (mysqli_query($db_handle, $sql)) {
                            header("Location: resultat_creation.html?x=0");
                        } else {
                            header("Location: resultat_creation.html?x=1");
                        }
                    } 
                    else 
                    {
                        echo "Database not found";
                    }
                    
                    // Fermez la connexion
                    mysqli_close($db_handle);
                } else {
                    echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
                }
            } else {
                echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
            }
        } else {
            echo "Désolé, votre fichier est trop volumineux.";
        }
    } else {
        echo "Désolé, le fichier n'est pas une image.";
    }
}
else 
{
    echo "Aucun fichier n'a été téléchargé.";
}
?>
