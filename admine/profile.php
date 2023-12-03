<?php
session_start();
$em = $_SESSION['email'];
$pre = $_SESSION['prenom'];
$nom = $_SESSION['nom'];
$mat = $_SESSION['id'];
$administration=$_SESSION['administration'];

$dbhost='localhost';
$db="authentication";
$user='root';
$psswd="";

try{
	$dns= new PDO("mysql:host=$dbhost;dbname=$db",$user,$psswd);
}catch(Exception $e){
	echo "ereur :".$e->getMessage();
}
$stmt= $dns->prepare('select titre , date_reclamation from reclamatiomuser where emailuser=:email ');
$stmt->execute(array(':email'=>$em));

$output = ''; 

while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $titre = $ligne['titre'];
  $daterec = $ligne['date_reclamation'];
  $output .= "<li><strong>".$titre."</strong> <span style='margin-left: 60px; padding-right: 60px;'>".$daterec."</span> <a href='afficher.php?titre=".urlencode($titre)."&daterec=".urlencode($daterec)."' style='color: blue;'>afficher</a></li>";
}


?>


<!DOCTYPE html>
<html>
<head>
<title> profile admine </title>
<meta charset="utf-8">
<link rel="stylesheet" href="profile.css">
<style>
/* Profile Container */
.container {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

/* Left side of the profile container */
.demande {
  flex: 1;
}

/* Right side of the profile container */
.floating-div {
  flex-shrink: 0;
  margin-left: 20px;
  background-color: #f5f5f5;
  width: 1400px;
  height: 300px;
  text-align:center;
  border-radius:12px;
  padding: 20px;
  box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
}

/* Heading Styles */
h1 {
  font-size: 36px;
  font-weight: bold;
  margin-bottom: 10px;
}

h2 {
  font-size: 24px;
  font-weight: normal;
  margin-top: 0;
  margin-bottom: 10px;
}

/* Image Styles */
.img {
  max-width: 100%;
  height: auto;
}



.paragraph {
  flex: 1;
  padding-right: 20px;
}

/* Right Side of Explanation Section */
.demande2 {
  flex-shrink: 0;
  background-color: #f5f5f5;
  width: 600px;
  height: 400px;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
}



.panel-shadow {
    box-shadow: rgba(0, 0, 0, 0.3) 7px 7px 7px;
}
.panel-white {
  border: 1px solid #dddddd;
}
.panel {
    font-size: 13px;
    color: #454545;
    background: #fafafa;
    position: relative;
    overflow-x: hidden;
    font-family: 'Source Sans Pro', 'Oxygen', sans-serif;
}
.panel-white  .panel-heading {
  color: #333;
  background-color: #fff;
  border-color: #ddd;
}
.panel-white  .panel-footer {
  background-color: #fff;
  border-color: #ddd;
}
.bg2 {
    background-image: url('info.jpeg');
}
.profile-widget {
  position: relative;
}
.profile-widget .image-container {
  background-size: cover;
  background-position: center;
  padding: 190px 0 10px;
}
.profile-widget .image-container .profile-background {
  width: 100%;
  height: auto;
}
.profile-widget .image-container .avatar {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  margin: 0 auto -60px;
  display: block;
}
.profile-widget .details {
  padding: 50px 15px 15px;
  text-align: center;
}   

.explaination {
  float: left;
  width: fit-content;
  margin-left: 60px;
}

.card {
  background-color: #f5f5f5;
  border-radius: 5px;
  margin-bottom: 20px;
  box-shadow: 12px 12px 40px rgba(0, 0, 0, 0.1);
}

.card-header {
  background-color: lime;
  padding: 10px;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  color:white;
}

.card-body {
  padding: 10px;
  font-family:bold;
  font-size:14px;

}

.card:hover {
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transform: translateY(-4px);
  transition: box-shadow 0.5s, transform 0.5s;
}


</style>
</head>
<body>
<div class='container'>
<div class="container bootstrap snippets bootdey">
    <div class="col-md-8" style='height:500px;'>
        <div class="panel panel-white profile-widget panel-shadow">
            <div class="row">
                <div class="col-sm-12">
                    <div class="image-container bg2">  
                        <img src="https://bootdey.com/img/Content/user_3.jpg" class="avatar" alt="avatar"> 
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="details">
                   <div class='container'>
      <div class='floating-div'>  
        <h1> Profile </h1>
        <h2><?php echo "utilisateur :". $pre . " " . $nom; ?></h2>
        <h2><?php echo " email :". $em; ?></h2>
        <h2><?php echo "id :". $mat; ?></h2>
        <h2><?php echo "Administration :". $administration; ?></h2>
        </div>
      </div>
    </div>
</div>

<div class='explaination'>
    <div class='paragraph'>
      <h1 style="color:black; text-align:left;">Vos tickets:</h1>
      <?php
      $stmt= $dns->prepare('select * from reclamatiomuser where admineid=:mat');
      $stmt->execute(array(':mat'=>$mat));
      while($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $emailuser = $ligne['emailuser'];
        $typerec = $ligne['typerec'];
        $phoneuser = $ligne['phoneuser'];
        $titre = $ligne['titre'];
        $descuser = $ligne['descuser'];
        $datetech = $ligne['date_reclamation'];
        $reponse = $ligne['reponse'];
   
      ?>
        <div class='card'>
          <div class='card-header'>
          <h3><?php echo $titre; ?></h3>
          <h3><?php echo $emailuser; ?></h3>
            <p><?php echo $phoneuser; ?></p>
            <p><?php echo $typerec; ?></p>
            <p><?php echo $datetech; ?></p>
          </div>
          <div class='card-body'>
            <p><?php echo $descuser; ?></p>
            <?php if (!empty($reponse)): ?>
              <hr style="margin-right:20px;">
              <h4>Réponse:</h4>
              <p><?php echo $reponse; ?></p>
            <?php endif; ?>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</body>
</html>
