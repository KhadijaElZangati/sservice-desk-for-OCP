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
$stmt= $dns->prepare('select titre , date_reclamation, typerec, descuser, reponse from reclamatiomuser where emailuser=:email ');
$stmt->execute(array(':email'=>$em));

$cards = '';

while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $titre = $ligne['titre'];
  $daterec = $ligne['date_reclamation'];
  $typerec = $ligne['typerec'];
  $descuser = $ligne['descuser'];
  $reponse = $ligne['reponse'];
  
  // Generate the card element
  $cards .= "
    <div class='card'>
      <h2 class='card-title'>$titre</h2>
      <p class='card-subtitle'>$daterec</p>
      <p class='card-type'>$typerec</p>
      <p class='card-description'>$descuser</p>
      <p class='card-response'>$reponse</p>
    </div>
  ";
}


?>


<!DOCTYPE html>
<html>
<head>
    <title> profile </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="profile.css">
    <style>
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .demande {
            flex: 1;
        }

        .floating-div {
            flex-shrink: 0;
            margin-left: 20px;
            background-color: wheat;
            width: 600px;
            height: 300px;
            text-align:center;
            border-radius:12px;
        }

        .card {
            width: 400px;
            height: 300px;
            margin: 20px;
            border-radius: 12px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            display: inline-block;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease-out;
            padding-left:40px;
            
           
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 12px 12px 40px rgb(0, 0, 0);
            background-color: #00d10a;
            color:azure;
           
        }

        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.05);
            opacity: 0;
            transition: all 0.3s ease-out;
        }

        .card:hover::before {
            opacity: 1;
        }

        .card-content {
    position: absolute;
    bottom: 0;
    margin-right:10px;
    left: 0;
    padding: 10px;
    color: white;
    font-size: 24px;
    font-weight: bold;
    text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);
    transition: all 0.3s ease-out;
    text-align:center; /* added property */
}


        .card:hover .card-content {
            bottom: 20px;
            color:azure;
            text-align:center;
        }

        .card-date {
            position: absolute;
            top: 10px;
            right: 10px;
            color: white;
            font-size: 18px;
            text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);
            padding-left:40px;
        }

        .card-link {
            position: absolute;
            bottom: 10px;
            right: 10px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease-out;
        }

        .card-link:hover {
            color: green;
        }

        .container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.demande {
  flex: 1;
}

.img {
  width: 100%;
  height: auto;
}

.floating-div {
  flex: 1;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  padding: 20px;
  text-align: center;
}

h1 {
  font-size: 36px;
  margin-bottom: 20px;
}

h2 {
  font-size: 24px;
  margin-bottom: 10px;
}

/* Responsive */
@media (max-width: 768px) {
  .container {
    flex-direction: column;
  }
  .floating-div {
    margin-top: 10px;
  }
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
    </style>
</head>
<body style='background-color:white;'>

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
      <h1>Profile</h1>
      <h2><?php echo "Utilisateur: " . $pre . " " . $nom; ?></h2>
      <h2><?php echo "Email: " . $em; ?></h2>
      <h2><?php echo "ID: " . $mat; ?></h2>
    </div>
  </div>

  <div class='explaination'>
    <div class='paragraph'>
      <h1 style="color:black; text-align:left;">Vos réclamations:</h1>
      <?php 
      $stmt= $dns->prepare('select titre, date_reclamation, descuser, reponse from reclamatiomuser where emailuser=:email');
      $stmt->execute(array(':email'=>$em));
      while($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $titre = $ligne['titre'];
        $daterec = $ligne['date_reclamation'];
        $descuser = $ligne['descuser'];
        $reponse = $ligne['reponse'];
      ?>
        <div class='card'>
          <div class='card-header'>
            <h3><?php echo $titre; ?></h3>
            <p><?php echo $daterec; ?></p>
          </div>
          <div class='card-body'>
            <p><?php echo $descuser; ?></p>
            <?php if (!empty($reponse)): ?>
              <hr style='margin-right:15px;'>
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
           
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



  