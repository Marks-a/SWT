<?php 
namespace App\Handling;
class TemplateController {
    protected $templatePath;
    public function __construct($templatePath = './../templates/'){
         $this->templatePath = $templatePath;
        //$this->templatePath = realpath($templatePath) . '/';
        // echo "Template path set to: " . $this->templatePath . "<br>";
    }
    public function render($template,array $data = []){
        $templatePath = $this->templatePath.$template.'.php';
        // echo "Rendering template: " . $templatePath . "<br>";
        //Render first the base.php file
        include $this->getTemplateFilePath('base');
        // echo "Including base template: " . $this->getTemplateFilePath('base') . "<br>";
        if(file_exists($templatePath)){
            extract($data);
            ob_start();
            include $templatePath;
            $content = ob_get_contents();
            // echo "Content captured: " . strlen($content) . " bytes<br>";
        
        }
        else {
            echo "No Template found ($templatePath)";
        }
    }
    protected function getTemplateFilePath(string $template): string
    {
        return $this->templatePath . $template . '.php';
    }
}
?>
