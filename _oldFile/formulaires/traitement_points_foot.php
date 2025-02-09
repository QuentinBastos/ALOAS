<?php


if(!isset($_SESSION['connecté'])){
    $_SESSION['connecté'] = false;
    header('Location: /index');
}
require ROOT . '/include/pdo.php' ;

$idMatch=$_GET['idMatch'];

$pointEquipe1=$_POST['foot_points_marques1'];
$pointEquipe2=$_POST['foot_points_marques2'];
$fair_play1=$_POST['fair-play1'];
$fair_play2=$_POST['fair-play2'];



if($pointEquipe1>-1||$pointEquipe2>-1) {
    try{
        unset($statement);
        /**
         * Insertion des points dans la table Match_foot
         */
        $statement = $pdo->prepare("INSERT INTO Match_foot (butsEquipe1,butsEquipe2,idMatch)values (:bEquipe1,:bEquipe2,:idM);");
        $statement->execute([
            'bEquipe1' => $pointEquipe1,
            'bEquipe2' => $pointEquipe2,
            'idM' => $idMatch
        ]);

        unset($statement);
        /**
         * Récupération des id des équipes
         */
        $statement = $pdo->prepare("select idEquipe1,idEquipe2 from Matchs where idMatch= :idM");
        $statement->execute([
            'idM' => $idMatch
        ]);
        $equipes = $statement->fetchALL();
        unset($statement);
        /**
         * Mise à jour du goalaverage et du fairplay des équipes
         */
        $statement = $pdo->prepare("UPDATE Equipes set fairplay =fairplay+ :fairplay where idEquipe= :idEquipe");
        $statement->execute([
            'fairplay' => $fair_play1,
            'idEquipe' => $equipes[0]['idEquipe1']
        ]);


        unset($statement);
        $statement = $pdo->prepare("UPDATE Equipes set fairplay =fairplay+ :fairplay where idEquipe= :idEquipe");
        $statement->execute([
            'fairplay' => $fair_play2,
            'idEquipe' => $equipes[0]['idEquipe2']
        ]);
        

        unset($statement);
        $statement = $pdo->prepare("select updateGoalaverageFoot( :idM )");
        $statement->execute([
            'idM' => $idMatch
        ]);


        unset($statement);
        $statement = $pdo->prepare("select idTournoi from Matchs where idMatch= :idM");
        $statement->execute([
            'idM' => $idMatch
        ]);
        $idTournoi = $statement->fetch()['idTournoi'];


    }catch(Exception $e){
        echo $e->getMessage();
    }

    include ROOT . '/formulaires/ajout_match_arbre.php';

    header("location:  /affichage_tournoi/vue_tournoi_admin?idTournoi=$idTournoi");
    exit();
}else{
    header("location:  /formulaires/saisie_points_foot?idMatch=$idMatch");
    exit();
}
