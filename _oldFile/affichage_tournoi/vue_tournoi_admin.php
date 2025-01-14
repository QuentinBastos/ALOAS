<?php

if(!isset($_SESSION['connecté'])){
    $_SESSION['connecté'] = false;
    header('Location: /affichage_tournoi/vue_tournoi?idTournoi='.$_GET['idTournoi'].'');
    exit();
  }




$titre = "vueTournoiAdmin";

include ROOT . "/modules/header.php";

include_once ROOT . "/classes/classe_equipe.php";

include_once ROOT . "/classes/classe_tournoi.php";
include ROOT . '/include/pdo.php' ; 

/* Récupération des informations du tournoi */
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



/* Création d'un objet Tournoi pour chaque ligne de la table */
foreach ($liste_lignes as $ligne) {

    $idTournoi = $ligne['idTournoi'];

    $nomTournoi = $ligne['nom'];

    $lieu = $ligne['lieu'];

    $discipline = $ligne['discipline'];

    if($ligne['tpsMinuteur'] == null){
        $minuteur = false;
        $temps_minuteur = null;
    }else{
        $minuteur = true;
        $temps_minuteur = $ligne['tpsMinuteur'];
    }




    // Création d'un objet Tournoi

    $tournoi1 = new Tournoi($idTournoi, $nomTournoi, $lieu, $discipline);




    // Ajouter l'objet Tournoi à la liste

    array_push($liste_tournois, $tournoi1);

}


/* Récupération des matchs du tournoi */
$statement = $pdo->prepare("SELECT * from Matchs where idTournoi = :idTournoi;");

$statement->execute([
        'idTournoi' => $_GET['idTournoi']
    ]);

$matchs = $statement->fetchALL();

?>
<!doctype html>

<html>



<body>

<script type="text/javascript" src="../js/code.js"> </script>

