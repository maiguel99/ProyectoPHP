<?php
$localhost = "localhost";
$root = "root";
$pass = "miguell";
$proyectomiguelphp = "proyectomiguelphp";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new PDO("mysql:host=$localhost;dbname=$proyectomiguelphp;charset=utf8", $root, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    session_start();

    $nomusuario = $_POST['nomusuario'];
    $contrausuario = $_POST['contrausuario'];

    $sql = "SELECT id, nombre, contraseña FROM usuario WHERE nombre = :usuario AND contraseña = :contra";
    $consulta = $conn->prepare($sql);
    $consulta->bindParam(':usuario', $nomusuario);
    $consulta->bindParam(':contra', $contrausuario);
    $consulta->execute();
    $rs = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($rs) {
        $_SESSION['user_id'] = $rs['id'];
        $_SESSION['user_name'] = $rs['nombre'];
        $_SESSION['is_admin'] = ($nomusuario === "admin");

        if ($_SESSION['is_admin']) {
            header("Location: elegirAdmin.html");
        } else {
            header("Location: index.html");
        }
    } else {
        header("Location: error.html");
    }
}
?>