<?php
include_once("config.php");
$dns=config::connect();
require_once("classimg.php");


class DAO{
   
	
	static function getPDO(){
		return new PDO("mysql:host=localhost;dbname=authentication","root","");
	}

static function image(){
		$pdo=DAO::getPDO();
		$req="select *from images;";
		$res=$pdo->prepare($req);
		$res->execute(array());
		$lst=[];
		while($row=$res->fetch()){
			$lst[]=new DAO('',$row["img_name"],$row["created_at"]);
		} return $lst;
}

static function enregistrerimg($l,$p,$h){
    $pdo=DAO::getPDO();
    $req="insert into image(img_name,created_at) values('$l','$p'); ";
    $res=$pdo->prepare($req);
    $res->execute(array());
 }
}
