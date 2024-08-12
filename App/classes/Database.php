<?php 
// Database need work:
// -New username and other credentials so would other not see or use.
// -Change class location to a secure folder.(No Inject and other attack be availble)
namespace App\classes;
use PDO;
use PDOException;
class Database {
  
    private $host = 'sql7.freesqldatabase.com';
    private $db_name = 'sql7725464';
    private $username = 'sql7725464';
    private $password = 'iZi7DXXEfY';
    private $conn;

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection Error(In database.php file try/catch block): ' . $e->getMessage();
        }

         return $this->conn;
    }
    public function getConn() {
        return $this->conn;
    }
}
?>