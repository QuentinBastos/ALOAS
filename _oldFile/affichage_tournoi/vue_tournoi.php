<?php
$titre = "vueTournoi";
include ROOT . "/modules/header.php";
include_once ROOT . "/classes/classe_equipe.php";
include_once ROOT . "/classes/classe_tournoi.php";
include ROOT . '/include/pdo.php' ; 

/* Page similaire à vue_tournoi_admin sauf les liens qui redirigent vers la vue des matchs */

$resultat =  $pdo->prepare("SELECT * FROM Tournois WHERE idTournoi = :idTournoi");
$resultat->execute(
    [
        'idTournoi' => $_GET['idTournoi']
    ]
);

if ($resultat) {
    $liste_lignes = $resultat->fetchAll(PDO::FETCH_ASSOC);
} else {
}

$liste_tournois = array();

foreach ($liste_lignes as $ligne) {
    $idTournoi = $ligne['idTournoi'];
    $nomTournoi = $ligne['nom'];
    $lieu = $ligne['lieu'];
    $discipline = $ligne['discipline'];

    // Création d'un objet Tournoi
    $tournoi1 = new Tournoi($idTournoi, $nomTournoi, $lieu, $discipline);

    // Ajouter l'objet Tournoi à la liste
    array_push($liste_tournois, $tournoi1);
}

$statement = $pdo->prepare("SELECT * from Matchs where idTournoi = :idTournoi;");
$statement->execute(
    [
        'idTournoi' => $_GET['idTournoi']
    ]
);
$matchs = $statement->fetchALL();

?>
<!doctype html>
<html>

