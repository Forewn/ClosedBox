<?php
    require_once('conn.php');
    session_start();
    date_default_timezone_set('America/Caracas');

    $mensaje = $_POST['mensaje'];
    $usuario = $_SESSION['username'];
    $id_chat = $_POST['chat_id'];

    $sql = "SELECT * FROM mensajes;";
    $num = mysqli_num_rows(mysqli_query($conn, $sql));

    $sql = "SELECT * FROM usuarios WHERE Usuario = '$usuario';";
    $result = mysqli_fetch_array(mysqli_query($conn, $sql));
    $id = $result['id'];
    $date = date("Y-m-d H:i:s");
    $timestamp = strtotime($date);

    $sql = "INSERT INTO mensajes(id_mensaje, contenido, hora_envio, id_chat, autor) VALUES($num, '$mensaje', '$date', $id_chat, $id);";

    mysqli_query($conn, $sql);

    echo "<div class='out'>";
    echo "<p class='identificador'>You</p>";
    echo "<p>".$mensaje."</p>";
    echo "<p class='hora'><small>".date('h:i A', $timestamp)."</small></p>";
    echo "</div>";

?>