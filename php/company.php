<?php
    session_start();

    if(!isset($_SESSION['other'])){
    global $other;
    }

    $_SESSION['other'] = $_POST['otherID'];
?>