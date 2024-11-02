<?php
$host = 'localhost';
$db = 'tareas_db';
$user = 'tu_usuario';
$pass = 'tu_contraseña';

$conexion = new mysqli($host,$user,$pass,$db);

if ($conexion->connect_errno){
    die ("Conexion Fallida" . $conexion->connect_errno);
} else {
    echo "conectado";
}


/*
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Conexión fallida: " . $e->getMessage();
}
    */
?>
