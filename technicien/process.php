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
        header('location:homerec.php');
    }else{
        echo "the email or password is invalide";
    }
}

function checklogin($dns , $email , $password){
    $query=$dns->prepare(" SELECT * from tech where techemail =:email and techmot_de_passe=:pass");
    $query->execute(array(":email"=>$email , ":pass"=>$password));
   
    if($query->rowCount()==1){
        $user = $query->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id'] = $user['techid'];
        $_SESSION['nom'] = $user['technom'];
        $_SESSION['prenom'] = $user['techprenom'];
        $_SESSION['administrateur']=$user['tech_admine'];
        $_SESSION['reftech']=$user['reftech'];
        return true;
    }else{
        return false;
    } 
}



?>