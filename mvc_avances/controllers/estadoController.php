<?php
namespace App\controllers;

use App\models\entity\Estado;

class EstadoController {
    public function getAllEstados() {
        return Estado::all(); 
    }
}
