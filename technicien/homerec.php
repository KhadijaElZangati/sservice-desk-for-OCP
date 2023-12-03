<?php
session_start();
$em = $_SESSION['email'];
$pre = $_SESSION['prenom'];
$nom = $_SESSION['nom'];
$mat = $_SESSION['id'];
$administrateur=  $_SESSION['administrateur'];
//$ref=$_SESSION['reftech'];

$dbhost='localhost';
$db="authentication";
$user='root';
$psswd="";

try {
  $dns = new PDO("mysql:host=$dbhost;dbname=$db",$user,$psswd);
} catch(Exception $e) {
  echo "ereur :".$e->getMessage();
}

$stmt = $dns->prepare('SELECT titre, emailuser FROM reclamatiomuser where reponse is null');
$stmt->execute();

$output = ''; 
while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $titre = $ligne['titre'];
  $emailuser = $ligne['emailuser'];
  $output .= "<div class='faq-card'><li><strong>".$titre."</strong> <span style='margin-left: 60px; padding-right: 60px;'>".$emailuser."</span> <a href='repondre.php?titre=".urlencode($titre)."&emailuser=".urlencode($emailuser)."' style='color: blue;'>repondre</a></li></div>";
}



?>

<!DOCTYPE html>
<html>
<head>
  <title>Home Page tech</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="homerec.css">
  <style>
    .faq-card {
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 10px;
      margin-bottom: 10px;
    
      

}

.intro-image {
  flex: 1;
  transition: transform 0.5s ease;
}

.intro-image:hover {
  transform: scale(1.1);
}



    .faq-card:hover {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      background-color: #00d10a;
      box-shadow: 12px 12px 40px rgba(0, 0, 0 , 0.75);
      color:azure;
    }

    .faq-question {
      font-weight: bold;
      font-size: 18px;
      margin-bottom: 5px;
    }

    .faq-answer {
      font-size: 16px;
      display: none; /* hide the answer by default */
    }

    .faq-card:hover .faq-answer {
      display: block; /* show the answer when hovering over the card */
    }
    .rec {
  font-size: 3rem;
  color: #333;
  animation: recAnimation 1s ease-in-out infinite alternate;
}

@keyframes recAnimation {
  0% {
    transform: scale(1);
    color: black;
  }
  50% {
    transform: scale(1);
    color: rgba(0, 0, 0, 0.75);
  }
  100% {
    transform: scale(1);
    color: #333;
  }
}

.wlc {
  animation-name: slide-in-text;
  animation-duration: 1s;
  animation-delay: 0s;
  animation-fill-mode: forwards;
}


@keyframes slide-in-text {
  0% {
    transform: translateY(-50%);
    opacity: 0;
  }
  100% {
    transform: translateY(0);
    opacity: 1;
  }
}

.reca {
  animation: slide-in 1s ease-in-out;
}

@keyframes slide-in {
  0% {
    transform: translateX(-100%);
  }
  100% {
    transform: translateX(0%);
  }
}


    
  </style>
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="createfaq.php">Nouveau FAQ</a></li>
        <li><a href="profiletech.php">Profile</a></li>
        <li><a href="/my help desk/login">Logout</a></li>
      </ul>
    </nav>
    <div class="header-text">
      <h1 class='wlc'>Bienvenue <?php echo $nom ." ". $pre ?></h1>
    </div>
  </header>
  <main>
 <section class="intro">
  <div class="intro-text">
    <h2 class='reca'>Helpdesk</h2>
    <p>Bienvenue sur notre site web de helpdesk! Notre équipe d'experts est là pour vous aider à résoudre tous vos problèmes techniques. Que vous ayez des difficultés avec un logiciel, un périphérique ou un réseau, nous sommes là pour vous offrir une assistance de qualité. Nous comprenons l'importance de minimiser les interruptions dans votre travail, c'est pourquoi nous offrons des solutions rapides et efficaces pour vous aider à reprendre vos activités normales. En utilisant notre site web de helpdesk, vous pouvez être sûr de bénéficier d'un service à la clientèle exceptionnel et d'une assistance technique professionnelle en tout temps. Merci de faire confiance à notre équipe pour tous vos besoins en matière de helpdesk.</p>
  </div>
  <div class="intro-image">
    <img src="ulc.png" alt="illustration">
  </div>
</section>

  <section class="faq">
    <div class='color'>
    <h2 class='rec'>Les tickets</h2>
    <?php echo $output ?>
  </div>
  </section>
</main>
<footer>
  <p>&copy; help desk made by zangati.</p>
</footer>
<script src="script.js"></script>
</body>
</html>
