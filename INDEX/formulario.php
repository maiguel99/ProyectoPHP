<?php

//$conexion = mysqli_connect('localhost', 'root', '', 'proyectomiguelphp')
//or die(mysql_error($mysqli));



// function insertar($conexion){

    $nombre = $_POST['nombre'];
    $gmail = $_POST['gmail'];
    $numeroTelefono = $_POST['numeroTelefono'];
    $texto = $_POST['texto'];

    $consulta = "INSERT INTO formulario(nombre, email, numeroTelefono, texto)
    VALUES ('$nombre', '$gmail', '$numeroTelefono', '$texto');"
die($consulta);
  //  mysqli_query($conexion, $consulta);
  //  mysqli_close($conexion);
// } 



?>