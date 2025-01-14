<?php
$titre = "Tournois en cours";
include ROOT . "/modules/header.php"; 
include_once ROOT . "/classes/classe_equipe.php";
include_once ROOT . "/classes/classe_tournoi.php";
include ROOT . '/include/pdo.php' ; 

/* Page similaire à tournoi finis mais pour les 3 derniers tournois */

$resultat =  $pdo->prepare("SELECT * FROM Tournois ORDER BY idTournoi DESC LIMIT 3");
$resultat->execute();

$ligne = $resultat->fetch(PDO::FETCH_ASSOC);
$tournoi1 = new Tournoi($ligne["idTournoi"],$ligne["nom"],$ligne["lieu"],$ligne["discipline"]);

$ligne = $resultat->fetch(PDO::FETCH_ASSOC);
$tournoi2 = new Tournoi($ligne["idTournoi"],$ligne["nom"],$ligne["lieu"],$ligne["discipline"]);

$ligne = $resultat->fetch(PDO::FETCH_ASSOC);
$tournoi3 = new Tournoi($ligne["idTournoi"],$ligne["nom"],$ligne["lieu"],$ligne["discipline"]);
?>
<!doctype html>
<html>
<body>

<main id="main_en_cours">
<section class="affichage_tournoi_arbre_poule">
        <?php
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

                $nbEquSelecReq = $pdo->prepare("SELECT nbEquipesSelec as nb FROM Tournois WHERE idTournoi = :idT");
                $nbEquSelecReq->execute(
                [
                    "idT"=> $id
                    ]
                );
                $nbEquSelec = $nbEquSelecReq->fetch(PDO::   FETCH_ASSOC);
                $nbEquSelec = $nbEquSelec["nb"];



       
                if($sport == "p"){
                    $qualifReq = $pdo->prepare("SELECT * from Equipes e
                where idTournoi = :varTournoi
                order by getPointsPoulePetanque(e.idEquipe,:varTournoi) desc");
                $qualifReq->execute([
                    ":varTournoi"=>$id
                ]);
                $qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);
        
        
                }elseif($sport == "t"){
                    $qualifReq = $pdo->prepare("SELECT * from Equipes e
                where idTournoi = :varTournoi
                order by getPointsPouleTennis(e.idEquipe,:varTournoi) desc");
                $qualifReq->execute([
                    ":varTournoi"=>$id
                ]);
                $qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);
        
        
                }elseif($sport == "f"){
        
                    $qualifReq = $pdo->prepare("SELECT * from Equipes e
                where idTournoi = :varTournoi
                order by getPointsPouleFoot(e.idEquipe,:varTournoi) desc");
                $qualifReq->execute([
                    ":varTournoi"=>$id
                ]);
                $qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);
        
            }
            ?>
        <h3> <?php echo $tournoi1->getNom(); ?> </h3>
        <div class="tournoi_en_cours_infos">
            <p> <?php echo $tournoi1->getLieu(); ?> </p>
            <p> <?php echo $tournoi1->getDiscipline(); ?> </p>
        </div>
        <div class="arbre_en_cours">
            <?php 
            if ($nbEquSelec >= 8){ include ROOT . "/affichage_tournoi/etage_quart.php";}
            if ($nbEquSelec >= 4){ include ROOT . "/affichage_tournoi/etage_demi.php";};
            ?>
            <?php 
             
                if($nbEquSelec >= 4){
                    if(isset($idGagnantMatch1) && isset($idGagnantMatch2)){
                    if($sport == "p"){
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatch1,
                    ":varEqu2"=> $idGagnantMatch2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                    }elseif($sport == "t"){
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatch1,
                    ":varEqu2"=> $idGagnantMatch2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                    }elseif($sport == "f"){
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatch1,
                    ":varEqu2"=> $idGagnantMatch2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                    }
                
                $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
                $equipeGagnanteReq->execute([
                    ":varId"=>$idGagnant["id"]
                ]);
                $equipeGagnanteDem1 = $equipeGagnanteReq->fetch(PDO :: FETCH_ASSOC);
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
             
                if($nbEquSelec >= 4){
                    if(isset($idGagnantMatch3) && isset($idGagnantMatch4)){
                    if($sport == "p"){
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatch3,
                    ":varEqu2"=> $idGagnantMatch4,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                    }elseif($sport == "t"){
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatch3,
                    ":varEqu2"=> $idGagnantMatch4,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                    }elseif($sport == "f"){
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatch3,
                    ":varEqu2"=> $idGagnantMatch4,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                    }
                
                $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
                $equipeGagnanteReq->execute([
                    ":varId"=>$idGagnant["id"]
                ]);
                $equipeGagnanteDem2 = $equipeGagnanteReq->fetch(PDO :: FETCH_ASSOC);
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
            <div <?php if($nbEquSelec >= 8){echo "class=\"icones_etage4\"";}elseif($nbEquSelec >= 4){echo "class=\"icones_etage4\"";}else{echo "class=\"icones_etage4_2eq\"";}?>>
                <div>
                <?php
                if(isset($idGagnantMatchDem1) && isset($idGagnantMatchDem2)){
                if($sport == "p"){
                    $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,false) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatchDem1,
                    ":varEqu2"=> $idGagnantMatchDem2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                }elseif($sport == "t"){
                    $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,false) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatchDem1,
                    ":varEqu2"=> $idGagnantMatchDem2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                }elseif($sport == "f"){
                    $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,false) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatchDem1,
                    ":varEqu2"=> $idGagnantMatchDem2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);
                }
                
                $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
                $equipeGagnanteReq->execute([
                    ":varId"=>$idGagnant["id"]
                ]);
                $equipeGagnante = $equipeGagnanteReq->fetch(PDO :: FETCH_ASSOC);
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
            <div <?php if($nbEquSelec >= 8){echo "class=\"barres_finale_container\"";}elseif($nbEquSelec >= 4){echo "class=\"barres_finale_container_4eq\"";}else{echo "class=\"barres_finale_container_2eq\"";}?>>
                <section class="barres_finale"></section>
            </div>
            <div <?php if($nbEquSelec >= 8){echo "class=\"icones_etage3\"";}elseif($nbEquSelec >= 4){echo "class=\"icones_etage3_4eq\"";}else{echo "class=\"icones_etage3_2eq\"";}?>>
                <div>
                    <?php 
                    if(isset($idGagnantMatchDem1)&& $idGagnantMatchDem1 != -1){ ?>
                    <img src="<?php echo $equipeGagnanteDem1["icones"] ?>" />
                    <?php }else{
                        echo " ";
                        }?>
                </div>
                
                <div>
                <?php if(isset($idGagnantMatchDem2)&& $idGagnantMatchDem2 != -1){ ?>
                    <img src="<?php echo $equipeGagnanteDem2["icones"] ?>" />
                    <?php }else{
                        echo " ";
                        }?>
                </div>
            </div>
        </div>
        <div class="tournois_poules">
            <?php 

if($sport == "p"){
    $qualifReq = $pdo->prepare("SELECT * from Equipes e
where idTournoi = :varTournoi
order by getPointsPetanque(e.idEquipe,:varTournoi) desc");
$qualifReq->execute([
    ":varTournoi"=>$id
]);
$qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);
}elseif($sport == "t"){
    $qualifReq = $pdo->prepare("SELECT * from Equipes e
where idTournoi = :varTournoi
order by getPointsTennis(e.idEquipe,:varTournoi) desc");
$qualifReq->execute([
    ":varTournoi"=>$id
]);
$qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);
}elseif($sport == "f"){

    $qualifReq = $pdo->prepare("SELECT * from Equipes e
where idTournoi = :varTournoi
order by getPointsFoot(e.idEquipe,:varTournoi) desc");
$qualifReq->execute([
    ":varTournoi"=>$id
]);
$qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);

} 
            $nbRequete = $pdo->prepare("SELECT count(*) as nb FROM Poules where idTournoi = :varId");
            $nbRequete->execute([
                "varId"=>$id
            ]);
            $nbRequete = $nbRequete->fetch(PDO::   FETCH_ASSOC);
            $nbPoules = $nbRequete["nb"];

            $poules = $pdo->prepare("SELECT * FROM Poules WHERE idTournoi = :varId");
            $poules->execute([
                "varId"=>$id
            ]);

            for ($i = 0; $i<$nbPoules; $i++){
                $poule = $poules->fetch(PDO::   FETCH_ASSOC);

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
                $idTournoi = $id;
                include ROOT . "/affichage_tournoi/poule.php";
            }
            ?>
        
        </div>
        <?php 
        if($_SESSION['connecté'] == true){
            echo "<a class=\"bouton_voir_tournoi\" href=\"vue_tournoi_admin?idTournoi=".$tournoi1->getId()."\">Gérer le tournoi</a>";
        }else {
            echo "<a class=\"bouton_voir_tournoi\" href=\"vue_tournoi?idTournoi=".$tournoi1->getId()."\">Voir le tournoi</a>";
        }
        
        ?>
        </section>

        <section class="affichage_tournoi_arbre_poule">
        <?php
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
            $id = $tournoi2->getId();
            $nbEquiReq = $pdo->prepare("SELECT count(*) as nb FROM Equipes WHERE idTournoi = :idT");
            $nbEquiReq->execute(
                [
                    "idT"=> $id
                    ]
                );
                $nbEqui = $nbEquiReq->fetch(PDO::   FETCH_ASSOC);
                $disci = strtolower($tournoi2->getDiscipline());
                if($disci == "pétanque"){
                    $sport = "p";
                }else if ($disci == "tennis"){
                    $sport = "t";
                }else if ($disci == "foot"){
                    $sport = "f";
                }

                $nbEquSelecReq = $pdo->prepare("SELECT nbEquipesSelec as nb FROM Tournois WHERE idTournoi = :idT");
                $nbEquSelecReq->execute(
                [
                    "idT"=> $id
                    ]
                );
                $nbEquSelec = $nbEquSelecReq->fetch(PDO::   FETCH_ASSOC);
                $nbEquSelec = $nbEquSelec["nb"];

                

                if($sport == "p"){
                    $qualifReq = $pdo->prepare("SELECT * from Equipes e
                where idTournoi = :varTournoi
                order by getPointsPoulePetanque(e.idEquipe,:varTournoi) desc");
                $qualifReq->execute([
                    ":varTournoi"=>$id
                ]);
                $qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);
        
        
                }elseif($sport == "t"){
                    $qualifReq = $pdo->prepare("SELECT * from Equipes e
                where idTournoi = :varTournoi
                order by getPointsPouleTennis(e.idEquipe,:varTournoi) desc");
                $qualifReq->execute([
                    ":varTournoi"=>$id
                ]);
                $qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);
        
        
                }elseif($sport == "f"){
        
                    $qualifReq = $pdo->prepare("SELECT * from Equipes e
                where idTournoi = :varTournoi
                order by getPointsPouleFoot(e.idEquipe,:varTournoi) desc");
                $qualifReq->execute([
                    ":varTournoi"=>$id
                ]);
                $qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);
        
            }
            
            
            
            ?>
        <h3> <?php echo $tournoi2->getNom(); ?> </h3>
        <div class="tournoi_en_cours_infos">
            <p> <?php echo $tournoi2->getLieu(); ?> </p>
            <p> <?php echo $tournoi2->getDiscipline(); ?> </p>
        </div>
        <div class="arbre_en_cours">
            <?php 
            if ($nbEquSelec >= 8){ include ROOT . "/affichage_tournoi/etage_quart.php";}
            if ($nbEquSelec >= 4){ include ROOT . "/affichage_tournoi/etage_demi.php";};
            ?>
            <?php 
             
                if($nbEquSelec >= 4){
                    if(isset($idGagnantMatch1) && isset($idGagnantMatch2)){
                    if($sport == "p"){
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatch1,
                    ":varEqu2"=> $idGagnantMatch2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                    }elseif($sport == "t"){
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatch1,
                    ":varEqu2"=> $idGagnantMatch2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                    }elseif($sport == "f"){
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatch1,
                    ":varEqu2"=> $idGagnantMatch2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                    }
                
                $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
                $equipeGagnanteReq->execute([
                    ":varId"=>$idGagnant["id"]
                ]);
                $equipeGagnanteDem1 = $equipeGagnanteReq->fetch(PDO :: FETCH_ASSOC);
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
             
                if($nbEquSelec >= 4){
                    if(isset($idGagnantMatch3) && isset($idGagnantMatch4)){
                    if($sport == "p"){
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatch3,
                    ":varEqu2"=> $idGagnantMatch4,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                    }elseif($sport == "t"){
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatch3,
                    ":varEqu2"=> $idGagnantMatch4,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                    }elseif($sport == "f"){
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatch3,
                    ":varEqu2"=> $idGagnantMatch4,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                    }
                
                $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
                $equipeGagnanteReq->execute([
                    ":varId"=>$idGagnant["id"]
                ]);
                $equipeGagnanteDem2 = $equipeGagnanteReq->fetch(PDO :: FETCH_ASSOC);
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
            <div <?php if($nbEquSelec >= 8){echo "class=\"icones_etage4\"";}elseif($nbEquSelec >= 4){echo "class=\"icones_etage4\"";}else{echo "class=\"icones_etage4_2eq\"";}?>>
                <div>
                <?php
                if(isset($idGagnantMatchDem1) && isset($idGagnantMatchDem2)){
                if($sport == "p"){
                    $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,false) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatchDem1,
                    ":varEqu2"=> $idGagnantMatchDem2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                }elseif($sport == "t"){
                    $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,false) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatchDem1,
                    ":varEqu2"=> $idGagnantMatchDem2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                }elseif($sport == "f"){
                    $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,false) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatchDem1,
                    ":varEqu2"=> $idGagnantMatchDem2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                }
                
                $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
                $equipeGagnanteReq->execute([
                    ":varId"=>$idGagnant["id"]
                ]);
                $equipeGagnante = $equipeGagnanteReq->fetch(PDO :: FETCH_ASSOC);
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
            <div <?php if($nbEquSelec >= 8){echo "class=\"barres_finale_container\"";}elseif($nbEquSelec >= 4){echo "class=\"barres_finale_container_4eq\"";}else{echo "class=\"barres_finale_container_2eq\"";}?>>
                <section class="barres_finale"></section>
            </div>
            <div <?php if($nbEquSelec >= 8){echo "class=\"icones_etage3\"";}elseif($nbEquSelec >= 4){echo "class=\"icones_etage3_4eq\"";}else{echo "class=\"icones_etage3_2eq\"";}?>>
                <div>
                    <?php 
                    if(isset($idGagnantMatchDem1)&& $idGagnantMatchDem1 != -1){ ?>
                    <img src="<?php echo $equipeGagnanteDem1["icones"] ?>" />
                    <?php }else{
                        echo " ";
                        }?>
                </div>
                
                <div>
                <?php if(isset($idGagnantMatchDem2)&& $idGagnantMatchDem2 != -1){ ?>
                    <img src="<?php echo $equipeGagnanteDem2["icones"] ?>" />
                    <?php }else{
                        echo " ";
                        }?>
                </div>
            </div>
        </div>
        <div class="tournois_poules">
            <?php 

if($sport == "p"){
    $qualifReq = $pdo->prepare("SELECT * from Equipes e
where idTournoi = :varTournoi
order by getPointsPetanque(e.idEquipe,:varTournoi) desc");
$qualifReq->execute([
    ":varTournoi"=>$id
]);
$qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);
}elseif($sport == "t"){
    $qualifReq = $pdo->prepare("SELECT * from Equipes e
where idTournoi = :varTournoi
order by getPointsTennis(e.idEquipe,:varTournoi) desc");
$qualifReq->execute([
    ":varTournoi"=>$id
]);
$qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);
}elseif($sport == "f"){

    $qualifReq = $pdo->prepare("SELECT * from Equipes e
where idTournoi = :varTournoi
order by getPointsFoot(e.idEquipe,:varTournoi) desc");
$qualifReq->execute([
    ":varTournoi"=>$id
]);
$qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);

} 
            $nbRequete = $pdo->prepare("SELECT count(*) as nb FROM Poules where idTournoi = :varId");
            $nbRequete->execute([
                "varId"=>$id
            ]);
            $nbRequete = $nbRequete->fetch(PDO::   FETCH_ASSOC);
            $nbPoules = $nbRequete["nb"];

            $poules = $pdo->prepare("SELECT * FROM Poules WHERE idTournoi = :varId");
            $poules->execute([
                "varId"=>$id
            ]);

            for ($i = 0; $i<$nbPoules; $i++){
                $poule = $poules->fetch(PDO::   FETCH_ASSOC);

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
                $idTournoi = $id;
                include ROOT . "/affichage_tournoi/poule.php";
            }
            ?>
        
        </div>
        <?php 
        if($_SESSION['connecté'] == true){
            echo "<a class=\"bouton_voir_tournoi\" href=\"vue_tournoi_admin?idTournoi=".$tournoi2->getId()."\">Gérer le tournoi</a>";
        }else {
            echo "<a class=\"bouton_voir_tournoi\" href=\"vue_tournoi?idTournoi=".$tournoi2->getId()."\">Voir le tournoi</a>";
        }
        
        ?>
        </section>

        <section class="affichage_tournoi_arbre_poule">
        <?php
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
            $id = $tournoi3->getId();
            $nbEquiReq = $pdo->prepare("SELECT count(*) as nb FROM Equipes WHERE idTournoi = :idT");
            $nbEquiReq->execute(
                [
                    "idT"=> $id
                    ]
                );
                $nbEqui = $nbEquiReq->fetch(PDO::   FETCH_ASSOC);
                $disci = strtolower($tournoi3->getDiscipline());
                if($disci == "pétanque"){
                    $sport = "p";
                }else if ($disci == "tennis"){
                    $sport = "t";
                }else if ($disci == "foot"){
                    $sport = "f";
                }

                $nbEquSelecReq = $pdo->prepare("SELECT nbEquipesSelec as nb FROM Tournois WHERE idTournoi = :idT");
                $nbEquSelecReq->execute(
                [
                    "idT"=> $id
                    ]
                );
                $nbEquSelec = $nbEquSelecReq->fetch(PDO::   FETCH_ASSOC);
                $nbEquSelec = $nbEquSelec["nb"];

                

                if($sport == "p"){
                    $qualifReq = $pdo->prepare("SELECT * from Equipes e
                where idTournoi = :varTournoi
                order by getPointsPoulePetanque(e.idEquipe,:varTournoi) desc");
                $qualifReq->execute([
                    ":varTournoi"=>$id
                ]);
                $qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);
        
        
                }elseif($sport == "t"){
                    $qualifReq = $pdo->prepare("SELECT * from Equipes e
                where idTournoi = :varTournoi
                order by getPointsPouleTennis(e.idEquipe,:varTournoi) desc");
                $qualifReq->execute([
                    ":varTournoi"=>$id
                ]);
                $qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);
        
        
                }elseif($sport == "f"){
        
                    $qualifReq = $pdo->prepare("SELECT * from Equipes e
                where idTournoi = :varTournoi
                order by getPointsPouleFoot(e.idEquipe,:varTournoi) desc");
                $qualifReq->execute([
                    ":varTournoi"=>$id
                ]);
                $qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);
        
            }
            
            
            
            ?>
        <h3> <?php echo $tournoi3->getNom(); ?> </h3>
        <div class="tournoi_en_cours_infos">
            <p> <?php echo $tournoi3->getLieu(); ?> </p>
            <p> <?php echo $tournoi3->getDiscipline(); ?> </p>
        </div>
        <div class="arbre_en_cours">
            <?php 
            if ($nbEquSelec >= 8){ include ROOT . "/affichage_tournoi/etage_quart.php";}
            if ($nbEquSelec >= 4){ include ROOT . "/affichage_tournoi/etage_demi.php";};
            ?>
            <?php 
             
                if($nbEquSelec >= 4){
                    if(isset($idGagnantMatch1) && isset($idGagnantMatch2)){
                    if($sport == "p"){
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatch1,
                    ":varEqu2"=> $idGagnantMatch2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                    }elseif($sport == "t"){
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatch1,
                    ":varEqu2"=> $idGagnantMatch2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                    }elseif($sport == "f"){
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatch1,
                    ":varEqu2"=> $idGagnantMatch2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                    }
                
                $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
                $equipeGagnanteReq->execute([
                    ":varId"=>$idGagnant["id"]
                ]);
                $equipeGagnanteDem1 = $equipeGagnanteReq->fetch(PDO :: FETCH_ASSOC);
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
             
                if($nbEquSelec >= 4){
                    if(isset($idGagnantMatch3) && isset($idGagnantMatch4)){
                    if($sport == "p"){
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatch3,
                    ":varEqu2"=> $idGagnantMatch4,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                    }elseif($sport == "t"){
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatch3,
                    ":varEqu2"=> $idGagnantMatch4,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                    }elseif($sport == "f"){
                        $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatch3,
                    ":varEqu2"=> $idGagnantMatch4,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                    }
                
                $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
                $equipeGagnanteReq->execute([
                    ":varId"=>$idGagnant["id"]
                ]);
                $equipeGagnanteDem2 = $equipeGagnanteReq->fetch(PDO :: FETCH_ASSOC);
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
            <div <?php if($nbEquSelec >= 8){echo "class=\"icones_etage4\"";}elseif($nbEquSelec >= 4){echo "class=\"icones_etage4\"";}else{echo "class=\"icones_etage4_2eq\"";}?>>
                <div>
                <?php
                if(isset($idGagnantMatchDem1) && isset($idGagnantMatchDem2)){
                if($sport == "p"){
                    $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,false) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatchDem1,
                    ":varEqu2"=> $idGagnantMatchDem2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                }elseif($sport == "t"){
                    $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,false) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatchDem1,
                    ":varEqu2"=> $idGagnantMatchDem2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                }elseif($sport == "f"){
                    $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,false) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatchDem1,
                    ":varEqu2"=> $idGagnantMatchDem2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                }
                
                $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
                $equipeGagnanteReq->execute([
                    ":varId"=>$idGagnant["id"]
                ]);
                $equipeGagnante = $equipeGagnanteReq->fetch(PDO :: FETCH_ASSOC);
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
            <div <?php if($nbEquSelec >= 8){echo "class=\"barres_finale_container\"";}elseif($nbEquSelec >= 4){echo "class=\"barres_finale_container_4eq\"";}else{echo "class=\"barres_finale_container_2eq\"";}?>>
                <section class="barres_finale"></section>
            </div>
            <div <?php if($nbEquSelec >= 8){echo "class=\"icones_etage3\"";}elseif($nbEquSelec >= 4){echo "class=\"icones_etage3_4eq\"";}else{echo "class=\"icones_etage3_2eq\"";}?>>
                <div>
                    <?php 
                    if(isset($idGagnantMatchDem1)&& $idGagnantMatchDem1 != -1){ ?>
                    <img src="<?php echo $equipeGagnanteDem1["icones"] ?>" />
                    <?php }else{
                        echo " ";
                        }?>
                </div>
                
                <div>
                <?php if(isset($idGagnantMatchDem2)&& $idGagnantMatchDem2 != -1){ ?>
                    <img src="<?php echo $equipeGagnanteDem2["icones"] ?>" />
                    <?php }else{
                        echo " ";
                        }?>
                </div>
            </div>
        </div>
        <div class="tournois_poules">
            <?php 

if($sport == "p"){
    $qualifReq = $pdo->prepare("SELECT * from Equipes e
where idTournoi = :varTournoi
order by getPointsPoulePetanque(e.idEquipe,:varTournoi) desc");
$qualifReq->execute([
    ":varTournoi"=>$id
]);
$qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);
}elseif($sport == "t"){
    $qualifReq = $pdo->prepare("SELECT * from Equipes e
where idTournoi = :varTournoi
order by getPointsPouleTennis(e.idEquipe,:varTournoi) desc");
$qualifReq->execute([
    ":varTournoi"=>$id
]);
$qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);
}elseif($sport == "f"){

    $qualifReq = $pdo->prepare("SELECT * from Equipes e
where idTournoi = :varTournoi
order by getPointsFoot(e.idEquipe,:varTournoi) desc");
$qualifReq->execute([
    ":varTournoi"=>$id
]);
$qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);

} 
            $nbRequete = $pdo->prepare("SELECT count(*) as nb FROM Poules where idTournoi = :varId");
            $nbRequete->execute([
                "varId"=>$id
            ]);
            $nbRequete = $nbRequete->fetch(PDO::   FETCH_ASSOC);
            $nbPoules = $nbRequete["nb"];

            $poules = $pdo->prepare("SELECT * FROM Poules WHERE idTournoi = :varId");
            $poules->execute([
                "varId"=>$id
            ]);

            for ($i = 0; $i<$nbPoules; $i++){
                $poule = $poules->fetch(PDO::   FETCH_ASSOC);

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
                $idTournoi = $id;
                include ROOT . "/affichage_tournoi/poule.php";
            }
            ?>
        
        </div>
        <?php 
        if($_SESSION['connecté'] == true){
            echo "<a class=\"bouton_voir_tournoi\" href=\"vue_tournoi_admin?idTournoi=".$tournoi3->getId()."\">Gérer le tournoi</a>";
        }else {
            echo "<a class=\"bouton_voir_tournoi\" href=\"vue_tournoi?idTournoi=".$tournoi3->getId()."\">Voir le tournoi</a>";
        }
        
        ?>
        </section>
    


    
</main>

<?php include ROOT . '/modules/footer.php' ?>
</body>
</html>