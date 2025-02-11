<?php
$titre = "Classement";
    include ROOT . "/modules/header.php"; 
    include_once ROOT . "/classes/classe_equipe.php";
    include_once ROOT . "/classes/classe_tournoi.php";
    include ROOT . '/include/pdo.php' ; 
    /* Page similaire à tournois finis */
    $resultat =  $pdo->prepare("SELECT * FROM Tournois ORDER BY idTournoi DESC LIMIT 20");
    $resultat->execute();


    if ($resultat) {
        $liste_lignes = $resultat->fetchAll(PDO::FETCH_ASSOC);
    } else {}

    $liste_tournois = array();

    foreach ($liste_lignes as $ligne) {
        $idTournoi = $ligne['idTournoi'];
        $nomTournoi = $ligne['nom'];
        $lieu = $ligne['lieu'];
        $discipline = $ligne['discipline'];

        $tournoi = new Tournoi($idTournoi,$nomTournoi,$lieu,$discipline);

        array_push($liste_tournois, $tournoi);
    }
?>
<!doctype html>
<html>
<body>
    <main id="main_en_cours">
   
    <?php
    
            foreach ($liste_tournois as $tournoi) { 
                 ?>
        
        
        <?php
            unset($idGagnant);
            unset($equipeGagnante);
            unset($equipeGagnanteDem1);
            unset($equipeGagnanteDem2);
            unset($qualif);
            unset($idGagnantMatch1);
            unset($idGagnantMatch2);
            unset($idGagnantMatch3);
            unset($idGagnantMatch4);
            $id = $tournoi->getId();
            $nbEquiReq = $pdo->prepare("SELECT count(*) as nb FROM Equipes WHERE idTournoi = :idT");
            $nbEquiReq->execute(
                [
                    "idT"=> $id
                    ]
                );
                $nbEqui = $nbEquiReq->fetch(PDO::   FETCH_ASSOC);
                $disci = strtolower($tournoi->getDiscipline());
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

            if(!isset($qualif[0]) || !isset($qualif[1])){}else{

                if($sport == "p"){
    
    
                
    
                $gagnantsReq = $pdo->prepare("SELECT getGagnantPet(:varidEquipe1,:varidEquipe2,:varidTournoi,true) ");
                $gagnantsReq->execute([
                    ":varidEquipe1"=>$qualif[0]["idEquipe"],
                    ":varidEquipe2"=>$qualif[1]["idEquipe"],
                    ":varidTournoi"=>$id
                ]);
                
                $gagnant = $gagnantsReq->fetch(PDO:: FETCH_ASSOC);
    
                }elseif($sport == "t"){
    
                $gagnantsReq = $pdo->prepare("SELECT getGagnantTen(:varidEquipe1,:varidEquipe2,:varidTournoi,true)");
                $gagnantsReq->execute([
                    ":varidEquipe1"=>$qualif[0]["idEquipe"],
                    ":varidEquipe2"=>$qualif[1]["idEquipe"],
                    ":varidTournoi"=>$id
                ]);
                
                $gagnant = $gagnantsReq->fetch(PDO:: FETCH_ASSOC);
    
                }elseif($sport == "f"){
    
    
                $gagnantsReq = $pdo->prepare("SELECT getGagnantFoot(:varidEquipe1,:varidEquipe2,:varidTournoi,true)");
                $gagnantsReq->execute([
                    ":varidEquipe1"=>$qualif[0]["idEquipe"],
                    ":varidEquipe2"=>$qualif[1]["idEquipe"],
                    ":varidTournoi"=>$id
                ]);
            
            $gagnant = $gagnantsReq->fetch(PDO:: FETCH_ASSOC);

            }
            
            
            ?>
            <section class="affichage_tournoi_arbre_poule">
        <h3> <?php echo $tournoi->getNom(); ?> </h3>
        <div class="tournoi_en_cours_infos">
            <p> <?php echo $tournoi->getLieu(); ?> </p>
            <p> <?php echo $tournoi->getDiscipline(); ?> </p>
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
                    $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatchDem1,
                    ":varEqu2"=> $idGagnantMatchDem2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                }elseif($sport == "t"){
                    $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatchDem1,
                    ":varEqu2"=> $idGagnantMatchDem2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                }elseif($sport == "f"){
                    $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,0) as id");
                $getGagnantReq->execute([
                    ":varEqu1"=> $idGagnantMatchDem1,
                    ":varEqu2"=> $idGagnantMatchDem2,
                    ":varidTournoi"=> $id
                ]);
                $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);

                }else{
                    echo "YA UNE ERREUR";
                }
                
                $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
                $equipeGagnanteReq->execute([
                    ":varId"=>$idGagnant["id"]
                ]);
                $equipeGagnante = $equipeGagnanteReq->fetch(PDO :: FETCH_ASSOC);
                }else{
                    unset($equipeGagnante);
                }

                if(isset($equipeGagnante) && $idGagnant["id"] > 0){
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
                    <?php if(isset($idGagnantMatchDem1) && isset($equipeGagnanteDem1)&& $idGagnantMatchDem1 != -1){ ?>
                    <img src="<?php echo $equipeGagnanteDem1["icones"] ?>" />
                    <?php }else{
                        echo " ";
                        }?>
                </div>
                
                <div>
                <?php if(isset($idGagnantMatchDem2) && isset($equipeGagnanteDem2)&& $idGagnantMatchDem2 != -1){?>
                    
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
order by getPointsPouleFoot(e.idEquipe,:varTournoi) desc");
$qualifReq->execute([
    ":varTournoi"=>$id
]);
$qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);

}else{
    echo "YA UNE ERREUR";
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
                $idTournoi = $tournoi->getId();
                include ROOT . "/affichage_tournoi/poule.php";
            }
           
            ?>
        
        </div>
        <a class="bouton_voir_tournoi" href="classement_goalaverage?idTournoi=<?php echo $tournoi->getId(); ?>">Voir le classement</a>
        </section>
<?php }
        } 

           
?>

    </main>
    <?php include ROOT . '/modules/footer.php' ?>
</body>
</html>