<?php
class Product {
    private $conn;
    private $table_name = "products";

    public $id;
    public $barcode;
    public $name;
    public $description;
    public $brand;
    public $category;
    public $image_url;
    public $co2_emissions;
    public $water_usage;
    public $recyclability;
    public $origin;
    public $carbon_footprint;
    public $energy_consumption;
    public $category_avg_co2;
    public $category_avg_water;
    public $category_avg_recycle;
    public $best_option_co2;
    public $best_option_water;
    public $best_option_recycle;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getByBarcode($barcode) {
        if (!$this->conn) {
            return $this->getSampleProduct($barcode);
        }

        $query = "SELECT 
                    p.*, 
                    em.co2_emissions, 
                    em.water_usage, 
                    em.recyclability, 
                    em.origin,
                    em.carbon_footprint,
                    em.energy_consumption,
                    c.category_avg_co2,
                    c.category_avg_water,
                    c.category_avg_recycle,
                    c.best_option_co2,
                    c.best_option_water,
                    c.best_option_recycle
                  FROM " . $this->table_name . " p
                  LEFT JOIN eco_metrics em ON p.id = em.product_id
                  LEFT JOIN comparisons c ON p.id = c.product_id
                  WHERE p.barcode = :barcode
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":barcode", $barcode);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->id = $row['id'];
            $this->barcode = $row['barcode'];
            $this->name = $row['name'];
            $this->description = $row['description'];
            $this->brand = $row['brand'];
            $this->category = $row['category'];
            $this->image_url = $row['image_url'];
            $this->co2_emissions = $row['co2_emissions'];
            $this->water_usage = $row['water_usage'];
            $this->recyclability = $row['recyclability'];
            $this->origin = $row['origin'];
            $this->carbon_footprint = $row['carbon_footprint'];
            $this->energy_consumption = $row['energy_consumption'];
            $this->category_avg_co2 = $row['category_avg_co2'];
            $this->category_avg_water = $row['category_avg_water'];
            $this->category_avg_recycle = $row['category_avg_recycle'];
            $this->best_option_co2 = $row['best_option_co2'];
            $this->best_option_water = $row['best_option_water'];
            $this->best_option_recycle = $row['best_option_recycle'];

