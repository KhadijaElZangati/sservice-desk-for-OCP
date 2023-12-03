<?php 


 class config{
    public static function connect(){
        $dbhost='localhost';
        $db="authentication";
        $user='root';
        $psswd="";

        try{
            $dns= new PDO("mysql:host=$dbhost;dbname=$db",$user,$psswd);
           $dns->setAttribute(pdo::ATTR_ERRMODE ,pdo::ERRMODE_WARNING);
        }catch(Exception $e){
            echo "ereur :".$e->getMessage();

        }
        return $dns;
    }
   
}





?>