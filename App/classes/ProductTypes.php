<?php
namespace App\classes;
use App\classes\subClasses\Book;
use App\classes\subClasses\Dvd;
use App\classes\subClasses\Furniture;
class ProductTypes
{
    private array $productTypes = [];

    public function __construct()
    {
        $this->loadProductTypes();
    }

    private function loadProductTypes(): void
    {
        // Check if each class exists, and create an instance if it does
        if (class_exists('App\classes\subClasses\Dvd')) {
            $this->productTypes['Dvd'] = new DVD('','','','','');
        }
        if (class_exists('App\classes\subClasses\Book')) {
            $this->productTypes['Book'] = new Book('','','','','');
        }
        if (class_exists('App\classes\subClasses\Furniture')) {
            $this->productTypes['Furniture'] = new Furniture('','','','','','','');
        }
    }

    /**
     * Get available product types.
     * @return array
     */
    public function getProductTypes(): array
    {
        return $this->productTypes;
    }

    /**
     * Render options for the product type dropdown.
     * @return string
     */
    public function renderProductTypeOptions(): string
    {
        $html = '<option value="" disabled selected>Select type</option>';
        foreach ($this->productTypes as $type => $product) {
            $html .= '<option value="' . $type . '" id="' . $type . '" name="' . $type . '">' . $type . '</option>';
        }
        return $html;
    }

    /**
     * Render attribute fields for the selected product type.
     * @param string $productType
     * @return string
     */
    public function renderAttributeFields(string $productType): string
    {
        if (!isset($this->productTypes[$productType])) {
            return '<p>Invalid product type selected.</p>';
        }

         return $this->productTypes[$productType]->renderAttributes();
    }
}