<?php
class db{
    protected $connection;
    function set_connection(){
        try{
            $this->connection=new PDO("mysql:host=localhost;dbname=library_management_db", "root", ""); 
        }catch(PDOException $e){
            echo "error";
        }
    }
}
?>