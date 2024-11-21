<?php

namespace app\Models;

include(__DIR__ . "/../Config/DatabaseConfig.php");

use app\Config\DatabaseConfig;
use mysqli;

class Product extends DatabaseConfig {
    public $conn;

    public function __construct() {
        // Connect to MySQL database
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database_name, $this->port);
        
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Function to retrieve all products
    public function findAll() {
        $sql = "SELECT * FROM properti";
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $this->conn->close();
        return $data;
    }

    // Function to retrieve product by ID
    public function findById($id) {
        $sql = "SELECT * FROM properti WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;
    }

    // Function to create a new product
    public function create($data) {
        $properti_rumah = $data['properti_rumah'];
        $properti_harga = $data['properti_harga'];
        $tanggal_terdaftar = $data['tanggal_terdaftar'];
        
        $query = "INSERT INTO properti (properti_rumah, properti_harga, tanggal_terdaftar) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sds", $properti_rumah, $properti_harga, $tanggal_terdaftar);
        $stmt->execute();
        $stmt->close();
    }

    // Function to update a product by ID
    public function update($data, $id) {
        $properti_rumah = $data['properti_rumah'];
        $properti_harga = $data['properti_harga'];
        $tanggal_terdaftar = $data['tanggal_terdaftar'];

        $query = "UPDATE properti SET properti_rumah = ?, properti_harga = ?, tanggal_terdaftar = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sdsi", $properti_rumah, $properti_harga, $tanggal_terdaftar, $id);
        $stmt->execute();
        $stmt->close();
    }

    // Function to delete a product by ID
    public function delete($id) {
        $query = "DELETE FROM properti WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}
?>
