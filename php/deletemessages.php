<?php
    require_once "conn.php";

    if(!isset($id_chat)){
        deleteMessage($conn, $id_mensaje);
    }
    else{
        deleteAllMessages($conn, $id_chat);
    }
    function deleteMessage($conn, $id_mensaje){

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
    }

    function deleteAllMessages($conn, $id_chat){
        $sql = "SELECT * FROM mensajes WHERE id_chat = $id_chat;";
        if(mysqli_num_rows(mysqli_query($conn, $sql))){
            $sql = "DELETE FROM mensajes WHERE id_chat = $id_chat;";
            mysqli_query($conn, $sql);
            require "updatemessageslist.php";
        }
        else{
            echo "Los mensajes no han podido ser eliminados";
        }
    }
    
?>