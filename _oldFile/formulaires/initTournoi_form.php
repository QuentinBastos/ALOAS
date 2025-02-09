<?php
include_once ROOT . "/classes/classe_tournoi.php";
include_once ROOT . "/classes/classe_equipe.php";


$TestTournoi=$_SESSION['TestTournoi'];

$TestTournoi->setNom($_POST['nomTournoi']);
$TestTournoi->setLieu($_POST['lieuTournoi']);
$TestTournoi->setDiscipline($_POST['sport']);
    
$_SESSION['TestTournoi']=$TestTournoi;
if($_POST['modal_temps']!=NULL){
    $_SESSION['tempsManche']=$_POST['modal_temps'];
}else{
    $_SESSION['tempsManche']=NULL;
}


$_SESSION['nbPoules']=0;


if($TestTournoi->getNbEquipes()<=1){
    header("location:  /organiser/organiser");
}else{
    header("location:  /organiser/organiser_poules");
}