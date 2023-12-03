<?php
session_start();
$em = $_SESSION['email'];
$pre = $_SESSION['prenom'];
$nom = $_SESSION['nom'];
$mat = $_SESSION['id'];
$administration = $_SESSION['administration'];
$phoneuser = $_GET['phoneuser'];




$dbhost='localhost';
$db="authentication";
$user='root';
$psswd="";

try {
  $dns = new PDO("mysql:host=$dbhost;dbname=$db",$user,$psswd);
} catch(Exception $e) {
  echo "Erreur : ".$e->getMessage();
}


$stmt = $dns->prepare('SELECT * FROM reclamationtech WHERE titre=:titre   and phoneuser=:phoneuser  ');
$stmt->execute(array(':titre' => $_GET['titre'] , 'phoneuser'=>$phoneuser ));
$output = '';
while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
 $emailtech=$ligne['emailtech'];
 $phonetech=$ligne['phonetech'];
 $phoneuser=$ligne['phoneuser'];
 $desc=$ligne['desctech'];
 $titre=$ligne['titre'];
}
if (isset($_POST['submitbt'])) {
  $answer = htmlspecialchars($_POST['reponse']);
  $stmt = $dns->prepare('UPDATE reclamationtech SET reponsetech=:reponse WHERE titre=:titre AND phoneuser=:phoneuser');
  $stmt->execute(array(':reponse' => $answer, ':titre' => $_GET['titre'], ':phoneuser' => $_GET['phoneuser']));
  $stmt1 = $dns->prepare('UPDATE reclamationtech SET idadmin=:id WHERE titre=:titre AND phoneuser=:phoneuser');
  $stmt1->execute(array(':id' => $mat, ':titre' => $_GET['titre'], ':phoneuser' => $_GET['phoneuser']));
  $stmt2 = $dns->prepare('UPDATE reclamatiomuser SET reponse=:reponse WHERE titre=:titre AND phoneuser=:phoneuser');
  $stmt2->execute(array(':reponse' => $answer, ':titre' => $_GET['titre'], ':phoneuser' => $_GET['phoneuser']));
  $stmt3 = $dns->prepare('UPDATE reclamatiomuser SET admineid=:id WHERE titre=:titre AND phoneuser=:phoneuser');
  $stmt3->execute(array(':id' => $mat, ':titre' => $_GET['titre'], ':phoneuser' => $_GET['phoneuser']));
  header('Location: homeadmine.php');
  exit();
}



?>


<!DOCTYPE html>
<html>
  <head>
    <title>Repondre admine</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="">
    <style>
    /* Global styles */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
  background-color: #F0F3F4;
}

/* Header styles */
.title {
  background-color: #333;
  height: 60px;
}

/* Content styles */
.show {
    background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: 20px;
  margin-bottom: 20px;
  margin-top: 20px;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  font-family: Arial, sans-serif;
  font-size: 16px;
  line-height: 1.5;
  color: #333;
  text align:center;
  margin-left:50px;
  margin-right:50px;
  }

.answer {
  display: block;
  width: 100%;
  height: 100px;
  margin: 20px 0;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 18px;
}

.signupbt {
  display: block;
  width: 100%;
  height: 50px;
  margin-top: 20px;
  border: none;
  border-radius: 5px;
  background-color: #00d10a ;
  color: #fff;
  font-size: 20px;
  cursor: pointer;
}

.signupbt:hover {
  background-color: #2ecc71;
}



 
  
  .answer {
    height: 150px;
  }


.header {
display: flex;
justify-content: center;
align-items: center;
height: 80px;
background: linear-gradient(to right, #232323, #4d4d4d);
text-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3);
color: #F0F3F4;
  /* Set the initial background color */
  animation: colorChange 6s infinite;
  /* Apply the animation */
}

@keyframes colorChange {
  0% { color: #F0F3F4; }

  100% { color: #F0F3F4; }
}

.nav {
display: flex;
justify-content: flex-end;
background-color: #333;
height: 50px;
align-items: center;
}

.nav a {
color: #fff;
text-decoration: none;
padding: 10px;
margin: 0 10px;
transition: all 0.2s ease;
}

.nav a:hover {
color: #232323;
background-color: #fff;
border-radius: 5px;
}

      </style>
  </head>
  <body >

    <div class="title" ></div>
    <div class="show" >
    <?php echo "<strong style='text-align:center;'>".$titre  ."</strong>"; ?><br>
      <?php echo "<strong > l'email de technicien : </strong>". $emailtech; ?><br>
      <?php echo "<strong> le telephone de techniciene : </strong>". $phonetech; ?><br>
      <?php echo "<strong> le telephone de client : </strong>". $phoneuser; ?><br>
      <?php echo "<strong> le description : </strong><p>". $desc ."</p>"; ?><br>

    <!--**********************************************************************-->




      <form action="<?php echo $_SERVER['PHP_SELF'].'?titre='.$_GET['titre'].'&phoneuser='.$phoneuser; ?>" method="post">
      <?php

require_once 'dbConfig.php';
try {
// Create a new PDO instance
$dsn = "mysql:host=$dbHost;dbname=$dbName";
$pdo = new PDO($dsn, $dbUsername, $dbPassword);

// Set PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get image data from database
$query = "SELECT image FROM imagess  ORDER BY id DESC";
$result = $pdo->query($query);


if ($result->rowCount() > 0) {
echo '<div class="gallery">';
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo '<img src="data:image/jpg;charset=utf8;base64,' . base64_encode($row['image']) . '" style=" margin-top:20px; margin-left:20px;" />';
   
}


echo '</div>';
} else {
echo '<p class="status error">Image(s) not found...</p>';
}
} catch (PDOException $e) {
die("Error: " . $e->getMessage());
}
?>
        <center>
        <textarea class="answer" name="reponse" placeholder="Réponse"></textarea>
        </center>
        <br>
        <input type="submit" name="submitbt" class="signupbt" value="envoyer" >
      </form>
     
    </div>
  </body>
</html>
