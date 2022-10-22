<?php
/* Part A */

    class Database {
        
        // public $connection;
        private $connection;

        public function __construct(){
            $this->connection = new PDO("mysql:host=". DB_HOST .";dbname=". DB_NAME , DB_USER , DB_PASSWORD);
        }
       public function __destruct(){
           $this->connection = null;
       }
        public function sqlQuery($sql,$bindVal = null){
            $statement = $this->connection->prepare($sql);
            if(is_array($bindVal)){
                $statement->execute($bindVal);
            } else {
                $statement->execute();
            }
            return  $statement;
        }
        public function fetchArray($sql,$bindVal = null){
            $result = $this->sqlQuery($sql, $bindVal);
            if ($result->rowCount() == 0){
                return false;
            } else {
                return $result->fetchAll(PDO::FETCH_ASSOC);
            }
        }
//        public function fetchRecord($sql){
//            $result = $this->sqlQuery($sql);
//            $numberOfRows = $result->rowCount();
//            if ($numberOfRows == 0){
//                return false;
//            } else {{
//                $resultRow = $result->fetch(PDO::FETCH_ASSOC);
//                return $resultRow;
//            }}
//        }
    }
    // $dbc = new Database();
?>