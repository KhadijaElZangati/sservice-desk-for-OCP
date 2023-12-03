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
        $admine=$_POST['mylistadmine'];
        $mot_de_Passe = $_POST['motdepasse'];
        $confirmation_password = $_POST['confmotdepasse'];
        $ref=$_POST['ref'];
        if(empty($_POST["lastname"])){
           $lterror=" votre nom est obligatoire";
        }
        if(empty($_POST["firstname"])){
            $frerror=" votre prenom est obligatoire";
        }
        if(empty($_POST["email"])){
            $emailrror=" votre email est obligatoire";
        }
        if(empty($_POST["administration"])){
          $admineerror=" votre administration est obligatoire";
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
          $reftechocp = $ligne['refadmineocp'];
      
          if ($ref != $reftechocp) {
              $referrorocp = "Votre référence est incorrecte";
              break; // Exit the loop if the reference is incorrect
          }
      }


        // hna kayn condition bax ila kan error mansstokish data f db .
      while ( empty($lterror) && empty($referror)   && empty($frerror) && empty( $emailrror) && empty( $motconferror) && empty($confmotidentiqueerror) && empty($referrorocp)) {
      $comm = "INSERT INTO admine (prenom_admine , nom_admine, email_admine, administration, password_admine , password_confadmine , ref ) VALUES (:prenom, :nom, :email, :admine, :mot_de_Passe, :confirmation_password , :ref)";
      $hashp=password_hash($mot_de_Passe , PASSWORD_DEFAULT);
      $hashc=password_hash($confirmation_password , PASSWORD_DEFAULT);
        $rep = $dns->prepare($comm);
        $rep->execute([ 'prenom' => $prenom, 'nom' => $name, 'email' => $email,'admine'=>$admine , 'mot_de_Passe' => $mot_de_Passe, 'confirmation_password' =>  $confirmation_password , 'ref'=>$ref] );
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
    <title> Signup page admine </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="signup.css">
    <style>
      body{
    background-color: rgb(229, 229, 229);
    background-size:cover;
    background-position: center center ;  
    filter: contrast(3);  
      }


.signupcard{
    background-color: rgb(255, 255, 255);
    padding-bottom: 20px;
    padding-left: 20px;
    padding-right: 20px;
    width: fit-content;
    text-align: center;
    margin: 100px auto;
    border-radius: 12px;
    box-shadow: 12px 12px 20px 20px rgba(0, 0, 0 , 0.55);
    margin-left:20px;
    margin-bottom:20px;

}

.all{
    background-color: rgb(255, 255, 255);
    padding-top: 0px;
    padding-bottom: 20px;
    padding-left: 30px;
    padding-right: 30px;
    width: fit-content;
    text-align: center;
    margin: 100px auto;
    border-radius: 12px;
    box-shadow: 12px 12px  40px rgba(0, 0, 0 , 0.75);}

.nom{
    width: 400px;
    height: 40px;
    padding-left: 8px;
    margin-bottom: 20px;
}

.signupbt{
    width: 200px;
    height: 40px;
    background-color: rgb(41,140,58);
    color: black;
    font-weight: 600;
}

.ocplogo{
    width: 200px;
    height: 200px;
}

pre{
    color: azure;
    font-size: 14px;
}

.p{
    color: rgb(255, 253, 253);
}

h1{
  color: #F0F3F4;
  /* Set the initial background color */
  animation: colorChange 6s infinite;
  /* Apply the animation */
}

@keyframes colorChange {
  0% { color: #F0F3F4; }
  25% { color: #E67E22; }
  50% { color: #3498DB; }
  75% { color: #27AE60; }
  100% { color: #F0F3F4; }
}


      </style>
    </head>
    <body>
    <div class='all'>
            <h1> Bienvenue Mr admine</h1>
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

<label style='color:black;'> choisir l'administration</label><br>
<select class="nom" name="mylistadmine" style="margin-top:10px ; width: 410px;   height: 40px;">
  <option value="Identity">Identity </option>
  <option value="Materiels">Materiels</option>
  <option value="Réseau">Réseau</option>
  <option value="Application">Application</option>
</select>
<br>
<?php //if(isset($admineerror) && !empty($admineerror)) { ?>
  <!--<p style="color:red;" class="error"><?php //echo//  $admineerror ; ?></p>-->
<?php //} ?>


            <input type="password" name="motdepasse" value="" placeholder="mot de passe" class="nom"><br>
            <?php if(isset( $motconferror) && !empty( $motconferror)) { ?>
  <p  style="color:red;" class="error"><?php echo   $motconferror  ; ?></p>
<?php } ?>


            <input type="password" name="confmotdepasse" value="" placeholder="confirme le mot de passe" class="nom"><br>
            <?php if(isset( $confmotidentiqueerror) && !empty($confmotidentiqueerror)) { ?>
  <p style="color:red;" class="error"><?php echo  $confmotidentiqueerror ; ?></p>
<?php } ?>

<input type="password" name="ref" value="" placeholder="ref" class="nom"><br>
            <?php if(isset( $referror) && !empty($referror)) { ?>
  <p style="color:red;" class="error"><?php echo  $referror ; ?></p><br>
<?php } ?>
<?php if(isset( $referrorocp) && !empty($referrorocp)) { ?>
  <p style="color:red;" class="error"><?php   echo  $referrorocp ; ?></p>
<?php } ?>


        <input type="submit" name="signupbt"  class="signupbt" value="Signup"> 
        </form>
    </div>
            </div>

    </body>
</html>