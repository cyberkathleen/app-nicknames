<?php
/**
 * 
 * ETML
 * Auteur : Kathleen Lu
 * Date : 15.11.23
 * Description : Page contenant toutes les fonctions
 */

// L'accès à la page n'est autorisée que si un utilisateur est connecté et qu'il s'agit d'un administrateur, sinon il reçoit une erreur 403
function IsUserAllowed() {
    if (!$_SESSION["isConnected"] || !$_SESSION["user"]["useAdministrator"]) {
        http_response_code(403);
        die();
    }
}

?>