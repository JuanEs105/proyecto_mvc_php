<?php
namespace App\models\db;
use mysqli;
class Database
{
    private $host = 'localhost';
    private $user = 'root';
    private $pwd = '';
    private $name = 'tareas_db';
    private $conex;
    function __construct()
    {
        $this->conex = new mysqli(
            $this->host,
            $this->user,
            $this->pwd,
            $this->name,
        );
    }
    function close()
    {
        $this->conex->close();
    }
    function query($sql)
    {
        if ($this->conex->connect_error) {
            echo $this->conex->connect_error;
            return null;
        }
        return $this->conex->query($sql);
    }
    public function getConnection() {
        $this->conex = new \mysqli($this->host, $this->user, $this->pwd, $this->name);
        if ($this->conex->connect_error) {
            die("Error de conexión a la base de datos: " . $this->conex->connect_error);
        }
        $this->conex->set_charset("utf8"); // Establecer el conjunto de caracteres

        return $this->conex;
    }
    
}
