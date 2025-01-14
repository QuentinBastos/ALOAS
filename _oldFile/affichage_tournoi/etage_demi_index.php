<?php 

$urlactive = $_SERVER["PHP_SELF"];
if($urlactive == "/affichage_tournoi/demi_index.php"){
    header('Location: /index');
  }
  include ROOT . '/include/pdo.php' ; 
  ?>
<div <?php if($nbEqui["nb"] > 8){echo "class=\"barres_demi_container_index\"";}elseif($nbEqui["nb"] > 4){echo "class=\"barres_demi_container_4eq_index\"";}else{echo "class=\"barres_demi_container_index_2eq_index\"";}?>>
    <section class="barres_demi_index"></section>
    <section class="barres_demi_index"></section>
</div>
<div <?php if($nbEqui["nb"] > 8){echo "class=\"icones_etage2_index\"";}elseif($nbEqui["nb"] > 4){echo "class=\"icones_etage2_4eq_index\"";}else{echo "class=\"icones_etage2_2eq_index\"";}?>>
    <div>
        <?php 
        if($nbEquSelec >= 8){
            unset($getGagnantReq);
            /**
             * Requête pour récupérer l'id de l'équipe gagnante
             */
        if($sport == "p"){
            $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,false) as id");
        }else if($sport == "t"){
            $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,false) as id");
        }else if($sport == "f"){
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
        /**
         * Requête pour récupérer les informations de l'équipe gagnante
         */
            $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
            $equipeGagnanteReq->execute([
                ":varId"=>$idGagnant  
            ]);
            $equipeGagnante = $equipeGagnanteReq->fetch(PDO :: FETCH_ASSOC);
             ?>
        <?php
        if($idGagnant   < 0){
            echo " ";
        }else{
            $idGagnantMatch1 = $equipeGagnante["idEquipe"];
        ?>
        <img src="<?php echo $equipeGagnante["icones"]?>" />
        <?php 
        }
        ?>
    </div>
    
    <div>
    <?php 
    if($nbEquSelec >= 8){
        unset($getGagnantReq);
        /**
         * Requête pour récupérer l'id de l'équipe gagnante
         */
        if($sport == "p"){
            $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,false) as id");
        }else if($sport == "t"){
            $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,false) as id");
        }else if($sport == "f"){
            $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,false) as id");
        }
            $getGagnantReq->execute([
                ":varEqu1"=> $qualif[1]["idEquipe"],
                ":varEqu2"=> $qualif[6]["idEquipe"],
                ":varidTournoi"=> $id
            ]);
            $idGagnant = $getGagnantReq->fetch(PDO:: FETCH_ASSOC);
            $idGagnant = $idGagnant["id"];
        }else{
            $idGagnant = $qualif[3]["idEquipe"];
        }
        /**
         * Requête pour récupérer les informations de l'équipe gagnante
         */
            $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
            $equipeGagnanteReq->execute([
                ":varId"=>$idGagnant  
            ]);
            $equipeGagnante = $equipeGagnanteReq->fetch(PDO :: FETCH_ASSOC);
             ?>
        <?php
        if($idGagnant   < 0){
            echo " ";
        }else{
            $idGagnantMatch2 = $equipeGagnante["idEquipe"];
        ?>
        <img src="<?php echo $equipeGagnante["icones"]?>" />
        <?php 
        }
        ?>
    </div>

    <div>
    <?php 
    if($nbEquSelec >= 8){
        unset($getGagnantReq);
        /**
         * Requête pour récupérer l'id de l'équipe gagnante
         */
            if($sport == "p"){
                $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,false) as id");
            }else if($sport == "t"){
                $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,false) as id");
            }else if($sport == "f"){
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
        /**
         * Requête pour récupérer les informations de l'équipe gagnante
         */
            $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
            $equipeGagnanteReq->execute([
                ":varId"=>$idGagnant  
            ]);
            $equipeGagnante = $equipeGagnanteReq->fetch(PDO :: FETCH_ASSOC);
             ?>
        <?php
        if($idGagnant   < 0){
            echo " ";
        }else{
            $idGagnantMatch3 = $equipeGagnante["idEquipe"];
        ?>
        <img src="<?php echo $equipeGagnante["icones"]?>" />
        <?php 
        }
        ?>
    </div>

    <div>
    <?php 
    if($nbEquSelec >= 8){
        unset($getGagnantReq);
        /**
         * Requête pour récupérer l'id de l'équipe gagnante
         */
    if($sport == "p"){
        $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,false) as id");
    }else if($sport == "t"){
        $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,false) as id");
    }else if($sport == "f"){
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
        /**
         * Requête pour récupérer les informations de l'équipe gagnante
         */
            $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");
            $equipeGagnanteReq->execute([
                ":varId"=>$idGagnant  
            ]);
            $equipeGagnante = $equipeGagnanteReq->fetch(PDO :: FETCH_ASSOC);
             ?>
        <?php
        if($idGagnant   < 0){
            echo " ";
        }else{
            $idGagnantMatch4 = $equipeGagnante["idEquipe"];
        ?>
        <img src="<?php echo $equipeGagnante["icones"]?>" />
        <?php 
        }
        ?>
    </div>
</div>