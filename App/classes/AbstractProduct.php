<?php
namespace App\classes;
use App\classes\Database;
use App\classes\ProductTypes;
abstract class AbstractProduct
{
    private $conn;

    private $table = 'products';      //Table in the db called "products"
    private $sku;
    private $name;
    private $price;
    private $type;
    private $attribute;

    protected $attributes = [];
    // public function __construct($db)
    // {
    //     $this->conn = $db;
    // }
    public function __construct($db, $isku, $iname, $iprice)
    {
        $this->conn = $db;
        $this->setSku($isku);
        $this->setName($iname);
        $this->setPrice($iprice);
    }

    //Setters & Getters;
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    // public function setAttribute($attribute)
    // {
    //     $this->attribute = $attribute;
    // }

    // Getters
    public function getSku()
    {
        return $this->sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getType()
    {
        return $this->type;
    }


    //Creates a product
    public function create()
    {
        $attributes = $this->getAttributes();
        $query = 'INSERT INTO ' . $this->table . ' (SKU, name, price, type, attribute) VALUES (:sku, :name, :price, :type, :attribute)';

        $stmt = $this->conn->prepare($query);
        echo 'Inserting SKU: ' . $this->sku . '<br>';

        $stmt->bindParam(':sku', $this->sku);

        $stmt->bindParam(':name', $this->name);

        $stmt->bindParam(':price', $this->price);

        $stmt->bindParam(':type', $this->type);

        $this->attribute = $this->convertAttributesToString($attributes);
        $stmt->bindParam(':attribute', $this->attribute);
        if ($stmt->execute()) {
            echo "The items was added succesfully";
            return true;
        }
        printf("Error(Product file create func): %s.\n", $stmt->error);

        return false;
    }
    function convertAttributesToString(array $attributes): string
    {
        $attributeStrings = [];

        foreach ($attributes as $key => $value) {
            $attributeStrings[] = "{$key} : {$value}";
        }

        // Join each key-value pair with a semicolon
        return implode(', ', $attributeStrings);
    }

    //Gettings the product from DB
    public function read()
    {
        $query = 'SELECT SKU, name, price, type, attribute FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }


    //Deleting function
    public function delete($sku)
    {
        if (!is_array($sku)) {
            $sku = [$sku];
        }
        $in = str_repeat('?,', count($sku) - 1) . '?';
        $query = 'DELETE FROM ' . $this->table . ' WHERE SKU IN (' . $in . ')';
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute($sku)) {
            return true;
        }
        printf('Error in delete function(Product): %s.\n', $stmt->error);
        return false;
    }

    public function renderAttributes(): string
    {
        $html = '';
        foreach ($this->attributes as $attribute) {
            $html .= '
                <label for="' . $attribute['id'] . '">' . $attribute['label'] . ':</label>
                <input type="number" name="' . $attribute['name'] . '" id="' . $attribute['id'] . '" required min="0" step="0.01" >
                <br>
            ';
        }
        return $html;
    }


    abstract protected function getAttributes(): array;

    public static function getAttSelectors(): array
    {
        // This function is for Javascript for save-btn.
        $allAttributeForSelector = [];
        $allAttributeClass = (new ProductTypes())->getProductTypes();
        foreach ($allAttributeClass as $type => $class) {
            $allAttributeForSelector[$type] = $class->getSelectors();
        }
        return $allAttributeForSelector;
    }
    abstract public function getSelectors(): array;

}
;




?>