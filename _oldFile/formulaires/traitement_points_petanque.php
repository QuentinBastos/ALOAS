<?php
if(!isset($_SESSION['connecté'])){
    $_SESSION['connecté'] = false;
    header('Location: /index');
}

require ROOT . '/include/pdo.php' ;

$idMatch=$_GET['idMatch'];
$i=0;
do{
    $i++;
}
while (isset($_POST['points_marques_A_manche'.$i]));
$equipeA =array();
$equipeB =array();
$pointA=0;
$pointB=0;
$fair_play1=$_POST['fair-play1'];
$fair_play2=$_POST['fair-play2'];
for ($j = 1; $j < $i; $j++) {
    $equipeA[$j] = $_POST['points_marques_A_manche' . $j];
    $equipeB[$j] = $_POST['points_marques_B_manche' . $j];
    $pointA+=$equipeA[$j];
    $pointB+=$equipeB[$j];
}

if(($pointA >= 13 || $pointB >= 13)){
    for ($j = 1; $j < $i; $j++) {
        if ($equipeB[$j] == 0 || $equipeA[$j] == 0) {
            unset($statement);
            /**
             * Insertion des points dans la table Manches_petanque
             */
            $statement = $pdo->prepare("INSERT INTO Manches_petanque (idMatch,num_manche,pointsEquipe1,pointsEquipe2)VALUES (:idM,:numM,:pEquipe1,:pEquipe2);");
            $statement->execute([
                'idM' => $idMatch,
                'numM' => $j,
                'pEquipe1' => $equipeA[$j],
                'pEquipe2' => $equipeB[$j]
            ]);
        } else {

            header("location:  /saisie_points_petanque?idMatch=$idMatch");
        }
    }

    unset($statement);
    /**
     * Récupération des id des équipes
     */
    $statement = $pdo->prepare("SELECT idEquipe1,idEquipe2 from Matchs where idMatch= :idM");
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
    $statement = $pdo->prepare("select updateGoalaveragePetanque( :idM )");
    $statement->execute([
        'idM' => $idMatch
    ]);

    unset($statement);
        $statement = $pdo->prepare("select idTournoi from Matchs where idMatch= :idM");
        $statement->execute([
            'idM' => $idMatch
        ]);
        $idTournoi = $statement->fetch()['idTournoi'];


    include ROOT . '/formulaires/ajout_match_arbre.php';


    header("location:  /affichage_tournoi/vue_tournoi_admin?idTournoi=$idTournoi");
    exit();

}else {

    header("location: /formulaires/saisie_points_petanque?idMatch=$idMatch");
    exit();
}
