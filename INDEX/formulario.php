
<?php
$localhost = "localhost";
$root = "root";
$pass = "miguell";
$proyectomiguelphp = "proyectomiguelphp";

try {
    $conn = new PDO("mysql:host=$localhost;dbname=$proyectomiguelphp;charset=utf8", $root, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $nombre = $_POST['nombre'];
    $email = $_POST['gmail'];
    $numeroTelefono = $_POST['numeroTelefono'];
    $texto = $_POST['textarea'];
    
    $sql = "INSERT INTO formulario (nombre, email, numeroTelefono, texto) VALUES (:nombre, :email, :numeroTelefono, :texto)";
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':numeroTelefono', $numeroTelefono);
    $stmt->bindParam(':texto', $texto);
    
    if($stmt->execute()) {
        header("Location: index.html");
        exit();
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
