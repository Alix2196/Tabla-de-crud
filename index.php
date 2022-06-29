<?php

include './php/funciones.php';

//csfr();
if (isset($_POST['submit']) && !hash_equals($_SESSION['csfr'], $_POST['csfr'])) {
    die();
}

$error = false;
$config = include './php/dbconfig.php';

try {
    $dsn = 'mysql:host=' . $config['db']['servidor'] . ';dbname=' . $config['db']['nombre'];
    $conexion = new PDO($dsn, $config['db']['usuario'], $config['db']['password'], $config['db']['options']);
    
    /* if (isset($_POST['precio_producto'])) {

        $consultsql = "select * from producto where precio_producto like '%" . $_post['precio_prodcuto'] . "%'";
    } else {
        $consultsql = "SELECT * FROM productos";
    } */

    $consultsql = "SELECT * FROM greenPawts.productos_mascotas;";
    
    $sentencia = $conexion->prepare($consultsql);
    $sentencia->execute();

    $producto = $sentencia->fetchAll();

    echo "conexion extoza";
} catch (PDOException $error) {
    $error = $error->getMessage();
    echo "conexion error";
}

$titulo = isset($_POST['precio_producto']) ? '   Lista de productos(' . $_post['precio_producto'] . ')' : 'Lista de productos';

?>
<?php include "./templates/header.php"; ?>

<?php

if ($error) {
?>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="alert-danger" role="alert">
                    <?= $error ?>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="./php/create.php" class="btn btn-primary mt-4">Crear producto</a>
            <hr>
            <form method="post" class="form-inline">
                <div class="form-group mr-3">
                    <input type="text" id="precio_producto" name="precio_producto" placeholder="Buscar por producto" class="form-control">
                </div>
                <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
                <button type="submit" name="submit" class="btn btn-primry">Ver resultados</button>
            </form> -->
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-3"><?= $titulo ?></h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col" >nombre_producto</th>
                        <th scope="col" >precio_producto</th>
                        <th scope="col" >cantidad_producto</th>
                        <th scope="col" >stock_producto
                        <th scope="col" >creacion_producto</th>
                        <th scope="col" >descripcion_producto</th>
                        <th scope="col">Acciones</th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($producto as $fila) {
?>
                            <tr>
                                <td><?php echo escapar($fila["id"]); ?></td>
                                <td><?php echo escapar($fila["nombre_producto"]); ?></td>
                                <td><?php echo escapar($fila["precio_producto"]); ?></td>
                                <td><?php echo escapar($fila["cantidad_producto"]); ?></td>
                                <td><?php echo escapar($fila["stock_producto"]); ?></td>
                                <td><?php echo escapar($fila["creacion_producto"]); ?></td>
                                <td><?php echo escapar($fila["descripcion_producto"]); ?></td>
                                <td><?php echo escapar($fila["Acciones"]); ?></td>

                                <td>
                                    <a href="<?= './php/borrar.php?id=' . escapar($fila["id"]) ?>">🗑️Borrar</a>
                                    <a href="<?= './php/editar.php?id=' . escapar($fila["id"]) ?>">✏️Editar</a>
                                </td>
                            </tr>
                        <?php
                        };
                    ?>
                <tbody>
            </table>
        </div>
    </div>
</div>

<?php include './templates/footer.php'; ?>