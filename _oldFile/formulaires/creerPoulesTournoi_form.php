<?php
include_once ROOT . "/classes/classe_tournoi.php";
include_once ROOT . "/classes/classe_equipe.php";
include_once ROOT . "/classes/classe_poule.php";
include ROOT . '/include/pdo.php' ; 


$TestTournoi=$_SESSION['TestTournoi'];


$date = date("Y-m-d H:i:s", strtotime("now"));

/**
 * On insère le tournoi dans la base de données
 */
$statement = $pdo->prepare("INSERT INTO Tournois(nom, lieu, discipline, date, tpsMinuteur, nbEquipesSelec) VALUES (:varNom, :varLieu, :varDiscipline, :varDate, :varTemps, :varNbEquSel)");
$statement->execute(
    [
    'varNom' => $TestTournoi->getNom(),
    'varLieu' => $TestTournoi->getLieu(),
    'varDiscipline' => $TestTournoi->getDiscipline(),
    'varDate' => $date,
    'varTemps' => $_SESSION['tempsManche'],
    'varNbEquSel' => $_SESSION['nbEquSelect']
    ]
);

/**
 * On récupère l'id du tournoi que l'on vient d'insérer
 */
$statement = $pdo->prepare("SELECT max(idTournoi) AS maxi FROM Tournois");
$statement->execute();
$idDerTournoi = $statement->fetch(PDO::FETCH_ASSOC);
$idDerTournoi = $idDerTournoi['maxi'];


for($i=0;$i<$TestTournoi->getNbEquipes();$i++){
    if($TestTournoi->getNbEquipes()>3 && $_SESSION['nbPoules']!=1){
        $TestTournoi->getEquipe($i)->setIdPoule($_POST['pouleEq'.$i]);
    }else{
        $TestTournoi->getEquipe($i)->setIdPoule(1);
    }
    $TestTournoi->getEquipe($i)->getCheminIcone();
    $TestTournoi->getEquipe($i)->getNom();
    /**
     * On insère les équipes dans la base de données
     */
    $statement = $pdo->prepare("INSERT INTO Equipes(nom,icones,alt,idTournoi) VALUES (:varNom, :varIcones, :varAlt, :varIdtournoi)");
    $statement->execute(
        [
        'varNom' => $TestTournoi->getEquipe($i)->getNom(),
        'varIcones' => $TestTournoi->getEquipe($i)->getCheminIcone(),
        'varAlt' => $TestTournoi->getEquipe($i)->getDescIcone(),
        'varIdtournoi' => $idDerTournoi
        ]
    ); 
}

/**
 * On récupère l'id de la dernière équipe que l'on vient d'insérer
 */
$statement = $pdo->prepare("SELECT min(idEquipe) AS maxo FROM Equipes WHERE idTournoi= :varIdT");
$statement->execute(
    [
    'varIdT' => $idDerTournoi
    ]
); 
$idDerEquipe = $statement->fetch(PDO::FETCH_ASSOC);
$idDerEquipe = $idDerEquipe['maxo'];

for($i=0;$i<$TestTournoi->getNbEquipes();$i++){
    $TestTournoi->getEquipe($i)->setId($idDerEquipe+$i);
}


