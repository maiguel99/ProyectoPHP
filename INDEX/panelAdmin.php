
<?php
$localhost = "localhost";
$root = "root";
$pass = "miguell";
$proyectomiguelphp = "proyectomiguelphp";

try {
    $conn = new PDO("mysql:host=$localhost;dbname=$proyectomiguelphp;charset=utf8", $root, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Online MikiCursos - Admin</title>
    <link rel="stylesheet" href="panelAdmin.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="icon" href="logoMR.png">
  </head>
  <body>
    <header>
      <nav>
        <div class="navegador">
          <a href="#">
            <img src="logoMR.png" alt="" />
            <h2 class="titulo">MR Online Courses / Admin Panel</h2>
          </a>
        </div>
      </nav>
    </header>

    <div class="admin-container">
      <h1>Panel de Administración</h1>
      <div class="admin-controls">
        <a href="crearCurso.html" class="admin-button">Crear Curso</a>

        <form action="eliminarCurso.php" method="post" class="delete-form">
          <select name="curso" required>
            <option value="">Seleccionar curso</option>
            <?php
              $stmt = $conn->query("SELECT nombre FROM curso");
              while($row = $stmt->fetch()) {
                echo "<option value='" . htmlspecialchars($row['nombre']) . "'>" . htmlspecialchars($row['nombre']) . "</option>";
              }
            ?>
          </select>
          <button type="submit" class="admin-button delete">Eliminar Curso</button>
        </form>

        <a href="index.html" class="admin-button">Web</a>
      </div>
    </div>
  </body>
</html>
