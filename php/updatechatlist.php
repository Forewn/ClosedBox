<?php
    require_once('conn.php');
    $sql = "SELECT * FROM chats;";
    $num = mysqli_num_rows(mysqli_query($conn, $sql));


    for($i = 0; $i < $num; $i++){
        $sql = "SELECT * FROM chats WHERE id_chat = $i;";
        $exist = mysqli_num_rows(mysqli_query($conn, $sql));
        if(!$exist){
            $sql = "UPDATE chats SET id_chat = $i WHERE id_chat = $i+1;";
            mysqli_query($conn, $sql);
            echo ($i+1)." Ahora es ".$i."<br>";
        }
    }

?>