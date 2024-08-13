<?php
namespace App\classes\subClasses;

use App\classes\AbstractProduct;
class Dvd extends AbstractProduct {
private $size;

//Setters  & getters
public function setSize($size) {
    $this->size = $size;
    $this->setAttribute($this->attributeToString());
}
public function getSize() {
    return $this->size;
}

public function attributeToString() {
    return 'Size: ' . $this->size . ' MB';
}

}
?>