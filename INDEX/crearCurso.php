
<?php
$localhost = "localhost";
$root = "root";
$pass = "miguell";
$proyectomiguelphp = "proyectomiguelphp";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conn = new PDO("mysql:host=$localhost;dbname=$proyectomiguelphp;charset=utf8", $root, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Obtener el nombre del formulario
        $nombre = $_POST['nombre'];
        
        // Preparar la consulta SQL
        $sql = "INSERT INTO curso (nombre) VALUES (:nombre)";
        $stmt = $conn->prepare($sql);
        
        // Vincular parámetros
        $stmt->bindParam(':nombre', $nombre);
        
        // Ejecutar la consulta
        if($stmt->execute()) {
            // Ruta al archivo index.html
            $indexPath = __DIR__ . '/index.html';
            
            // Leer el contenido actual
            $content = file_get_contents($indexPath);
            
            // Crear el nuevo div del curso
            $newCourse = "\n          <div class=\"cursos_items\">\n            <a href=\"\"><img src=\"\" alt=\"" . htmlspecialchars($nombre) . "\" /><h3>" . htmlspecialchars($nombre) . "</h3></a>\n          </div>";
            
            // Encontrar la posición para insertar (justo antes del cierre del div curso_contenedor)
            $position = strpos($content, '</div>', strpos($content, 'curso_contenedor')) - 10;
            
            // Insertar el nuevo curso
            $newContent = substr_replace($content, $newCourse, $position, 0);
            
            // Guardar los cambios
            file_put_contents($indexPath, $newContent);
            
            header("Location: panelAdmin.php");
            exit();
        } else {
            echo "Error al crear el curso";
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    $conn = null;
}
?>
