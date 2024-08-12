<?php 
namespace App\Handling\ButtonControllers;
use App\Handling\ButtonController;
class AddProductPage implements ButtonController {
    public function getActionButtonText():string {
        return 'SAVE';
    }
    public function getActionButtonLink():string {
        return '';
    }
    public function getDeleteButtonText():string {
        return 'CANCEL';
    }

    public function getDeleteButtonLink():string {
        return 'index.php';
    }

}
?>