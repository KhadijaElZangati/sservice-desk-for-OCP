

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
   $dns->setAttribute(pdo::ATTR_ERRMODE ,pdo::ERRMODE_WARNING);
}catch(Exception $e){
    echo "ereur :".$e->getMessage();
}



$phoneusererror = '';
$titreerror = '';
$typeadmineerror = '';
$typerecerror = '';
$descerror = '';
$phonetecherror='';

if(isset($_POST['submitbt'])){
   // if(empty($_POST['phoneuser'])){
        //$phoneusererror = 'Le numéro de téléphone est obligatoire';
   // }
    if(empty($_POST['phonetech'])){
        $phonetecherror = 'Le numéro de téléphone est obligatoire';
    }
    //if(empty($_POST['titre'])){
      //  $titreerror = 'Le titre de réclamation est obligatoire';
  //  }
    if(empty($_POST['mylistadmine'])){
        $typeadmineerror = 'Le type est obligatoire';
    }
    if(empty($_POST['mylist'])){
        $typerecerror = 'Le type est obligatoire';
    }
    if(empty($_POST['DESC'])){
        $descerror = 'La description est obligatoire';
    }

    if(/*empty($phoneusererror) &&*/ empty($phonetecherror) /*&& empty($titreerror)*/ && empty($typeadmineerror) && empty($typerecerror) && empty($descerror)){
        $phoneuser = $_GET['phoneuser'];
        $phonetech = $_POST['phonetech'];
        $titre = $_GET['titre'];
        $desc = $_POST['DESC'];
        $typeadmine = $_POST['mylistadmine'];
        $typerec = $_POST['mylist'];
        $d = date('Y-m-d H:i:s');
        $rep = $dns->prepare('INSERT INTO reclamationtech (phoneuser, phonetech, titre, desctech, typerec, typeadmine, emailtech, date_reclamationtech) values (:phoneuser, :phonetech, :titre, :desctech, :mylist, :mylistadmine, :emailtech, :d)');
        $rep->execute(array(':phoneuser' => $phoneuser, ':phonetech' => $phonetech, ':titre' => $titre, ':desctech' => $desc, ':mylistadmine' => $typeadmine, ':mylist' => $typerec, ':emailtech' => $em, ':d' => $d));
        $errors = $rep->errorInfo();
if ($errors[0] !== '00000') {
    print_r($errors);
}

        header('location:homerec.php');
        exit();
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
    <title> reclamation </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="lvl.css">
    <style>
        .body{
    background-color: rgb(253, 253, 253);
}
.signupcard{
    background-color: rgb(255, 255, 255);
    padding-top: 20px;
    padding-bottom: 20px;
    padding-left: 20px;
    padding-right: 20px;
    width: fit-content;
    text-align: center;
    margin: 20px auto;
    border-radius: 12px;
    box-shadow: 12px 12px 40px rgba(0, 0, 0 , 0.75);
}
.all{
    background-color: rgb(255, 255, 255);
    padding-top: 2px;
    padding-bottom: 0px;
    padding-left: 30px;
    padding-right: 30px;
    width: fit-content;
    text-align: center;
    margin: 100px auto;
    border-radius: 12px;
    box-shadow: 12px 12px 40px rgba(0, 0, 0 , 0.75);
    background-color: #F0F3F4;
  /* Set the initial background color */
  animation: colorChange 6s infinite;
  /* Apply the animation */
}

@keyframes colorChange {
  0% { background-color: #F0F3F4; }
  25% { background-color: #E67E22; }
  50% { background-color: #3498DB; }
  75% { background-color: #27AE60; }
  100% { background-color: #F0F3F4; }
}

.nom{
    height: 40px;
    width: 400px;
    margin-bottom: 20px;
    padding-left: 10px;
}



.DESC{
    width: 400px;
    height: 100px;
    padding-left: 8px;
    margin-bottom: 20px;  
    border-radius: 12px;
}


.DESC::placeholder{
position: absolute;
top: 0;
left: 0;
padding-left: 8px;
padding-top: 12px;
}





h1{
    color:azure;
}


pre{
    color: azure;
    font-size: 14px;
}

.p{
    color: rgb(255, 253, 253);
}




    </style>



    </head>
    <body >
        <div class='all'>
            <h1>Nous savons que vous avez fait de votre mieux.</h1>
    <div class="signupcard" style='shadow-box:black;' >
  
    
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">


            <input type="text" name="phonetech" value="" placeholder="telephone de technicien" class="nom"><br>
            <?php if(isset($phonetecherror) && !empty($phonetecherror)) { ?>
                <p style="color:red;" class="error"><?php echo $phonetecherror; ?></p>
            <?php } ?>

<!--<input type="text" name="phoneuser" value="" placeholder="telephone d'utilisateur" class="nom"><br>
<?php// if(isset($phoneusererror) && !empty($phoneusererror)) { ?>
                <p style="color:red;" class="error"><?php //echo $phoneusererror; ?></p>
            <?php// } ?>-->


<!--<input type="text" name="titre" value="" placeholder="titre" class="nom"><br>
<?php// if(isset($titreerror) && !empty($titreerror)) { ?>
                <p style="color:red;" class="error"><?php// echo $titreerror; ?></p>
            <?php// } ?>-->
          
            <input type="text" class='DESC' name="DESC" value="" placeholder="description" ><br>
            <?php if(isset($descerror) && !empty($descerror)) { ?>
                <p style="color:red;" class="error"><?php echo $descerror; ?></p>
            <?php } ?>

<label style='color:azure;'> choisir l'administrateur</label><br>
<select class="nom" name="mylistadmine" >
  <option value="Identity">Identity </option>
  <option value="Materiels">Materiels</option>
  <option value="Réseau">Réseau</option>
  <option value="Application">Application</option>
</select>
<br>
<?php if(isset($typeadmineerror) && !empty($typeadmineerror)) { ?>
                <p style="color:red;" class="error"><?php echo $typeadmineerror; ?></p>
            <?php } ?>

<label for="myList" style='color:azure;'>le type de reclamation</label><br>
<select class="nom" name="mylist" style="margin-top:10px ; width: 400px;   height: 40px;">
  <option value="demande d'une service">demande d'une service</option>
  <option value="demende d'information">demende d'information</option>
  <option value="declaration d'une probleme">declaration d'une probleme</option>
  <option value="declaration d'incident">declaration d'incident</option>
</select>
<br>
<?php if(isset($typerecerror) && !empty($typerecerror)) { ?>
                <p style="color:red;" class="error"><?php echo $typerecerror; ?></p>
            <?php } ?>

          
            <input type="submit" name="submitbt"  class="signupbt" value="envoyer"style="margin-top:10px ; width: 250px;   height: 50px; color:azure; background-color: rgb(41,140,58);"> 
        </form>
    </div>
</div>
    </body>
</html>
