<?php include('./php/dbconfig.php'); ?>

<?php
 
    $consulta = "SELECT * FROM productos_mascotas";
    $rp = $conexion-> prepare($consulta);

    echo "Conexión realizada Satisfactoriamente";

?>

