<?php
namespace App\classes\subClasses;

use App\classes\AbstractProduct;

class Furniture extends AbstractProduct {
    private $height;
    private $width;
    private $length;

    //Getters & setters;
    public function getHeight() {
        return $this->height;
    }
    public function getWidth() {
        return $this->width;
    }
    public function getLength() {
        return $this->length;
    }
    public function setHeight($height) {
        $this->height = $height;
        $this->setAttribute($this->attributeToString());
    }
    public function setWidth($width) {
        $this->width = $width;
        $this->setAttribute($this->attributeToString());
    }
    public function setLength($length) {
        $this->length = $length;
        $this->setAttribute($this->attributeToString());
    }
    public function attributeToString() {
        return 'Dimensions: ' . $this->height . 'x' . $this->width . 'x' . $this->length . ' CM';
    }


}
 ?>