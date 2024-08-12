<?php
namespace App\classes\subClasses;

use App\classes\AbstractProduct;
class Book extends AbstractProduct {
    private $weight;
    //Setters and getters
    public function setWeight($weight) {
        $this->weight = $weight;
        $this->setAttribute($this->attributeToString());
    }
    public function getWeight() {
        return $this->weight;
    }
    public function attributeToString() {
        return 'Weight: ' . $this->weight . ' KG';
    }

}

?>