<?php session_start();
require_once("functions.php"); ?>
<?php

    $_SESSION = array();
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }
    session_destroy();
   redirect_to('index.php');

?>
