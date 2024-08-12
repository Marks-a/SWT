<?php 
namespace App\Handling\PageControllers;
use App\Handling\PageController;
use App\classes\Database;
use App\classes\ProductListPage;
use PDO;

class productListController extends PageController {
    private $productList;
    private $dbTable;
    private $conn;
    public function __construct() {
        // echo "productListController instantiated.<br>";
        parent::__construct();
        $datbase = new Database(); //Creating a new Object
        $this->conn = $datbase->connect(); //Creating a connection
        $this->populateListFromDB($this->conn);
        $this->productList = "product_list";
        $this->handle(); 
    }
    public function handle() {
        // $items = $this->dbTable->fetchAll(PDO::FETCH_ASSOC);
        $items = $this->getdbTable()->fetchAll(PDO::FETCH_ASSOC);
        $this->renderTemplate($this->productList, ['items'=>$items]);
        
    }
    public function populateListFromDB($conn) {
    $dbConnected = new ProductListPage($conn); 
    $this->dbTable = $dbConnected->read(); 
    //Function to making a connection and reading it contents
    }
    public function getdbTable () {
        return $this->dbTable; //Return the items in the DB.
    }
    
}

?>
