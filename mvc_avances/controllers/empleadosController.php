<?php
namespace App\controllers;

use App\models\entity\Empleado;

class EmpleadosController{
    function getAllEmpleados(){
        return Empleado::all();
    }
}
?>