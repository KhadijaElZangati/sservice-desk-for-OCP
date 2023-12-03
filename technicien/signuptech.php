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
        $mot_de_Passe = $_POST['motdepasse'];
        $confirmation_password = $_POST['confmotdepasse'];
        $admine = $_POST['admine'];
        $reftech = $_POST['ref'];
        $phonetech = $_POST['phone'];
        if(empty($_POST["lastname"])){
           $lterror=" votre nom est obligatoire";
        }
        if(empty($_POST["firstname"])){
            $frerror=" votre prenom est obligatoire";
        }
        if(empty($_POST["email"])){
            $emailrror=" votre email est obligatoire";
        }
        if(empty($_POST["admine"])){
          $admineerror=" votre administrateur  est obligatoire";
      }
        if( (empty($_POST["motdepasse"])) || (empty($_POST["confmotdepasse"]))){
            $motconferror=" le mot de passe  est obligatoire";
        }
        
    
        if($_POST["motdepasse"]!==$_POST["confmotdepasse"]){ //hada bach ikon mot de passe ou conf dyalo identique
            $confmotidentiqueerror=" le mot se passe et le confirmation de mot de passe doit etre identique";
        }

        if(empty($_POST["ref"])){
          $referror=" votre reference est obligatoire";
      }
    
      $stmt = $dns->prepare('SELECT * FROM refocp');
      $stmt->execute();
      $output = '';

      
      $referrorocp = '';
      
      while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $reftechocp = $ligne['reftechocp'];
      
          if ($reftech != $reftechocp) {
              $referrorocp = "Votre référence est incorrecte";
              break; // Exit the loop if the reference is incorrect
          }
      }
      




      if( (empty($_POST["phone"])) || (empty($_POST["phone"] && strlen($_POST['phone'])==10))){
        $phoneerror=" le numero de telephone est obligatoire il doit contenir 10 nomber";
    }

        // hna kayn condition bax ila kan error mansstokish data f db .
      while ( empty($lterror) &&  empty($referror)   && empty($frerror) && empty( $emailrror) && empty( $motconferror) && empty($confmotidentiqueerror) && empty($admineerror) && empty($phoneerror) && empty($referrorocp)) {
      $comm = "INSERT INTO tech (technom , techprenom , techemail, phonetech, techmot_de_passe , techconf_mot_de_passe , tech_admine , reftech) VALUES (:prenom, :nom, :email, :phonetech , :mot_de_Passe, :confirmation_password , :admine , :reftech)";
      $hashp=password_hash($mot_de_Passe , PASSWORD_DEFAULT);
      $hashc=password_hash($confirmation_password , PASSWORD_DEFAULT);
        $rep = $dns->prepare($comm);
        $rep->execute([ 'prenom' => $prenom, 'nom' => $name, 'email' => $email, 'phonetech'=>$phonetech , 'mot_de_Passe' => $hashp, 'confirmation_password' =>  $hashc , 'admine'=>$admine , 'reftech'=>$reftech]);
          header('Location: /my help desk/login'); // this one is to move to the login page if there is no errors kayditikti 
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
    <title> Signup page</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="signup.css">
    </head>
    <body>
    <div class="signupcard">
    <pre>Bienvenue sur notre site web! Veuillez 
         saisir votre information pour Crée votre compte </pre>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="lastname" value="" placeholder="nom" class="nom"><br>
            <?php if(isset($lterror) && !empty($lterror)) { ?>
  <p  style="color:red;" class="error"><?php echo $lterror; ?></p>
<?php } ?>

            <input type="text" name="firstname" value="" placeholder="prenom" class="nom"><br>
            <?php if(isset($frerror) && !empty($frerror)) { ?>
  <p style="color:red;" class="error"><?php echo  $frerror ; ?></p>
<?php } ?>


            <input type="email" name="email" value="" placeholder="email" class="nom"><br>
            <?php if(isset( $emailrror) && !empty( $emailrror)) { ?>
  <p style="color:red;" class="error"><?php echo   $emailrror ; ?></p>
<?php } ?>

          <input type="text" name="phone" value="" placeholder="Téléphone" class="nom">
            <?php if(isset($phoneerror) && !empty($phoneerror)) { ?>
                <p style="color:red;" class="error"><?php echo $phoneerror; ?></p>
            <?php } ?>    


            <input type="password" name="motdepasse" value="" placeholder="mot de passe" class="nom"><br>
            <?php if(isset( $motconferror) && !empty( $motconferror)) { ?>
  <p  style="color:red;" class="error"><?php echo   $motconferror  ; ?></p>
<?php } ?>


            <input type="password" name="confmotdepasse" value="" placeholder="confirme le mot de passe" class="nom"><br>
            <?php if(isset( $confmotidentiqueerror) && !empty($confmotidentiqueerror)) { ?>
  <p style="color:red;" class="error"><?php echo  $confmotidentiqueerror ; ?></p>
<?php } ?>

<input type="text" name="admine" value="" placeholder="administrateur" class="nom"><br>
            <?php if(isset( $admineerror) && !empty($admineerror)) { ?>
  <p style="color:red;" class="error"><?php echo  $admineerror ; ?></p>
<?php } ?>

<input type="password" name="ref" value="" placeholder="ref" class="nom"><br>
            <?php if(isset( $referror) && !empty($referror)) { ?>
  <p style="color:red;" class="error"><?php echo  $referror ; ?></p><br>
<?php } ?>
<?php if(isset( $referrorocp) && !empty($referrorocp)) { ?>
  <p style="color:red;" class="error"><?php echo  $referrorocp ; ?></p>
<?php } ?>


            <input type="submit" name="signupbt"  class="signupbt" value="Signup"> 
        </form>
    </div>

    </body>
</html>