<?php
$titre = "Tournois en cours";
include ROOT . "/modules/header.php";
include_once ROOT . "/classes/classe_equipe.php";
include_once ROOT . "/classes/classe_tournoi.php";
include ROOT . '/include/pdo.php' ; 
$idTournoi=$_GET['idTournoi'];
/**
 * Récupération des informations du tournoi
 */
$resultat =  $pdo->prepare("SELECT * FROM Tournois where idTournoi=" .intval($idTournoi). "");
$resultat->execute();
$ligne = $resultat->fetch(PDO::FETCH_ASSOC);
$tournoi1 = new Tournoi($ligne["idTournoi"],$ligne["nom"],$ligne["lieu"],$ligne["discipline"]);
?>

<!doctype html>
<html>
<body>

<main id="poule">
    <section class="poule_tournoi">
        <?php
        unset($idGagnant);
        unset($equipeGagnante);
        unset($equipeGagnanteDem1);
        unset($equipeGagnanteDem2);
        unset($qualif);
        $id = $tournoi1->getId();
        /**
         * Récupération du nombre d'équipes
         */
        $nbEquiReq = $pdo->prepare("SELECT count(*) as nb FROM Equipes WHERE idTournoi = :idT");
        $nbEquiReq->execute(
            [
                "idT"=> $id
            ]
        );
        $nbEqui = $nbEquiReq->fetch(PDO::   FETCH_ASSOC);
        $disci = strtolower($tournoi1->getDiscipline());
        if($disci == "pétanque"){
            $sport = "p";
        }else if ($disci == "tennis"){
            $sport = "t";
        }else if ($disci == "foot"){
            $sport = "f";
        }

        if($sport == "p"){
            /**
             * Récupération des équipes qualifiées
             */
            $qualifReq = $pdo->prepare("SELECT * from Equipes e
            where idTournoi = :varTournoi
            order by getPointsPoulePetanque(e.idEquipe,:varTournoi) desc");
            $qualifReq->execute([
                ":varTournoi"=>$id
            ]);
            $qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);

            /**
             * Récupération de l'id des matchs
             */
            $test = $pdo->prepare('SELECT idMatch from Matchs where idTournoi=:idTournoi');
            $test->execute(
                [
                    'idTournoi' => $_GET['idTournoi']
                ]
            );
            $test=$test->fetchAll();


            if(!empty($test)) {
                /**
                 * Récupération de l'id de l'équipe gagnante
                 */
                $gagnantsReq = $pdo->prepare("SELECT getGagnantPet(:varidEquipe1,:varidEquipe2,:varidTournoi,true)");
                $gagnantsReq->execute([
                    ":varidEquipe1" => $qualif[0]["idEquipe"],
                    ":varidEquipe2" => $qualif[1]["idEquipe"],
                    ":varidTournoi" => $id
                ]);

                $gagnant = $gagnantsReq->fetch(PDO:: FETCH_ASSOC);
            }
        }elseif($sport == "t"){

            /**
             * Récupération des équipes qualifiées
             */
            $qualifReq = $pdo->prepare("SELECT * from Equipes e
            where idTournoi = :varTournoi
            order by getPointsPouleTennis(e.idEquipe,:varTournoi) desc");
            $qualifReq->execute([
                ":varTournoi"=>$id
            ]);
            $qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);


            /**
             * Récupération de l'id des equipes gagnantes
             */
            $gagnantsReq = $pdo->prepare("SELECT getGagnantTen(:varidEquipe1,:varidEquipe2,:varidTournoi,true)");
            $gagnantsReq->execute([
                ":varidEquipe1"=>$qualif[0]["idEquipe"],
                ":varidEquipe2"=>$qualif[1]["idEquipe"],
                ":varidTournoi"=>$id
            ]);

            $gagnant = $gagnantsReq->fetch(PDO:: FETCH_ASSOC);

        }elseif($sport == "f"){
            /**
             * Récupération des équipes qualifiées
             */
            $qualifReq = $pdo->prepare("SELECT * from Equipes e
            where idTournoi = :varTournoi
            order by getPointsPouleFoot(e.idEquipe,:varTournoi) desc");
            $qualifReq->execute([
                ":varTournoi"=>$id
            ]);
            $qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);

            /**
             * Récupération de l'id des equipes gagnantes
             */
            $gagnantsReq = $pdo->prepare("SELECT getGagnantFoot(:varidEquipe1,:varidEquipe2,:varidTournoi,true)");
            $gagnantsReq->execute([
                ":varidEquipe1"=>$qualif[0]["idEquipe"],
                ":varidEquipe2"=>$qualif[1]["idEquipe"],
                ":varidTournoi"=>$id
            ]);

            $gagnant = $gagnantsReq->fetch(PDO:: FETCH_ASSOC);
        }
        ?>


        <div class="tournois_poules">
            <?php
            /**
             * Récupération du nombre de poules
             */
            $nbRequete = $pdo->prepare("SELECT count(*) as nb FROM Poules where idTournoi = :varId");
            $nbRequete->execute([
                "varId"=>$id
            ]);
            $nbRequete = $nbRequete->fetch(PDO::   FETCH_ASSOC);
            $nbPoules = $nbRequete["nb"];

            /**
             * Récupération des poules
             */
            $poules = $pdo->prepare("SELECT * FROM Poules WHERE idTournoi = :varId");
            $poules->execute([
                "varId"=>$id
            ]);

            for ($i = 0; $i<$nbPoules; $i++){
                $poule = $poules->fetch(PDO::   FETCH_ASSOC);

                /**
                 * Récupération des équipes
                 */
                $equipe1 = $pdo->prepare("SELECT * FROM Equipes where idEquipe = :varId");
                $equipe1->execute([
                    "varId"=>$poule["idEquipe1"]
                ]);
                $equipe1 = $equipe1->fetch(PDO::   FETCH_ASSOC);

                $equipe2 = $pdo->prepare("SELECT * FROM Equipes where idEquipe = :varId");
                $equipe2->execute([
                    "varId"=>$poule["idEquipe2"]
                ]);
                $equipe2 = $equipe2->fetch(PDO::   FETCH_ASSOC);

                $equipe3 = $pdo->prepare("SELECT * FROM Equipes where idEquipe = :varId");
                $equipe3->execute([
                    "varId"=>$poule["idEquipe3"]
                ]);
                $equipe3 = $equipe3->fetch(PDO::   FETCH_ASSOC);

                $equipe4 = $pdo->prepare("SELECT * FROM Equipes where idEquipe = :varId");
                $equipe4->execute([
                    "varId"=>$poule["idEquipe4"]
                ]);
                $equipe4 = $equipe4->fetch(PDO::   FETCH_ASSOC);

                $equipe5 = $pdo->prepare("SELECT * FROM Equipes where idEquipe = :varId");
                $equipe5->execute([
                    "varId"=>$poule["idEquipe5"]
                ]);
                $equipe5 = $equipe5->fetch(PDO::   FETCH_ASSOC);

                $equipe6 = $pdo->prepare("SELECT * FROM Equipes where idEquipe = :varId");
                $equipe6->execute([
                    "varId"=>$poule["idEquipe6"]
                ]);
                $equipe6 = $equipe6->fetch(PDO::   FETCH_ASSOC);

                include ROOT . "/affichage_tournoi/poule_score.php";
            }
            ?>

        </div>
    </section>

