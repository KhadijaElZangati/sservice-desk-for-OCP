<?php
session_start();

require_once("images.php");
require_once("classimg.php");
$list=DAO::image();
$em = $_SESSION['email'];
$pre = $_SESSION['prenom'];
$nom = $_SESSION['nom'];
$mat = $_SESSION['id'];
$phone=  $_SESSION['phoneuser'];

if (!isset($_POST['mylist']) && isset($_POST['submitbt'])  ) {
    $typeerror="choisir le type ";
}
$dbhost='localhost';
$db="authentication";
$user='root';
$psswd="";

try{
	$dns= new PDO("mysql:host=$dbhost;dbname=$db",$user,$psswd);
	//echo"connexion reussir<br>";

	if (isset($_POST['submitbt']) && isset($_POST['titre']) && isset($_POST['DESC'])) {
        $name = $nom;
        $prenom = $pre;
        $email = $em;
        $DESC = $_POST['DESC'];
        $type=$_POST['mylist'];
        $daterec = date("Y-m-d H:i:s");
        $header=$_POST['titre'];

      
        if( (empty($_POST["DESC"])) || (empty($_POST["DESC"]))){
            $descerror=" la description est obligatoire";
        }
        if( (empty($_POST["titre"])) || (empty($_POST["titre"]))){
            $titrerror=" la description est obligatoire";
        }

   

        // hna kayn condition bax ila kan error mansstokish data f db .
      while (isset($_POST['submitbt']) && empty( $phoneerror) && empty($descerror) && empty($titrerror)) {
      $comm = "INSERT INTO reclamatiomuser (prenomuser, nomuser, emailuser, phoneuser ,descuser , typerec , date_reclamation , titre , userid ) VALUES (:prenom, :nom, :email, :phone, :de , :typerec , :daterec , :titre , :userid)";
        $rep = $dns->prepare($comm);
        $rep->execute([ 'prenom' => $pre, 'nom' => $nom, 'email' => $em, 'phone' =>  $phone , 'de'=>$DESC , 'typerec'=> $type ,'daterec'=>$daterec , 'titre'=>$header , 'userid'=>$mat ]);
         header("location:homerec.php");// this one is to move to the login page if there is no errors kayditikti  
         exit();//bach n7ebsso l'execution dyal had script 
      }

      }
      
}catch(Exception $e){
	echo "ereur :".$e->getMessage();
}

//uploading images to db 

if (isset($_POST['upload'])) {

	
			



}

?>



<!DOCTYPE html>
<html>
<head>
    <title>Reclamation</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="demande.css">
    <style>
   body {
	background-color: #f7f7f7;
	font-family: Arial, Helvetica, sans-serif;
    background-color: #F0F3F4;
  }

     .signupbt {
    background-color: #2ecc71;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-size: 18px;
    margin-top: 20px;
    margin-top:10px ;
    width: 250px; 
    height: 50px;
    text-align:center;
   
}
 .signupbt:hover {
    background-color: #00d10a;
}
		.error {
			color: #a00;
		}
		.gallery img{
            width: 127px;
		}

        .signupcard {
    width: 50%;
    margin: 0 auto;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    padding: 30px;
    border-radius: 5px;
    margin-left:400px;
    box-shadow: 12px 12px 40px black;
}




        .sidebar {
  width: 300px;
  background-color:white;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  box-shadow: 12px 12px 40px black;
}

.sidebar ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.sidebar li a {
  display: block;
  color: #000;
  padding: 8px 16px;
  text-decoration: none;
}

.sidebar li a:hover {
  background-color: limegreen;
  color: azure;
}


.nom{
    height: 40px;
    width: 400px;
    margin-bottom: 20px;
    padding-left: 10px;
}

.imgupload{
    background-color:lime;
    width:100px;
    height:40px;
    margin-left:280px;
}


.upload{
    background-color:green;
    width:400px;
    height:40px; 
   
}

        </style>
</head>
<body>
<div class="sidebar">
  <ul>
    <li><a href="homerec.php">Home</a></li>
    <li><a href="demande.php">Nouveau ticket</a></li>
    <li><a href="about_us.php">À propos de nous</a></li>
    <li><a href="profile.php">profile</a></li>
    <li><a href="login.php">logout </a></li>
  </ul>
</div>




    <div class="signupcard">
        <h2> Nouveau ticket</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="titre" value="" placeholder="Titre" class="nom">
            <?php if(isset($titrerror) && !empty($titrerror)) { ?>
                <p style="color:red;" class="error"><?php echo $titrerror; ?></p>
            <?php } ?>

           
            <input type="text" class='DESC' name="DESC" value="" placeholder="Description">
            <?php if(isset($descerror) && !empty($descerror)) { ?>
                <p style="color:red;" class="error"><?php echo $descerror; ?></p>
            <?php } ?>
            <label for="myList">Type de réclamation</label><br>
            <select class="nom" name="mylist" style='height:60px; width: 103%; '>
                <option value="demande d'une service">Demande d'une service</option>
                <option value="demende d'informatioin">Demande d'information</option>
                <option value="declaration d'une probleme">Déclaration d'un problème</option>
                <option value="declaration d'incident">Déclaration d'incident</option>
            </select>

            <input type="submit" name="submitbt"  class="signupbt" value="envoyer" style='margin-top:20px; margin-bottom:20px;'>
            
	    <?php  
            if (isset($_GET['error'])) {
            	echo "<p class='error'>";
            	    echo htmlspecialchars($_GET['error']);
            	echo "</p>";
            }
	    ?>


        </from>


            
