<?php

    class database{
        
    private $dsn = "mysql:host=localhost; dbname=db_shop";
    private $dbuser="root";
    private $dbpass= "";

    public $conn;

    public function __construct(){
                try {
            $this->conn = new PDO($this->dsn, $this->dbuser, $this->dbpass);
            
    //  echo "successful";
                }catch(PDOException $e) {
                    echo "Error : ".$e->getmessage();
                }
                return $this->conn;
    }

    
    public function showmessage($type,$message){
    return  '<div class= "alert alert-'.$type.'alert-dismissible">
    <button type= "button" class=" close" data dissmiss="alert">&times</button>
    <strong class="text-center">'.$message.'</strong> </div>';
    }
    }

?>