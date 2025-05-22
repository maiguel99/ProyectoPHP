
<?php
$localhost = "localhost";
$root = "root";
$pass = "miguell";
$proyectomiguelphp = "proyectomiguelphp";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conn = new PDO("mysql:host=$localhost;dbname=$proyectomiguelphp;charset=utf8", $root, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // First, insert the user
        $sql = "INSERT INTO usuario (nombre, email, contraseña) VALUES (:nombre, :email, :password)";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':nombre', $_POST['nombre']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':password', $_POST['password']);
        
        $stmt->execute();
        $userId = $conn->lastInsertId();
        
        // Get the course ID
        $sql = "SELECT id FROM curso WHERE nombre = :curso";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':curso', $_POST['curso']);
        $stmt->execute();
        $cursoId = $stmt->fetchColumn();
        
        // Insert into matricula
        $sql = "INSERT INTO matricula (idCurso, idUsuario) VALUES (:cursoId, :userId)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cursoId', $cursoId);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        
        header("Location: index.html");
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>
