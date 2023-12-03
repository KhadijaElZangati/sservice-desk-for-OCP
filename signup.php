<?php
$dbhost='localhost';
$db="authentication";
$user='root';
$psswd="";

try{
	$dns= new PDO("mysql:host=$dbhost;dbname=$db",$user,$psswd);
	//echo"connexion reussir<br>";

	
	if (isset($_POST['signupbt']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['motdepasse']) && isset($_POST['confmotdepasse'])) {
        $name = $_POST['lastname'];
        $prenom = $_POST['firstname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $mot_de_Passe = $_POST['motdepasse'];
        $confirmation_password = $_POST['confmotdepasse'];

        if(empty($_POST["lastname"])){
           $lterror=" votre nom est obligatoire";
        }
        if(empty($_POST["firstname"])){
            $frerror=" votre prenom est obligatoire";
        }
        if(empty($_POST["email"])){
            $emailrror=" votre email est obligatoire";
        }
        if( (empty($_POST["motdepasse"])) || (empty($_POST["confmotdepasse"]))){
            $motconferror=" le mot de passe  est obligatoire";
        }
    
        if($_POST["motdepasse"]!==$_POST["confmotdepasse"]){ //hada bach ikon mot de passe ou conf dyalo identique
            $confmotidentiqueerror=" le mot se passe et le confirmation de mot de passe doit etre identique";
        }

        if( (empty($_POST["phone"])) || (empty($_POST["phone"] && strlen($_POST['phone'])==10))){
          $phoneerror=" le numero de telephone est obligatoire il doit contenir 10 nomber";
      }

        // hna kayn condition bax ila kan error mansstokish data f db .
      while ( empty($lterror)   && empty($frerror) && empty( $emailrror) && empty( $motconferror) && empty($confmotidentiqueerror)) {
      $comm = "INSERT INTO utilisateur (prenom, nom, email, phoneuser , mot_de_Passe, confirmation_password) VALUES (:prenom, :nom, :email,:phone, :mot_de_Passe, :confirmation_password)";
      $hashp=password_hash($mot_de_Passe , PASSWORD_DEFAULT);
      $hashc=password_hash($confirmation_password , PASSWORD_DEFAULT);
        $rep = $dns->prepare($comm);
        $rep->execute([ 'prenom' => $prenom, 'nom' => $name, 'email' => $email,'phone'=>$phone, 'mot_de_Passe' => $mot_de_Passe, 'confirmation_password' =>  $confirmation_password]);
          header('Location: login.html'); // this one is to move to the login page if there is no errors kayditikti 
    exit(); //bach n7ebsso l'execution dyal had script 
      }

      }
      
}catch(Exception $e){
	echo "ereur :".$e->getMessage();
}

?>




<!DOCTYPE html>
<html>
  <head>
    <title>Signup Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link href="signup.css" rel="stylesheet">
    <style>
   .tech{
    height: 150px;
    width: 140px;
    background-color:white;
    border-radius:10px;
    margin-top:70px;
    margin-right:-20px;
    float:left;
    box-shadow:12px 12px 40px grey;
   }
   .tech:hover{
     background-color:white;
     color:black;
     box-shadow:12px 12px 40px black;
   }
   .admine{
    height: 150px;
    width: 140px;
    background-color:white;
    border-radius:10px;
    margin-top:70px;
    margin-right:-20px;
    float:right;
    box-shadow:12px 12px 40px grey;
   }

   .admine:hover{
     background-color:white;
     color:black;
     box-shadow:12px 12px 40px black;
   }

    .error{
      color:red;
    }

    .card{
      height: 700px;
      width: 800px;
      box-shadow:12px 12px 40px black;
    }
    </style>

  </head>
  <body>
   
      <div class="card">
        <h1>Créer un compte client.</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="input-group">
            <label for="lastname">nom</label>
            <input type="text" id="lastname" name="lastname" >
            <?php if(isset($lterror) && !empty($lterror)) { ?>
              <p class="error"><?php echo $lterror; ?></p>
            <?php } ?>
          </div>
          <div class="input-group">
            <label for="firstname">prenom</label>
            <input type="text" id="firstname" name="firstname">
            <?php if(isset($frerror) && !empty($frerror)) { ?>
              <p class="error"><?php echo $frerror ; ?></p>
            <?php } ?>
          </div>
          <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
            <?php if(isset($emailrror) && !empty($emailrror)) { ?>
              <p class="error"><?php echo $emailrror ; ?></p>
            <?php } ?>
          </div>
          <div class="input-group">
          <label for="email">numéro de téléphone</label>
          <input type="text" name="phone" value="" placeholder="Téléphone" class="nom">
            <?php if(isset($phoneerror) && !empty($phoneerror)) { ?>
                <p style="color:red;" class="error"><?php echo $phoneerror; ?></p>
            <?php } ?>
            </div>
          <div class="input-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="motdepasse" >
            <?php if(isset($motconferror) && !empty($motconferror)) { ?>
              <p class="error"><?php echo $motconferror  ; ?></p>
            <?php } ?>
          </div>
          <div class="input-group">
            <label for="confirm-password">Confirmation de mot de passe</label>
            <input type="password" id="confirm-password" name="confmotdepasse" >
            <?php if(isset($confmotidentiqueerror) && !empty($confmotidentiqueerror)) { ?>
              <p class="error"><?php echo $confmotidentiqueerror ; ?></p>
            <?php } ?>
          </div>
          <button type="submit" name="signupbt" class="btn">Sign up</button>
          <div class='con'>
          <div class='tech'>
  <img src='ulc.png' alt='avatar' style='border-radius: 50%; width: 80px; height: 80px; margin: 20px auto 0 auto; display: block;'>
  <a href='technicien/signuptech.php' style='text-align:center; margin-left:30px;'><strong> technicien</strong></a>
</div>

            <div class='admine'>
            <img src='ulb (3).png' alt='avatar' style='border-radius: 50%; width: 80px; height: 80px; margin: 20px auto 0 auto; display: block;'>
  <a href='admine/signup.php' style='text-align:center;  margin-left:40px;'><strong> admine</strong></a>
            </div>
            </div>
        </form>
        <div class="link">
          <p>Vous avez déjà un compte ? <a href="login.php">Log in</a></p>
        </div>
      </div>
  </body>
</html>
