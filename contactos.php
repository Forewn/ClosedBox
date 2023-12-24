<?php
    session_start();
    if(isset($_SESSION['username'])){
        require_once("php/conn.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/contactos.css">
</head>
<body>
    <header></header>
    <main>
        <?php
            $username = $_SESSION['username'];
            $sql = "SELECT * FROM usuarios WHERE Usuario != '$username';";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)){
                echo "<div class='contacto' onclick='guardarID(".$row['id'].")'><a href='chat.php'>";
                echo "<h5>".$row['Usuario']."</h5>";
                echo "<p>Descripcion</p>";
                echo "Chatear";
                echo "</a></div>";
            }
        ?>
    </main>
    <a href="./php/logout.php" name="salir">Salir</a>
    <script>
        function guardarID(ID){
            request = new XMLHttpRequest();
            request.open('POST', './php/company.php');
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.onload = function(){
            var respuesta = request.responseText;
            console.log(respuesta);
        };
            request.send("otherID="+ID);
        }
    </script>
    <footer></footer>
</body>
</html>