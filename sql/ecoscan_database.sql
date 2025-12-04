CREATE DATABASE IF NOT EXISTS ecoscan_db;
USE ecoscan_db;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    barcode VARCHAR(50) UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    brand VARCHAR(100),
    category VARCHAR(100),
    image_url VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE eco_metrics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    co2_emissions DECIMAL(8,2), -- kg CO2
    water_usage DECIMAL(8,2), -- litros
    recyclability DECIMAL(5,2), -- porcentaje
    origin VARCHAR(100),
    carbon_footprint DECIMAL(8,2),
    energy_consumption DECIMAL(8,2), -- kWh
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE comparisons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    category_avg_co2 DECIMAL(8,2),
    category_avg_water DECIMAL(8,2),
    category_avg_recycle DECIMAL(5,2),
    best_option_co2 DECIMAL(8,2),
    best_option_water DECIMAL(8,2),
    best_option_recycle DECIMAL(5,2),
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Datos de ejemplo
INSERT INTO products (barcode, name, description, brand, category, image_url) VALUES
('7501006558602', 'Jugo de Naranja Natural', 'Jugo de naranja 100% natural, sin conservadores ni azúcares añadidos.', 'NaturalFresh', 'Bebidas', 'https://via.placeholder.com/300?text=Jugo+Natural'),
('7501055301029', 'Galletas Integrales', 'Galletas de avena con pasas, bajas en azúcar y altas en fibra.', 'Saludable', 'Snacks', 'https://via.placeholder.com/300?text=Galletas+Integrales'),
('7501035911202', 'Shampoo Natural', 'Shampoo con ingredientes naturales, libre de parabenos y sulfatos.', 'EcoCare', 'Cuidado Personal', 'https://via.placeholder.com/300?text=Shampoo+Natural');

INSERT INTO eco_metrics (product_id, co2_emissions, water_usage, recyclability, origin, carbon_footprint, energy_consumption) VALUES
(1, 1.20, 80.00, 90.00, 'Local', 2.10, 0.80),
(2, 0.80, 45.00, 75.00, 'Nacional', 1.50, 0.45),
(3, 1.50, 25.00, 60.00, 'Internacional', 2.80, 1.20);

INSERT INTO comparisons (product_id, category_avg_co2, category_avg_water, category_avg_recycle, best_option_co2, best_option_water, best_option_recycle) VALUES
(1, 1.80, 120.00, 75.00, 0.90, 60.00, 95.00),
(2, 1.20, 80.00, 65.00, 0.60, 35.00, 85.00),
(3, 2.10, 40.00, 55.00, 1.20, 15.00, 80.00);