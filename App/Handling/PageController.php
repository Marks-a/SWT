<?php 
namespace App\Handling;
use App\Handling\TemplateController;
abstract class PageController {
    protected $template;

    public function __construct()
    {
        $this->template = new TemplateController();
    }

    abstract public function handle();

    protected function renderTemplate(string $template, array $data = [])
    {
        $this->template->render($template, $data);
    }
}
?>