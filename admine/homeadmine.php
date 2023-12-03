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

try {
  $dns = new PDO("mysql:host=$dbhost;dbname=$db", $user, $psswd);
} catch (Exception $e) {
  echo "erreur :" . $e->getMessage();
}

$stmt = $dns->prepare('SELECT titre, emailtech, date_reclamationtech, phoneuser FROM reclamationtech WHERE typeadmine = :admine and reponsetech is null');
$stmt->execute(array(':admine' => $administration));
$output = '';

while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $titre = $ligne['titre'];
  $emailtech = $ligne['emailtech'];
  $d = $ligne['date_reclamationtech'];


  $output .= "<li><strong>" . $titre . "</strong> <span style='margin-left: 40px; padding-right: 60px;'>" . $emailtech . "</span><span style='margin-left: 40px; padding-right: 60px;'>" . $d . "</span> <a href='repondre.php?titre=" . urlencode($titre) . "&daterec=" . urlencode($d) . "&phoneuser=" . urlencode($ligne['phoneuser']) . "' style='color: blue;'>repondre</a></li>";
}

if ($stmt->errorCode() !== '00000') {
  $errorInfo = $stmt->errorInfo();
  echo "Error executing statement: {$errorInfo[2]}";
}

?>




<!DOCTYPE html>
<html>
<head>
<title> home page admine </title>
<meta charset="utf-8">
<link rel="stylesheet" href="homerec.css">
<style>
 
    body {
font-family: 'Open Sans', sans-serif;
margin: 0;
padding: 0;
background-color: #f5f5f5;
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

.explanation {
padding: 20px;
display: flex;
flex-direction: row;
align-items: center;
justify-content: space-between;
}

.explanation h1 {
font-size: 40px;
color: #232323;
text-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3);
border-bottom: 3px solid #232323;
padding-bottom: 10px;
}

.paragraph {
display: flex;
flex-direction: row;
align-items: center;
justify-content: space-between;
margin-top: 20px;
}

.paragraph p {
font-size: 16px;
color: #232323;
margin-left: 20px;
}

.paragraph img {
width: 300px;
height: 300px;
}


ul {
  list-style: none;
  margin: 20px 0 0 0; /* Add 20px top margin */
  padding: 0;
}

li {
  margin-bottom: 10px;
  padding: 10px;
  border-radius: 5px;
  background-color: #f7f7f7;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  transition: background-color 0.3s ease-in-out; /* Add transition effect */
  height: 40px;
  margin-left:20px;
  margin-right:20px;
  color:black;
}

li:hover {
  background-color:  #00d10a; /* Change background color on hover */
  color:azure;
  box-shadow: 12px 12px 40px black;
}
.rec{
  margin-left:20px;
}

.animated {
  animation-name: example;
  animation-duration: 2s;
  animation-iteration-count: infinite; /* Add this line to make the animation repeat infinitely */
}

@keyframes example {
  0% { transform: scale(1); }
  50% { transform: scale(1.1); }
  100% { transform: scale(1); }
}

.welcome-message {
  font-size: 18px;
  line-height: 1.5;
  margin-bottom: 20px;
  text-align: justify;
  color: #333;
  margin-left:20px;
  margin-right:20px;
}

.welcome-message::first-letter {
  font-size: 40px;
  font-weight: bold;
  float: left;
  margin-right: 5px;
  color: #00d10a;
}

.welcome-message em {
  font-style: italic;
  color: #666;
}

.welcome-message strong {
  font-weight: bold;
  color: #0066cc;
}

.welcome-message a {
  color: #0066cc;
  text-decoration: none;
  border-bottom: 1px solid #0066cc;
}

.welcome-message a:hover {
  background-color: #0066cc;
  color: #fff;
}



    </style>
</head>
<body>
    <div class='demande'>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
 <nav class='nav'>
    <a href="profile.php" class='nav1' > profile </a>
    <a href="/my help desk/login" class='nav1' > logout </a>
</nav>

</form>
</div>
<div class='title'>
<h1 class='header'> Bienvenue <?php echo $nom ." ". $pre ?> </h1>;
</div>
<div class='explaination'>


<div class='paragraph'>
<img src='ulc.png' alt='illustration' class='img animated'>


<p class="welcome-message"> 
Bienvenue Administrateur sur notre site web de helpdesk ! Nous sommes là pour vous aider à
 résoudre tous vos problèmes techniques. Que vous ayez des difficultés avec un logiciel,
  un périphérique ou un réseau, notre équipe d'experts est là pour vous offrir une assistance
   de qualité. Nous comprenons l'importance de minimiser les interruptions dans votre
    travail, c'est pourquoi nous offrons des solutions rapides et efficaces pour vous aider
     à reprendre vos activités normales. En utilisant notre site web de helpdesk,
      vous pouvez être sûr de bénéficier d'un service à la clientèle exceptionnel et
       d'une assistance technique professionnelle en tout temps. Nous vous remercions de
        faire confiance à notre équipe pour tous vos besoins en matière de helpdesk.
</p>
</div>
  <div class='demande2' >  
  <h1 class='rec'>Les tickets</h1>
        <ul>
<?php echo $output ?>
</ul>
    </div>
</div>
</div>
</body>
</html>