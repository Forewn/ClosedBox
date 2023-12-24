<?php
    require_once('conn.php');
    $usuario = strtolower(htmlspecialchars($_POST['usuario']));
    $nombre = strtoupper(htmlspecialchars($_POST['nombre']));
    $email = strtolower(htmlspecialchars($_POST['correo']));
    $password = trim(password_hash(htmlspecialchars($_POST['contrasena']), PASSWORD_DEFAULT));

    $num = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM usuarios;"));
    $sql = "INSERT INTO usuarios(id, Nombre, Usuario, Correo, Contrasena) VALUES($num, '$nombre', '$usuario', '$email', '$password');";
    if(!mysqli_query($conn, $sql)){
        echo "Ha habido un error";
    }
    else{
        session_start();
        $_SESSION['$username'] = $usuario;
        header('Location: ../contactos.php');
    }
    
?>