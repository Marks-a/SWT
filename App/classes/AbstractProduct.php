<?php 
namespace App\classes;
use App\classes\Database;
abstract class AbstractProduct {
    private $conn;
  
    private $table = 'products';      //Table in the db called "products"
    private $sku;
    private $name;
    private $price;
    private $type;
    private $attribute;
    public function __construct($db) {
        $this->conn = $db;
    }
    //Setters & Getters;
    public function setSku($sku) {
        $this->sku = $sku;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setType($type) {
        $this->type = $type;
    }
    public function setAttribute($attribute) {
        $this->attribute = $attribute;
    }

    // Getters
    public function getSku() {
        return $this->sku;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getType() {
        return $this->type;
    }
    public function getAttribute() {
        return $this->attribute;
    }

    //Creates a product
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (SKU, name, price, type, attribute) VALUES (:sku, :name, :price, :type, :attribute)';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':attribute', $this->attribute);
        if ($stmt->execute()) {
            return true;
        }
        printf("Error(Product file create func): %s.\n", $stmt->error);

        return false;
    }

    //Gettings the product from DB
    public function read() {
        $query = 'SELECT SKU, name, price, type, attribute FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }



    //Deleting function
    public function  delete($sku) {
        if (!is_array($sku)) {
            $sku = [$sku];
        }
        $in = str_repeat('?,', count($sku) - 1) . '?';
        $query = 'DELETE FROM ' . $this->table . ' WHERE SKU IN (' . $in . ')';
        $stmt = $this->conn->prepare($query);
        if( $stmt->execute($sku)) {
            return true;
    }
    printf('Error in delete function(Product): %s.\n', $stmt->error);
    return false;
}



}



?>