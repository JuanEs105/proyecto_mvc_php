<?php
namespace App\controllers;

use App\models\entity\Tarea;
use App\models\entity\Prioridad;
use App\models\entity\Estado;
use App\models\entity\Empleado;
use App\models\db\Database;

class TareasController {

    
    // Obtener todas las tareas
    function allTareas() {
        return Tarea::all();
    }

    // Obtener todos los empleados
    public function getAllEmpleados() {
        return Empleado::all();
    }
 
    // Crear una nueva tarea
    function saveTarea($datos) {
        $tarea = new Tarea();
        $tarea->set('titulo', $datos['titulo']);
        $tarea->set('descripcion', $datos['descripcion']);
        $tarea->set('fechaEstimadaFinalizacion', $datos['fechaEstimadaFinalizacion']);
        $tarea->set('creadorTarea', $datos['creadorTarea']);
        $tarea->set('idEmpleado', $datos['idEmpleado']);
        $tarea->set('idEstado', $datos['idEstado']);
        $tarea->set('idPrioridad', $datos['idPrioridad']);
        $tarea->set('observaciones', $datos['observaciones']);
        return $tarea->save();
    }

    // Obtener una tarea por ID
    function getTarea($id) {
        return Tarea::find($id);
    }

    // Actualizar una tarea existente
    function updateTarea($datos) {
        $tarea = Tarea::find($datos['id']);
        if ($tarea) {
            $tarea->set('titulo', $datos['titulo']);
            $tarea->set('descripcion', $datos['descripcion']);
            $tarea->set('fechaEstimadaFinalizacion', $datos['fechaEstimadaFinalizacion']);
            $tarea->set('idEmpleado', $datos['idEmpleado']);
            $tarea->set('idEstado', $datos['idEstado']);
            $tarea->set('idPrioridad', $datos['idPrioridad']);
            $tarea->set('observaciones', $datos['observaciones']);
            return $tarea->update();
        }
        return false;
    }

    // Nueva Tarea
    function newTarea($datos){

    }

    // Eliminar una tarea por ID
    function deleteTarea($id) {
        $tarea = Tarea::find($id);
        return $tarea ? $tarea->delete() : false;
    }

    
    
}
