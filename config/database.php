<?php
class Database {
    private $host = "localhost";
    private $db_name = "ecoscan_db";
    private $username = "root";
    private $password = "";  // Por defecto en XAMPP está vacío
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            // Si hay error, usar modo demo con datos de ejemplo
            error_log("Error de conexión: " . $exception->getMessage());
        }
        return $this->conn;
    }
}
?>