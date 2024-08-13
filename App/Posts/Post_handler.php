<?php
namespace App\Posts;
class Post_handler extends Post_main{
    private $currentPage;
    public function __construct($currentPage){
        parent::__construct();
        $this->currentPage = $currentPage;
    }
    public function addButton () {
            (new Post_main())->handleRequestAdd($this->currentPage);
         
    }
    public function deleteButton () {
            (new Post_main())->handleRequestDelete();
    
    }
}