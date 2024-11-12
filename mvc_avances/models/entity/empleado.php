<?php
namespace App\models\entity;

require_once __DIR__ . '/../queries/empleadosQueries.php';
use App\models\queries\EmpleadosQueries;
use App\models\db\Database;

class Empleado {
    private static $empleadosQuery;

    public static function all() {
        if (!self::$empleadosQuery) {
            $database = new Database();
            $conex = $database->getConnection();
            self::$empleadosQuery = new EmpleadosQueries($conex);
        }
        return self::$empleadosQuery->obtenerTodosLosEmpleados();
    }
}
