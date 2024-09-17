<?php
namespace App\classes\subClasses;

use App\classes\AbstractProduct;
class Dvd extends AbstractProduct {
private $size;
private $productName = "Dvd";
public function __construct($db,$isku, $iname, $iprice, $isize=0){
    parent::__construct($db,$isku, $iname, $iprice);
    $this->setType($this->productName);
    $this->size = $isize;
    $this->attributes = [
        [
            'label' => 'Size (MB)',
            'name' => 'size',
            'id' => 'size'
            // 'value' => $this->size
        ]
    ];
}
public function getSelectors(): array{
    return [$this->productName=>$this->attributes[0]['id']];
}
public function getAttributes(): array
    {
        return [
            $this->attributes[0]['label'] => $this->size
        ];
    }
    public function validate(): array
    {
        $errors = [];
        if (empty($this->size) || $this->size <= 0) {
            $errors[] = "Size must be a positive number.";
        }
        return $errors;
    }

    

//Setters  & getters
public function setSize($size) {
    $this->size = $size;
    // $this->setAttribute($this->attributeToString());
}
public function getSize() {
    return $this->size;
}

public function attributeToString() {
    return 'Size: ' . $this->size . ' MB';
}

}
?>