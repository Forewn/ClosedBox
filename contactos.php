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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz@1,9..40&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="sticky-top">
        <nav class="navbar border-bottom border-body" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="php/logout.php">Salir</a>
                        </li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown link
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Chatear</th>
                    <th>Borrar chat</th>
                </tr>
                <tr></tr>
            </thead>
            <tbody>
            <?php
                $username = $_SESSION['username'];
                $sql = "SELECT * FROM usuarios WHERE Usuario != '$username' ORDER BY Nombre;";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>".$row['Nombre']."</td>";
                    echo "<td>".$row['Usuario']."</td>";
                    echo "<td class='text-center'><a href='chat.php' onclick='enviarID(".$row['id'].")' class='btn btn-outline-success'><i class='bi bi-box-arrow-in-right'></i></a></td>";
                    echo "<td class='text-center'><a href='./php/deletechats.php' class='btn btn-outline-danger' onclick='enviarID(".$row['id'].")'><i class='bi bi-trash'></i></a></td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </main>
    <script>
        function enviarID(ID){
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>