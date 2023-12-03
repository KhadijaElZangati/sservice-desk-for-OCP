<?php
session_start();
$em = $_SESSION['email'];
$pre = $_SESSION['prenom'];
$nom = $_SESSION['nom'];
$mat = $_SESSION['id'];
$admine = $_SESSION['administrateur'];
$dbhost='localhost';
$db="authentication";
$user='root';
$psswd="";

try {
  $dns = new PDO("mysql:host=$dbhost;dbname=$db",$user,$psswd);
} catch(Exception $e) {
  echo "Erreur : ".$e->getMessage();
}

if (isset($_POST['submitbt'])) {
  $answer = htmlspecialchars($_POST['reponse']);
  $stmt = $dns->prepare('UPDATE reclamatiomuser SET reponse=:reponse WHERE titre=:titre AND emailuser=:emailuser');
  $stmt->execute(array(':reponse' => $answer, ':titre' => $_GET['titre'], ':emailuser' => $_GET['emailuser']));
  $stmt2 = $dns->prepare('UPDATE reclamatiomuser SET techid=:idtech WHERE titre=:titre AND emailuser=:emailuser');
  $stmt2->execute(array(':idtech' => $mat, ':titre' => $_GET['titre'], ':emailuser' => $_GET['emailuser']));
  header('Location: homerec.php');
  exit();
}
//INSERTING THE ID TECH TO THE RECLAMATIOMUSER ; NOT WORKING ;


$stmt = $dns->prepare('SELECT titre , nomuser, prenomuser, phoneuser , emailuser, descuser, typerec, date_reclamation FROM reclamatiomuser WHERE titre=:titre AND emailuser=:emailuser');
$stmt->execute(array(':titre' => $_GET['titre'], ':emailuser' => $_GET['emailuser']));
$output = '';
while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
$titre=$ligne['titre'];
$nomuser=$ligne['nomuser'];
$prenomuser=$ligne['prenomuser'];
$emailuser=$ligne['emailuser'];
$descuser=$ligne['descuser'];
$typerec=$ligne['typerec'];
$daterec=$ligne['date_reclamation'];
$phoneuser=$ligne['phoneuser'];
}


if(isset($_POST['levelupbt'])){
  header('location: levelup.php?titre='.urlencode($titre).'$phoneuser='.urlencode($phoneuser));
  exit();
}


?>

<!DOCTYPE html>
<html>
  <head>
    <title>repondre tech</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="repondre.css">
    <style>

body{
    background-color: rgb(229, 229, 229);
    background-size:cover;
    background-position: center center ;  
    filter: contrast(3);  
    background-color: #F0F3F4;
}

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
}

.show strong {
  font-weight: bold;
  color: #555;
}



.show p {
  margin: 0;
}

.answer {
  width: 100%;
  height: 200px;
  padding: 10px;
  font-family: Arial, sans-serif;
  font-size: 16px;
  line-height: 1.5;
  color: #333;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
}

.answer:focus {
  outline: none;
  border-color:#2ecc71;
  box-shadow: 0 0 5px #0066cc;
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
    <?php echo "<b style='text-align:center;'><u>".$titre  ."</u></b>"; ?><br>
      <?php echo "<strong> nom de client : </strong>".$nomuser ?><br>
      <?php echo "<strong> prenom de client : </strong>".$prenomuser ?><br>
      <?php echo "<strong> l'email de client : </strong>".$emailuser ?><br>
      <?php echo "<strong> le numéro de téléphone de client : </strong>".$phoneuser ?><br>
      <?php echo "<strong> description de client : </strong>".$descuser ?><br>
      <?php echo "<strong> type de réclamation : </strong>".$typerec ?><br>
      <?php echo "<strong> la date de réclamation : </strong>".$daterec ?><br>

 
     
     
              <!--**********************************************************************-->
<?php

require_once 'dbConfig.php';
try {
// Create a new PDO instance
$dsn = "mysql:host=$dbHost;dbname=$dbName";
$pdo = new PDO($dsn, $dbUsername, $dbPassword);

// Set PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get image data from database
$query = "SELECT image FROM imagess   ORDER BY id DESC";
$result = $pdo->prepare($query);
$result->execute();


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


<form action="<?php echo $_SERVER['PHP_SELF'].'?titre='.$_GET['titre'].'&emailuser='.$_GET['emailuser']; ?>" method="post">
        <center> 
        <textarea class="answer" name="reponse" placeholder="Réponse"></textarea>
        </center>
        <br>
        <input type="submit" name="submitbt" class="signupbt" value="envoyer" >
        <input type="submit" name="levelupbt" class="levelbt" value="Monter de niveau" >
      </form>


    </div>
  </body>
</html>
