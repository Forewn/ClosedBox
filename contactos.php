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
    <link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/sweetalert2.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/sweetalert2.min.js"></script>
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
                        <li class="nav-item" onclick="logoutModal()">
                        <a class="nav-link" href="#!">Salir</a>
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
                    <th class="text-center">Chatear</th>
                    <th class="text-center">Borrar chat</th>
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
                    echo "<td class='text-center pb-2'><a href='chat.php' onclick='enviarID(".$row['id'].")' class='btn btn-outline-success'><i class='bi bi-box-arrow-in-right'></i></a></td>";
                    echo "<td class='text-center pb-2'><a href='#!' class='btn btn-outline-danger' onclick='openWarning(".$row['id'].")'><i class='bi bi-trash'></i></a></td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </main>
    <footer></footer>
    <script src="js/manageContacts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>