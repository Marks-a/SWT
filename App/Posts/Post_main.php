<?php
namespace App\Posts;

use App\classes\ProductListPage;
use App\classes\Database;
use Exception;
use PDOException;
use App\classes\subClasses\Book;
use App\classes\subClasses\Dvd;
use App\classes\subClasses\Furniture;

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
class Post_main
{
    public $product;
    public $conn;
    public function __construct()
    {
        $datbase = new Database();
        $this->conn = $datbase->connect();
        //Using the previously constructed PHP OOP class.
    }

    public function handleRequestDelete()
    {
        if (
            $_SERVER['REQUEST_METHOD'] == 'POST' &&
            !empty($_POST['items'])
        ) {
            try {
                $this->product = new ProductListPage($this->conn);
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
                // $this->product = null;
                $productSku = $_POST['sku'] ?? null;
                $productName = $_POST['name'] ?? null;
                $productPrice = $_POST['price'] ?? null;
                $productType = $_POST['type'] ?? null;
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
                    // $attributes['Size (MB)'] = $_POST['size'];
                    $attributes[] = $_POST['size'];
                } elseif (isset($_POST['weight'])) {
                    // $attributes['Weight (KG)'] = $_POST['weight'];
                    $attributes[] = $_POST['weight'];
                } elseif (isset($_POST['height']) && isset($_POST['width']) && isset($_POST['length'])) {
                    $attributes[] = $_POST['height'];
                    $attributes[] = $_POST['width'];
                    $attributes[] = $_POST['length'];
                    // $attributes['Height (CM)'] = $_POST['height'];
                    // $attributes['Width (CM)'] = $_POST['width'];
                    // $attributes['Length (CM)'] = $_POST['length'];
                }
                if (empty($attributes)) {
                    $errors[] = 'Chosen type attributes is required.';
                }

                if (empty($errors)) {
                    switch ($productType) {
                        case 'Book':
                            $this->product = new Book(
                                $this->conn,
                                $productSku,
                                $productName,
                                $productPrice,
                                $attributes[0]
                            );
                            $this->product->setSku($productSku);
                            $this->product->setName($productName);
                            $this->product->setPrice($productPrice);
                            // $this->product->setSku($productSku);
                            break;
                        case 'Dvd':
                            $this->product = new DVD(
                                $this->conn,
                                $productSku,
                                $productName,
                                $productPrice,
                                $attributes[0]
                            );
                            echo "Dvd added Succesfully";
                            break;
                        case 'Furniture':
                            $this->product = new Furniture(
                                $this->conn,
                                $productSku,
                                $productName,
                                $productPrice,
                                $attributes[0],
                                $attributes[1],
                                $attributes[2]
                            );
                            echo "Furniture added Succesfully";
                            break;
                    }
                    echo "This product will now be created...";
                    $this->product->create();
                    $this->product = null;




                    // $this->product->setSku($productSku);
                    // $this->product->setName($productName);
                    // $this->product->setPrice($productPrice);
                    // $this->product->setType($productType);
                    // $formattedAttributes = [];
                    // foreach ($attributes as $key => $value) {
                    //     $formattedAttributes[] = "$key: $value";
                    // }
                    // $attributeString = implode(', ', $formattedAttributes);
                    // $this->product->setAttribute($attributeString);



                    // $this->product->create();
                    echo 'Successfully added';
                    header('Location: /');
                    exit();
                } else {
                    foreach ($errors as $element) {
                        echo '<p>' . htmlspecialchars($element) . '</p>' . '<br>'; // Use htmlspecialchars to avoid XSS attacks
                    }
                    ;
                    exit();
                }
            } catch (PDOException $e) {
                $errorCode = $e->getCode();
                $errorMessage = $e->getMessage();
                echo '<p class="error-message">Error Code: ' . $errorCode . ' | Message: ' . $errorMessage . '</p>';
                if ($e->getCode() == 23000) {
                    echo '<p class="error-message">Error: The SKU already exists</p>';
                    ob_flush();
                    flush();
                } else {
                    echo '<p class="error-message">Error: Try/catch block |</p>' . $e->getMessage();
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
