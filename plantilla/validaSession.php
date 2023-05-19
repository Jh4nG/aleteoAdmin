<?php 
    session_start();
    if (!isset($_SESSION['aleteo_user']) || is_null($_SESSION['aleteo_user'])) {
        header('Location: login.php');
        exit;
    } else {
        $_SESSION["aleteo_verif"] = true;
    }
?>