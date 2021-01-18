<?php
namespace App;

class DatabaseClass{

    private $connection = null;

    // this function is called everytime this class is instantiated
    public function __construct( $dbhost = "localhost", $dbname = "myData", $username = "root", $password    = ""){
        try{
            $this->connection = new mysqli($dbhost, $username, $password, $dbname);
            if( mysqli_connect_errno() ){
                throw new Exception("Could not connect to database." . mysqli_connect_errno());
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }

    }

    // Insert a row/s in a Database Table
    public function insert( $query = "" , $params = [] ){
        try{
        $stmt = $this->executeStatement( $query , $params );
            $stmt->close();
            return $this->connection->insert_id;
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
        return false;
    }

    // Select a row/s in a Database Table
    public function select( $query = "" , $params = [] ){
        try{
            $stmt = $this->executeStatement( $query , $params );
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $result;
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }

        return false;
    }

    // Update a row/s in a Database Table
    public function update( $query = "" , $params = [] ){
        try{
            $this->executeStatement( $query , $params )->close();
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
        return false;
    }

    // Remove a row/s in a Database Table
    public function remove( $query = "" , $params = [] ){
        try{
            $this->executeStatement( $query , $params )->close();
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
        return false;
    }

    // execute statement
    private function executeStatement( $query = "" , $params = [] ){
        try{
            $stmt = $this->connection->prepare( $query );
            if($stmt === false) {
                throw New Exception("Unable to  prepare the following statement: " . $query);
            }
            if( $params ){
                call_user_func_array(array($stmt, 'bind_param'), $params );
            }
            $stmt->execute();
            return $stmt;
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }

    }

}

 ?>