<section class="match_poule">
    <?php
    /**
     * Récupération des matchs de poules
     */
    $matchsPoules = $pdo->prepare("SELECT * FROM Matchs where idTournoi = :idTournoi and matchPoule=1");
    $matchsPoules->execute([
        "idTournoi"=>$idTournoi
    ]);
    $matchsPoules=$matchsPoules->fetchAll();

    /**
     * Récupération du nombre de matchs de poules
     */
    $statement = $pdo->prepare("SELECT count(*) as nb FROM Matchs where idTournoi = :idTournoi and matchPoule=1");
    $statement->execute([
        "idTournoi"=>$idTournoi
    ]);
    $nbMatchsPoules=$statement->fetch();

    $equipe1ParMatch=array();
    $equipe2ParMatch=array();

    for($i=0;$i<$nbMatchsPoules['nb'];$i++) {
        /**
         * Récupération des équipes
         */
        $equipe1Matchs = $pdo->prepare("SELECT * FROM Equipes where idEquipe=:idEquipe1");
        $equipe1Matchs->execute([
            "idEquipe1" => $matchsPoules[$i]['idEquipe1']
        ]);
        $equipe1ParMatch[$i] = $equipe1Matchs->fetch();

        $equipe2Matchs = $pdo->prepare("SELECT * FROM Equipes where idEquipe=:idEquipe2");
        $equipe2Matchs->execute([
            "idEquipe2" => $matchsPoules[$i]['idEquipe2']
        ]);
        $equipe2ParMatch[$i] = $equipe2Matchs->fetch();

        echo '<div class="match_conso_infos">';

        echo '<div class="vs_conso">';

        $point1=0;
        $point2=0;
        if($sport=="f"){
            unset($statement);
            /**
             * Récupération des matchs de foot
             */
            $statement = $pdo->prepare("select * from Match_foot where idMatch = :idMatch");
            $statement->execute([
                "idMatch"=> $matchsPoules[$i]['idMatch']
            ]);
            $matchExiste=$statement->fetchAll();
        }
        if($sport=="t"){
            unset($statement);

            /**
             * Récupération des matchs de tennis
             */
            $statement = $pdo->prepare("select * from Match_tennis where idMatch = :idMatch");
            $statement->execute([
                "idMatch"=> $matchsPoules[$i]['idMatch']
            ]);
            $matchExiste=$statement->fetchAll();

        }
        if($sport=="p"){
            unset($statement);

            /**
             * Récupération des matchs de pétanque
             */
            $statement = $pdo->prepare("select * from Manches_petanque where idMatch = :idMatch");
            $statement->execute([
                "idMatch"=> $matchsPoules[$i]['idMatch']
            ]);
            $matchExiste=$statement->fetchAll();
            unset($statement);

            /**
             * Récupération du nombre de manches de pétanque
             */
            $statement = $pdo->prepare("select count(idManche) as nb from Manches_petanque where idMatch = :idMatch");
            $statement->execute([
                "idMatch"=> $matchsPoules[$i]['idMatch']
            ]);
            $nbManches=$statement->fetch();

            
            for($j=0;$j<$nbManches['nb'];$j++){
                $point1=$point1+$matchExiste[$j]['pointsEquipe1'];
                $point2=$point2+$matchExiste[$j]['pointsEquipe2'];
            }
        }
        

        echo '<img src=';
        echo $equipe1ParMatch[$i]["icones"];
        echo '>';
        echo '<div>VS</div>
    <img src=';
        echo $equipe2ParMatch[$i]["icones"];
        echo '></div> ';
if(isset($matchExiste[0])){
    echo '<div class="score_match">';
    if ($sport == "f") {
       echo '<p>';
       echo $matchExiste[0]['butsEquipe1'];
       echo'</p> <p>-</p>';

        echo '<p>';
        echo $matchExiste[0]['butsEquipe2'];
        echo'</p>';
    }
    if ($sport == "t") {
        
        echo '<p>';
        echo $matchExiste[0]['setEquipe1'];
        echo'</p> <p>-</p>';

        echo '<p>';
        echo $matchExiste[0]['setEquipe2'];
        echo'</p>';
    }
    if ($sport == "p") {
        echo '<p>';
        echo $point1;
        echo'</p> <p>-</p>';

        echo '<p>';
        echo $point2;
        echo'</p>';
    }
echo '</div>';
}else {

    if($_SESSION['connecté']===true){
    if ($sport == "f") {
        echo '<a href="/formulaires/saisie_points_foot?idMatch=';
    }
    if ($sport == "t") {
        echo '<a href="/formulaires/saisie_points_tennis?idMatch=';
    }
    if ($sport == "p") {
        echo '<a href="/formulaires/saisie_points_petanque?idMatch=';
    }
    echo $matchsPoules[$i]['idMatch'];
    echo '">Saisir le match</a>';

    }else{
        echo '<p>Match non saisi</p>';
    }

}

        echo '</div>';
    }
    ?>

</section>

</main>


<?php include ROOT . '/modules/footer.php' ?>
</body>
</html>

