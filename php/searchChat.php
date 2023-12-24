<?php
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
?>