<?php 
session_start();
$em = $_SESSION['email'];
$pre = $_SESSION['prenom'];
$nom = $_SESSION['nom'];
$mat = $_SESSION['id'];

$dbhost='localhost';
$db="authentication";
$user='root';
$psswd="";

try{
	$dns= new PDO("mysql:host=$dbhost;dbname=$db",$user,$psswd);
}catch(Exception $e){
	echo "ereur :".$e->getMessage();
}
$stmt= $dns->prepare('select nomuser , prenomuser , emailuser , phoneuser ,titre, descuser ,typerec , date_reclamation , reponse  from reclamatiomuser where emailuser=:email and titre=:titre and date_reclamation=:dat ');
$stmt->execute(array(':email' => $em , ':titre' => $_GET['titre'], ':dat' => $_GET['daterec']));

$output = ''; 

while($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
    foreach($ligne as $cle => $val) {
        $output .= "<p><strong>".$cle."</strong> : ".$val."</p>";
    }
}

    ?>

    <!DOCTYPE html>
    <html>
    <head>
<title> profile </title>
<meta charset="utf-8">
<link rel="stylesheet" href="afficher.css">
</head>
<body >
<div class="show">
  <div class="card">
    <?php echo $output; ?>
  </div>
</div>

</body>
</html>