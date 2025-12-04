<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    $barcode = isset($_GET['barcode']) ? $_GET['barcode'] : '';
} else if ($method == 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    $barcode = isset($data->barcode) ? $data->barcode : '';
}

if (!empty($barcode)) {
    if ($product->getByBarcode($barcode)) {
        $product_data = array(
            "id" => $product->id,
            "barcode" => $product->barcode,
            "name" => $product->name,
            "description" => $product->description,
            "brand" => $product->brand,
            "category" => $product->category,
            "image_url" => $product->image_url,
            "eco_metrics" => array(
                "co2_emissions" => $product->co2_emissions,
                "water_usage" => $product->water_usage,
                "recyclability" => $product->recyclability,
                "origin" => $product->origin,
                "carbon_footprint" => $product->carbon_footprint,
                "energy_consumption" => $product->energy_consumption
            ),
            "comparisons" => array(
                "category_avg" => array(
                    "co2" => $product->category_avg_co2,
                    "water" => $product->category_avg_water,
                    "recycle" => $product->category_avg_recycle
                ),
                "best_option" => array(
                    "co2" => $product->best_option_co2,
                    "water" => $product->best_option_water,
                    "recycle" => $product->best_option_recycle
                )
            )
        );

        http_response_code(200);
        echo json_encode(array(
            "success" => true,
            "message" => "Producto encontrado",
            "data" => $product_data
        ));
    } else {
        http_response_code(404);
        echo json_encode(array(
            "success" => false,
            "message" => "Producto no encontrado"
        ));
    }
} else {
    http_response_code(400);
    echo json_encode(array(
        "success" => false,
        "message" => "Código de barras requerido"
    ));
}
?>