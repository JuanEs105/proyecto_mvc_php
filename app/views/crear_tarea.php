<?php

require_once 'app/models/Tarea.php';

class TareaController {
    private $tareaModel;

    public function __construct() {
        $this->tareaModel = new Tarea();
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $titulo = $_POST['titulo'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';
            $fechaEstimadaFinalizacion = $_POST['fechaEstimadaFinalizacion'] ?? '';
            $creadorTarea = $_POST['creadorTarea'] ?? '';
            $idEmpleado = $_POST['idEmpleado'] ?? 1; 
            $idEstado = 1; // Estado 'Pendiente'
            $idPrioridad = $_POST['idPrioridad'] ?? 1; // Asignar por defecto prioridad alta
            $observaciones = $_POST['observaciones'] ?? '';

            
            $this->tareaModel->crearTarea($titulo, $descripcion, $fechaEstimadaFinalizacion, $creadorTarea, $idEmpleado, $idEstado, $idPrioridad, $observaciones);
            header('Location: /proyecto_mvc_php_Taller1/public/index.php'); // Redirigir después de crear
            exit();
        }

     
        require_once 'app/views/crear_tarea.php';
    }
}
