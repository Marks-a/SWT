<?php
namespace App\classes\subClasses;

use App\classes\AbstractProduct;

class Furniture extends AbstractProduct {
    private $productName = "Furniture";
    private $height;
    private $width;
    private $length;
    public function __construct($db,$isku, $iname, $iprice,$iheight = 0, $iwidth = 0, $ilength = 0){
        parent::__construct($db,$isku, $iname, $iprice);
    
        $this->setType($this->productName);
        $this->setHeight($iheight);
        $this->setWidth($iwidth);
        $this->setLength($ilength);
        $this->attributes = [
            [
                'label' => 'Height (CM)',
                'name' => 'height',
                'id' => 'height',
                // 'value' => $this->height
            ],
            [
                'label' => 'Width (CM)',
                'name' => 'width',
                'id' => 'width',
                // 'value' => $this->width
            ],
            [
                'label' => 'Length (CM)',
                'name' => 'length',
                'id' => 'length',
                // 'value' => $this->length
            ]
        ];
    }
    public function getSelectors(): array{
        return [$this->productName=>[$this->attributes[0]['id'],
        $this->attributes[1]['id'],
        $this->attributes[2]['id']]];
    }
    public function getAttributes(): array
    {
        return [
            $this->attributes[0]['label'] => $this->height,
            $this->attributes[1]['label'] => $this->width,
            $this->attributes[2]['label'] => $this->length
        ];
    }
    public function validate(): array {
        $errors = [];
        if (empty($this->height) || $this->height <= 0) {
            $errors[] = "Height must be a positive number.";
        }
        if (empty($this->width) || $this->width <= 0) {
            $errors[] = "Width must be a positive number.";
        }
        if (empty($this->length) || $this->length <= 0) {
            $errors[] = "Length must be a positive number.";
        }
        return $errors;
    }



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
        // $this->setAttribute($this->attributeToString());
    }
    public function setWidth($width) {
        $this->width = $width;
        // $this->setAttribute($this->attributeToString());
    }
    public function setLength($length) {
        $this->length = $length;
        // $this->setAttribute($this->attributeToString());
    }
    public function attributeToString() {
        return 'Dimensions: ' . $this->height . 'x' . $this->width . 'x' . $this->length . ' CM';
    }


}
 ?>