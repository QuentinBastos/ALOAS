<?php

include_once ROOT. "/classes/classe_tournoi.php";
include_once ROOT. "/classes/classe_equipe.php";


$id=$_GET['id'];

$TestTournoi=$_SESSION['TestTournoi'];


$TestTournoi->supprimerEquipe($id);

$_SESSION['dejala']=true;


header("location:  /organiser/organiser");