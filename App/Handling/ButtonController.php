<?php
namespace App\Handling;
interface ButtonController {
    //Buttons for the main Index page
    public function getActionButtonText():string;
    public function getActionButtonLink():string;
    //Buttons for Add_product page;
    public function getDeleteButtonText():string;
    public function getDeleteButtonLink():string;
}
?>