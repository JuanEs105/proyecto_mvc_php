<?php

namespace App\views;

use App\controllers\TareasController;

class TareasView
{
    private $tareasController;

    function __construct()
    {
        $this->tareasController = new TareasController();
    }

    function tablaTareas()
{
    $rows = '';
    $tareas = $this->tareasController->allTareas();
    if (count($tareas) > 0) {
        foreach ($tareas as $tarea) {
            $id = $tarea->get('id');
            $estado = $tarea->get('estado');
            $claseEstado = ($estado === 'impedimento') ? 'estado-impedimento' : '';
            $rows .= '<tr class="' . $claseEstado . '">';
            $rows .= '<td>' . $tarea->get('titulo') . '</td>';
            $rows .= '<td>' . $tarea->get('responsable') . '</td>';
            $rows .= '<td>' . $tarea->get('prioridad') . '</td>';
            $rows .= '<td>' . $estado . '</td>';
            $rows .= '<td>';
            $rows .= '<button onclick="onChangeEstado(' . $id . ', \'' . $estado . '\')">Cambiar Estado</button>';
            $rows .= '</td>';
            $rows .= '<td>';
            $rows .= '<button onclick="onReasignarTarea(' . $id . ')">Reasignar</button>';
            $rows .= '</td>';
            $rows .= '<td>';
            $rows .= '<button onClick="onDeleteTarea(' . $id . ')">Eliminar</button>';
            $rows .= '</td>';
            $rows .= '</tr>';
        }
    } else {
        $rows .= '<tr><td colspan="7">No se han registrado tareas </td></tr>';
    }

    $table = '<table>';
    $table .= '<thead><tr><th>Título</th><th>Responsable</th><th>Prioridad</th><th>Estado</th><th>Cambiar Estado</th><th>Reasignar</th><th>Eliminar</th></tr></thead>';
    $table .= '<tbody>' . $rows . '</tbody>';
    $table .= '</table>';
    return $table;
}




    function getMsgConfirmarTarea($datosFormulario)
    {
        $datosGuardados = empty($datosFormulario['cod'])
            ? $this->tareasController->newTarea($datosFormulario)
            : $this->tareasController->updateTarea($datosFormulario);
        if ($datosGuardados) {
            return '<P>Tarea asignada correctamente</P>';
        } else {
            return '<P>No se pudo guardar la tarea</P>';
        }
    }

    function getMsgEliminarTarea($id)
    {
        $datoEliminado = $this->tareasController->deleteTarea($id);
        if ($datoEliminado) {
            return '<P>Tarea eliminada</P>';
        } else {
            return '<P>No se pudo eliminar la tarea</P>';
        }
    }

}