            return true;
        }
        return false;
    }

    private function getSampleProduct($barcode) {
        // Ruta local para las imágenes
        $base_path = 'assets/images';
        
        $sampleProducts = [
            '7501006558602' => [
                'id' => 1,
                'barcode' => '7501006558602',
                'name' => 'Jugo de Naranja Natural',
                'description' => 'Jugo de naranja 100% natural, sin conservadores ni azúcares añadidos.',
                'brand' => 'NaturalFresh',
                'category' => 'Bebidas',
                'image_url' => $base_path . 'jugo.jpg', // ← Tu imagen local
                'co2_emissions' => 1.20,
                'water_usage' => 80.00,
                'recyclability' => 90.00,
                'origin' => 'Local',
                'carbon_footprint' => 2.10,
                'energy_consumption' => 0.80,
                'category_avg_co2' => 1.80,
                'category_avg_water' => 120.00,
                'category_avg_recycle' => 75.00,
                'best_option_co2' => 0.90,
                'best_option_water' => 60.00,
                'best_option_recycle' => 95.00
            ],
            '7501055301029' => [
                'id' => 2,
                'barcode' => '7501055301029',
                'name' => 'Galletas Integrales',
                'description' => 'Galletas de avena con pasas, bajas en azúcar y altas en fibra.',
                'brand' => 'Saludable',
                'category' => 'Snacks',
                'image_url' => $base_path . 'galletas.jpg',
                'co2_emissions' => 0.80,
                'water_usage' => 45.00,
                'recyclability' => 75.00,
                'origin' => 'Nacional',
                'carbon_footprint' => 1.50,
                'energy_consumption' => 0.45,
                'category_avg_co2' => 1.20,
                'category_avg_water' => 80.00,
                'category_avg_recycle' => 65.00,
                'best_option_co2' => 0.60,
                'best_option_water' => 35.00,
                'best_option_recycle' => 85.00
            ],
            '7501035911202' => [
                'id' => 3,
                'barcode' => '7501035911202',
                'name' => 'Shampoo Natural',
                'description' => 'Shampoo con ingredientes naturales, libre de parabenos y sulfatos.',
                'brand' => 'EcoCare',
                'category' => 'Cuidado Personal',
                'image_url' => $base_path . 'shampoo.jpg',
                'co2_emissions' => 1.50,
                'water_usage' => 25.00,
                'recyclability' => 60.00,
                'origin' => 'Internacional',
                'carbon_footprint' => 2.80,
                'energy_consumption' => 1.20,
                'category_avg_co2' => 2.10,
                'category_avg_water' => 40.00,
                'category_avg_recycle' => 55.00,
                'best_option_co2' => 1.20,
                'best_option_water' => 15.00,
                'best_option_recycle' => 80.00
            ]
        ];

        if (isset($sampleProducts[$barcode])) {
            $product = $sampleProducts[$barcode];
            
            $this->id = $product['id'];
            $this->barcode = $product['barcode'];
            $this->name = $product['name'];
            $this->description = $product['description'];
            $this->brand = $product['brand'];
            $this->category = $product['category'];
            $this->image_url = $product['image_url'];
            $this->co2_emissions = $product['co2_emissions'];
            $this->water_usage = $product['water_usage'];
            $this->recyclability = $product['recyclability'];
            $this->origin = $product['origin'];
            $this->carbon_footprint = $product['carbon_footprint'];
            $this->energy_consumption = $product['energy_consumption'];
            $this->category_avg_co2 = $product['category_avg_co2'];
            $this->category_avg_water = $product['category_avg_water'];
            $this->category_avg_recycle = $product['category_avg_recycle'];
            $this->best_option_co2 = $product['best_option_co2'];
            $this->best_option_water = $product['best_option_water'];
            $this->best_option_recycle = $product['best_option_recycle'];

            return true;
        }
        return false;
    }

    public function search($search_term) {
        if (!$this->conn) {
            return $this->searchSampleProducts($search_term);
        }

        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE name LIKE :search_term 
                  OR brand LIKE :search_term 
                  OR category LIKE :search_term 
                  LIMIT 10";

        $stmt = $this->conn->prepare($query);
        $search_term = "%{$search_term}%";
        $stmt->bindParam(":search_term", $search_term);
        $stmt->execute();

        return $stmt;
    }

    private function searchSampleProducts($search_term) {
        // Implementación simple de búsqueda en datos de ejemplo
        $base_path = 'assets/images';
        
        $allProducts = [
            [
                'id' => 1,
                'barcode' => '7501006558602',
                'name' => 'Jugo de Naranja Natural',
                'brand' => 'NaturalFresh',
                'category' => 'Bebidas',
                'image_url' => $base_path . 'jugo.jpg'
            ],
            [
                'id' => 2,
                'barcode' => '7501055301029',
                'name' => 'Galletas Integrales',
                'brand' => 'Saludable',
                'category' => 'Snacks',
                'image_url' => $base_path . 'galletas.jpg'
            ],
            [
                'id' => 3,
                'barcode' => '7501035911202',
                'name' => 'Shampoo Natural',
                'brand' => 'EcoCare',
                'category' => 'Cuidado Personal',
                'image_url' => $base_path . 'shampoo.jpg'
            ]
        ];

        $search_term = strtolower($search_term);
        $results = array_filter($allProducts, function($product) use ($search_term) {
            return strpos(strtolower($product['name']), $search_term) !== false ||
                   strpos(strtolower($product['brand']), $search_term) !== false ||
                   strpos(strtolower($product['category']), $search_term) !== false;
        });

        return array_slice($results, 0, 10);
    }
}
?>