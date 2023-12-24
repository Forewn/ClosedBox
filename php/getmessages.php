<?php
    require_once('conn.php');
    session_start();
    $usuario = $_SESSION['username'];
    $chat_id = $_POST['chat_id'];
    $other_id = $_POST['other'];
    $mensaje;
    $row = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM usuarios WHERE Usuario = '$usuario'"));
    $id = $row['id'];
    $sql = "SELECT * FROM `mensajes` WHERE id_chat = $chat_id AND autor != $id and leido = 0 ORDER BY `hora_envio` DESC LIMIT 1;";
    $result = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM usuarios WHERE id = $other_id;";
    $other = mysqli_fetch_array(mysqli_query($conn, $sql));
    $other_user = $other['Usuario'];


    if(mysqli_num_rows($result) > 0){
        $result = mysqli_fetch_array($result);
        $mensaje = $result['contenido'];
        $hora = strtotime($result['hora_envio']);
        $id_mensaje = $result['id_mensaje'];
        echo "<div class='in'>";
        echo "<p class='identificador'>".$other_user."</p>";
        echo "<p>".$mensaje."</p>";
        echo "<p class='hora'><small>".date('h:i A', $hora)."</small></p>";
        echo "</div>";
        $sql = "UPDATE mensajes SET leido = 1 WHERE id_mensaje = $id_mensaje;";
        mysqli_query($conn, $sql);
    }
    
?>