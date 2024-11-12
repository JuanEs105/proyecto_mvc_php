<?php
require '../models/db/database.php';
require '../models/entity/tarea.php';
require '../controllers/tareasController.php';

use App\controllers\TareasController;

$tareaController = new TareasController();
$tarea = new \App\models\entity\Tarea();

if (!empty($_POST['id'])) {
    $tarea->set('id', $_POST['id']);
}

$tarea->set('titulo', $_POST['titulo']);
$tarea->set('descripcion', $_POST['descripcion']);
$tarea->set('fechaEstimadaFinalizacion', $_POST['fechaEstimadaFinalizacion']);
$tarea->set('idEmpleado', $_POST['idEmpleado']);
$tarea->set('idEstado', $_POST['idEstado']);
$tarea->set('idPrioridad', $_POST['idPrioridad']);
$tarea->set('observaciones', $_POST['observaciones']);

if ($tareaController->saveTarea($tarea)) {
    echo "Tarea guardada con éxito.";
} else {
    echo "Error al guardar la tarea.";
}
?>
