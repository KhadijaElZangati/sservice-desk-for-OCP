<?php  
require_once("images.php");
class img{
	private $img_name;
	private $created_at;

	function __get($prop){
		switch ($prop) {
			case 'img_name': return $this->img_name;  break;
			case 'created_at': return $this->created_at;  break;
		

		}
	}
	function __construct($n,$l,$p,$ph){
			$this->img_name=$n;
			$this->created_at=$l;
	}

	function save(){
		DAO::enregistrerimg($this->img_name,$this->created_at);
	}

}
?>