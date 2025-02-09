<?php 

if(PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['connecté']) || $_SESSION['connecté'] != true)
{
    header('Location: /index');
}

if(!isset($_GET['idTournoi']) || empty($_GET['idTournoi']))
{
    header('Location: /index');
}

require ROOT . '/include/pdo.php' ; 


$idTournoi = $_GET['idTournoi'];

/* Appel d'une fonction qui supprime un tournoi passer en paramètre */

$supprTournoi = $pdo->prepare("SELECT SupprimerTournoi(:idTournoi)");
$supprTournoi->execute(
    [
        'idTournoi' => $idTournoi
    ]
);

header('Location: /index');
