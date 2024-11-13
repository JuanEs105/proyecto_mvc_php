<?php
require '../models/db/database.php';

require '../models/queries/tareasQueries.php';
require '../models/queries/empleadosQueries.php';
require '../models/queries/prioridadQueries.php';
require '../models/queries/estadoQueries.php';

require '../models/entity/tarea.php';
require '../models/entity/empleado.php';
require '../models/entity/estado.php';
require '../models/entity/prioridad.php';

require '../controllers/tareasController.php';
require '../controllers/estadoController.php';
require '../controllers/prioridadcontroller.php';
require '../controllers/empleadosController.php';

require '../views/tareasView.php';
require '../views/estadosView.php';


use App\controllers\TareasController;
use App\views\TareasViews;
use App\views\PrioridadesViews;
use App\views\EmpleadosViews;
use App\views\EstadosViews;

$titulo = empty($_GET['id']) ? 'Crear tarea' : 'Modificar tarea';
$tareaController = new TareasController();

// Obtenemos los datos de empleados, estados y prioridades
$tarea = new \App\models\entity\Tarea();
$empleados = $tareaController->getAllEmpleados();
$estados = $estadoController->getAllEstados();
$prioridades = [
    (object) ['id' => 'alta', 'nombre' => 'Alta'],
    (object) ['id' => 'media', 'nombre' => 'Media'],
    (object) ['id' => 'baja', 'nombre' => 'Baja']
];

if (!empty($_GET['id'])) {
    $tarea = $tareaController->getTarea($_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>
    <link rel="stylesheet" href="css/formTarea.css">
</head>
<body>
    <section>
        <h1><?php echo $titulo; ?></h1>
        <form action="confirmarTarea.php" method="post">
            <?php if (!empty($_GET['id'])): ?>
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <?php endif; ?>

            <!-- Título de la Tarea -->
            <div>
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" value="<?php echo $tarea->get('titulo'); ?>" required>
            </div>

            <!-- Descripción de la Tarea -->
            <div>
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" required><?php echo $tarea->get('descripcion'); ?></textarea>
            </div>

            <!-- Empleado Responsable -->
            <div>
                <label for="idEmpleado">Empleado Responsable:</label>
                <select name="idEmpleado" id="idEmpleado" required>
                    <option value="">Seleccione un empleado</option>
                    <?php if (!empty($empleados) && is_array($empleados)): ?>
                        <?php foreach ($empleados as $empleado): ?>
                            <option value="<?php echo $empleado->id; ?>"
                                <?php echo $empleado->id == $tarea->get('idEmpleado') ? 'selected' : ''; ?>>
                                <?php echo $empleado->nombre; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">No hay empleados disponibles</option>
                    <?php endif; ?>
                </select>
            </div>

            <!-- Estado de la Tarea -->
            <div>
                <label for="idEstado">Estado de la Tarea:</label>
                <select name="idEstado" id="idEstado" required>
                    <option value="">Seleccione un estado</option>
                    <?php if (!empty($estados) && is_array($estados)): ?>
                        <?php foreach ($estados as $estado): ?>
                            <option value="<?php echo $estado->id; ?>"
                                <?php echo $estado->id == $tarea->get('idEstado') ? 'selected' : ''; ?>>
                                <?php echo $estado->nombre; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">No hay estados disponibles</option>
                    <?php endif; ?>
                </select>
            </div>

            <!-- Prioridad de la Tarea -->
            <div>
                <label for="idPrioridad">Prioridad de la Tarea:</label>
                <select name="idPrioridad" id="idPrioridad" required>
                    <option value="">Seleccione una prioridad</option>
                    <?php if (!empty($prioridades) && is_array($prioridades)): ?>
                        <?php foreach ($prioridades as $prioridad): ?>
                            <option value="<?php echo $prioridad->id; ?>"
                                <?php echo $prioridad->id == $tarea->get('idPrioridad') ? 'selected' : ''; ?>>
                                <?php echo $prioridad->nombre; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">No hay prioridades disponibles</option>
                    <?php endif; ?>
                </select>
            </div>

            <!-- Fecha Estimada de Finalización -->
            <div>
                <label for="fechaEstimacion">Fecha Estimada de Finalización:</label>
                <input type="date" name="fechaEstimacion" id="fechaEstimacion" value="<?php echo $tarea->get('fechaEstimacion'); ?>" required>
            </div>

            <!-- Observaciones -->
            <div>
                <label for="observaciones">Observaciones:</label>
                <textarea name="observaciones" id="observaciones"><?php echo $tarea->get('observaciones'); ?></textarea>
            </div>

            <div>
                <button type="submit">Guardar</button>
            </div>
        </form>
    </section>
</body>
</html>
