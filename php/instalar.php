<?php

$config = include './dbconfig.php';

    $dbconfig = include './dbconfig.php';

    try {

        $dsn = 'mysql:host=' . $config['db']['servidor'] . ';dbname=' . $config['db']['nombre'];
        $conexion = new PDO($dsn, $config['db']['usuario'], $config['db']['password'], $config['db']['options']);
        $sql = file_get_contents("data/migration.sql");
        
        $conexion->exec($sql);

        echo "La base de datos y la tabla productos se ha creado con exito.";

    }catch (PDOException $error) {
        
        echo $error->getMessage();
    }





