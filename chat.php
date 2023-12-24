<?php
    require_once('php/conn.php');
    session_start();
    $other = $_SESSION['other'];
    $sql = "SELECT * FROM usuarios WHERE id = $other";
    $result2 = mysqli_fetch_array(mysqli_query($conn, $sql));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/chat.css">
</head>
<body>
    <div class="chat">
        <div class="titulo">
            <div class="row">
            <div class="col-2"><a href="./contactos.php"><img src="./img/back.png" alt="return" id="volver"></a></div>
                <div class="col-8">
                    <?php
                        echo $result2['Usuario'];
                    ?>
                </div>
                <div class="col-2"><img src="" alt="foto"></div>
            </div>
        </div>
            <?php
                $usuario = $_SESSION['username'];
                $sql = "SELECT * FROM usuarios WHERE Usuario = '$usuario';";
                $result = mysqli_fetch_array(mysqli_query($conn, $sql));
                $you = $result['id'];
                $other_name = $result2['Nombre'];
                $id_chat = search_chat($conn, $you, $other);

                $sql = "SELECT * FROM mensajes WHERE id_chat = $id_chat;";
                $result = mysqli_query($conn, $sql);

                echo "<script> var other =". $other."</script>";

                echo "<div class='mensajes' id='".$id_chat."'>";
                while($mensaje = mysqli_fetch_array($result)){
                    $hora = strtotime($mensaje['hora_envio']);
                    if($mensaje['autor'] == $you){
                        echo "<div class='out'>";
                        echo "<p class='identificador'>You</p>";
                        echo "<p>".$mensaje['contenido']."</p>";
                        echo "<p class='hora'><small>".date('h:i A', $hora)."</small></p>";
                        echo "</div>";
                    }
                    else if($mensaje['autor'] == $other){
                        echo "<div class='in'>";
                        echo "<p class='identificador'>".$other_name."</p>";
                        echo "<p>".$mensaje['contenido']."</p>";
                        echo "<p class='hora'><small>".date('h:i A', $hora)."</small></p>";
                        echo "</div>";
                        if($mensaje['leido'] == 0){
                            $id_mensaje = $mensaje['id_mensaje'];
                            $sql = "UPDATE mensajes SET leido = 1 WHERE id_mensaje = $id_mensaje;";
                            mysqli_query($conn, $sql);
                        }
                    }
                }
                function search_chat($conn, $you, $other){
                    $sql = "SELECT * FROM chats WHERE id_usuario1 = $you AND id_usuario2 = $other;";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        $record = mysqli_fetch_array($result);
                        $id_chat = $record['id_chat'];
                    }
                    else{
                        $sql = "SELECT * FROM chats WHERE id_usuario1 = $other AND id_usuario2 = $you;";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                            $record = mysqli_fetch_array($result);
                            $id_chat = $record['id_chat'];
                        }
                        else{
                            $num = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM chats;"));
                            $sql = "INSERT INTO chats(id_chat, id_usuario1, id_usuario2) VALUES($num, $you, $other);";
                            mysqli_query($conn, $sql);
                            $id_chat = $num;
                        }
                    }
                    return $id_chat;
                }
                echo "</div>";
            ?> 
        <div class="escribir">
            <form>
                <input type="text" name="" id="text-area" placeholder="Escribe algo...">
                <button id="button"><i class="bi bi-send"></i></button>
            </form>
        </div>
    </div>
    <script src="js/new_message.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>