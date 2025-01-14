<?php
$titre = "Accueil";


include_once ROOT . "/classes/classe_equipe.php";
include_once ROOT . "/classes/classe_tournoi.php";
include ROOT . "/modules/header.php"; 
include ROOT . '/include/pdo.php' ; 

/**
 *  Récupère les tournois
 */
$statement = $pdo->prepare("SELECT * from Tournois order by idTournoi desc ; ");
$statement->execute();
$tournoi = $statement->fetchAll();


/**
 * Récupère les 3 derniers tournois
 */
$resultat =  $pdo->prepare("SELECT * FROM Tournois ORDER BY idTournoi DESC LIMIT 3");
$resultat->execute();

if($resultat->rowCount() > 0){
    $ligne = $resultat->fetch(PDO::FETCH_ASSOC);
    $tournoi1 = new Tournoi($ligne["idTournoi"],$ligne["nom"],$ligne["lieu"],$ligne["discipline"]);
}

if($resultat->rowCount() > 1){
    $ligne = $resultat->fetch(PDO::FETCH_ASSOC);
    $tournoi2 = new Tournoi($ligne["idTournoi"],$ligne["nom"],$ligne["lieu"],$ligne["discipline"]);
}

if($resultat->rowCount() > 2){
    $ligne = $resultat->fetch(PDO::FETCH_ASSOC);
    $tournoi3 = new Tournoi($ligne["idTournoi"],$ligne["nom"],$ligne["lieu"],$ligne["discipline"]);
}





 //

 function iconesEquipes($idTournoi)
 {
     include ROOT . '/include/pdo.php';
 
     unset($statement);
     try{
         $statement = $pdo->prepare("SELECT * FROM Equipes 
     JOIN Matchs ON Equipes.idEquipe = Matchs.idEquipe1 OR Equipes.idEquipe = Matchs.idEquipe2 
     WHERE Matchs.idTournoi = (SELECT idTournoi FROM Tournois ORDER BY date DESC LIMIT 1 OFFSET :idT)
     AND Matchs.idMatch = (SELECT idMatch FROM Matchs 
                          WHERE idTournoi = (SELECT idTournoi FROM Tournois ORDER BY date DESC LIMIT 1 OFFSET :idT)
                          ORDER BY idMatch DESC LIMIT 1)
     ORDER BY Matchs.idMatch DESC;");
 
 $statement->bindParam(':idT', $idTournoi, PDO::PARAM_INT);
 $statement->execute();
 
 $matchs = $statement->fetchAll();
     }catch(Exception $e){
 
     }
     
 
 if (!empty($matchs)) {
 
     echo '<img src="';
     echo $matchs[0]['icones'];
     echo '" alt="';
     echo $matchs[0]['alt'];
     echo '">';
 
     echo '<p>vs</p>';
 
     echo '<img src="';
     echo $matchs[1]['icones'];
     echo '" alt="';
     echo $matchs[1]['alt'];
     echo '">';
     
 }
 }
 
 
 /**
  * Récupère les équipes trier par goalaverage
  */
 unset($statement);
 $statement = $pdo->prepare("SET @row_number = 0;
 SELECT (@row_number:=@row_number + 1) AS place, idEquipe, nom, goalaverage, fairplay, icones, alt 
 FROM Equipes 
 ORDER BY goalaverage DESC;");
 $statement->execute();
 $equipes = $statement->fetchALL();
 
 
 
 function discipline($idTournoi){
    include ROOT . '/include/pdo.php';
 
 
     unset($statement);
     /* Récupère la discipline du tournoi */
 
    $statement = $pdo->prepare("SELECT discipline from Tournois order by idTournoi desc ;  ");
     $statement->execute();
     $discipline = $statement->fetchALL();
     echo $discipline[$idTournoi][0];
     
 }
 
 
 function resultat($idTournoi){
     
   
    include ROOT . '/include/pdo.php';
     unset($statement);
     /* Récupère la discipline du tournoi */
     $statement = $pdo->prepare("SELECT discipline from Tournois order by idTournoi desc;  ");
     $statement->execute();
     $discipline = $statement->fetchALL();
 
     if ($discipline[$idTournoi][0]=="Pétanque"){
         /* Récupère le nombre de manches jouées */
         unset($statement);
         $statement = $pdo->prepare("SELECT count(*) FROM Manches_petanque mf JOIN Matchs m ON m.idMatch = mf.idMatch WHERE idTournoi = (SELECT idTournoi FROM Tournois ORDER BY date DESC LIMIT 1 OFFSET " . intval($idTournoi) . ")AND mf.idMatch = (SELECT idMatch  FROM Matchs WHERE idTournoi = (SELECT idTournoi FROM Tournois ORDER BY date DESC LIMIT 1 OFFSET " . intval($idTournoi) . ")ORDER BY idMatch DESC LIMIT 1)ORDER BY m.idMatch DESC;");
         $statement->execute();
         $nb_manches = $statement->fetchALL();
         $limit = $nb_manches[0][0];
 
 
 
         /* Récupère les informations de la manche */
         unset($statement);
         $statement = $pdo->prepare("SELECT * FROM Manches_petanque mf JOIN Matchs m ON m.idMatch = mf.idMatch WHERE idTournoi = (SELECT idTournoi FROM Tournois ORDER BY date DESC LIMIT 1 OFFSET  " . intval($idTournoi) . ") ORDER BY m.idMatch DESC LIMIT $limit ;");
         $statement->execute();
         $manches = $statement->fetchALL();
         $total1=0;
         $total2=0;
         if (!empty($manches)){
            
             for ($i = 0; $i < $nb_manches[0][0]; $i++) {
                 $total1 += $manches[$i]['pointsEquipe1'];
                 $total2 += $manches[$i]['pointsEquipe2'];
             }
             echo "<p>".$total1."</p>";
             echo  "<p> - </p>";
             echo "<p>".$total2."</p>";
 
         }
         else {
             echo "Aucun match n'a encore été joué.";
         }
 
 
 
     }
 
     if($discipline[$idTournoi][0]=="Foot"){
 
        
         /* Récupère les informations du match */
         unset($statement);
         $statement = $pdo->prepare("SELECT butsEquipe1, butsEquipe2 FROM Match_foot mf JOIN Matchs m ON m.idMatch = mf.idMatch WHERE idTournoi = (SELECT idTournoi FROM Tournois ORDER BY date DESC LIMIT 1 OFFSET " . intval($idTournoi) . ") ORDER BY m.idMatch DESC LIMIT 1 ;");//OFFSET ". intval($matchFootAfficher) ."
         $statement->execute();
         $pointsEquipe = $statement->fetchAll();
 
         if (!empty($pointsEquipe)) {
             
             echo "<p>".$pointsEquipe[0]['butsEquipe1']."</p>";
             echo  "<p> - </p>";
             echo "<p>".$pointsEquipe[0]['butsEquipe2']."</p>";
         } else {
             echo "Aucun match n'a encore été joué.";
         }
 
     }
     if($discipline[$idTournoi][0]=="Tennis"){
 
      
          /* Récupère les informations du match */
          unset($statement);
          $statement = $pdo->prepare("SELECT setEquipe1, setEquipe2 FROM Match_tennis mf JOIN Matchs m ON m.idMatch = mf.idMatch WHERE idTournoi = (SELECT idTournoi FROM Tournois ORDER BY date DESC LIMIT 1 OFFSET " . intval($idTournoi) . ") ORDER BY m.idMatch DESC LIMIT 1 ; ");//OFFSET". intval($matchTennisAfficher) ."
         $statement->execute();
         $pointsEquipe = $statement->fetchALL();
 
         if (!empty($pointsEquipe)) {
 
             echo "<p>".$pointsEquipe[0]['setEquipe1']."</p>";
             echo  "<p> - </p>";
             echo "<p>".$pointsEquipe[0]['setEquipe2']."</p>";
         } else {
             echo "Aucun match n'a encore été joué.";
         }
 
 
     }
 
 
 }

?>
<html lang="fr">
<body>


<main class="accueil">


    <section>
    
    
        <section class="arbre_accueil">
        <?php if($tournoi1){ ?>
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

            /* Récupère le nombre d'équipes du tournoi */
            $nbEquiReq = $pdo->prepare("SELECT count(*) as nb FROM Equipes WHERE idTournoi = :idT");
            unset($statement);
            try{
                $nbEquiReq->execute(
                    [
                        "idT"=> $id
                        ]
                    );
            }catch(PDOException $e){
                echo $e->getMessage();
            }
                $nbEqui = $nbEquiReq->fetch(PDO::   FETCH_ASSOC);
                $nbEqui = $nbEqui["nb"];

                $disci = strtolower($tournoi1->getDiscipline());
                if($disci == "pétanque"){
                    $sport = "p";
                }else if ($disci == "tennis"){
                    $sport = "t";
                }else if ($disci == "foot"){
                    $sport = "f";
                }

                /* Récupère le nombre d'équipes sélectionnées pour le tournoi */
                $nbEquSelecReq = $pdo->prepare("SELECT nbEquipesSelec as nb FROM Tournois WHERE idTournoi = :idT");
                $nbEquSelecReq->execute(
                [
                    "idT"=> $id
                    ]
                );
                $nbEquSelec = $nbEquSelecReq->fetch(PDO::   FETCH_ASSOC);
                $nbEquSelec = $nbEquSelec["nb"];


                
                /* Récupère les équipes qualifiées du tournoi */
                if($sport == "p"){
                    $qualifReq = $pdo->prepare("SELECT * from Equipes e
                where idTournoi = :varTournoi
                order by getPointsPoulePetanque(e.idEquipe,:varTournoi)  desc");
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
                order by getPointsPouleFoot(e.idEquipe,:varTournoi)  desc");
                $qualifReq->execute([
                    ":varTournoi"=>$id
                ]);
                $qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);
    
                }else{
                    echo "YA UNE ERREUR"; 
                }
    
                if($_SESSION['connecté']){ ?>
                    <a class="arbre_tournoi_index"  href="<?php if($id != null){ echo "/affichage_tournoi/vue_tournoi_admin?idTournoi= $id";}else{ echo "#"; }?>">
               <?php } else { ?>
                    <a class="arbre_tournoi_index"  href="<?php if($id != null){ echo "/affichage_tournoi/vue_tournoi?idTournoi= $id";}else{ echo "#"; }?>">
                <?php }?> 
            
            
        <h3> <?php echo $tournoi1->getNom(); ?> </h3>
        <div class="tournoi_en_cours_infos">
            <p> <?php echo $tournoi1->getLieu(); ?> </p>
            <p> <?php echo $tournoi1->getDiscipline(); ?> </p>
        </div>
        <div class="arbre_en_cours_index">
            <?php 
            if ($nbEquSelec >= 8){ include ROOT . "/affichage_tournoi/etage_quart.php";}
            if ($nbEquSelec >= 4){ include ROOT . "/affichage_tournoi/etage_demi.php";};
            ?>
            <?php 
             
                if($nbEquSelec >= 4){
                    if(isset($idGagnantMatch1) && isset($idGagnantMatch2)){

                        /* Récupère l'équipe gagnante du match */
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
    
                        }else{
                            echo "YA UNE ERREUR";
                        }
    
                /* Récupère les informations de l'équipe gagnante */
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
                       /* Récupère l'équipe gagnante du match */
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

                    }else{
                        echo "YA UNE ERREUR";
                    }

                /* Récupère les informations de l'équipe gagnante */
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
            <div <?php if($nbEquSelec >= 8){echo "class=\"icones_etage4_index\"";}elseif($nbEquSelec >= 4){echo "class=\"icones_etage4_index\"";}else{echo "class=\"icones_etage4_2eq_index\"";}?>>
                <div>
                <?php
                if(isset($idGagnantMatchDem1) && isset($idGagnantMatchDem2)){

                    /* Récupère l'équipe gagnante du match */
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
    
                    }else{
                        echo "YA UNE ERREUR";
                    }
    
                /* Récupère les informations de l'équipe gagnante */
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
            <div <?php if($nbEquSelec >= 8){echo "class=\"barres_finale_container_index\"";}elseif($nbEquSelec >= 4){echo "class=\"barres_finale_container_4eq_index\"";}else{echo "class=\"barres_finale_container_2eq_index\"";}?>>
                <section class="barres_finale"></section>
            </div>
            <div <?php if($nbEquSelec >= 8){echo "class=\"icones_etage3_index\"";}elseif($nbEquSelec >= 4){echo "class=\"icones_etage3_4eq_index\"";}else{echo "class=\"icones_etage3_2eq_index\"";}?>>
                <div>
                    <?php if(isset($idGagnantMatchDem1)&& $idGagnantMatchDem1 != -1){ 
                        ?>
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
        </a>
        <?php }else{
            echo " Il n'y a pas encore de tournoi";
        
        } ?>
        </section>
        

        
        <section class="arbre_accueil">
        <?php if($tournoi2){ 

            /* Pareil que le tournoi 1*/
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
            order by getPointsPoulePetanque(e.idEquipe,:varTournoi)  desc");
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
            order by getPointsPouleFoot(e.idEquipe,:varTournoi)  desc");
            $qualifReq->execute([
                ":varTournoi"=>$id
            ]);
            $qualif = $qualifReq->fetchAll(PDO::   FETCH_ASSOC);

            }else{
                echo "YA UNE ERREUR";
            }
            
            if($_SESSION['connecté']){ ?>
                <a class="arbre_tournoi_index"  href="<?php if($id != null){ echo "/affichage_tournoi/vue_tournoi_admin?idTournoi= $id";}else{ echo "#"; }?>">
           <?php } else { ?>
                <a class="arbre_tournoi_index"  href="<?php if($id != null){ echo "/affichage_tournoi/vue_tournoi?idTournoi= $id";}else{ echo "#"; }?>">
            <?php }?> 
        <h3> <?php echo $tournoi2->getNom(); ?> </h3>
        <div class="tournoi_en_cours_infos">
            <p> <?php echo $tournoi2->getLieu(); ?> </p>
            <p> <?php echo $tournoi2->getDiscipline(); ?> </p>
        </div>
        <div class="arbre_en_cours_index">
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

                    }else{
                        echo "YA UNE ERREUR";
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

                    }else{
                        echo "YA UNE ERREUR";
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
            <div <?php if($nbEquSelec >= 8){echo "class=\"icones_etage4_index\"";}elseif($nbEquSelec >= 4){echo "class=\"icones_etage4_index\"";}else{echo "class=\"icones_etage4_2eq_index\"";}?>>
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

                if(isset($equipeGagnante)  && $idGagnant["id"] > 0 ){
             ?>
             <img src="<?php echo $equipeGagnante["icones"] ?>" />
             <?php }else{
                echo " ";
             } ?>
                </div>
            </div>
            <div <?php if($nbEquSelec >= 8){echo "class=\"barres_finale_container_index\"";}elseif($nbEquSelec >= 4){echo "class=\"barres_finale_container_4eq_index\"";}else{echo "class=\"barres_finale_container_2eq_index\"";}?>>
                <section class="barres_finale"></section>
            </div>
            <div <?php if($nbEquSelec >= 8){echo "class=\"icones_etage3_index\"";}elseif($nbEquSelec >= 4){echo "class=\"icones_etage3_4eq_index\"";}else{echo "class=\"icones_etage3_2eq_index\"";}?>>
                <div>
                    <?php if(isset($idGagnantMatchDem1)&& $idGagnantMatchDem1 != -1){ ?>
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
        </a>
        <?php }else{
            echo " Il n'y a pas encore de tournoi";
        
        } ?>
        </section>

        <section class="arbre_accueil">
        <?php if($tournoi3){
 
            /* Pareil que le tournoi 1*/
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

            }else{
                echo "YA UNE ERREUR";
            }
            
            
            if($_SESSION['connecté']){ ?>
                <a class="arbre_tournoi_index"  href="<?php if($id != null){ echo "/affichage_tournoi/vue_tournoi_admin?idTournoi= $id";}else{ echo "#"; }?>">
           <?php } else { ?>
                <a class="arbre_tournoi_index"  href="<?php if($id != null){ echo "/affichage_tournoi/vue_tournoi?idTournoi= $id";}else{ echo "#"; }?>">
            <?php }?> <h3> <?php echo $tournoi3->getNom(); ?> </h3>
        <div class="tournoi_en_cours_infos">
            <p> <?php echo $tournoi3->getLieu(); ?> </p>
            <p> <?php echo $tournoi3->getDiscipline(); ?> </p>
        </div>
        <div class="arbre_en_cours_index">
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

                    }else{
                        echo "YA UNE ERREUR";
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

                    }else{
                        echo "YA UNE ERREUR";
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
            <div <?php if($nbEquSelec >= 8){echo "class=\"icones_etage4_index\"";}elseif($nbEquSelec >= 4){echo "class=\"icones_etage4_index\"";}else{echo "class=\"icones_etage4_2eq_index\"";}?>>
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

                if(isset($equipeGagnante)  && $idGagnant["id"] > 0){
             ?>
             <img src="<?php echo $equipeGagnante["icones"] ?>" />
             <?php }else{
                echo " ";
             } ?>
                </div>
            </div>

            <div <?php if($nbEquSelec >= 8){echo "class=\"barres_finale_container_index\"";}elseif($nbEquSelec >= 4){echo "class=\"barres_finale_container_4eq_index\"";}else{echo "class=\"barres_finale_container_2eq_index\"";}?>>
                <section class="barres_finale"></section>
            </div>
            <div <?php if($nbEquSelec >= 8){echo "class=\"icones_etage3_index\"";}elseif($nbEquSelec >= 4){echo "class=\"icones_etage3_4eq_index\"";}else{echo "class=\"icones_etage3_2eq_index\"";}?>>
                <div>
                    <?php if(isset($idGagnantMatchDem1)&& $idGagnantMatchDem1 != -1){ ?>
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
        </a>
        </section>

       
        <?php }else{
            echo " Il n'y a pas encore de tournoi";
        
        } ?>
    </section>
    <a class="bouton bouton_index" href="/affichage_tournoi/tournois_en_cours">Voir + sur les 3 derniers</a>
    

    <h2>Les 10 derniers tournois</h2>
    <section>

        <!-- Affichage des finales des 10 derniers tournois -->
        <div class="grille">
            <a href="<?php if($tournoi[0]['idTournoi'] != null){ echo "/affichage_tournoi/vue_tournoi?idTournoi=". $tournoi[0]['idTournoi'] ;}else{ echo "#"; }?>">
            
            <div class="derniers_tournois_acccueil grille_1">
                <div>
                    <h3><?php echo $tournoi[0]['nom']; ?></h3>
                </div>
                <div class="confrontation_index">
                    
                    <?php iconesEquipes(0); ?>
                </div>
                <div class="resultat-tournois">
                    <?php resultat(0) ?>
                </div>
                <div>
                    <h4>
                        <?php discipline(0)?>
                    </h4>
                </div>
            </div>
            </a>

            
            <a href="<?php if($tournoi[1]['idTournoi'] != null){ echo "/affichage_tournoi/vue_tournoi?idTournoi=". $tournoi[1]['idTournoi'] ;}else{ echo "#"; }?>">
            <div class="derniers_tournois_acccueil grille_2">
                <div>
                    <h3><?php echo $tournoi[1]['nom']; ?></h3>
                </div>
                <div class="confrontation_index">
                    <?php iconesEquipes(1) ?>
                </div>

                <div class="resultat-tournois">
                    <?php resultat(1) ?>
                </div>
                <div>
                    <h4>
                        <?php discipline(1)?>
                    </h4>
                </div>
            </div>
            </a>
            <a href="<?php if($tournoi[2]['idTournoi'] != null){ echo "/affichage_tournoi/vue_tournoi?idTournoi=". $tournoi[2]['idTournoi'] ;}else{ echo "#"; }?>">
            <div class="derniers_tournois_acccueil grille_3">
                <div>
                    <h3><?php echo $tournoi[2]['nom']; ?></h3>
                </div>
                <div class="confrontation_index">
                    <?php iconesEquipes(2) ?>
                </div>
                <div class="resultat-tournois">
                    <?php resultat(2) ?>
                </div>
                <div>
                    <h4>
                        <?php discipline(2)?>
                    </h4>
                </div>
            </div>
            </a>
            <a href="<?php if($tournoi[3]['idTournoi'] != null){ echo "/affichage_tournoi/vue_tournoi?idTournoi=". $tournoi[3]['idTournoi'] ;}else{ echo "#"; }?>">
            <div class="derniers_tournois_acccueil grille_4">
                <div>
                    <h3><?php echo $tournoi[3]['nom']; ?></h3>
                </div>
                <div class="confrontation_index">
                    <?php iconesEquipes(3) ?>
                </div>
                <div class="resultat-tournois">
                    <?php resultat(3) ?>
                </div>
                <div>
                    <h4>
                        <?php discipline(3)?>
                    </h4>
                </div>
            </div>
            </a>
            <a href="<?php if($tournoi[4]['idTournoi'] != null){ echo "/affichage_tournoi/vue_tournoi?idTournoi=". $tournoi[4]['idTournoi'] ;}else{ echo "#"; }?>">
            <div class="derniers_tournois_acccueil grille_5">
                <div>
                    <h3><?php echo $tournoi[4]['nom']; ?></h3>
                </div>
                <div class="confrontation_index">
                    <?php iconesEquipes(4) ?>
                </div>
                <div class="resultat-tournois">
                    <?php resultat(4) ?>
                </div>
                <div>
                    <h4>
                        <?php discipline(4)?>
                    </h4>
                </div>
            </div>
            </a>
            <a href="<?php if($tournoi[5]['idTournoi'] != null){ echo "/affichage_tournoi/vue_tournoi?idTournoi=". $tournoi[5]['idTournoi'] ;}else{ echo "#"; }?>">
            <div class="derniers_tournois_acccueil grille_6">
                <div>
                    <h3><?php echo $tournoi[5]['nom']; ?></h3>
                </div>
                <div class="confrontation_index">
                    <?php iconesEquipes(5) ?>
                </div>
                <div class="resultat-tournois">
                    <?php resultat(5) ?>
                </div>
                <div>
                    <h4>
                        <?php discipline(5)?>
                    </h4>
                </div>
            </div>
            </a>
            <a href="<?php if($tournoi[6]['idTournoi'] != null){ echo "/affichage_tournoi/vue_tournoi?idTournoi=". $tournoi[6]['idTournoi'] ;}else{ echo "#"; }?>">
            <div class="derniers_tournois_acccueil grille_7">
                <div>
                    <h3><?php echo $tournoi[6]['nom']; ?></h3>
                </div>
                <div class="confrontation_index">
                    <?php iconesEquipes(6) ?>
                </div>
                <div class="resultat-tournois">
                    <?php resultat(6) ?>
                </div>
                <div>
                    <h4>
                        <?php discipline(6)?>
                    </h4>
                </div>
            </div>
            </a>
            <a href="<?php if($tournoi[7]['idTournoi'] != null){ echo "/affichage_tournoi/vue_tournoi?idTournoi=". $tournoi[7]['idTournoi'] ;}else{ echo "#"; }?>">
            <div class="derniers_tournois_acccueil grille_8">
                <div>
                    <h3><?php echo $tournoi[7]['nom']; ?></h3>
                </div>
                <div class="confrontation_index">
                    <?php iconesEquipes(7) ?>
                </div>
                <div class="resultat-tournois">
                    <?php resultat(7) ?>
                </div>
                <div>
                    <h4>
                        <?php discipline(7)?>
                    </h4>
                </div>
            </div>
            </a>
            <a href="<?php if($tournoi[8]['idTournoi'] != null){ echo "/affichage_tournoi/vue_tournoi?idTournoi=". $tournoi[8]['idTournoi'] ;}else{ echo "#"; }?>">
            <div class="derniers_tournois_acccueil grille_9">
                <div>
                    <h3><?php echo $tournoi[8]['nom']; ?></h3>
                </div>
                <div class="confrontation_index">
                    <?php iconesEquipes(8) ?>
                </div>
                <div class="resultat-tournois">
                    <?php resultat(8) ?>
                </div>
                <div>
                    <h4>
                        <?php discipline(8)?>
                    </h4>
                </div>
            </div>
            </a>
            <a href="<?php if($tournoi[9]['idTournoi'] != null){ echo "/affichage_tournoi/vue_tournoi?idTournoi=". $tournoi[9]['idTournoi'] ;}else{ echo "#"; }?>">
            <div class="derniers_tournois_acccueil grille_10">
                <div>
                    <h3><?php echo $tournoi[9]['nom']; ?></h3>
                </div>
                <div class="confrontation_index">
                    <?php iconesEquipes(9) ?>
                </div>
                <div class="resultat-tournois">
                    <?php resultat(9) ?>
                </div>
                <div>
                    <h4>
                        <?php discipline(9)?>
                    </h4>
                </div>
            </div>
            </a>
        </div>
        <a class="bouton_bis bouton" href="/affichage_tournoi/tournois_finis">Voir +</a>
    </section>
</main>



<?php include ROOT . "/modules/footer.php"; ?>
</body>
</html>
