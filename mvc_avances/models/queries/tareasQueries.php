<?php

namespace App\models\queries;

class TareasQuery
{
    // Obtener todas las tareas ordenadas por prioridad y fecha estimada de finalización
    static function all()
    {
        return "SELECT * FROM tareas ORDER BY idprioridad DESC, fechaEstimadaFinalizacion ASC";
    }

        static function allEmpleados() {
        return "SELECT * FROM empleados";
    }

    static function allEstados() {
        return "SELECT * FROM estados";
    }

    static function allPrioridades() {
        return "SELECT * FROM prioridades";
    }

    static function insert($tarea) {
        return "INSERT INTO tareas (titulo, descripcion, fechaEstimadaFinalizacion, creadorTarea, idEmpleado, idEstado, idPrioridad, observaciones) 
                VALUES ('{$tarea->get('titulo')}', '{$tarea->get('descripcion')}', '{$tarea->get('fechaEstimadaFinalizacion')}', '{$tarea->get('creadorTarea')}', '{$tarea->get('idEmpleado')}', '{$tarea->get('idEstado')}', '{$tarea->get('idPrioridad')}', '{$tarea->get('observaciones')}')";
    }

    // Obtener una tarea por su ID
    static function whereId($id)
    {
        return "SELECT * FROM tareas WHERE id=$id";
    }

    // Actualizar una tarea existente
    static function update($tarea)
    {
        $id = $tarea->get('id');
        $titulo = $tarea->get('titulo');
        $descripcion = $tarea->get('descripcion');
        $responsable = $tarea->get('responsable');
        $prioridad = $tarea->get('prioridad');
        $estado = $tarea->get('estado');
        $fechaEstimacion = $tarea->get('fecha_estimacion');
        $fechaModificacion = date('Y-m-d');

        $sql = "UPDATE tareas SET 
                    titulo='$titulo', 
                    descripcion='$descripcion', 
                    responsable='$responsable', 
                    prioridad='$prioridad', 
                    estado='$estado', 
                    fecha_modificacion='$fechaModificacion', 
                    fecha_estimacion='$fechaEstimacion' 
                WHERE id=$id";
        return $sql;
    }

    // Eliminar una tarea
    static function delete($id)
    {
        return "DELETE FROM tareas WHERE id=$id";
    }

    // Filtrar tareas por prioridad, fecha y responsable
    static function filter($filtros)
    {
        $where = "WHERE 1=1";
        if (!empty($filtros['prioridad'])) {
            $where .= " AND prioridad = '{$filtros['prioridad']}'";
        }
        if (!empty($filtros['responsable'])) {
            $where .= " AND responsable LIKE '%{$filtros['responsable']}%'";
        }
        if (!empty($filtros['fecha_inicio']) && !empty($filtros['fecha_fin'])) {
            $where .= " AND fecha_estimacion BETWEEN '{$filtros['fecha_inicio']}' AND '{$filtros['fecha_fin']}'";
        }
        return "SELECT * FROM tareas $where ORDER BY prioridad DESC, fecha_estimacion ASC";
    }
    
    static function updateEstado($tarea)
    {
        $id = $tarea->get('id');
        $idEstado = $tarea->get('idEstado');
        $updated_at = $tarea->get('updated_at');
        $sql = "update tareas set idEstado='$idEstado', updated_at='$updated_at' where id=$id";
        return $sql;
    }
    static function updateEmpleado($tarea)
    {
        $id = $tarea->get('id');
        $idEmpleado = $tarea->get('idEmpleado');
        $updated_at = $tarea->get('updated_at');
        $sql = "update tareas set idEmpleado='$idEmpleado', updated_at='$updated_at' where id=$id";
        return $sql;
    }
}
