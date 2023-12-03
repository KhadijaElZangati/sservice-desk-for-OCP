<?php
session_start();
include_once("config.php");
$dns=config::connect();

if(isset($_POST['loginbt'])){
    $dns=config::connect();
    $email=$_POST['email'];
    $password=$_POST['motdepasse'];
    if(checkloginuser($dns,$email,$password)){
        $_SESSION['email']=$email;
        header('location:homerec.php');
    }else{
        echo "<h1 >the email or password is invalide</h1>";
    }
    if(checklogintech($dns,$email,$password)){
        $_SESSION['email']=$email;
        header('location:technicien/homerec.php');
    }else{
        echo "the email or password is invalide";
    }

    $dns=config::connect();
    $email=$_POST['email'];
    $password=$_POST['motdepasse'];
    if(checklogin($dns,$email,$password)){
        $_SESSION['email']=$email;
        header('location:admine/homeadmine.php');
    }else{
        echo "the email or password is invalide";
    }

  }


function checkloginuser($dns , $email , $password){
    $query=$dns->prepare(" SELECT * from utilisateur where email =:email and mot_de_passe=:pass");
    $query->execute(array(":email"=>$email , ":pass"=>$password));
   
    if($query->rowCount()==1){
        $user = $query->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id'] = $user['id'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['phoneuser']=$user['phoneuser'];
        
        return true;
    }else{
        return false;
    } 
}

function checklogintech($dns , $email , $password){

    $query=$dns->prepare(" SELECT * from tech where techemail =:email and techmot_de_passe=:pass");
    $query->execute(array(":email"=>$email , ":pass"=>$password));
   
    if($query->rowCount()==1){
        $user = $query->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id'] = $user['techid'];
        $_SESSION['nom'] = $user['technom'];
        $_SESSION['prenom'] = $user['techprenom'];
        $_SESSION['administrateur']=$user['tech_admine'];
        return true;
    }else{
        return false;
    } 
}


function checklogin($dns , $email , $password){
    $query=$dns->prepare(" SELECT * from admine where email_admine =:email and password_admine=:pass");
    $query->execute(array(":email"=>$email , ":pass"=>$password));
   
    if($query->rowCount()==1){
        $user = $query->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id'] = $user['id_admine'];
        $_SESSION['nom'] = $user['nom_admine'];
        $_SESSION['prenom'] = $user['prenom_admine'];
        $_SESSION['administration'] = $user['administration'];
        return true;
    }else{
        return false;
    } 
}


?>