<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Coach CV</title>
</head>
<body>


<?php
session_start();
$idcoach=$_SESSION['idcoach'];
$database = "projetpiscine";
$db_handle = mysqli_connect('localhost', 'root', 'root');
$db_found = mysqli_select_db($db_handle, $database);

if($db_found){
    $sql = "SELECT Nom,Prenom FROM coach Where ID = '$idcoach'";
    $result = mysqli_query($db_handle, $sql);

    
      $row = mysqli_fetch_assoc($result);
      $nom = $row['Nom'];
       $prenom = $row['Prenom'];
     
        // Nom du fichier XML
        $xmlFileName = $prenom . "_" . $nom . ".xml";
        echo "$xmlFileName";


    }

$xml = simplexml_load_file($xmlFileName); // charger le fichier xml correspondant

if ($xml === false) {
    echo "Erreur de chargement du fichier XML";
    foreach(libxml_get_errors() as $error) {
        echo "<br>" . $error->message;
    }
} else {
    // Afficher les informations du cv 
    echo "<h2>Informations Personnelles</h2>";
    echo "Nom: " . $xml->InformationsPersonnelles->Nom . "<br>";
    echo "Email: " . $xml->InformationsPersonnelles->Email . "<br>";
    echo "Numéro de Téléphone: " . $xml->InformationsPersonnelles->NuméroTéléphone . "<br>";
    echo "Adresse: " . $xml->InformationsPersonnelles->Adresse->Rue . ", " .
                      $xml->InformationsPersonnelles->Adresse->Ville . ", " .
                      $xml->InformationsPersonnelles->Adresse->CodePostal . ", " .
                      $xml->InformationsPersonnelles->Adresse->Pays . "<br>";

    echo "<h2>Éducation</h2>";
    foreach ($xml->Éducation->Diplôme as $diplome) {
        echo "Titre: " . $diplome->Titre . "<br>";
        echo "Institution: " . $diplome->Institution . "<br>";
        echo "Année: " . $diplome->Année . "<br><br>";
    }

   
    echo "<h2>Expérience</h2>";
    foreach ($xml->Expérience->Emploi as $emploi) {
        echo "Titre: " . $emploi->Titre . "<br>";
        echo "Entreprise: " . $emploi->Entreprise . "<br>";
        echo "Lieu: " . $emploi->Lieu . "<br>";
        echo "Date Début: " . $emploi->DateDébut . "<br>";
        echo "Date Fin: " . $emploi->DateFin . "<br>";
        echo "Responsabilités: <br>";
        foreach ($emploi->Responsabilités->Responsabilité as $responsabilite) {
            echo "- " . $responsabilite . "<br>";
        }
        echo "<br>";
    }

    echo "<h2>Certifications</h2>";
    foreach ($xml->Certifications->Certification as $certification) {
        echo "Titre: " . $certification->Titre . "<br>";
        echo "Émetteur: " . $certification->Émetteur . "<br>";
        echo "Année: " . $certification->Année . "<br><br>";
    }

    // Afficher les compétences
    echo "<h2>Compétences</h2>";
    foreach ($xml->Compétences->Compétence as $competence) {
        echo "- " . $competence . "<br>";
    }
}?>
<center><button onclick="goBack()">Retour</button></center>

        <script>
            function goBack() {
                window.history.back();
            }
        </script>
</body>
</html>
