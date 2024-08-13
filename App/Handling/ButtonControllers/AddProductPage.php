<?php 
namespace App\Handling\ButtonControllers;
use App\Handling\ButtonController;
class AddProductPage implements ButtonController {
    public function getActionButtonText():string {
        return 'Save';
    }
    public function getActionButtonLink():string {
        return '';
    }
    public function getDeleteButtonText():string {
        return 'Cancel';
    }

    public function getDeleteButtonLink():string {
        return '/';
    }

}
?>
