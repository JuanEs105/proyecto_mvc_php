<?php

namespace App\models\entity;


use App\models\db\Database;
use App\models\queries\EstadoQueries;

class Estado
{

    private $id;
    private $nombre;

    function set($prop, $value)
    {
        $this->{$prop} = $value;
    }

    function get($prop)
    {
        return $this->{$prop};
    }
    public static function all()
    {
        $sql = EstadoQueries::estado(); 
        $db = new Database();
        $result = $db->query($sql);
        $estados = [];
        while ($row = $result->fetch_assoc()) {
            $estado = new Estado();
            $estado->set('id', $row['id']);
            $estado->set('nombre', $row['nombre']);
            array_push($estados, $estado);
        }
        $db->close();
        return $estados;
    }
}
