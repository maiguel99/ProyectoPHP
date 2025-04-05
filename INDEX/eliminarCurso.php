
<?php
$localhost = "localhost";
$root = "root";
$pass = "miguell";
$proyectomiguelphp = "proyectomiguelphp";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['curso'])) {
    try {
        $conn = new PDO("mysql:host=$localhost;dbname=$proyectomiguelphp;charset=utf8", $root, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $curso = $_POST['curso'];
        
        // Delete from database
        $sql = "DELETE FROM curso WHERE nombre = :nombre";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $curso);
        
        if($stmt->execute()) {
            // Update index.html
            $indexPath = __DIR__ . '/index.html';
            $content = file_get_contents($indexPath);
            
            // Find and remove the course div
            $pattern = '/<div class="cursos_items">\s*<a href=""><img[^>]*alt="' . preg_quote($curso, '/') . '"[^>]*\/><h3>' . preg_quote($curso, '/') . '<\/h3><\/a>\s*<\/div>/';
            $newContent = preg_replace($pattern, '', $content);
            
            file_put_contents($indexPath, $newContent);
            
            header("Location: panelAdmin.html");
            exit();
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>
