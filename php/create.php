<?php
   
    if(isset($_POST['enviar'])){

        $config = include './dbconfig.php';

        try{

            $dsn = 'mysql:host=' . $config['db']['servidor'] . ';dbname=' . $config['db']['nombre'];
            $conexion = new PDO($dsn, $config['db']['usuario'], $config['db']['password'], $config['db']['options']);

            $producto = [
                "id" => $_POST['id'],
                "nombre_producto" => $_POST["nombre_producto"],
                "precio_producto" => $_POST["precio_producto"],   
                "cantidad_producto" => $_POST["cantidad_producto"],
                "stock_producto" => $_POST["stock_producto"],
                "creacion_producto" => $_POST["creacion_producto"],
                "descripcion_producto" => $_POST["descripcion_producto"]
            ];

            $consultasql = "INSERT INTO productos_mascotas (
                id,
                nombre_producto,
                precio_producto,
                cantidad_producto,
                stock_producto,
                creacion_producto,
                descripcion_producto) 
            values(:" . implode(",:", array_keys($producto)) . ")";
            

            $sentencia = $conexion->prepare($consultasql);
            $sentencia->execute($producto); 

            echo "conexion exito";

        }catch(PDOException $error){
            
            echo "Error conexion";
            $resultado['error'] = true;
            $resultado['mensaje'] = $error->getMessage();

        }
    };
?>

<?php include './templates/header.php';?>

<form method="post">
    <div class="form-group">
        <label for="name">id</label>
        <input type="number" name="id" id="id" class="form-control">
    </div>
    <div class="form-group">
        <label for="name">nombre del producto:</label>
        <input type="name" name="nombre_producto" id="nombre_producto" class="form-control">
    </div>
    <div class="form-group">
        <label for="number">precio_producto</label>
        <input type="number" name="precio_producto" id="precio_producto" class="form-control">
    </div>
    <div class="form-group">
        <label for="number">Cantidad del producto</label>
        <input type="number" name="cantidad_producto" id="cantidad_producto" class="form-control">
    </div>
    <div class="form-group">
        <label for="number">stock producto</label>
        <input type="number" name="stock_producto" id="stock_producto" class="form-control">
    </div>
    <div class="form-group">
        <label for="date">Fecha de creacion:</label>
        <input type="date" name="fecha_creacion" id="fecha_creacion" class="form-control">
    </div>
    <div class="form-group">
        <label for="mensaje">Descripcion del producto:</label>
        <textarea name="descripcion_producto" id="descripcion_producto" class="form-control"></textarea>
    </div>
    <div class="form-group">
    <input type="submit" name="enviar" class="btn btn-primary" value="Enviar">
    </div>
</form>


<?php include "./templates/footer.php"; ?>