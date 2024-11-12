<?php
namespace App\models\queries;

class EmpleadosQueries {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Método para obtener todos los empleados
    public function obtenerTodosLosEmpleados() {
        $query = "SELECT * FROM empleados";  // Ajusta el nombre de la tabla si es necesario
        $result = $this->conn->query($query);

        $empleados = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $empleados[] = (object) $row;  // Convierte cada fila en un objeto
            }
        } else {
            error_log("No se encontraron empleados o problema en la consulta SQL.");
        }
        return $empleados;
    }

    // Método para obtener un empleado por ID
    public function obtenerEmpleadoPorId($id) {
        $query = "SELECT * FROM empleados WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $empleado = $result->fetch_assoc();
        $stmt->close();

        return $empleado ? (object) $empleado : null;  // Retorna el empleado como objeto o null si no existe
    }

    // Método para crear un nuevo empleado
    public function crearEmpleado($nombre, $email, $puesto) {
        $query = "INSERT INTO empleados (nombre, email, puesto) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $nombre, $email, $puesto);
        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;  // Retorna true si fue exitoso
    }

    // Método para actualizar un empleado
    public function actualizarEmpleado($id, $nombre, $email, $puesto) {
        $query = "UPDATE empleados SET nombre = ?, email = ?, puesto = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $nombre, $email, $puesto, $id);
        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;  // Retorna true si fue exitoso
    }

    // Método para eliminar un empleado por ID
    public function eliminarEmpleado($id) {
        $query = "DELETE FROM empleados WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;  // Retorna true si fue exitoso
    }
}
