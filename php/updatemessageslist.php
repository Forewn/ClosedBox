<?php
    require_once('conn.php');
    $sql = "SELECT * FROM mensajes;";
    $num = mysqli_num_rows(mysqli_query($conn, $sql));


    for($i = 0; $i < $num; $i++){
        $sql = "SELECT * FROM mensajes WHERE id_mensaje = $i;";
        $exist = mysqli_num_rows(mysqli_query($conn, $sql));
        if(!$exist){
            $sql = "UPDATE mensajes SET id_mensaje = $i WHERE id_mensaje = $i+1;";
            mysqli_query($conn, $sql);
            echo ($i+1)." Ahora es ".$i."<br>";
        }
    }

?>