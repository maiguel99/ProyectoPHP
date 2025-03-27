<?php

$localhost = "localhost";
$root = "root";
$pass = "miguell";
$proyectomiguelphp = "proyectomiguelphp";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $conn = new PDO("mysql:host=$localhost;dbname=$proyectomiguelphp;charset=utf8", $root, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    session_start();
    // Obtener los datos del formulario
    $nomusuario = $_POST['nomusuario'];
    $contrausuario = $_POST['contrausuario'];
    // die(var_dump($nomusuario));
    // $contraseñacifrada = password_hash($contrausuario, PASSWORD_DEFAULT);
    $contraseña_cifrada = password_hash("admin", PASSWORD_DEFAULT);
    // Condulta SQL
    $sql = "SELECT nombre, contraseña FROM usuario WHERE nombre = :usuario and contraseña = :contra";
    $consulta = $conn->prepare($sql);
    $consulta->bindParam(':usuario', $nomusuario);
    $consulta->bindParam(':contra', $contrausuario);
    $consulta->execute();
    $rs = $consulta->fetch(PDO::FETCH_ASSOC);
    // $_SESSION['admin'] = $nomusuario;

    if ($rs) {
        header("Location: index.html");
    } else {
        header("Location: error.html");
    }

}




// Hash de la contraseña (recomendado para seguridad)
    // $contraseñacifrada = password_hash($contrausuario, PASSWORD_DEFAULT);

    /* Preparar la consulta SQL para insertar datos
    $sql = "INSERT INTO formulario (nomusuario, contrausuario) VALUES (?, ?)";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    // Vincular los parámetros
    $stmt->bind_param("ss", $nomusuario, $hashed_password);

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        echo "Registro insertado correctamente.";
    } else {
        echo "Error al insertar el registro: " . $stmt->error;
    }
    
    // Cerrar la sentencia
    $stmt->close();
    */


// Cerrar la conexión
?>