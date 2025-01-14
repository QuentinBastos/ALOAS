<?php 

$urlactive = $_SERVER["PHP_SELF"];
if($urlactive == "/affichage_tournoi/poule_score.php"){
    header('Location: /index');
  } 
  include ROOT . '/include/pdo.php' ; 
  ?>
<div class="poule">
    <ul class="liste_poule">
        <div class="nom_colonne">
            <p>goalaverage</p>
            <p>fair-play</p>
        </div>
        <li class="equipe_poule">

            <p> <?php if ($equipe1) echo $equipe1["nom"]; ?> </p>
            <img src="<?php if ($equipe1) echo $equipe1["icones"]; ?>" />
            <p>
                <?php
                /**
                 * Récupération de la discipline du tournoi
                 */
                $statement = $pdo->prepare('SELECT discipline from Tournois where idTournoi = :idTournoi;');
                $statement->execute(
                    [
                        'idTournoi' => $_GET['idTournoi']
                    ]
                );
                $discipline=$statement->fetch();

if($discipline['discipline']=="Foot") {

    /**
     * Récupération du nb de points hors poule
     */
    $statement = $pdo->prepare('SELECT getPointsFootHorsPoule(:equipe, :idTournoi) AS points;');
    $statement->execute(
        [
            'idTournoi' => $_GET['idTournoi'],
            'equipe' => $equipe1["idEquipe"]
        ]
    );
    $scoreHorsPouleEquipe1 = $statement->fetch(PDO::FETCH_ASSOC);

    /**
     * Récupération du nb de points en poule
     */
    $statement = $pdo->prepare('SELECT getPointsFoot(:equipe, :idTournoi) AS points;');
    $statement->execute(
        [
            'idTournoi' => $_GET['idTournoi'],
            'equipe' => $equipe1["idEquipe"]
        ]
    );
    $scorePouleEquipe1 = $statement->fetch(PDO::FETCH_ASSOC);
    /**
     * Récupération du goalaverage
     */

    $statement = $pdo->prepare('SELECT goalaverage from Equipes where idEquipe=:equipe;');
    $statement->execute(
        [
            'equipe' => $equipe1["idEquipe"]
        ]
    );
    $goalAverageEquipe1 = $statement->fetch(PDO::FETCH_ASSOC);
    echo $goalAverageEquipe1["goalaverage"];

}elseif ($discipline['discipline']=="Pétanque"){
    /**
     * Récupération du nb de points hors poule
     */
    $statement = $pdo->prepare('SELECT getPointsPetanqueHorsPoule(:equipe, :idTournoi) AS points;');
    $statement->execute(
        [
            'idTournoi' => $_GET['idTournoi'],
            'equipe' => $equipe1["idEquipe"]
        ]
    );
    $scoreHorsPouleEquipe1 = $statement->fetch(PDO::FETCH_ASSOC);

     /**
     * Récupération du nb de points en poule
     */
    $statement = $pdo->prepare('SELECT getPointsPetanque(:equipe, :idTournoi) AS points;');
    $statement->execute(
        [
            'idTournoi' => $_GET['idTournoi'],
            'equipe' => $equipe1["idEquipe"]
        ]
    );
    $scorePouleEquipe1 = $statement->fetch(PDO::FETCH_ASSOC);
    /**
     * Récupération du goalaverage
     */
    $statement = $pdo->prepare('SELECT goalaverage from Equipes where idEquipe=:equipe;');
    $statement->execute(
        [
            'equipe' => $equipe1["idEquipe"]
        ]
    );
    $goalAverageEquipe1 = $statement->fetch(PDO::FETCH_ASSOC);
    echo $goalAverageEquipe1["goalaverage"];
}elseif ($discipline['discipline']=="Tennis"){
    $statement = $pdo->prepare('SELECT getPointsTennisHorsPoule(:equipe, :idTournoi) AS points;');
    $statement->execute(
        [
            'idTournoi' => $_GET['idTournoi'],
            'equipe' => $equipe1["idEquipe"]
        ]
    );
    $scoreHorsPouleEquipe1 = $statement->fetch(PDO::FETCH_ASSOC);

     /**
     * Récupération du nb de points en poule
     */
    $statement = $pdo->prepare('SELECT getPointsTennis(:equipe, :idTournoi) AS points;');
    $statement->execute(
        [
            'idTournoi' => $_GET['idTournoi'],
            'equipe' => $equipe1["idEquipe"]
        ]
    );
    $scorePouleEquipe1 = $statement->fetch(PDO::FETCH_ASSOC);
    /**
     * Récupération du goalaverage
     */
    $statement = $pdo->prepare('SELECT goalaverage from Equipes where idEquipe=:equipe;');
    $statement->execute(
        [
            'equipe' => $equipe1["idEquipe"]
        ]
    );
    $goalAverageEquipe1 = $statement->fetch(PDO::FETCH_ASSOC);
    echo $goalAverageEquipe1["goalaverage"];
}


                ?>
            </p>
            <p>
                <?php
                /**
                 * Récupération du fairplay
                 */
                $statement = $pdo->prepare('select fairplay from Equipes where idEquipe=:equipe;');
                $statement->execute(
                    [
                        'equipe' => $equipe1["idEquipe"]
                    ]
                );
                $fairplay=$statement->fetchAll();

                echo $fairplay[0]["fairplay"];
                ?>
            </p>
            <?php $cpt = 1;foreach ($qualif as $equipeP) {

                if ($equipeP && $equipe1) {
                    if ($equipeP["idEquipe"] == $equipe1["idEquipe"]) {
                        echo "<img src=/icones/etoile.svg> ";
                    }
                }


                if($nbEqui["nb"] > 8 && $cpt >= 8){
                    break;
                }elseif($nbEqui["nb"] < 8 && $nbEqui["nb"]>4 && $cpt >= 4){
                    break;
                }
                elseif($nbEqui["nb"] <= 4 &&  $cpt >= 2){
                    break;
                }
                $cpt++;
            }
            ?>

        </li>

        <li class="equipe_poule">
            <p> <?php if ($equipe2) echo $equipe2["nom"]; ?> </p>
            <img src="<?php if ($equipe2) echo $equipe2["icones"]; ?>" />
            <p>
                <?php


                if($discipline['discipline']=="Foot") {

                    /**
                     * Récupération du nb de points hors poule
                     */
                    $statement = $pdo->prepare('SELECT getPointsFootHorsPoule(:equipe, :idTournoi) AS points;');
                    $statement->execute(
                        [
                            'idTournoi' => $_GET['idTournoi'],
                            'equipe' => $equipe2["idEquipe"]
                        ]
                    );
                    $scoreHorsPouleEquipe2 = $statement->fetch(PDO::FETCH_ASSOC);

                    /**
                     * Récupération du nb de points en poule
                     */
                    $statement = $pdo->prepare('SELECT getPointsFoot(:equipe, :idTournoi) AS points;');
                    $statement->execute(
                        [
                            'idTournoi' => $_GET['idTournoi'],
                            'equipe' => $equipe2["idEquipe"]
                        ]
                    );
                    $scorePouleEquipe2 = $statement->fetch(PDO::FETCH_ASSOC);
                    /**
                     * Récupération du goalaverage
                     */
                    $statement = $pdo->prepare('SELECT goalaverage from Equipes where idEquipe=:equipe;');
    $statement->execute(
        [
            'equipe' => $equipe2["idEquipe"]
        ]
    );
    $goalAverageEquipe2 = $statement->fetch(PDO::FETCH_ASSOC);
    echo $goalAverageEquipe2["goalaverage"];

                }elseif ($discipline['discipline']=="Pétanque"){
                    /**
                     * Récupération du nb de points hors poule
                     */
                    $statement = $pdo->prepare('SELECT getPointsPetanqueHorsPoule(:equipe, :idTournoi) AS points;');
                    $statement->execute(
                        [
                            'idTournoi' => $_GET['idTournoi'],
                            'equipe' => $equipe2["idEquipe"]
                        ]
                    );
                    $scoreHorsPouleEquipe2 = $statement->fetch(PDO::FETCH_ASSOC);
                        
                    /**
                     * Récupération du nb de points en poule
                     */
                    $statement = $pdo->prepare('SELECT getPointsPetanque(:equipe, :idTournoi) AS points;');
                    $statement->execute(
                        [
                            'idTournoi' => $_GET['idTournoi'],
                            'equipe' => $equipe2["idEquipe"]
                        ]
                    );
                    $scorePouleEquipe2 = $statement->fetch(PDO::FETCH_ASSOC);
                    /**
                     * Récupération du goalaverage
                     */
                    $statement = $pdo->prepare('SELECT goalaverage from Equipes where idEquipe=:equipe;');
    $statement->execute(
        [
            'equipe' => $equipe2["idEquipe"]
        ]
    );
    $goalAverageEquipe2 = $statement->fetch(PDO::FETCH_ASSOC);
    echo $goalAverageEquipe2["goalaverage"];
                }elseif ($discipline['discipline']=="Tennis"){
                    /**
                     * Récupération du nb de points hors poule
                     */
                    $statement = $pdo->prepare('SELECT getPointsTennisHorsPoule(:equipe, :idTournoi) AS points;');
                    $statement->execute(
                        [
                            'idTournoi' => $_GET['idTournoi'],
                            'equipe' => $equipe2["idEquipe"]
                        ]
                    );
                    $scoreHorsPouleEquipe2 = $statement->fetch(PDO::FETCH_ASSOC);

                    /**
                     * Récupération du nb de points en poule
                     */
                    $statement = $pdo->prepare('SELECT getPointsTennis(:equipe, :idTournoi) AS points;');
                    $statement->execute(
                        [
                            'idTournoi' => $_GET['idTournoi'],
                            'equipe' => $equipe2["idEquipe"]
                        ]
                    );
                    $scorePouleEquipe2 = $statement->fetch(PDO::FETCH_ASSOC);
                    /**
                     * Récupération du goalaverage
                     */
                    $statement = $pdo->prepare('SELECT goalaverage from Equipes where idEquipe=:equipe;');
    $statement->execute(
        [
            'equipe' => $equipe2["idEquipe"]
        ]
    );
    $goalAverageEquipe2 = $statement->fetch(PDO::FETCH_ASSOC);
    echo $goalAverageEquipe2["goalaverage"];
                }
                ?>
            </p>
            <p>
                <?php
                /**
                 * Récupération du fairplay
                 */
                $statement = $pdo->prepare('select fairplay from Equipes where idEquipe=:equipe;');
                $statement->execute(
                    [
                        'equipe' => $equipe2["idEquipe"]
                    ]
                );
                $fairplay=$statement->fetchAll();

                echo $fairplay[0]["fairplay"];
                ?>
            </p>
            <?php $cpt = 1;foreach ($qualif as $equipeP) {

                if ($equipeP && $equipe2) {
                    if ($equipeP["idEquipe"] == $equipe2["idEquipe"]) {
                        echo "<img src=/icones/etoile.svg> ";
                    }
                }


                if($nbEqui["nb"] > 8 && $cpt >= 8){
                    break;
                }elseif($nbEqui["nb"] < 8 && $nbEqui["nb"]>4 && $cpt >= 4){
                    break;
                }
                elseif($nbEqui["nb"] <= 4 &&  $cpt >= 2){
                    break;
                }
                $cpt++;
            }
            ?>

        </li>

        <li class="equipe_poule">
            <p> <?php if ($equipe3) echo $equipe3["nom"]; ?> </p>
            <img src="<?php if ($equipe3) echo $equipe3["icones"]; ?>" />
            <p>
                <?php
                if(!empty($equipe3)) {

                    if($discipline['discipline']=="Foot") {

                        /**
                         * Récupération du nb de points hors poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsFootHorsPoule(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe3["idEquipe"]
                            ]
                        );
                        $scoreHorsPouleEquipe3 = $statement->fetch(PDO::FETCH_ASSOC);

                        /**
                         * Récupération du nb de points en poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsFoot(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe3["idEquipe"]
                            ]
                        );
                        $scorePouleEquipe3 = $statement->fetch(PDO::FETCH_ASSOC);
                        /**
                         * Récupération du goalaverage
                         */
                        $statement = $pdo->prepare('SELECT goalaverage from Equipes where idEquipe=:equipe;');
    $statement->execute(
        [
            'equipe' => $equipe3["idEquipe"]
        ]
    );
    $goalAverageEquipe3 = $statement->fetch(PDO::FETCH_ASSOC);
    echo $goalAverageEquipe3["goalaverage"];

                    }elseif ($discipline['discipline']=="Pétanque"){
                        /**
                         * Récupération du nb de points hors poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsPetanqueHorsPoule(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe3["idEquipe"]
                            ]
                        );
                        $scoreHorsPouleEquipe3 = $statement->fetch(PDO::FETCH_ASSOC);

                        /**
                         * Récupération du nb de points en poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsPetanque(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe3["idEquipe"]
                            ]
                        );
                        $scorePouleEquipe3 = $statement->fetch(PDO::FETCH_ASSOC);
                        /**
                         * Récupération du goalaverage
                         */
                        $statement = $pdo->prepare('SELECT goalaverage from Equipes where idEquipe=:equipe;');
    $statement->execute(
        [
            'equipe' => $equipe3["idEquipe"]
        ]
    );
    $goalAverageEquipe3 = $statement->fetch(PDO::FETCH_ASSOC);
    echo $goalAverageEquipe3["goalaverage"];
                    }elseif ($discipline['discipline']=="Tennis"){
                        /**
                         * Récupération du nb de points hors poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsTennisHorsPoule(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe3["idEquipe"]
                            ]
                        );
                        $scoreHorsPouleEquipe3 = $statement->fetch(PDO::FETCH_ASSOC);

                        /**
                         * Récupération du nb de points en poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsTennis(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe3["idEquipe"]
                            ]
                        );
                        $scorePouleEquipe3 = $statement->fetch(PDO::FETCH_ASSOC);
                        /**
                         * Récupération du goalaverage
                         */
                        $statement = $pdo->prepare('SELECT goalaverage from Equipes where idEquipe=:equipe;');
    $statement->execute(
        [
            'equipe' => $equipe3["idEquipe"]
        ]
    );
    $goalAverageEquipe3 = $statement->fetch(PDO::FETCH_ASSOC);
    echo $goalAverageEquipe3["goalaverage"];
                    }
                }
                ?>
            </p>
            <p>
                <?php
                if(!empty($equipe3)) {
                    /**
                     * Récupération du fairplay
                     */
                    $statement = $pdo->prepare('select fairplay from Equipes where idEquipe=:equipe;');
                    $statement->execute(
                        [
                            'equipe' => $equipe3["idEquipe"]
                        ]
                    );
                    $fairplay = $statement->fetchAll();

                    echo $fairplay[0]["fairplay"];
                }
                ?>
            </p>

            <?php
            if(!empty($equipe3)) {
                $cpt = 1;
                foreach ($qualif as $equipeP) {

                    if ($equipeP && $equipe3) {
                        if ($equipeP["idEquipe"] == $equipe3["idEquipe"]) {
                            echo "<img src=/icones/etoile.svg> ";
                        }
                    }


                    if ($nbEqui["nb"] > 8 && $cpt >= 8) {
                        break;
                    } elseif ($nbEqui["nb"] < 8 && $nbEqui["nb"] > 4 && $cpt >= 4) {
                        break;
                    } elseif ($nbEqui["nb"] <= 4 && $cpt >= 2) {
                        break;
                    }
                    $cpt++;
                }
            }
            ?>

        </li>

        <li class="equipe_poule">
            <p> <?php if ($equipe4) echo $equipe4["nom"]; ?> </p>
            <img src="<?php if ($equipe4) echo $equipe4["icones"]; ?>" />
            <p>
                <?php
                if(!empty($equipe4)) {

                    if($discipline['discipline']=="Foot") {

                        /**
                         * Récupération du nb de points hors poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsFootHorsPoule(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe4["idEquipe"]
                            ]
                        );
                        $scoreHorsPouleEquipe4 = $statement->fetch(PDO::FETCH_ASSOC);

                        /**
                         * Récupération du nb de points en poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsFoot(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe4["idEquipe"]
                            ]
                        );
                        $scorePouleEquipe4 = $statement->fetch(PDO::FETCH_ASSOC);
                        /**
                         * Récupération du goalaverage
                         */
                        $statement = $pdo->prepare('SELECT goalaverage from Equipes where idEquipe=:equipe;');
    $statement->execute(
        [
            'equipe' => $equipe4["idEquipe"]
        ]
    );
    $goalAverageEquipe4 = $statement->fetch(PDO::FETCH_ASSOC);
    echo $goalAverageEquipe4["goalaverage"];

                    }elseif ($discipline['discipline']=="Pétanque"){
                        /**
                         * Récupération du nb de points hors poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsPetanqueHorsPoule(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe4["idEquipe"]
                            ]
                        );
                        $scoreHorsPouleEquipe4 = $statement->fetch(PDO::FETCH_ASSOC);

                        /**
                         * Récupération du nb de points en poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsPetanque(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe4["idEquipe"]
                            ]
                        );
                        $scorePouleEquipe4 = $statement->fetch(PDO::FETCH_ASSOC);
                        /**
                         * Récupération du goalaverage
                         */
                        $statement = $pdo->prepare('SELECT goalaverage from Equipes where idEquipe=:equipe;');
    $statement->execute(
        [
            'equipe' => $equipe4["idEquipe"]
        ]
    );
    $goalAverageEquipe4 = $statement->fetch(PDO::FETCH_ASSOC);
    echo $goalAverageEquipe4["goalaverage"];
                    }elseif ($discipline['discipline']=="Tennis"){
                        /**
                         * Récupération du nb de points hors poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsTennisHorsPoule(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe4["idEquipe"]
                            ]
                        );
                        $scoreHorsPouleEquipe4 = $statement->fetch(PDO::FETCH_ASSOC);

                        /**
                         * Récupération du nb de points en poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsTennis(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe4["idEquipe"]
                            ]
                        );
                        $scorePouleEquipe4 = $statement->fetch(PDO::FETCH_ASSOC);
                        /**
                         * Récupération du goalaverage
                         */
                        $statement = $pdo->prepare('SELECT goalaverage from Equipes where idEquipe=:equipe;');
    $statement->execute(
        [
            'equipe' => $equipe4["idEquipe"]
        ]
    );
    $goalAverageEquipe4 = $statement->fetch(PDO::FETCH_ASSOC);
    echo $goalAverageEquipe4["goalaverage"];
                    }
                }
                ?>
            </p>
            <p>
                <?php
                if(!empty($equipe4)) {
                    /**
                     * Récupération du fairplay
                     */
                    $statement = $pdo->prepare('select fairplay from Equipes where idEquipe=:equipe;');
                    $statement->execute(
                        [
                            'equipe' => $equipe4["idEquipe"]
                        ]
                    );
                    $fairplay = $statement->fetchAll();

                    echo $fairplay[0]["fairplay"];
                }
                ?>
            </p>
            <?php
            if(!empty($equipe4)) {
                $cpt = 1;
                foreach ($qualif as $equipeP) {

                    if ($equipeP && $equipe4) {
                        if ($equipeP["idEquipe"] == $equipe4["idEquipe"]) {
                            echo "<img src=/icones/etoile.svg> ";
                        }
                    }


                    if ($nbEqui["nb"] > 8 && $cpt >= 8) {
                        break;
                    } elseif ($nbEqui["nb"] < 8 && $nbEqui["nb"] > 4 && $cpt >= 4) {
                        break;
                    } elseif ($nbEqui["nb"] <= 4 && $cpt >= 2) {
                        break;
                    }
                    $cpt++;
                }
            }
            ?>

        </li>

        <li class="equipe_poule">
            <p> <?php if ($equipe5) echo $equipe5["nom"]; ?> </p>
            <img src="<?php if ($equipe5) echo $equipe5["icones"]; ?>" />
            <p>
                <?php
                if(!empty($equipe5)) {

                    if($discipline['discipline']=="Foot") {

                        /**
                         * Récupération du nb de points hors poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsFootHorsPoule(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe5["idEquipe"]
                            ]
                        );
                        $scoreHorsPouleEquipe5 = $statement->fetch(PDO::FETCH_ASSOC);

                        /**
                         * Récupération du nb de points en poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsFoot(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe5["idEquipe"]
                            ]
                        );
                        $scorePouleEquipe5 = $statement->fetch(PDO::FETCH_ASSOC);
                        /**
                         * Récupération du goalaverage
                         */
                        $statement = $pdo->prepare('SELECT goalaverage from Equipes where idEquipe=:equipe;');
    $statement->execute(
        [
            'equipe' => $equipe5["idEquipe"]
        ]
    );
    $goalAverageEquipe5 = $statement->fetch(PDO::FETCH_ASSOC);
    echo $goalAverageEquipe5["goalaverage"];

                    }elseif ($discipline['discipline']=="Pétanque"){
                        /**
                         * Récupération du nb de points hors poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsPetanqueHorsPoule(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe5["idEquipe"]
                            ]
                        );
                        $scoreHorsPouleEquipe5 = $statement->fetch(PDO::FETCH_ASSOC);

                        /**
                         * Récupération du nb de points en poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsPetanque(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe5["idEquipe"]
                            ]
                        );
                        $scorePouleEquipe1 = $statement->fetch(PDO::FETCH_ASSOC);
                        /**
                         * Récupération du goalaverage
                         */
                        $statement = $pdo->prepare('SELECT goalaverage from Equipes where idEquipe=:equipe;');
                        $statement->execute(
                            [
                                'equipe' => $equipe5["idEquipe"]
                            ]
                        );
                        $goalAverageEquipe5 = $statement->fetch(PDO::FETCH_ASSOC);
                        echo $goalAverageEquipe5["goalaverage"];
                    }elseif ($discipline['discipline']=="Tennis"){
                        /**
                         * Récupération du nb de points hors poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsTennisHorsPoule(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe5["idEquipe"]
                            ]
                        );
                        $scoreHorsPouleEquipe5 = $statement->fetch(PDO::FETCH_ASSOC);

                        /**
                         * Récupération du nb de points en poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsTennis(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe5["idEquipe"]
                            ]
                        );
                        $scorePouleEquipe5 = $statement->fetch(PDO::FETCH_ASSOC);
                        /**
                         * Récupération du goalaverage
                         */
                        $statement = $pdo->prepare('SELECT goalaverage from Equipes where idEquipe=:equipe;');
    $statement->execute(
        [
            'equipe' => $equipe5["idEquipe"]
        ]
    );
    $goalAverageEquipe5 = $statement->fetch(PDO::FETCH_ASSOC);
    echo $goalAverageEquipe5["goalaverage"];
                    }
                }
                ?>
            </p>
            <p>
                <?php
                if(!empty($equipe5)) {
                    /**
                     * Récupération du fairplay
                     */
                    $statement = $pdo->prepare('select fairplay from Equipes where idEquipe=:equipe;');
                    $statement->execute(
                        [
                            'equipe' => $equipe5["idEquipe"]
                        ]
                    );
                    $fairplay = $statement->fetchAll();

                    echo $fairplay[0]["fairplay"];
                }
                ?>
            </p>
            <?php
            if(!empty($equipe5)) {
                $cpt = 1;
                foreach ($qualif as $equipeP) {

                    if ($equipeP && $equipe5) {
                        if ($equipeP["idEquipe"] == $equipe5["idEquipe"]) {
                            echo "<img src=/icones/etoile.svg> ";
                        }
                    }


                    if ($nbEqui["nb"] > 8 && $cpt >= 8) {
                        break;
                    } elseif ($nbEqui["nb"] < 8 && $nbEqui["nb"] > 4 && $cpt >= 4) {
                        break;
                    } elseif ($nbEqui["nb"] <= 4 && $cpt >= 2) {
                        break;
                    }
                    $cpt++;
                }
            }
            ?>

        </li>

        <li class="equipe_poule">
            <p> <?php if ($equipe6) echo $equipe6["nom"]; ?> </p>
            <img src="<?php if ($equipe6) echo $equipe6["icones"]; ?>" />
            <p>
                <?php
                if(!empty($equipe6)) {

                    if($discipline['discipline']=="Foot") {

                        /**
                         * Récupération du nb de points hors poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsFootHorsPoule(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe6["idEquipe"]
                            ]
                        );
                        $scoreHorsPouleEquipe1 = $statement->fetch(PDO::FETCH_ASSOC);

                        /**
                         * Récupération du nb de points en poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsFoot(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe6["idEquipe"]
                            ]
                        );
                        $scorePouleEquipe6 = $statement->fetch(PDO::FETCH_ASSOC);
                        /**
                         * Récupération du goalaverage
                         */
                        $statement = $pdo->prepare('SELECT goalaverage from Equipes where idEquipe=:equipe;');
    $statement->execute(
        [
            'equipe' => $equipe6["idEquipe"]
        ]
    );
    $goalAverageEquipe6 = $statement->fetch(PDO::FETCH_ASSOC);
    echo $goalAverageEquipe6["goalaverage"];

                    }elseif ($discipline['discipline']=="Pétanque"){
                        /**
                         * Récupération du nb de points hors poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsPetanqueHorsPoule(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe6["idEquipe"]
                            ]
                        );
                        $scoreHorsPouleEquipe1 = $statement->fetch(PDO::FETCH_ASSOC);

                        /**
                         * Récupération du nb de points en poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsPetanque(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe6["idEquipe"]
                            ]
                        );
                        $scorePouleEquipe1 = $statement->fetch(PDO::FETCH_ASSOC);
                        /**
                         * Récupération du goalaverage
                         */
                        $statement = $pdo->prepare('SELECT goalaverage from Equipes where idEquipe=:equipe;');
    $statement->execute(
        [
            'equipe' => $equipe6["idEquipe"]
        ]
    );
    $goalAverageEquipe6 = $statement->fetch(PDO::FETCH_ASSOC);
    echo $goalAverageEquipe6["goalaverage"];
                    }elseif ($discipline['discipline']=="Tennis"){
                        /**
                         * Récupération du nb de points hors poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsTennisHorsPoule(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe6["idEquipe"]
                            ]
                        );
                        $scoreHorsPouleEquipe6 = $statement->fetch(PDO::FETCH_ASSOC);

                        /**
                         * Récupération du nb de points en poule
                         */
                        $statement = $pdo->prepare('SELECT getPointsTennis(:equipe, :idTournoi) AS points;');
                        $statement->execute(
                            [
                                'idTournoi' => $_GET['idTournoi'],
                                'equipe' => $equipe6["idEquipe"]
                            ]
                        );
                        $scorePouleEquipe6 = $statement->fetch(PDO::FETCH_ASSOC);
                        /**
                         * Récupération du goalaverage
                         */
                        $statement = $pdo->prepare('SELECT goalaverage from Equipes where idEquipe=:equipe;');
    $statement->execute(
        [
            'equipe' => $equipe6["idEquipe"]
        ]
    );
    $goalAverageEquipe6 = $statement->fetch(PDO::FETCH_ASSOC);
    
    echo $goalAverageEquipe6["goalaverage"];
                    }
                }
                ?>

            </p>
            <p>
                <?php
                if(!empty($equipe6)) {
                    /**
                     * Récupération du fairplay
                     */
                    $statement = $pdo->prepare('select fairplay from Equipes where idEquipe=:equipe;');
                    $statement->execute(
                        [
                            'equipe' => $equipe6["idEquipe"]
                        ]
                    );
                    $fairplay = $statement->fetchAll();

                    echo $fairplay[0]["fairplay"];
                }
                ?>
            </p>
            <?php
            if(!empty($equipe6)) {
                $cpt = 1;
                foreach ($qualif as $equipeP) {

                    if ($equipeP && $equipe6) {
                        if ($equipeP["idEquipe"] == $equipe6["idEquipe"]) {
                            echo "<img src=/icones/etoile.svg> ";
                        }
                    }


                    if ($nbEqui["nb"] > 8 && $cpt >= 8) {
                        break;
                    } elseif ($nbEqui["nb"] < 8 && $nbEqui["nb"] > 4 && $cpt >= 4) {
                        break;
                    } elseif ($nbEqui["nb"] <= 4 && $cpt >= 2) {
                        break;
                    }
                    $cpt++;
                }
            }
            ?>

        </li>
    </ul>
</div>
