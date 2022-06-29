<?php
    
    include 'funciones.php';

    $config = include 'dbconfig.php';

    $dsn = 'mysql:host=' . $config['db']['servidor'] . ';dbname=' . $config['db']['nombre'];
    $conexion = new PDO($dsn, $config['db']['usuario'], $config['db']['password'], $config['db']['options']);
        
    try{        
             
        $consultaSql = "SELECT * FROM productos_mascotas WHERE id = " . $_GET["id"];

        $sentencia = $conexion->prepare($consultaSql); 
        $sentencia->execute();
        
        
        $producto = $sentencia->fetchAll();
               
        print_r($producto);

        echo "conexion extoza";

    }catch(PDOException $error){
            
        echo "Error conexion";
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }

    

   /*  if (isset($_POST['submit'])){
        try{

            $config = include './php/dbconfig.php';

            $dsn = 'mysql:host=' . $config['db']['servidor'] . ';dbname=' . $config['db']['nombre'];
            $conexion = new PDO($dsn, $config['db']['usuario'], $config['db']['password'], $config['db']['options']);

            $producto = [

                "id" => ['id'],
                "nombre_producto" => $_GET["nombre_producto"],
                "precio_producto" => $_POST["precio_producto"],   
                "cantidad_producto" =>$_POST ["cantidad_producto"],
                "stock_producto" => $_POST ["stock_producto"],
                "creacion_producto" =>$_POST ["creacion_producto"],
                "descripcion_producto" =>$_POST ["descripcion_producto"],
            ];

            $consultasql = "UPDATE prductos SET
            
                id = :id
                nombre_producto =:nombre_producto,
                precio_producto =:precio_producto,   
                cantidad_producto =:cantidad_producto,
                stock_producto =:stock_producto,
                creacion_producto =:creacion_producto,
                descripcion_producto =:descripcion_producto,
                updated_at =NOW()
                WHERE id=:id";
                $consulta =$conexion->prepare($consultasql);
                $consulta->execute($producto);
        } catch (PDOException $error){
            $resultado['error']=true;
            $resultado['mensaje']=$error->getMessage();
        }
    } */
?>

<?php require "./templates/header.php";?>

<?php

if ($resultado['error']){
    ?>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="alert alert-danger"role="alert">
                        <?=$resultado['mensaje']?>          
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <?php
    }
?>
<?php
if (isset($producto)&& $producto){
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-succes"role="alert">
                    El producto ha sido actualizado correctamente 
                </div>
            </div>
        </div>
    </div>
</div>
<?php

if (isset ($producto)&& $producto){
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-4">Editado el producto<?=escapar($producto['nombre_producto']).''.escapar($producto['nombre_producto'])?></h2>
                <hr>
                <form method="post">
                    <div class="form-group">
                    <input type="text"name="nombre_producto"id="nombre_producto"value="<?=escapar($producto['nombre_producto']) ?>" class="form-control">
                    <label for="nombre_producto">Nombre</label>
                    </div>
                    <div class="form-grop">
                        <label for="precio_producto"></label>
                        <input type="precio_producto"name="precio_producto"id="precio_producto"value="<?=escapar($producto['precio_producto'])?>"class="form-control">
                    </div>
                    <div class="form-grop">
                        <label for="cantidad_producto"></label>
                        <input type="cantidad_producto"name="cantidad_producto"id="cantidad_producto"value="<?=escapar($producto['cantidad_producto'])?>"class="form-control">
                    </div>
                    <div class="form-grop">
                        <label for="stock_producto"></label>
                        <input type="stock_producto"name="stock_producto"id="stock_producto"value="<?=escapar($producto['stock_producto'])?>"class="form-control">
                    </div>
                    <div class="form-grop">
                        <label for="creacion_producto"></label>
                        <input type="creacion_producto"name="creacion_producto"id="creacion_producto"value="<?=escapar($producto['creacion_producto'])?>"class="form-control">
                    </div>
                    <div class="form-grop">
                        <label for="descripcion_producto"></label>
                        <input type="descripcion_producto"name="descripcion_producto"id="descripcion_producto"value="<?=escapar($producto['descripcion_producto'])?>"class="form-control">
                    </div>
                    <div class="form-group">
                    <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
                    <input type="submit" name="submit" class="btn btn-primary" value="Actualizar">
                    <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}

}
?>
<?php require "./templates/footer.php";?>