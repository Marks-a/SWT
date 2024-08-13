<?php 
namespace App\Handling\PageControllers;

use App\Handling\PageController;
use App\handling\TemplateController;

class footerController extends PageController {
    private $footer;
    public function __construct() { 
      // echo "footerController instantiated.<br>";
        parent::__construct();
        $this->footer = 'footer';
        $this->handle();
     }
     public function handle() {
        $this->renderTemplate($this->footer);
     }
}
?>