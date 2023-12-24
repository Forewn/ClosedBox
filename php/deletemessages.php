<?php
    require_once "conn.php";

    $id_mensaje = 1;

    $sql = "SELECT * FROM mensajes WHERE id_mensaje = $id_mensaje;";
    if(mysqli_num_rows(mysqli_query($conn, $sql))){
        $sql = "DELETE FROM mensajes WHERE id_mensaje = $id_mensaje;";
        mysqli_query($conn, $sql);
        require "updatemessageslist.php";
        header("location: ../contactos.php");
    }
    else{
        echo "Mensaje no ha podido ser borrado";
    }

    
?>