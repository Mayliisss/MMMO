<?php
// Démarrez la session
session_start();

// Unset all les variables de session
$_SESSION = array();

// Si vous voulez effacer complètement les variables de session, vous pouvez également les supprimer du disque.
// Notez que cela détruira la session, et non seulement les données de session!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Enfin, détruisez la session
session_destroy();
?>