<body>
<main id="main_en_cours">
    <section class="tournoi_en_cours_vue">
        <?php
        $id = $tournoi1->getId();
        $nbEquiReq = $pdo->prepare("SELECT count(*) as nb FROM Equipes WHERE idTournoi = :idT");
        $nbEquiReq->execute(
            [
                "idT"=> $id
            ]
        );
        $nbEqui = $nbEquiReq->fetch(PDO::   FETCH_ASSOC);

            unset($idGagnant);
            unset($equipeGagnante);
            unset($equipeGagnanteDem1);
            unset($equipeGagnanteDem2);
            unset($idGagnantMatchDem1);
            unset($idGagnantMatchDem2);
            unset($qualif);
            unset($idGagnantMatch1);
            unset($idGagnantMatch2);
            unset($idGagnantMatch3);
            unset($idGagnantMatch4);
            $id = $tournoi1->getId();
            $nbEquiReq = $pdo->prepare("SELECT count(*) as nb FROM Equipes WHERE idTournoi = :idT");
            $nbEquiReq->execute(
                [
                    "idT" => $id
                ]
            );
            $nbEqui = $nbEquiReq->fetch(PDO::FETCH_ASSOC);

            $nbEquSelecReq = $pdo->prepare("SELECT nbEquipesSelec as nb FROM Tournois WHERE idTournoi = :idT");
                $nbEquSelecReq->execute(
                [
                    "idT"=> $id
                    ]
                );
                $nbEquSelec = $nbEquSelecReq->fetch(PDO::   FETCH_ASSOC);
                $nbEquSelec = $nbEquSelec["nb"];

            $disci = strtolower($tournoi1->getDiscipline());
            if ($disci == "pétanque") {
                $sport = "p";
            } else if ($disci == "tennis") {
                $sport = "t";
            } else if ($disci == "foot") {
                $sport = "f";
            }

            if ($sport == "p") {
                $qualifReq = $pdo->prepare("SELECT * from Equipes e
            where idTournoi = :varTournoi
            order by getPointsPoulePetanque(e.idEquipe,:varTournoi) desc");
                $qualifReq->execute([
                    ":varTournoi" => $id
                ]);
                $qualif = $qualifReq->fetchAll(PDO::FETCH_ASSOC);

            } elseif ($sport == "t") {
                $qualifReq = $pdo->prepare("SELECT * from Equipes e
            where idTournoi = :varTournoi
            order by getPointsPouleTennis(e.idEquipe,:varTournoi)  desc");
                $qualifReq->execute([
                    ":varTournoi" => $id
                ]);
                $qualif = $qualifReq->fetchAll(PDO::FETCH_ASSOC);

            } elseif ($sport == "f") {

                $qualifReq = $pdo->prepare("SELECT * from Equipes e
            where idTournoi = :varTournoi
            order by getPointsPouleFoot(e.idEquipe,:varTournoi) desc");
                $qualifReq->execute([
                    ":varTournoi" => $id
                ]);
                $qualif = $qualifReq->fetchAll(PDO::FETCH_ASSOC);

            } 
            ?>
            <h3> <?php echo $tournoi1->getNom(); ?> </h3>
            <div class="tournoi_en_cours_infos">
                <p> <?php echo $tournoi1->getLieu(); ?> </p>
                <p> <?php echo $tournoi1->getDiscipline(); ?> </p>
            </div>
            <div class="arbre_en_cours">
                <?php
                if ($nbEquSelec >= 8) {
                    include ROOT . "/affichage_tournoi/etage_quart_vue.php";
                }
                if ($nbEquSelec >= 4) {
                    include ROOT . "/affichage_tournoi/etage_demi_vue.php";
                };
                ?>
                <?php
                if ($nbEquSelec >= 4) {
                    if(isset($idGagnantMatch1) && isset($idGagnantMatch2)){
                    if ($sport == "p") {
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,false) as id");
                        $getGagnantReq->execute([
                            ":varEqu1" => $idGagnantMatch1,
                            ":varEqu2" => $idGagnantMatch2,
                            ":varidTournoi" => $id
                        ]);
                        $idGagnant = $getGagnantReq->fetch(PDO::FETCH_ASSOC);
                    } elseif ($sport == "t") {
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,false) as id");
                        $getGagnantReq->execute([
                            ":varEqu1" => $idGagnantMatch1,
                            ":varEqu2" => $idGagnantMatch2,
                            ":varidTournoi" => $id
                        ]);
                        $idGagnant = $getGagnantReq->fetch(PDO::FETCH_ASSOC);
                    } elseif ($sport == "f") {
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,false) as id");
                        $getGagnantReq->execute([
                            ":varEqu1" => $idGagnantMatch1,
                            ":varEqu2" => $idGagnantMatch2,
                            ":varidTournoi" => $id
                        ]);
                        $idGagnant = $getGagnantReq->fetch(PDO::FETCH_ASSOC);
                    } 
                    $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
                    $equipeGagnanteReq->execute([
                        ":varId" => $idGagnant["id"]
                    ]);
                    $equipeGagnanteDem1 = $equipeGagnanteReq->fetch(PDO::FETCH_ASSOC);
                    if($equipeGagnanteDem1){
                        $idGagnantMatchDem1 = $equipeGagnanteDem1["idEquipe"];
                    }else {
                        $idGagnantMatchDem1 = -1;
                    }
                    
                }
            }else{
                $equipeGagnanteDem1 = $qualif[0];
                $idGagnantMatchDem1 = $equipeGagnanteDem1["idEquipe"];
            }
             ?>
                <?php
                if ($nbEquSelec >= 4) {
                    if(isset($idGagnantMatch3) && isset($idGagnantMatch4)){
                    if ($sport == "p") {
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                        $getGagnantReq->execute([
                            ":varEqu1" => $idGagnantMatch3,
                            ":varEqu2" => $idGagnantMatch4,
                            ":varidTournoi" => $id
                        ]);
                        $idGagnant = $getGagnantReq->fetch(PDO::FETCH_ASSOC);
                    } elseif ($sport == "t") {
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                        $getGagnantReq->execute([
                            ":varEqu1" => $idGagnantMatch3,
                            ":varEqu2" => $idGagnantMatch4,
                            ":varidTournoi" => $id
                        ]);
                        $idGagnant = $getGagnantReq->fetch(PDO::FETCH_ASSOC);
                    } elseif ($sport == "f") {
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                        $getGagnantReq->execute([
                            ":varEqu1" => $idGagnantMatch3,
                            ":varEqu2" => $idGagnantMatch4,
                            ":varidTournoi" => $id
                        ]);
                        $idGagnant = $getGagnantReq->fetch(PDO::FETCH_ASSOC);
                    } 

                    $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
                    $equipeGagnanteReq->execute([
                        ":varId" => $idGagnant["id"]
                    ]);
                    $equipeGagnanteDem2 = $equipeGagnanteReq->fetch(PDO::FETCH_ASSOC);
                    if($equipeGagnanteDem2){
                        $idGagnantMatchDem2 = $equipeGagnanteDem2["idEquipe"];
                    }else {
                        $idGagnantMatchDem2 = -1;
                    }
                }
            }else{
                $equipeGagnanteDem2 = $qualif[1];
                $idGagnantMatchDem2 = $equipeGagnanteDem2["idEquipe"];

            }
                ?>
                <div <?php if ($nbEquSelec >= 8) {
                            echo "class=\"icones_etage4\"";
                        } elseif ($nbEquSelec >= 4) {
                            echo "class=\"icones_etage4\"";
                        } else {
                            echo "class=\"icones_etage4_2eq\"";
                        } ?>>
                    <div>
                        <?php
                        if(isset($idGagnantMatchDem1) && isset($idGagnantMatchDem2)){
                        if ($sport == "p") {
                            $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,false) as id");
                            $getGagnantReq->execute([
                                ":varEqu1" => $idGagnantMatchDem1,
                                ":varEqu2" => $idGagnantMatchDem2,
                                ":varidTournoi" => $id
                            ]);
                            $idGagnant = $getGagnantReq->fetch(PDO::FETCH_ASSOC);
                        } elseif ($sport == "t") {
                            $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,false) as id");
                            $getGagnantReq->execute([
                                ":varEqu1" => $idGagnantMatchDem1,
                                ":varEqu2" => $idGagnantMatchDem2,
                                ":varidTournoi" => $id
                            ]);
                            $idGagnant = $getGagnantReq->fetch(PDO::FETCH_ASSOC);
                        } elseif ($sport == "f") {
                            $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,false) as id");
                            $getGagnantReq->execute([
                                ":varEqu1" => $idGagnantMatchDem1,
                                ":varEqu2" => $idGagnantMatchDem2,
                                ":varidTournoi" => $id
                            ]);
                            $idGagnant = $getGagnantReq->fetch(PDO::FETCH_ASSOC);
                        } 
                        $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
                        $equipeGagnanteReq->execute([
                            ":varId" => $idGagnant["id"]
                        ]);
                        $equipeGagnante = $equipeGagnanteReq->fetch(PDO::FETCH_ASSOC);
                    }else{
                        unset($equipeGagnante);
                    }
                    if(isset($equipeGagnante)  && $idGagnant["id"] > 0){
                        ?>
                        <img src="<?php echo $equipeGagnante["icones"] ?>" />
                        <?php }else{
                           echo " ";
                        } ?>
                    </div>
                </div>
                <div <?php if ($nbEquSelec >= 8) {
                            echo "class=\"barres_finale_container\"";
                        } elseif ($nbEquSelec >= 4) {
                            echo "class=\"barres_finale_container_4eq\"";
                        } else {
                            echo "class=\"barres_finale_container_2eq\"";
                        } ?>>
                    <section class="barres_finale"></section>
                </div>
                <div <?php if ($nbEquSelec >= 8) {
                            echo "class=\"icones_etage3\"";
                        } elseif ($nbEquSelec >= 4) {
                            echo "class=\"icones_etage3_4eq\"";
                        } else {
                            echo "class=\"icones_etage3_2eq\"";
                        } ?>>
                    <div>
                    <?php if(isset($idGagnantMatchDem1) && $idGagnantMatchDem1 != -1){ ?>
                        <img src="<?php echo $equipeGagnanteDem1["icones"] ?>" />
                        <?php if ($nbEquSelec >= 2 && $nbEquSelec < 4) {
                            echo "<p>" . $equipeGagnanteDem1["nom"] . "</p>";
                        } ?>
                        <?php }else{
                        echo " ";
                        }?>
                    </div>
                    <?php if ($tournoi1->getDiscipline() == "Pétanque") { ?>
                        <a href="/affichage_tournoi/match_petanque?idMatch=<?php
                        
                        for ($i = 0; $i < count($matchs); $i++) {
                            if($equipeGagnanteDem1 && $equipeGagnanteDem2){
                            if ((($matchs[$i]['idEquipe1'] == $equipeGagnanteDem1['idEquipe'] && $matchs[$i]['idEquipe2'] == $equipeGagnanteDem2['idEquipe'] )|| ($matchs[$i]['idEquipe2'] == $equipeGagnanteDem1['idEquipe'] && $matchs[$i]['idEquipe1'] == $equipeGagnanteDem2['idEquipe'] )) && $matchs[$i]['matchPoule'] == 0) {

                                echo $matchs[$i]['idMatch'];

                            }
                        }else {
                            echo " ";
                        }
                            } ?>" class="bouton_vue_tournoi final_vue">
                            Finale
                        </a>
                    <?php } else if ($tournoi1->getDiscipline() == "Foot") { ?>
                        <a href="/affichage_tournoi/match_foot?idMatch=<?php
                            for ($i = 0; $i < count($matchs); $i++) {
                                if($equipeGagnanteDem1 && $equipeGagnanteDem2){
                                if ((($matchs[$i]['idEquipe1'] == $equipeGagnanteDem1['idEquipe'] && $matchs[$i]['idEquipe2'] == $equipeGagnanteDem2['idEquipe'] )|| ($matchs[$i]['idEquipe2'] == $equipeGagnanteDem1['idEquipe'] && $matchs[$i]['idEquipe1'] == $equipeGagnanteDem2['idEquipe'] )) && $matchs[$i]['matchPoule'] == 0) {

                                    echo $matchs[$i]['idMatch'];

                                }
                            }else {
                                echo " ";
                            }
                            } ?>" class="bouton_vue_tournoi final_vue">
                            Finale
                        </a>
                    <?php } else if ($tournoi1->getDiscipline() == "Tennis") { ?>
                        <a href="/affichage_tournoi/match_tennis?idMatch=<?php
                            for ($i = 0; $i < count($matchs); $i++) {
                                if($equipeGagnanteDem1 && $equipeGagnanteDem2){
                                if ((($matchs[$i]['idEquipe1'] == $equipeGagnanteDem1['idEquipe'] && $matchs[$i]['idEquipe2'] == $equipeGagnanteDem2['idEquipe'] )|| ($matchs[$i]['idEquipe2'] == $equipeGagnanteDem1['idEquipe'] && $matchs[$i]['idEquipe1'] == $equipeGagnanteDem2['idEquipe'] )) && $matchs[$i]['matchPoule'] == 0) {

                                    echo $matchs[$i]['idMatch'];

                                }
                            }else {
                                echo " ";
                            }
                            } ?>" class="bouton_vue_tournoi final_vue">
                            Finale
                        </a>
                    <?php } ?>
                    <div>
                    <?php if(isset($idGagnantMatchDem2) && $idGagnantMatchDem2 != -1){ ?>
                        <img src="<?php echo $equipeGagnanteDem2["icones"] ?>" />
                        <?php if ($nbEquSelec >= 2 && $nbEquSelec < 4) {
                            echo "<p>" . $equipeGagnanteDem2["nom"] . "</p>";
                        } ?>
                        <?php }else{
                        echo " ";
                        }?>
                    </div>
                </div>
            </div>
            <div class="tournois_poules">
                <?php
                $nbRequete = $pdo->prepare("SELECT count(*) as nb FROM Poules where idTournoi = :varId");
                $nbRequete->execute([
                    "varId" => $id
                ]);
                $nbRequete = $nbRequete->fetch(PDO::FETCH_ASSOC);
                $nbPoules = $nbRequete["nb"];

                $poules = $pdo->prepare("SELECT * FROM Poules WHERE idTournoi = :varId");
                $poules->execute([
                    "varId" => $id
                ]);

                for ($i = 0; $i < $nbPoules; $i++) {
                    $poule = $poules->fetch(PDO::FETCH_ASSOC);

                    $equipe1 = $pdo->prepare("SELECT * FROM Equipes where idEquipe = :varId");
                    $equipe1->execute([
                        "varId" => $poule["idEquipe1"]
                    ]);
                    $equipe1 = $equipe1->fetch(PDO::FETCH_ASSOC);

                    $equipe2 = $pdo->prepare("SELECT * FROM Equipes where idEquipe = :varId");
                    $equipe2->execute([
                        "varId" => $poule["idEquipe2"]
                    ]);
                    $equipe2 = $equipe2->fetch(PDO::FETCH_ASSOC);

                    $equipe3 = $pdo->prepare("SELECT * FROM Equipes where idEquipe = :varId");
                    $equipe3->execute([
                        "varId" => $poule["idEquipe3"]
                    ]);
                    $equipe3 = $equipe3->fetch(PDO::FETCH_ASSOC);

                    $equipe4 = $pdo->prepare("SELECT * FROM Equipes where idEquipe = :varId");
                    $equipe4->execute([
                        "varId" => $poule["idEquipe4"]
                    ]);
                    $equipe4 = $equipe4->fetch(PDO::FETCH_ASSOC);

                    $equipe5 = $pdo->prepare("SELECT * FROM Equipes where idEquipe = :varId");
                    $equipe5->execute([
                        "varId" => $poule["idEquipe5"]
                    ]);
                    $equipe5 = $equipe5->fetch(PDO::FETCH_ASSOC);

                    $equipe6 = $pdo->prepare("SELECT * FROM Equipes where idEquipe = :varId");
                    $equipe6->execute([
                        "varId" => $poule["idEquipe6"]
                    ]);
                    $equipe6 = $equipe6->fetch(PDO::FETCH_ASSOC);

                    include ROOT . "/affichage_tournoi/poule.php";
                }
                ?>

            </div>
            <h3 class="conso_titre"> Consolantes </h3>
            <div class="affichage_consolante">
                <?php
                if((count($qualif) - $nbEquSelec) >= 2){

                if ($nbEquSelec >= 8) {
                    $equipesConso = array_slice($qualif, 8);
                } elseif ($nbEquSelec >= 4) {
                    $equipesConso = array_slice($qualif, 4);
                } else {
                    $equipesConso = array_slice($qualif, 2);
                }

                $idEquipesConso = array();

                foreach ($equipesConso as $e) {
                    array_push($idEquipesConso, $e["idEquipe"]);
                }

                $matchsConsoReq = $pdo->prepare("SELECT * FROM Matchs WHERE matchPoule = false AND (idEquipe1 IN (" . implode(',', $idEquipesConso) . ") OR idEquipe2 IN (" . implode(',', $idEquipesConso) . "))");
                $matchsConsoReq->execute();
                $matchsConso = $matchsConsoReq->fetchAll(PDO::FETCH_ASSOC);

                $cptConso = 0;
                foreach ($matchsConso as $m) {
                    $cptConso++;

                    $equipeConso1Req = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
                    $equipeConso1Req->execute([
                        ":varId" => $m["idEquipe1"]
                    ]);
                    $equipeConso1 = $equipeConso1Req->fetch(PDO::FETCH_ASSOC);

                    $equipeConso2Req = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
                    $equipeConso2Req->execute([
                        ":varId" => $m["idEquipe2"]
                    ]);
                    $equipeConso2 = $equipeConso2Req->fetch(PDO::FETCH_ASSOC);

                    

                    if ($sport == "p") {
                        $poinsEquipe1ConsoReq = $pdo->prepare("SELECT getPointsPetanqueHorsPoule(:varIdEqu,:varidT)");
                        $poinsEquipe1ConsoReq->execute([
                            ":varIdEqu"=>$equipeConso1["idEquipe"],
                            ":varidT"=>$id
                        ]);
                        $pointsEquipe1Conso = $poinsEquipe1ConsoReq->fetch(PDO:: FETCH_ASSOC);
                        $pointsEquipe1Conso = reset($pointsEquipe1Conso);

                        $poinsEquipe2ConsoReq = $pdo->prepare("SELECT getPointsPetanqueHorsPoule(:varIdEqu,:varidT)");
                        $poinsEquipe2ConsoReq->execute([
                            ":varIdEqu"=>$equipeConso2["idEquipe"],
                            ":varidT"=>$id
                        ]);
                        $pointsEquipe2Conso = $poinsEquipe2ConsoReq->fetch(PDO:: FETCH_ASSOC);
                        $pointsEquipe2Conso = reset($pointsEquipe2Conso);
                    } elseif ($sport == "t") {
                        $poinsEquipe1ConsoReq = $pdo->prepare("SELECT getPointsTennisHorsPoule(:varIdEqu,:varidT)");
                        $poinsEquipe1ConsoReq->execute([
                            ":varIdEqu"=>$equipeConso1["idEquipe"],
                            ":varidT"=>$id
                        ]);
                        $pointsEquipe1Conso = $poinsEquipe1ConsoReq->fetch(PDO:: FETCH_ASSOC);
                        $pointsEquipe1Conso = reset($pointsEquipe1Conso);

                        $poinsEquipe2ConsoReq = $pdo->prepare("SELECT getPointsTennisHorsPoule(:varIdEqu,:varidT)");
                        $poinsEquipe2ConsoReq->execute([
                            ":varIdEqu"=>$equipeConso2["idEquipe"],
                            ":varidT"=>$id
                        ]);
                        $pointsEquipe2Conso = $poinsEquipe2ConsoReq->fetch(PDO:: FETCH_ASSOC);
                        $pointsEquipe2Conso = reset($pointsEquipe2Conso);
                    } elseif ($sport == "f") {
                        $poinsEquipe1ConsoReq = $pdo->prepare("SELECT getPointsFootHorsPoule(:varIdEqu,:varidT)");
                        $poinsEquipe1ConsoReq->execute([
                            ":varIdEqu"=>$equipeConso1["idEquipe"],
                            ":varidT"=>$id
                        ]);
                        $pointsEquipe1Conso = $poinsEquipe1ConsoReq->fetch(PDO:: FETCH_ASSOC);
                        $pointsEquipe1Conso = reset($pointsEquipe1Conso);

                        $poinsEquipe2ConsoReq = $pdo->prepare("SELECT getPointsFootHorsPoule(:varIdEqu,:varidT)");
                        $poinsEquipe2ConsoReq->execute([
                            ":varIdEqu"=>$equipeConso2["idEquipe"],
                            ":varidT"=>$id
                        ]);
                        $pointsEquipe2Conso = $poinsEquipe2ConsoReq->fetch(PDO:: FETCH_ASSOC);
                        $pointsEquipe2Conso = reset($pointsEquipe2Conso);
                    } else {
                        echo "IL Y A UNE ERREUR";
                    }

                    include ROOT . "/affichage_tournoi/match_conso.php";
                }
            }else{
                    echo "<p class=\"conso_erreur\"> Il n'y a pas assez d'équipes non sélectionnées pour jouer des consolantes</p>";
                }
    

                ?>
        </section>
    </main>
    <?php include ROOT . "/modules/footer.php"; ?>
</body>

</html>