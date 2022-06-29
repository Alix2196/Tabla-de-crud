<?php
include './php/funciones.php';

$dbconfig = include'dbconfig.php';

$resultado=[
    'error'=>false,
    'mensaje'=>''
];

try{

    $$dsn = 'mysql:host=' . $config['db']['servidor'] . ';dbname=' . $config['db']['nombre'];
    $conexion = new PDO($dsn, $config['db']['usuario'], $config['db']['password'], $config['db']['options']);
    
    $id =$_GET['id'];
    $consultasql ="DELETE FROM alumnos WHERE id=".$id;

    $sentencia =$conexion->prepare($consultasql);
    $sentencia->execute();

    header('location:/index.php');
    
}catch (PDOException $error){
    $resultado['error']=true;
    $resultado['mensaje']=$error->getMessage();

}
?>
<?php  require "./templates/header.php";?>

<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger"role="alert">
                <?=$resultado['mensaje']?>
            </div>
        </div>
    </div>
</div>
<?php require "./templates/footer.php";