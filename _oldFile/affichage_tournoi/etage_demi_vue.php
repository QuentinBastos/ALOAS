<?php 

$urlactive = $_SERVER["PHP_SELF"];
if($urlactive == "/affichage_tournoi/etage_demi_vue"){
    header('Location: /index');
  }
  include ROOT . '/include/pdo.php' ; 

  /* Cette page est similaire à étage demi index*/

  ?>
<div <?php if($nbEquSelec >= 8){echo "class=\"barres_demi_container\"";}elseif($nbEquSelec >= 4){echo "class=\"barres_demi_container_4eq\"";}else{echo "class=\"barres_demi_container_2eq\"";}?>>
    <section class="barres_demi"></section>
    <section class="barres_demi"></section>
</div>
<div <?php if($nbEquSelec >= 8){echo "class=\"icones_etage2\"";}elseif($nbEquSelec >= 4){echo "class=\"icones_etage2_4eq\"";}else{echo "class=\"icones_etage2_2eq\"";}?>>
    <div>
    <?php 
    if($nbEquSelec >= 8){
        unset($getGagnantReq);
        if($sport == "p"){
            $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,false) as id");
        }elseif($sport == "t"){
            $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,false) as id");
        }elseif($sport == "f"){
            $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,false) as id");
        }
        $getGagnantReq->execute([
            ":varEqu1"=> $qualif[0]["idEquipe"],
            ":varEqu2"=> $qualif[7]["idEquipe"],
            ":varidTournoi"=> $id
        ]);
        $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);
        $idGagnant = $idGagnant["id"];
    }else{
        $idGagnant = $qualif[0]["idEquipe"];
    }
        $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
        $equipeGagnanteReq->execute([
            ":varId"=>$idGagnant  
        ]);
        $equipeGagnante = $equipeGagnanteReq->fetch(PDO :: FETCH_ASSOC);
             ?>
             
             <?php
        if($idGagnant  < 0){
            echo " ";
        }else{
            $idGagnantMatch1 = $equipeGagnante["idEquipe"];
        ?>
        <img src="<?php echo $equipeGagnante["icones"]?>" />
        <?php if($nbEquSelec >= 4 && $nbEquSelec < 8){echo "<p>".$equipeGagnante["nom"]."</p>";}?>
        <?php 
        }
        ?>
        
    </div>
    
    <div>
    <?php 
    if($nbEquSelec >= 8){
        unset($getGagnantReq);
    if($sport == "p"){
        $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,false) as id");
    }elseif($sport == "t"){
        $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,false) as id");
    }elseif($sport == "f"){
        $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,false) as id");
    }
    
            $getGagnantReq->execute([
                ":varEqu1"=> $qualif[1]["idEquipe"],
                ":varEqu2"=> $qualif[6]["idEquipe"],
                ":varidTournoi"=> $id
            ]);
            $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);
            $idGagnant = $idGagnant["id"];
            //-----------
        }else{
            $idGagnant = $qualif[3]["idEquipe"];
        }
            $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
            $equipeGagnanteReq->execute([
                ":varId"=>$idGagnant  
            ]);
            $equipeGagnante = $equipeGagnanteReq->fetch(PDO :: FETCH_ASSOC);
             ?>

        <?php
        if($idGagnant  < 0){
            echo " ";
        }else{
            $idGagnantMatch2 = $equipeGagnante["idEquipe"];
        }
        if ($tournoi1->getDiscipline()=="Pétanque") { ?>
                            <a href="/affichage_tournoi/match_petanque?idMatch=<?php
                            for($i=0;$i<count($matchs);$i++){
                                if($matchs[$i]['idEquipe1']== $idGagnantMatch1 && $matchs[$i]['idEquipe2']==$idGagnantMatch2 && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }
                            }?>" class="bouton_vue_tournoi demi_vue">
                             Demi
                            </a>
                   <?php } else if($tournoi1->getDiscipline()=="Foot"){  ?>
                    <a href="/affichage_tournoi/match_foot?idMatch=<?php
                            for($i=0;$i<count($matchs);$i++){
                                if($matchs[$i]['idEquipe1']== $idGagnantMatch1 && $matchs[$i]['idEquipe2']==$idGagnantMatch2 && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }
                            }?>" class="bouton_vue_tournoi demi_vue">
                             Demi
                            </a>
                            <?php } else if($tournoi1->getDiscipline()=="Tennis"){  ?>
                    <a href="/affichage_tournoi/match_tennis?idMatch=<?php
                            for($i=0;$i<count($matchs);$i++){
                                if($matchs[$i]['idEquipe1']== $idGagnantMatch1 && $matchs[$i]['idEquipe2']==$idGagnantMatch2 && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }
                            }?>" class="bouton_vue_tournoi demi_vue">
                             Demi
                            </a>
                            <?php } ?>


        
    </div>

    <div>
             
             <?php
        if($idGagnant  < 0){
            echo " ";
        }else{
            
            
        ?>
        <img src="<?php echo $equipeGagnante["icones"]?>" />
        <?php if($nbEquSelec >= 4 && $nbEquSelec < 8){echo "<p>".$equipeGagnante["nom"]."</p>";}?>
        <?php 
        }
        ?>
        </div>

    <div>
    <?php 
    if($nbEquSelec >= 8){
        unset($getGagnantReq);
            if($sport == "p"){
                $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,false) as id");
            }elseif($sport == "t"){
                $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,false) as id");
            }elseif($sport == "f"){
                $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,false) as id");
            }
            $getGagnantReq->execute([
                ":varEqu1"=> $qualif[2]["idEquipe"],
                ":varEqu2"=> $qualif[5]["idEquipe"],
                ":varidTournoi"=> $id
            ]);
            $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);
            $idGagnant = $idGagnant["id"];
        }else{
            $idGagnant = $qualif[1]["idEquipe"];
        }
            $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
            $equipeGagnanteReq->execute([
                ":varId"=>$idGagnant  
            ]);
            $equipeGagnante = $equipeGagnanteReq->fetch(PDO :: FETCH_ASSOC);

             ?>
             
             <?php
        if($idGagnant  < 0){
            echo " ";
        }else{
            $idGagnantMatch3 = $equipeGagnante["idEquipe"];
        ?>
        <img src="<?php echo $equipeGagnante["icones"]?>" />
        <?php if($nbEquSelec >= 4 && $nbEquSelec < 8){echo "<p>".$equipeGagnante["nom"]."</p>";}?>
        <?php 
        }
        ?>
    </div>

    <div>
    <?php
    if($nbEquSelec >= 8){
        unset($getGagnantReq);
     if($sport == "p"){
            $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,false) as id");
        }elseif($sport == "t"){
            $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,false) as id");
        }elseif($sport == "f"){
            $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,false) as id");
        }
            $getGagnantReq->execute([
                ":varEqu1"=> $qualif[3]["idEquipe"],
                ":varEqu2"=> $qualif[4]["idEquipe"],
                ":varidTournoi"=> $id
            ]);
            $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);
            $idGagnant = $idGagnant["id"];
        }else{
            $idGagnant = $qualif[2]["idEquipe"];
        }
            $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
            $equipeGagnanteReq->execute([
                ":varId"=>$idGagnant  
            ]);
            $equipeGagnante = $equipeGagnanteReq->fetch(PDO :: FETCH_ASSOC);
             ?>



        <?php
        if($idGagnant  < 0){
            echo " ";
        }else{
            $idGagnantMatch4 = $equipeGagnante["idEquipe"];
        }
        if ($tournoi1->getDiscipline()=="Pétanque") { ?>
            <a href="/affichage_tournoi/match_petanque?idMatch=<?php
            for($i=0;$i<count($matchs);$i++){
                if($matchs[$i]['idEquipe1']== $idGagnantMatch3 && $matchs[$i]['idEquipe2']==$idGagnantMatch4 && $matchs[$i]['matchPoule']==0){
                    echo $matchs[$i]['idMatch'];
                }
            }?>" class="bouton_vue_tournoi demi_vue">
                Demi
            </a>
        <?php } else if($tournoi1->getDiscipline()=="Foot"){  ?>
            <a href="/affichage_tournoi/match_foot?idMatch=<?php
            for($i=0;$i<count($matchs);$i++){
                if($matchs[$i]['idEquipe1']== $idGagnantMatch3 && $matchs[$i]['idEquipe2']==$idGagnantMatch4 && $matchs[$i]['matchPoule']==0){
                    echo $matchs[$i]['idMatch'];

                }
            }?>" class="bouton_vue_tournoi demi_vue">
                Demi
            </a>
        <?php } else if($tournoi1->getDiscipline()=="Tennis"){  ?>
            <a href="/affichage_tournoi/match_tennis?idMatch=<?php
            for($i=0;$i<count($matchs);$i++){
                if($matchs[$i]['idEquipe1']== $idGagnantMatch3 && $matchs[$i]['idEquipe2']==$idGagnantMatch4 && $matchs[$i]['matchPoule']==0){
                    echo $matchs[$i]['idMatch'];
                }
            }?>" class="bouton_vue_tournoi demi_vue">
                Demi
            </a>
        <?php } ?>
    </div>

    <div>
    <?php
        if($idGagnant  < 0){
            echo " ";
        }else{
           
        ?>
        <img src="<?php echo $equipeGagnante["icones"]?>" />
        <?php if($nbEquSelec >= 4 && $nbEquSelec < 8){echo "<p>".$equipeGagnante["nom"]."</p>";}?>
        <?php 
        }
        ?>
        </div>
</div>
