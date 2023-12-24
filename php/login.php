<?php

    require_once('conn.php');
    $password = htmlspecialchars($_POST['contrasena']);
    $username = htmlspecialchars($_POST['user']);

    $sql = "SELECT * FROM usuarios WHERE Usuario = '$username';";

    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $result = mysqli_fetch_array($result);
        if(password_verify($password, $result['Contrasena'])){
            session_start();
            $_SESSION['username'] = $username;
            header('Location: ../contactos.php');
        }
    }
    echo "error";

?>