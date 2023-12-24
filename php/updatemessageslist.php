<?php
    require_once('conn.php');
    $sql = "SELECT * FROM mensajes;";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_array($result)){
            $last_id = $row['id_mensaje'];
        }
    
        for($i = 0; $i <= $last_id; $i++){
            $sql = "SELECT * FROM mensajes WHERE id_mensaje = $i;";
            $iexists = mysqli_num_rows(mysqli_query($conn, $sql));
            if(!$iexists){
                for($j = $i+1; $j <= $last_id; $j++){
                    $sql = "SELECT * FROM mensajes WHERE id_mensaje = $j;";
                    $jexist = mysqli_num_rows(mysqli_query($conn, $sql));
                    if($jexist){
                        $sql = "UPDATE mensajes SET id_mensaje = $i WHERE id_mensaje = $j;";
                        mysqli_query($conn, $sql);
                        break;
                    }
                }
            }
        }
    }
?>