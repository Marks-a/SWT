<?php 
namespace App\Handling\PageControllers;
use App\Handling\PageController;

class add_productController extends PageController {
    private $add_product;
    public function __construct() { 
        parent::__construct();
        $this->add_product = 'add_product_form';
        $this->handle(); 
    }
    public function handle() {
        $this->renderTemplate($this->add_product);
    }
}
?>