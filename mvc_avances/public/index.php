<?php
require '../models/db/database.php';
require '../models/queries/tareasQueries.php';
require '../models/entity/tarea.php';
require '../models/entity/empleado.php';
require '../models/entity/estado.php';
require '../models/entity/prioridad.php';
require '../controllers/tareasController.php';
require '../views/tareasView.php';
require '../views/modalesView.php';

use App\views\TareasView;
use App\views\ModalesView;


$tareasView = new TareasView();
$modalesView = new ModalesView();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>admin de tareas</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/modales.css">
</head>
<body>
    <header>
        <h1> Seguimiento Tareas</h1>
    </header>
    <section>
        <a href="formularioTarea.php">Registrar Tarea</a>
        <br><br>
        <?php echo $tareasView->tablaTareas(); ?>
    </section>
    <?php echo $modalesView->getConfirmacion('modalEliminarTarea', 'eliminarTarea.php', 'tareaForm'); ?>
    <script src="js/tareas.js"></script>
</body>
</html>
