<?php
require_once '../../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Handling\PageControllers\headerController;
use App\Handling\PageControllers\footerController;
use App\Handling\PageControllers\productListController;
use App\Handling\PageControllers\add_productController;




$page = isset($_GET['page']) ? $_GET['page'] : 'product_list';
new HeaderController($page);
if ($page === 'add_product_form.php') {
    new add_productController();
} else  {
    new productListController();
}

try {
new footerController();
    } catch (Exception $e) {
        echo "Error in footerController: " . $e->getMessage() . "<br>";
    }
