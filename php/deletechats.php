<?php
    require_once "conn.php";
    session_start();
    $you = $_SESSION['id'];
    $other = $_SESSION['other'];
    require_once "searchChat.php";
    $id_chat = search_chat($conn, $you, $other);

    $sql = "SELECT * FROM chats WHERE id_chat = $id_chat;";
    if(mysqli_num_rows(mysqli_query($conn, $sql))){
        require "deletemessages.php";
        $sql = "DELETE FROM chats WHERE id_chat = $id_chat;";
        mysqli_query($conn, $sql);
        require "updatechatlist.php";
        header("location: ../contactos.php");
    }
    else{
        echo "Chat no ha podido ser borrado";
    }

    
?>