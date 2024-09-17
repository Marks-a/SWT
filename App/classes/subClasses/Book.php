<?php
namespace App\classes\subClasses;

use App\classes\AbstractProduct;
class Book extends AbstractProduct
{
    private $weight;
    private $productName = "Book";
    public function __construct($db, $isku, $iname, $iprice, $iweight = 0)
    {
        parent::__construct($db, $isku, $iname, $iprice);
        $this->setType($this->productName);
        $this->weight = $iweight;
        $this->attributes = [
            [
                'label' => 'Weight (KG)',
                'name' => 'weight',
                'id' => 'weight',
                // 'value' => $this->weight
            ]
        ];
    }
    public function getSelectors(): array
    {
        return [$this->attributes[0]['id']];
    }

    public function getAttributes(): array
    {
        return [
            $this->attributes[0]['label'] => $this->weight
        ];
    }

    public function validate(): array
    {
        $errors = [];
        if (empty($this->weight) || $this->weight <= 0) {
            $errors[] = "Weight must be a positive number.";
        }
        return $errors;
    }


    //Setters and getters
    public function setWeight($weight)
    {
        $this->weight = $weight;
        // $this->setAttribute($this->attributeToString());
    }

    public function getWeight()
    {
        return $this->weight;
    }
    // public function attributeToString() {
    //     return 'Weight: ' . $this->weight . ' KG';
    // }


}

?>