<?php
session_start();
if (isset($_SESSION['name']) && isset($_SESSION['nameDest'])) {
    $text = $_POST['text'];
    $expediteur = $_SESSION['name'];
    $destinataire = $_SESSION['nameDest'];

    $filename = strtolower(min($expediteur, $destinataire) . '_' . max($expediteur, $destinataire) . '_log.html');

    $text_message = "<div class='msgln'><span class='chat-time'>" . date("g:i A") . "</span> <b class='username'>" . $expediteur . "</b> " . stripslashes(htmlspecialchars($text)) . "<br></div>";
    $myfile = fopen($filename, "a") or die("Impossible d'ouvrir le fichier " . $filename);
    fwrite($myfile, $text_message);
    fclose($myfile);
}
?>
