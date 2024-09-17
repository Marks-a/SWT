<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\classes\ProductTypes;


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $productType = isset($_GET['productType']) ? htmlspecialchars($_GET['productType']) : '';

    $productTypeManager = new ProductTypes();
    $attributeFieldsHtml = $productTypeManager->renderAttributeFields($productType);

    echo $attributeFieldsHtml;
} else {
    http_response_code(405);
    echo 'Method Not Allowed';
}
