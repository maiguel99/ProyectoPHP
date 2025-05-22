
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
            // Create new course page
            $newCoursePage = "<!DOCTYPE html>
<html lang=\"en\">
  <head>
    <meta charset=\"UTF-8\" />
    <title>" . htmlspecialchars($nombre) . " - MR Online Courses</title>
    <link rel=\"stylesheet\" href=\"style.css\" />
    <link href=\"https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css\" rel=\"stylesheet\"/>
    <link rel=\"icon\" href=\"logoMR.png\">
    <style>
      .form-container {
        max-width: 500px;
        margin: 20px auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
      }
      .form-group {
        margin-bottom: 15px;
      }
      .form-group label {
        display: block;
        margin-bottom: 5px;
        color: #333;
      }
      .form-group input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
      }
      .submit-btn {
        background: #333f61;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
      }
      .submit-btn:hover {
        background: #2a3350;
      }
    </style>
  </head>
  <body>
    <header>
      <nav>
        <div class=\"navegador\">
          <a href=\"index.html\">
            <img src=\"logoMR.png\" alt=\"\" />
            <h2 class=\"titulo\">MR Online Courses / " . htmlspecialchars($nombre) . "</h2>
          </a>
        </div>
      </nav>
    </header>

    <div class=\"form-container\">
      <h2>Registro para " . htmlspecialchars($nombre) . "</h2>
      <form action=\"matricula.php\" method=\"POST\">
        <div class=\"form-group\">
          <label>Nombre del usuario</label>
          <input type=\"text\" name=\"nombre\" required>
        </div>
        <div class=\"form-group\">
          <label>Email</label>
          <input type=\"email\" name=\"email\" required>
        </div>
        <div class=\"form-group\">
          <label>Contraseña</label>
          <input type=\"password\" name=\"password\" required>
        </div>
        <input type=\"hidden\" name=\"curso\" value=\"" . htmlspecialchars($nombre) . "\">
        <button type=\"submit\" class=\"submit-btn\">Matricularse en " . htmlspecialchars($nombre) . "</button>
      </form>
    </div>
  </body>
</html>";
            
            // Save the new course page
            $courseFileName = strtolower($nombre) . '.html';
            file_put_contents(__DIR__ . '/' . $courseFileName, $newCoursePage);
            
            // Update index.html
            $indexPath = __DIR__ . '/index.html';
            $content = file_get_contents($indexPath);
            
            // Create the new div del curso with link to new page
            $newCourse = "\n          <div class=\"cursos_items\">\n            <a href=\"" . htmlspecialchars($courseFileName) . "\"><img src=\"\" alt=\"" . htmlspecialchars($nombre) . "\" /><h3>" . htmlspecialchars($nombre) . "</h3></a>\n\n          \n          \n          \n          </div>";
            
            // Find position to insert
            $position = strpos($content, '<div class="cursos_items">', strpos($content, 'curso_contenedor'));
            
            // Insert the new course
            $newContent = substr_replace($content, $newCourse, $position, 0);
            
            // Save changes
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
