<?php
namespace App\Handling\PageControllers;

use App\Handling\PageController;
use App\Handling\ButtonControllers\AddProductPage;
use App\Handling\ButtonControllers\ProductListPage;

class headerController extends PageController
{
    private $header;
    private $currentPage;
    private $buttonController;
    public function __construct($currentPage)
    {
        parent::__construct();
        if ($currentPage === 'add_product_form.php') {
            $this->buttonController = new AddProductPage();
        } else {
            $this->buttonController = new ProductListPage();
        }
        $this->currentPage = $currentPage;
        $this->header = "header";
        $this->handle();
    }
    public function handle()
    {
        $this->renderTemplate($this->header, [
            'currentPage' => $this->currentPage,
            'actionButtonText' => $this->buttonController->getActionButtonText(),
            'actionButtonLink' => $this->buttonController->getActionButtonLink(),
            'deleteButtonText' => $this->buttonController->getDeleteButtonText(),
            'deleteButtonLink' => $this->buttonController->getDeleteButtonLink(),
        ]);
    }


}
