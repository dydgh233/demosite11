<?php
    session_start();
    unset($_SESSION["username"]);
    
    setcookie("ID", "");
    setcookie("password", "");
    header("Location: list.php");
?>