<?php 

ob_start(); 

$_SESSION['pageTournoiDejaVisite']=false;

if((!isset($_POST['ID']) || empty($_POST['ID']) )|| (!isset($_POST['mdp'] )|| empty($_POST['mdp']) ) ){
  header("location:  /formulaires/connexion");
  exit;
}

include ROOT . '/include/pdo.php' ; 
/**
 *  Récupération des informations de l'admin
 */
$statement = $pdo->prepare("SELECT * FROM Admin WHERE ID= :varID");
$statement->execute(
    [
    'varID' => $_POST['ID']
    ]
);

$connexionAdmin = $statement->fetch();
/**
 *  Vérification des informations de l'admin
 */
if($connexionAdmin){
  if (($_POST['ID']===$connexionAdmin["ID"]) && (password_verify($_POST['mdp'],$connexionAdmin["MotDePasse"]))){
    $_SESSION['connecté'] = true;
    header("location: /index");
    exit;
  }
} 
header("location: /formulaires/connexion");
exit;
ob_end_flush();