for($i=1;$i<=$_SESSION['nbPoules'];$i++){

    $Poule = new Poule ($i,$idDerTournoi);

    for($j=0;$j<$TestTournoi->getNbEquipes();$j++){
        if($TestTournoi->getEquipe($j)->getIdPoule()==$i){
            
            $Poule->ajoutEquipe($TestTournoi->getEquipe($j));
        }
    }
    for($j=0;$j<$Poule->getNbEquipes();$j++){
        switch($j){
            case 0 :
                $varEq0=$Poule->getEquipe(($j))->getId();
                break;
            case 1 :
                $varEq1=$Poule->getEquipe(($j))->getId();
                break;
            case 2 :
                $varEq2=$Poule->getEquipe(($j))->getId();
                break;
            case 3 :
                $varEq3=$Poule->getEquipe(($j))->getId();
                break;
            case 4 :
                $varEq4=$Poule->getEquipe(($j))->getId();
                break;
            case 5 :
                $varEq5=$Poule->getEquipe(($j))->getId();
                break;
        }
    }
    for($j=6;$j>$Poule->getNbEquipes();$j--){
        switch($j){
            case 1 :
                $varEq0=NULL;
                break;
            case 2 :
                $varEq1=NULL;
                break;
            case 3 :
                $varEq2=NULL;
                break;
            case 4 :
                $varEq3=NULL;
                break;
            case 5 :
                $varEq4=NULL;
                break;
            case 6 :
                $varEq5=NULL;
                break;
        }
    }
    
    /**
     * On insère les poules dans la base de données
     */
    $statement = $pdo->prepare("INSERT INTO Poules(idTournoi,idEquipe1,idEquipe2,idEquipe3,idEquipe4,idEquipe5,idEquipe6) 
    VALUES (:varIdTournoi, :varEq1, :varEq2, :varEq3, :varEq4, :varEq5, :varEq6)");
    $statement->execute(
        [
        'varIdTournoi' => $idDerTournoi,
        'varEq1' => $varEq0,
        'varEq2' => $varEq1,
        'varEq3' => $varEq2,
        'varEq4' => $varEq3,
        'varEq5' => $varEq4,
        'varEq6' => $varEq5
        ]
    ); 
}

/** 
 *  On récupère les poules que l'on vient de créer
 */
$poulesTournoi = $pdo->prepare("SELECT * FROM Poules WHERE idTournoi = :idT");

            $poulesTournoi->execute(

                [

                    "idT" => $idDerTournoi

                ]

            );





            while($lignePoule = $poulesTournoi->fetch(PDO::FETCH_ASSOC)){

                $idPoule = $lignePoule['idPoule'];

                $equ1Poule = $lignePoule['idEquipe1'];

                $equ2Poule = $lignePoule['idEquipe2'];

                $equ3Poule = $lignePoule['idEquipe3'];

                $equ4Poule = $lignePoule['idEquipe4'];

                $equ5Poule = $lignePoule['idEquipe5'];

                $equ6Poule = $lignePoule['idEquipe6'];





                if($equ6Poule){

                    $listeEquipePoule = [$equ1Poule,

                                        $equ2Poule,

                                        $equ3Poule,

                                        $equ4Poule,

                                        $equ5Poule,

                                        $equ6Poule];

                }elseif($equ5Poule){

                    $listeEquipePoule = [$equ1Poule,

                                        $equ2Poule,

                                        $equ3Poule,

                                        $equ4Poule,

                                        $equ5Poule];

                }elseif($equ4Poule){

                    $listeEquipePoule = [$equ1Poule,

                                        $equ2Poule,

                                        $equ3Poule,

                                        $equ4Poule];

                }elseif($equ3Poule){

                    $listeEquipePoule = [$equ1Poule,

                                        $equ2Poule,

                                        $equ3Poule];

                }elseif($equ2Poule){

                    $listeEquipePoule = [$equ1Poule,

                                        $equ2Poule];

                }





                for ($i = 0; $i < count($listeEquipePoule); $i++) {

                    for ($j = $i + 1; $j < count($listeEquipePoule); $j++) {
                        /**
                         * On insère les matchs vides dans la base de données
                         */
                        $insertMatchVide = $pdo->prepare("INSERT INTO Matchs(idEquipe1, idEquipe2, idTournoi, matchPoule) values(:varEqu1,:varEqu2,:varIdT,1)");

                        $insertMatchVide->execute(

                            [

                                "varIdT" => $idDerTournoi,

                                "varEqu1" => $listeEquipePoule[$i],

                                "varEqu2" => $listeEquipePoule[$j],

                            ]

                            );

                    }

                }

            }

    unset($_SESSION['TestTournoi']);  
    unset($_SESSION['creer']);  

header("location:  /organiser/organiser");
