<?php
session_start();
$em = $_SESSION['email'];
$pre = $_SESSION['prenom'];
$nom = $_SESSION['nom'];
$mat = $_SESSION['id'];

$host ='localhost';
$db='authentication';
$user='root';
$password='';

try {
  $dns = new PDO("mysql:host=$host;dbname=$db",$user,$password);
} catch(Exception $e) {
  echo 'error'.$e->getMessage();
}

$question = '';
$answer = '';

if (isset($_POST['reponse']) && isset($_POST['question'])) {
  if (isset($_POST['submitbt'])) {
    $question = $_POST['question'];
    $answer = $_POST['reponse'];
    $rep = $dns->prepare('INSERT INTO faq (question, answer , techid ) VALUES (:question, :answer , :id) ');
    $rep->execute(array(':question' => $question, ':answer' => $answer , ':id'=>$mat));
    header('location:homerec.php');
    exit();
  }
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>create faq</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="createfaq.css">
    <style>
      .img {
        margin-bottom:20px;
  animation: scaleUpDown 2s infinite ease-in-out;
}

@keyframes scaleUpDown {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1);
  }
  100% {
    transform: scale(1);
  }
}

.signupbt {
    margin-top: 10px;
    width: 250px;
    height: 50px;
    color: azure;
    background-color: rgb(41, 140, 58);
    border: none;
    border-radius: 12px;
    cursor: pointer;
  }
  
  .signupbt:hover {
    background-color: rgb(0, 255, 42);
  }
      </style>
  </head>
  <body >
    <div >
      <div class="signupcard" >
        <img src='u.png' alter='illustration' class='img' >

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <input type="text" name="question" value="" placeholder="question/titre" class='qcm'>


          <textarea class='answer' name="reponse" placeholder="reponse"></textarea><br>



          <input type="submit" name="submitbt" class="signupbt" value="Submit" >
        </form>
      </div>
    </div>
  </body>
</html>