<main id="main_en_cours">
 
    <!-- Suppression du tournoi -->
    <div id="supprimerTournoi">
       <img src="/img/cross.svg" id="croix_suppr" onclick="openDialog()"> 
    </div>

    <dialog id="popSupprTournoi" >
        Voulez-vous vraiment supprimer ce tournoi ?
        <form action="/formulaires/supprimer_tournoi?idTournoi=<?php echo $idTournoi ?>" method="post">
            
            <input type="submit" class="bouton_orga_suppr btnSupprTournoi" value="Supprimer">
        </form>

        <button class="bouton_orga_suppr btnSupprTournoi"  onclick="closeDialog()" >Fermer</button>
    </dialog>
    
    <section class="tournoi_en_cours_vueadmin">

        <?php

        $id = $tournoi1->getId();
         /* Récupération du nombre d'équipes */
         $nbEquiReq = $pdo->prepare("SELECT count(*) as nb FROM Equipes WHERE idTournoi = :idT");

         $nbEquiReq->execute(
 
             [
 
                 "idT"=> $id
 
             ]
 
         );
 
         $nbEqui = $nbEquiReq->fetch(PDO::   FETCH_ASSOC);
 
        /* Récupération du nombre d'équipes sélectionnées */
        $nbEquSelecReq = $pdo->prepare("SELECT nbEquipesSelec as nb FROM Tournois WHERE idTournoi = :idT");
                $nbEquSelecReq->execute(
                [
                    "idT"=> $id
                    ]
                );
                $nbEquSelec = $nbEquSelecReq->fetch(PDO::   FETCH_ASSOC);
                $nbEquSelec = $nbEquSelec["nb"];



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

            /* Récupération du nombre d'équipes */
            $nbEquiReq = $pdo->prepare("SELECT count(*) as nb FROM Equipes WHERE idTournoi = :idT");

            $nbEquiReq->execute(

                [

                    "idT" => $id

                ]

            );

            $nbEqui = $nbEquiReq->fetch(PDO::FETCH_ASSOC);

            $disci = strtolower($tournoi1->getDiscipline());

            if ($disci == "pétanque") {
                $sport = "p";

            /* Récupération des équipes qualifiées */
            $qualifReq = $pdo->prepare("SELECT * from Equipes e
            where idTournoi = :varTournoi
            order by getPointsPoulePetanque(e.idEquipe,:varTournoi) desc");
                $qualifReq->execute([
                    ":varTournoi" => $id
                ]);
            } else if ($disci == "tennis") {

            /* Récupération des équipes qualifiées */
            $qualifReq = $pdo->prepare("SELECT * from Equipes e
            where idTournoi = :varTournoi
            order by getPointsPouleTennis(e.idEquipe,:varTournoi) desc");
                $qualifReq->execute([
                    ":varTournoi" => $id
                ]);
                $sport = "t";
            } else if ($disci == "foot") {
            /* Récupération des équipes qualifiées */

            $qualifReq = $pdo->prepare("SELECT * from Equipes e
            where idTournoi = :varTournoi
            order by getPointsPouleFoot(e.idEquipe,:varTournoi) desc");
                $qualifReq->execute([
                    ":varTournoi" => $id
                ]);
                $sport = "f";
            }
                $qualif = $qualifReq->fetchAll(PDO::FETCH_ASSOC);

            ?>

            <!-- Affichage des informations du tournoi -->
            <h3> <?php echo $tournoi1->getNom(); ?> </h3>

            <div class="tournoi_en_cours_infos">

                <p> <?php echo $tournoi1->getLieu(); ?> </p>

                <p> <?php echo $tournoi1->getDiscipline(); ?> </p>

            </div>


            <div class="arbre_en_cours">
                <!-- Affichage de l'arbre du tournoi -->

                <?php

                if ($nbEquSelec >= 8) {

                    include ROOT . "/affichage_tournoi/etage_quart_vue_admin.php";

                }

                if ($nbEquSelec >= 4) {

                    include ROOT . "/affichage_tournoi/etage_demi_vue_admin.php";

                };

                ?>

                <?php


                if ($nbEquSelec >= 4) {
                    if(isset($idGagnantMatch1) && isset($idGagnantMatch2)){

                    if ($sport == "p") {

                        /* Récupération de l'équipe gagnante */
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,false) as id");

                        $getGagnantReq->execute([

                            ":varEqu1" => $idGagnantMatch1,

                            ":varEqu2" => $idGagnantMatch2,

                            ":varidTournoi" => $id

                        ]);

                        $idGagnant = $getGagnantReq->fetch(PDO::FETCH_ASSOC);

                    } elseif ($sport == "t") {

                        /* Récupération de l'équipe gagnante */
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,false) as id");

                        $getGagnantReq->execute([

                            ":varEqu1" => $idGagnantMatch1,

                            ":varEqu2" => $idGagnantMatch2,

                            ":varidTournoi" => $id

                        ]);

                        $idGagnant = $getGagnantReq->fetch(PDO::FETCH_ASSOC);

                    } elseif ($sport == "f") {

                        /* Récupération de l'équipe gagnante */
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,false) as id");

                        $getGagnantReq->execute([

                            ":varEqu1" => $idGagnantMatch1,

                            ":varEqu2" => $idGagnantMatch2,

                            ":varidTournoi" => $id

                        ]);

                        $idGagnant = $getGagnantReq->fetch(PDO::FETCH_ASSOC);

                    } else {

                        echo "Il Y A UNE ERREUR";

                    }


                    /* Recupération des informations de l'équipe gagnante */
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

                        /* Récupération de l'équipe gagnante */
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,0) as id");

                        $getGagnantReq->execute([

                            ":varEqu1" => $idGagnantMatch3,

                            ":varEqu2" => $idGagnantMatch4,

                            ":varidTournoi" => $id

                        ]);

                        $idGagnant = $getGagnantReq->fetch(PDO::FETCH_ASSOC);

                    } elseif ($sport == "t") {

                        /* Récupération de l'équipe gagnante */
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,0) as id");

                        $getGagnantReq->execute([

                            ":varEqu1" => $idGagnantMatch3,

                            ":varEqu2" => $idGagnantMatch4,

                            ":varidTournoi" => $id

                        ]);

                        $idGagnant = $getGagnantReq->fetch(PDO::FETCH_ASSOC);

                    } elseif ($sport == "f") {

                        /* Récupération de l'équipe gagnante */
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,0) as id");

                        $getGagnantReq->execute([

                            ":varEqu1" => $idGagnantMatch3,

                            ":varEqu2" => $idGagnantMatch4,

                            ":varidTournoi" => $id

                        ]);

                        $idGagnant = $getGagnantReq->fetch(PDO::FETCH_ASSOC);

                    } else {

                        echo "IL Y A UNE ERREUR";

                    }




                    /* Récupération des informations l'équipe gagnante */
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
                        /* Affichage des étages en fonction du nombre d'équipes séléctionées */
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

                            /* Récupération de l'équipe gagnante */
                            $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,false) as id");

                            $getGagnantReq->execute([

                                ":varEqu1" => $idGagnantMatchDem1,

                                ":varEqu2" => $idGagnantMatchDem2,

                                ":varidTournoi" => $id

                            ]);

                            $idGagnant = $getGagnantReq->fetch(PDO::FETCH_ASSOC);

                        } elseif ($sport == "t") {

                            /* Récupération de l'équipe gagnante */
                            $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,false) as id");

                            $getGagnantReq->execute([

                                ":varEqu1" => $idGagnantMatchDem1,

                                ":varEqu2" => $idGagnantMatchDem2,

                                ":varidTournoi" => $id

                            ]);

                            $idGagnant = $getGagnantReq->fetch(PDO::FETCH_ASSOC);

                        } elseif ($sport == "f") {

                            /* Récupération de l'équipe gagnante */
                            $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,false) as id");

                            $getGagnantReq->execute([

                                ":varEqu1" => $idGagnantMatchDem1,

                                ":varEqu2" => $idGagnantMatchDem2,

                                ":varidTournoi" => $id

                            ]);

                            $idGagnant = $getGagnantReq->fetch(PDO::FETCH_ASSOC);

                        } else {

                            echo "IL Y A UNE ERREUR";

                        }

                        /* Récupération des informations de l'équipe gagnante */
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

                    echo "class=\"barres_finale_container_vueadmin\"";

                    } elseif ($nbEquSelec >= 4) {

                    echo "class=\"barres_finale_container_4eq_vueadmin\"";

                    } else {

                    echo "class=\"barres_finale_container_2eq_vueadmin\"";

                    } ?>>

                    <section class="barres_finale_vueadmin"></section>

                    </div>

                    <div <?php if ($nbEquSelec >= 8) {

                    echo "class=\"icones_etage3\"";

                    } elseif ($nbEquSelec >= 4) {

                    echo "class=\"icones_etage3_4eq\"";

                    } else {

                    echo "class=\"icones_etage3_2eq\"";

                    } ?>>

                    <div>


                    <?php if(isset($idGagnantMatchDem1)&& $idGagnantMatchDem1 != -1){ ?>
                        <img src="<?php echo $equipeGagnanteDem1["icones"] ?>" />
                        <?php if ($nbEquSelec >= 2 && $nbEquSelec < 4) {
                            echo "<p>" . $equipeGagnanteDem1["nom"] . "</p>";
                        } ?>
                        <?php }else{
                        echo " ";
                        }?>

                    </div>
                    <?php
                    
                    if ($tournoi1->getDiscipline() == "Pétanque") { ?>

                        <section class="section_minuteur_vuematch">

                            <a href="/formulaires/saisie_points_petanque?idMatch=<?php

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

                            <!-- Lancement du minuteur -->
                            <?php if($minuteur){ ?>
                                <button onclick="debutMinuteur(<?php  echo $temps_minuteur; ?>, '<?php echo $equipeGagnanteDem1['nom'] ?>', '<?php echo $equipeGagnanteDem2['nom'] ?>','timer')" class="boutonTimer">

                            Lancer le minuteur

                            </button>

                            <div id="timer"></div>
                            
                            <?php } ?>
                        </section>

                        <?php }else if ($tournoi1->getDiscipline() == "Foot"){ ?>

                            <section class="section_minuteur_vuematch">
                            <!-- Lien vers la page de saisie des points -->
                            <a href="/formulaires/saisie_points_foot?idMatch=<?php

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


                            <!-- Lancement du minuteur -->
                            <?php if($minuteur){ ?>
                                <button onclick="debutMinuteur(<?php  echo $temps_minuteur; ?>, '<?php echo $equipeGagnanteDem1['nom'] ?>', '<?php echo $equipeGagnanteDem2['nom'] ?>','timer')" class="boutonTimer">

                            Lancer le minuteur

                            </button>
                            <div id="timer"></div>
                            <?php } ?>

                        </section>

                    <?php }else if ($tournoi1->getDiscipline() == "Tennis"){ ?>

                        <section class="section_minuteur_vuematch">
                            <!-- Lien vers la page de saisie des points -->
                            <a href="/formulaires/saisie_points_tennis?idMatch=<?php

                                for ($i = 0; $i < count($matchs); $i++) {

                                    for ($i = 0; $i < count($matchs); $i++) {
                                        if($equipeGagnanteDem1 && $equipeGagnanteDem2){
                                            if ((($matchs[$i]['idEquipe1'] == $equipeGagnanteDem1['idEquipe'] && $matchs[$i]['idEquipe2'] == $equipeGagnanteDem2['idEquipe'] )|| ($matchs[$i]['idEquipe2'] == $equipeGagnanteDem1['idEquipe'] && $matchs[$i]['idEquipe1'] == $equipeGagnanteDem2['idEquipe'] )) && $matchs[$i]['matchPoule'] == 0) {
        
                                                echo $matchs[$i]['idMatch'];
        
                                            }
                                        }else {
                                            echo " ";
                                        }
                                    }

                                } ?>" class="bouton_vue_tournoi final_vue">

                                Finale
                            </a>
                            <!-- Lancement du minuteur -->
                            <?php if($minuteur){ ?>
                            <button onclick="debutMinuteur(<?php  echo $temps_minuteur; ?>, '<?php echo $equipeGagnanteDem1['nom'] ?>', '<?php echo $equipeGagnanteDem2['nom'] ?>','timer')" class="boutonTimer">

                            Lancer le minuteur

                            </button>
                            <?php } ?>
                            <div id="timer"></div>
                        </section>

                    <?php } ?>

                    <div>
                    <?php if(isset($idGagnantMatchDem2)&& $idGagnantMatchDem2 != -1){ ?>
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
                /* Récupération du nombre de  poules */
                $nbRequete = $pdo->prepare("SELECT count(*) as nb FROM Poules where idTournoi = :varId");

                $nbRequete->execute([

                    "varId" => $id

                ]);

                $nbRequete = $nbRequete->fetch(PDO::FETCH_ASSOC);

                $nbPoules = $nbRequete["nb"];


                /* Récupération des informations des poules */
                $poules = $pdo->prepare("SELECT * FROM Poules WHERE idTournoi = :varId");

                $poules->execute([

                    "varId" => $id

                ]);



                for ($i = 0; $i < $nbPoules; $i++) {

                    $poule = $poules->fetch(PDO::FETCH_ASSOC);



                    /* Récupération des informations des équipes */
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
                <!-- Affichage des matchs de consolante -->
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



                /* Récupération des matchs de consolante */
                $matchsConsoReq = $pdo->prepare("SELECT * FROM Matchs WHERE matchPoule = false AND (idEquipe1 IN (" . implode(',', $idEquipesConso) . ") OR idEquipe2 IN (" . implode(',', $idEquipesConso) . "))");

                $matchsConsoReq->execute();

                $matchsConso = $matchsConsoReq->fetchAll(PDO::FETCH_ASSOC);



                $cptConso = 0;

                foreach ($matchsConso as $m) {

                    $cptConso++;

                    /* Récupération des informations des équipes */
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
                    ?>

                    <div class="vueadmin_conso_container">
                        <?php

                    

                    if ($sport == "p") {
                        /* Récupération des points des équipes */
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

                        ?>
                        

                        <section class="section_minuteur_vuematch">
                            <!-- Lien vers la page de saisie des points -->
                            <a href="/formulaires/saisie_points_petanque?idMatch=<?php

                                for ($i = 0; $i < count($matchs); $i++) {

                                    if ($matchs[$i]['idEquipe1'] == $equipeConso1['idEquipe'] && $matchs[$i]['idEquipe2'] == $equipeConso2["idEquipe"] && $matchs[$i]['matchPoule'] == 0) {

                                        echo $matchs[$i]['idMatch'];

                                    }

                                } ?>" class="bouton_vue_tournoi final_vue">

                                Saisir les points

                            </a>


                            <!-- Lancement du minuteur -->
                            
                            <?php if($minuteur){ ?>
                            <button onclick="debutMinuteur(<?php  echo $temps_minuteur; ?>, '<?php echo $equipeConso1['nom'] ?>', '<?php echo $equipeConso2['nom'] ?>','timer<?php echo $cptConso ?>')" class="boutonTimer">

                            Lancer le minuteur
                            
                            </button>
                            <div id="timer<?php echo $cptConso ?>"></div>
                            <?php } ?>
                        </section>

                            <?php

                    } elseif ($sport == "t") {
                        /* Récupération des points des équipes */
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

                        ?>

                        <section class="section_minuteur_vuematch">
                            <!-- Lien vers la page de saisie des points -->
                            <a href="/formulaires/saisie_points_tennis?idMatch=<?php

                                for ($i = 0; $i < count($matchs); $i++) {

                                    if ($matchs[$i]['idEquipe1'] == $equipeConso1['idEquipe'] && $matchs[$i]['idEquipe2'] == $equipeConso2["idEquipe"] && $matchs[$i]['matchPoule'] == 0) {

                                        echo $matchs[$i]['idMatch'];

                                    }

                                } ?>" class="bouton_vue_tournoi final_vue">

                                Saisir les points

                                </a>

                            <!-- Lancement du minuteur -->
                            <?php if($minuteur){ ?>
                            <button onclick="debutMinuteur(<?php  echo $temps_minuteur; ?>, '<?php echo $equipeConso1['nom'] ?>', '<?php echo $equipeConso2['nom'] ?>','timer<?php echo $cptConso ?>')" class="boutonTimer">

                            Lancer le minuteur
                            
                            </button>
                            <div id="timer<?php echo $cptConso ?>"></div>
                            <?php } ?>
                        </section>

                            <?php



                    } elseif ($sport == "f") {
                        /* Récupération des points des équipes */
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
                        include ROOT . "/affichage_tournoi/match_conso.php";
                        
                        ?>

                        
                        

                        <section class="section_minuteur_vuematch quart_section_minuteur">
                            <!-- Lien vers la page de saisie des points -->
                            <a href="/formulaires/saisie_points_foot?idMatch=<?php

                            for ($i = 0; $i < count($matchs); $i++) {

                                if ($matchs[$i]['idEquipe1'] == $equipeConso1['idEquipe'] && $matchs[$i]['idEquipe2'] == $equipeConso2["idEquipe"] && $matchs[$i]['matchPoule'] == 0) {

                                    echo $matchs[$i]['idMatch'];

                                }

                            } ?>" class="bouton_vue_tournoi final_vue">

                            Saisir les points

                            </a>

                            <!-- Lancement du minuteur -->
                            <?php if($minuteur){ ?>
                            <button onclick="debutMinuteur(<?php  echo $temps_minuteur; ?>, '<?php echo $equipeConso1['nom'] ?>', '<?php echo $equipeConso2['nom'] ?>','timer<?php echo $cptConso ?>')" class="boutonTimer">

                            Lancer le minuteur
                            
                            </button>
                            <div id="timer<?php echo $cptConso ?>"></div>
                            <?php } ?>
                        </section>

                            <?php

                    } else {

                        echo "IL Y A UNE ERREUR";

                    }

                    

                     ?>
                     </div>
                    </div>
                    <?php

                    

                }
            }else{
                echo "<p class=\"conso_erreur\"> Il n'y a pas assez d'équipes non sélectionnées pour jouer des consolantes</p>";
            }

                ?>
                

        </section>
        
        
        
        

    </main>

</body>


<?php include ROOT . '/modules/footer.php' ?>
</html>
