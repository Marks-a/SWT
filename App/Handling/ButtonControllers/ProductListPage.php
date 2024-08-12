<?php 
namespace App\Handling\ButtonControllers;
use App\Handling\ButtonController;
class ProductListPage implements ButtonController {
    public function getActionButtonText():string {
        return 'ADD';
    }

    public function getActionButtonLink():string {
        return 'add_product_form.php';
    }

    public function getDeleteButtonText():string {
        return 'DELETE';
    }

    public function getDeleteButtonLink():string {
        return '';
    }

}
?>