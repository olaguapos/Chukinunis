<?php
// Script opcional para crear la base de datos
// Ejecutar una vez manualmente si se quiere usar base de datos real

$host = 'localhost';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear base de datos
    $pdo->exec("CREATE DATABASE IF NOT EXISTS ecoscan_db");
    $pdo->exec("USE ecoscan_db");

    // Crear tablas
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            barcode VARCHAR(50) UNIQUE NOT NULL,
            name VARCHAR(255) NOT NULL,
            description TEXT,
            brand VARCHAR(100),
            category VARCHAR(100),
            image_url VARCHAR(500),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS eco_metrics (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_id INT,
            co2_emissions DECIMAL(8,2),
            water_usage DECIMAL(8,2),
            recyclability DECIMAL(5,2),
            origin VARCHAR(100),
            carbon_footprint DECIMAL(8,2),
            energy_consumption DECIMAL(8,2),
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
        )
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS comparisons (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_id INT,
            category_avg_co2 DECIMAL(8,2),
            category_avg_water DECIMAL(8,2),
            category_avg_recycle DECIMAL(5,2),
            best_option_co2 DECIMAL(8,2),
            best_option_water DECIMAL(8,2),
            best_option_recycle DECIMAL(5,2),
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
        )
    ");

    echo "Base de datos creada exitosamente!";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>