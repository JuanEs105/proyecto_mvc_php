<?php
namespace App\controllers;
use App\models\entity\Estado;

class EstadoController {
    
    function Estados() {
        return Estado::all(); 
    }
}