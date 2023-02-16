<?php 
    include('templates/header.php');
    //destory session
    if(isset($_SESSION['name'])) {
        session_unset();
        session_destroy();
        jsRedirect(SITE_ROOT);
    }
    jsRedirect(SITE_ROOT);
?>
