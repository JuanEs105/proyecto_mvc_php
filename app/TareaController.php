<?php
require_once '../app/config/database.php'; 
require_once '../app/models/Tarea.php';

class TareaController {
    private $tarea;

    public function __construct($pdo) {
        $this->tarea = new Tarea($pdo); 
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $fechaEstimadaFinalizacion = $_POST['fechaEstimadaFinalizacion'];
            $creadorTarea = $_POST['creadorTarea'];
            $idEmpleado = $_POST['idEmpleado'];
            $idEstado = $_POST['idEstado'];
            $idPrioridad = $_POST['idPrioridad'];
            $observaciones = $_POST['observaciones'];

            if ($this->tarea->crear($titulo, $descripcion, $fechaEstimadaFinalizacion, $creadorTarea, $idEmpleado, $idEstado, $idPrioridad, $observaciones)) {
                header("Location: /tareas-app/public/index.php");
            } else {
                
            }
        }
        require '../app/views/crear_tarea.php';
    }

   
}
?>