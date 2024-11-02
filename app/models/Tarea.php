<?php

require_once 'app/config/database.php';

class Tarea {
    private $pdo;

    public function __construct() {
        $this->pdo = $this->connect();
    }

    private function connect() {
        global $host, $db, $user, $pass;
        return new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    }

    public function crearTarea($titulo, $descripcion, $fechaEstimadaFinalizacion, $creadorTarea, $idEmpleado, $idEstado, $idPrioridad, $observaciones) {
        $sql = "INSERT INTO tareas (titulo, descripcion, fechaEstimadaFinalizacion, creadorTarea, idEmpleado, idEstado, idPrioridad, observaciones, created_at) 
                VALUES (:titulo, :descripcion, :fechaEstimadaFinalizacion, :creadorTarea, :idEmpleado, :idEstado, :idPrioridad, :observaciones, NOW())";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':fechaEstimadaFinalizacion', $fechaEstimadaFinalizacion);
        $stmt->bindParam(':creadorTarea', $creadorTarea);
        $stmt->bindParam(':idEmpleado', $idEmpleado);
        $stmt->bindParam(':idEstado', $idEstado);
        $stmt->bindParam(':idPrioridad', $idPrioridad);
        $stmt->bindParam(':observaciones', $observaciones);

        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }
}
