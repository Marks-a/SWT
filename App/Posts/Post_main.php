<?php
namespace App\Posts;

use App\classes\ProductListPage;
use App\classes\Database;
use Exception;
use PDOException;

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
class Post_main
{
    public $product;
    public function __construct()
    {
        $datbase = new Database();
        $conn = $datbase->connect();
        //Using the previously constructed PHP OOP class.
        $this->product = new ProductListPage($conn);
    }

    public function handleRequestDelete()
    {
        if (
            $_SERVER['REQUEST_METHOD'] == 'POST' &&
            !empty($_POST['items'])
        ) {
            try {
                $itemsToDelete = $_POST['items'];
                $this->product->delete($itemsToDelete);
                //Needs testing to see if this needed. with the header and exit.
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit;
            } catch (Exception $e) {
                echo "No items selected for deletion.";
            }
        }
        $this->__destruct();
    }
    public function handleRequestAdd($currentPage)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $currentPage === 'add_product_form.php') {
            try {
                $productSku = $_POST['sku'];
                $productName = $_POST['name'];
                $productPrice = $_POST['price'];
                $productType = $_POST['type'];
                $errors = [];

                // Validate required fields
                if (empty($productSku)) {
                    $errors[] = 'SKU in POST is required.';
                }
                if (empty($productName)) {
                    $errors[] = 'Name in POST is required.';
                }
                if (empty($productPrice) || !is_numeric($productPrice)) {
                    $errors[] = 'Valid price in POST is required.';
                }
                if (empty($productType)) {
                    $errors[] = 'Product type in POST is required.';
                }
                $attributes = [];
                if (isset($_POST['size'])) {
                    $attributes['Size (MB)'] = $_POST['size'];
                } elseif (isset($_POST['weight'])) {
                    $attributes['Weight (KG)'] = $_POST['weight'];
                } elseif (isset($_POST['height']) && isset($_POST['width']) && isset($_POST['length'])) {
                    $attributes['Height (CM)'] = $_POST['height'];
                    $attributes['Width (CM)'] = $_POST['width'];
                    $attributes['Length (CM)'] = $_POST['length'];
                }
                if (empty($attributes)) {
                    $errors[] = 'Chosen type attributes is required.';
                }

                if (empty($errors)) {
                    $this->product->setSku($productSku);
                    $this->product->setName($productName);
                    $this->product->setPrice($productPrice);
                    $this->product->setType($productType);
                    $formattedAttributes = [];
                    foreach ($attributes as $key => $value) {
                        $formattedAttributes[] = "$key: $value";
                    }
                    $attributeString = implode(', ', $formattedAttributes);
                    $this->product->setAttribute($attributeString);
                    $this->product->create();
                    echo 'Successfully added';
                    header('Location: ../src/index.php');
                    exit();
                } else {
                    foreach ($errors as $element) {
                        echo '<p>' . htmlspecialchars($element) . '</p>' . '<br>'; // Use htmlspecialchars to avoid XSS attacks
                    }
                    ;
                    exit();
                }
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    echo '<p class="error-message">Error: The SKU already exists</p>';
                    ob_flush();
                    flush();
                } else {
                    echo  '<p class="error-message">Error: Try/catch block |</p>' . $e->getMessage();
                    ob_flush();
                    flush();
                }

            }

        }
        // $this->__destruct();
    }
    public function __destruct()
    {
        $this->product = null;
    }
}