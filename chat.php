<?php
session_start();


$userType = $_SESSION['user_type'];
$MDP = $_SESSION['MDP'];
$login = $_SESSION['login'];
// echo "_".$userType."_";
// echo "_".$MDP."_";
// echo "_".$login."_";



function getPrenomFromDatabase() {
    // Identifier le nom de base de données
    $database = "projetpiscine";
    // Connectez-vous à votre BDD
    $db_handle = mysqli_connect('localhost', 'root', 'root');
    $db_found = mysqli_select_db($db_handle, $database);
    // Si le BDD existe, faire le traitement
    if ($db_found) {
        // Exécuter la requête SQL pour obtenir le prénom
        // $sql = "SELECT Prenom FROM Client WHERE Numero_etudiant = 1";
        if($_SESSION['user_type'] === 'Client') $sql = "SELECT Prenom FROM Client WHERE Numero_etudiant = ".$_SESSION['MDP']."";
        elseif($_SESSION['user_type'] === 'Coach') $sql = "SELECT Prenom FROM Coach WHERE MDP = '".$_SESSION['MDP']."' AND Email = '".$_SESSION['login']."'";
        else echo "merdeeeeeee";
        



        // $sql = "SELECT Prenom FROM $userType WHERE ID = 13";
        $result = mysqli_query($db_handle, $sql);
        // Vérifier si la requête a retourné un résultat
        if ($result && mysqli_num_rows($result) > 0) {
            // Récupérer le prénom
            $data = mysqli_fetch_assoc($result);
            mysqli_close($db_handle);
            return $data['Prenom'];
        } 
        else {
            echo "Aucun étudiant trouvé avec le numéro d'étudiant 1.";
        }
    } else {
        echo "Database not found";
    }
    // Fermer la connexion
    mysqli_close($db_handle);
    return null;
}


function PrenomDestinataire()
{
    // Identifier le nom de base de données
    $database = "projetpiscine";
    // Connectez-vous à votre BDD
    $db_handle = mysqli_connect('localhost', 'root', 'root');
    $db_found = mysqli_select_db($db_handle, $database);
    // Si le BDD existe, faire le traitement
    if ($db_found) {
        // Exécuter la requête SQL pour obtenir le prénom
        // $sql = "SELECT Prenom FROM Coach WHERE ID = 13";
        $sql = "SELECT Prenom FROM Client WHERE Numero_etudiant = 1";
        $result = mysqli_query($db_handle, $sql);
        // Vérifier si la requête a retourné un résultat
        if ($result && mysqli_num_rows($result) > 0) {
            // Récupérer le prénom
            $data = mysqli_fetch_assoc($result);
            mysqli_close($db_handle);
            return $data['Prenom'];
        } else {
            echo "Aucun étudiant trouvé avec le numéro d'étudiant 1.";
        }
    } else {
        echo "Database not found";
    }
    // Fermer la connexion
    mysqli_close($db_handle);
    return null;


}


// Récupérer le prénom de l'étudiant et le stocker dans la session si ce n'est pas déjà fait
if (!isset($_SESSION['name'])) {
    $prenom = getPrenomFromDatabase();
    if ($prenom) {
        $_SESSION['name'] = $prenom;
    } else {
        echo '<span class="error">Impossible de récupérer le prénom de l\'étudiant.</span>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Exemple Chat Texto</title>
    <link rel="stylesheet" href="style_chat.css" />

</head>
<body>
    <?php if (isset($_SESSION['name'])): ?>

        <button id="Boutton_Apparition">CHATBOX</button>
        <?php
            $prenom = getPrenomFromDatabase();
            $Prenom_dest = PrenomDestinataire();
            $_SESSION['name'] = $prenom;
            $_SESSION['nameDest'] = $Prenom_dest;     

        ?>

        <script>
            document.getElementById("Boutton_Apparition").addEventListener("click", function() {
                var wrapper = document.getElementById("wrapper");
                wrapper.style.display = "block";

                var boutton = document.getElementById("Boutton_Apparition");
                boutton.style.display = "none";
            });
        </script>

        <div id="wrapper">
            <div id="menu">
                <p class="TOP">Destinataire : <b><?php echo $_SESSION['nameDest']; ?></b></p>
                
            </div>
            <div id="chatbox">
                <?php
                    $filename = strtolower(min($_SESSION['name'], $_SESSION['nameDest']) . '_' . max($_SESSION['name'], $_SESSION['nameDest']) . '_log.html');
                    if (file_exists($filename) && filesize($filename) > 0) {
                        $contents = file_get_contents($filename);
                        echo $contents;
                    }
                ?>
            </div>
            <form name="message" action="">
                <input name="usermsg" type="text" id="usermsg" />
                <input name="submitmsg" type="submit" id="submitmsg" value="Envoyer" />
            </form>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            // jQuery Document
            $(document).ready(function () {
                $("#submitmsg").click(function () {
                    var clientmsg = $("#usermsg").val();
                    $.post("post.php", { text: clientmsg });
                    $("#usermsg").val("");
                    return false;
                });

                function loadLog() {
                    var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; // Hauteur de défilement avant la requête
                    $.ajax({
                        url: "<?php echo $filename; ?>",
                        cache: false,
                        success: function (html) {
                            $("#chatbox").html(html);
                            var newscrollHeight = $("#chatbox")[0].scrollHeight - 20;
                            if (newscrollHeight > oldscrollHeight) {
                                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal');
                            }
                        }
                    });

                  }

                setInterval(loadLog, 2500);
                $("#exit").click(function () {
                    var exit = confirm("Voulez-vous vraiment mettre fin à la session ?");
                    if (exit == true) {
                        window.location = "chat.php?logout=true";
                    }
                });
            });
        </script>
    <?php endif; ?>
</body>
</html>
