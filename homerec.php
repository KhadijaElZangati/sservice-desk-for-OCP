<?php
session_start();
$em = $_SESSION['email'];
$pre = $_SESSION['prenom'];
$nom = $_SESSION['nom'];
$mat = $_SESSION['id'];
$phone=  $_SESSION['phoneuser'];

$dbhost='localhost';
$db="authentication";
$user='root';
$psswd="";

try {
    $dns= new PDO("mysql:host=$dbhost;dbname=$db",$user,$psswd);
} catch(Exception $e) {
    echo "ereur :".$e->getMessage();
}

$stmt= $dns->prepare('select question, answer from faq ');
$stmt->execute();

$output = ''; 

while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $question = $ligne['question'];
  $answer = $ligne['answer'];
  $output .= "<div class='faq-card'><h3>".$question."</h3><p class='answer'>".$answer."</p></div>";
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Home Page client</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="homerec.css">
  <style>
    .faq-card {
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 10px;
      margin-bottom: 10px;
      transition: box-shadow 0.3s;
    }

    .faq-card:hover {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      background-color: #00d10a;
      color:azure;
      box-shadow:12px 12px 40px black;
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
        <li><a href="demande.php">Nouveau ticket</a></li>
        <li><a href="about_us.php">À propos de nous</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="login.html">Logout</a></li>
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
    <h2 class='rec'>FAQ'S</h2>
    <?php echo $output ?>
  </section>
</main>
<footer>
  <p>&copy; help desk  made by zangati.</p>
</footer>
<script src="script.js"></script>
</body>
</html>
