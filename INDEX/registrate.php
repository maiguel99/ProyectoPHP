<?php
// Datos de conexión a la base de datos
$localhost = "localhost";
$root = "root";
$pass = "miguell";
$proyectomiguelphp = "proyectomiguelphp";

// Crear conexión
$conn = new mysqli($localhost, $root, $pass, $proyectomiguelphp);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recoger datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];
$contraseña = $_POST['contraseña'];

// Preparar la consulta SQL
$sql = "INSERT INTO usuario (nombre, apellido, email, direccion, contraseña) 
        VALUES ('$nombre', '$apellido', '$email', '$direccion', '$contraseña')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    header("Location: login.html");
} else {
    echo "Error al insertar el registro: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>