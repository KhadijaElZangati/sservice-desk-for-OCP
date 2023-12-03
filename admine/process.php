<?php
session_start();
include_once("config.php");
$dns=config::connect();

if(isset($_POST['loginbt'])){
    $dns=config::connect();
    $email=$_POST['email'];
    $password=$_POST['motdepasse'];
    if(checklogin($dns,$email,$password)){
        $_SESSION['email']=$email;
        header('location:homeadmine.php');
    }else{
        echo "the email or password is invalide";
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