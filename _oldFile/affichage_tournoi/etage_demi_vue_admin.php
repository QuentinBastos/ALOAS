<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$urlactive = $_SERVER["PHP_SELF"];
if($urlactive == "/affichage_tournoi/etage_demi_vue_admin.php"){
    header('Location: /index');
  } 
  include ROOT . '/include/pdo.php' ; 

  /* Cette page est similaire à étage demi index*/

  ?>
<div <?php if($nbEquSelec >= 8){echo "class=\"barres_demi_container_vueadmin\"";}elseif($nbEquSelec >= 4){echo "class=\"barres_demi_container_4eq_vueadmin\"";}else{echo "class=\"barres_demi_container_2eq_vueadmin\"";}?>>

    <section class="barres_demi_vueadmin"></section>

    <section class="barres_demi_vueadmin"></section>

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
        }else{
            echo "IL Y A UNE ERREUR";
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
        if($idGagnant   < 0){
            echo " ";
        }else{
            $idGagnantMatch1 = $equipeGagnante["idEquipe"];
        ?>
        <img src="<?php echo $equipeGagnante["icones"]?>" />
        <?php if($nbEquSelec >= 4 && $nbEquSelec < 8){echo "<p>".$equipeGagnante["nom"]."</p>";}?>
        <?php 
        }
        ?>

    <?php 
        if($nbEquSelec >= 8){
            unset($getGagnantReq);

if($sport == "p"){
    $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,false) as id");
}elseif($sport == "t"){
    $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,false) as id");
}elseif($sport == "f"){
    $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,false) as id");
}else{
    echo "IL Y A UNE ERREUR";
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

            $equipeGagnanteReq = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :varId");

            $equipeGagnanteReq->execute([

                ":varId"=>$idGagnant  

            ]);

            $equipeGagnante = $equipeGagnanteReq->fetch(PDO :: FETCH_ASSOC);

             ?>

        

        



        

    </div>

    <?php

    
        if($idGagnant   < 0){
            echo " ";
        }else{
        $idGagnantMatch2 = $equipeGagnante["idEquipe"];
        }
    
         if ($tournoi1->getDiscipline()=="Pétanque") { ?>

         <section class="section_minuteur_vuematch">

                            <a href="/formulaires/saisie_points_petanque?idMatch=<?php 

                            for($i=0;$i<count($matchs);$i++){

                                if((($matchs[$i]['idEquipe1']== $idGagnantMatch1 && $matchs[$i]['idEquipe2']== $idGagnantMatch2)||($matchs[$i]['idEquipe1']== $idGagnantMatch2 && $matchs[$i]['idEquipe2']==$idGagnantMatch1)) && $matchs[$i]['matchPoule']==0){

                                    echo $matchs[$i]['idMatch'];
                                    unset($statement);
                                    $statement = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :idEquipe");
                                    $statement->execute(['idEquipe' => $idGagnantMatch1]);
                                    $equipeGagnante1 = $statement->fetch();
                                    $statement->execute(['idEquipe' => $idGagnantMatch2]);
                                    $equipeGagnante2 = $statement->fetch();
                                }                                 

                            }?>" class="bouton_vue_tournoi demi_vue">

                             Demi

                            </a>   
                            <?php if($minuteur){ ?>

                            <button onclick="debutMinuteur(<?php  echo $temps_minuteur; ?>, '<?php echo $equipeGagnante1['nom'] ?>', '<?php echo $equipeGagnante2['nom'] ?>','timer2')" class="boutonTimer">
                            Lancer le minuteur

                            </button>
                            <div id="timer2"></div>
                            <?php } ?>

                            </section>                       

                   <?php } else if($tournoi1->getDiscipline()=="Foot"){ ?>

                    <section class="section_minuteur_vuematch">

                    <a href="/formulaires/saisie_points_foot?idMatch=<?php 

                            for($i=0;$i<count($matchs);$i++){

                                if((($matchs[$i]['idEquipe1']== $idGagnantMatch1 && $matchs[$i]['idEquipe2']== $idGagnantMatch2)||($matchs[$i]['idEquipe1']== $idGagnantMatch2 && $matchs[$i]['idEquipe2']==$idGagnantMatch1)) && $matchs[$i]['matchPoule']==0){

                                    echo $matchs[$i]['idMatch'];
                                    unset($statement);
                                    $statement = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :idEquipe");
                                    $statement->execute(['idEquipe' => $idGagnantMatch1]);
                                    $equipeGagnante1 = $statement->fetch();
                                    $statement->execute(['idEquipe' => $idGagnantMatch2]);
                                    $equipeGagnante2 = $statement->fetch();

                                }                                 

                            }?>" class="bouton_vue_tournoi demi_vue">

                             Demi

                            </a>   
                            <?php if($minuteur){ ?>
                            <button onclick="debutMinuteur(<?php  echo $temps_minuteur; ?>, '<?php echo $equipeGagnante1['nom'] ?>', '<?php echo $equipeGagnante2['nom'] ?>','timer2')" class="boutonTimer">

                            Lancer le minuteur

                            </button> 
                            <div id="timer2"></div> 
                            <?php } ?>
                    </section>

                            <?php } else if($tournoi1->getDiscipline()=="Tennis"){ ?>

                                <section class="section_minuteur_vuematch">

                    <a href="/formulaires/saisie_points_tennis?idMatch=<?php 

                            for($i=0;$i<count($matchs);$i++){

                                if((($matchs[$i]['idEquipe1']== $idGagnantMatch1 && $matchs[$i]['idEquipe2']== $idGagnantMatch2)||($matchs[$i]['idEquipe1']== $idGagnantMatch2 && $matchs[$i]['idEquipe2']==$idGagnantMatch1)) && $matchs[$i]['matchPoule']==0){

                                    echo $matchs[$i]['idMatch'];
                                    unset($statement);
                                    $statement = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :idEquipe");
                                    $statement->execute(['idEquipe' => $idGagnantMatch1]);
                                    $equipeGagnante1 = $statement->fetch();
                                    $statement->execute(['idEquipe' => $idGagnantMatch2]);
                                    $equipeGagnante2 = $statement->fetch();
                                }                                 

                            }?>" class="bouton_vue_tournoi demi_vue">

                             Demi

                            </a>   
                            <?php if($minuteur){ ?>
                            <button onclick="debutMinuteur(<?php  echo $temps_minuteur; ?>, '<?php echo $equipeGagnante1['nom'] ?>', '<?php echo $equipeGagnante2['nom'] ?>','timer2')" class="boutonTimer">

                            Lancer le minuteur

                            </button>  
                            <div id="timer2"></div>
                            <?php } ?>
                                </section>

        <?php } ?>
        <div>
             
             <?php
        if($idGagnant   < 0){
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
        if($idGagnant   < 0){
            echo " ";
        }else{
            $idGagnantMatch3 = $equipeGagnante["idEquipe"];
        ?>
        <img src="<?php echo $equipeGagnante["icones"]?>" />
        <?php if($nbEquSelec >= 4 && $nbEquSelec < 8){echo "<p>".$equipeGagnante["nom"]."</p>";}?>
        <?php 
        }
        ?>


    <?php 
        if($nbEquSelec >= 8){
            unset($getGagnantReq);
    if($sport == "p"){
            $getGagnantReq = $pdo->prepare("SELECT getGagnantPet(:varEqu1,:varEqu2,:varidTournoi,false) as id");
        }elseif($sport == "t"){
            $getGagnantReq = $pdo->prepare("SELECT getGagnantTen(:varEqu1,:varEqu2,:varidTournoi,false) as id");
        }elseif($sport == "f"){
            $getGagnantReq = $pdo->prepare("SELECT getGagnantFoot(:varEqu1,:varEqu2,:varidTournoi,false) as id");
        }else{
            echo "IL Y A UNE ERREUR";
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

        
       

    </div>

    <?php 
        if($idGagnant   < 0){
            echo " ";
        }else{
            $idGagnantMatch4 = $equipeGagnante["idEquipe"];
        }
        if ($tournoi1->getDiscipline()=="Pétanque") { ?>

        <section class="section_minuteur_vuematch">

                            <a href="/formulaires/saisie_points_petanque?idMatch=<?php 

                            for($i=0;$i<count($matchs);$i++){

                                if((($matchs[$i]['idEquipe1']== $idGagnantMatch3 && $matchs[$i]['idEquipe2']== $idGagnantMatch4)||($matchs[$i]['idEquipe1']== $idGagnantMatch4 && $matchs[$i]['idEquipe2']==$idGagnantMatch3)) && $matchs[$i]['matchPoule']==0){

                                    echo $matchs[$i]['idMatch'];
                                    unset($statement);
                                    $statement = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :idEquipe");
                                    $statement->execute(['idEquipe' => $idGagnantMatch3]);
                                    $equipeGagnante3 = $statement->fetch();
                                    $statement->execute(['idEquipe' => $idGagnantMatch4]);
                                    $equipeGagnante4 = $statement->fetch();

                                }                                  

                            }?>" class="bouton_vue_tournoi demi_vue">

                             Demi

                            </a>    
                            <?php if($minuteur){ ?>
                            <button onclick="debutMinuteur(<?php  echo $temps_minuteur; ?>, '<?php echo $equipeGagnante3['nom'] ?>', '<?php echo $equipeGagnante4['nom'] ?>','timer3')" class="boutonTimer">

                            Lancer le minuteur

                            </button>  
                            <div id="timer3"></div>
                            <?php } ?>
        </section>                             

                            <?php } else if($tournoi1->getDiscipline()=="Foot"){ ?>

                                <section class="section_minuteur_vuematch">

                    <a href="/formulaires/saisie_points_foot?idMatch=<?php 

                            for($i=0;$i<count($matchs);$i++){

                                if((($matchs[$i]['idEquipe1']== $idGagnantMatch3 && $matchs[$i]['idEquipe2']== $idGagnantMatch4)||($matchs[$i]['idEquipe1']== $idGagnantMatch4 && $matchs[$i]['idEquipe2']==$idGagnantMatch3)) && $matchs[$i]['matchPoule']==0){

                                    echo $matchs[$i]['idMatch'];
                                    unset($statement);
                                    $statement = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :idEquipe");
                                    $statement->execute(['idEquipe' => $idGagnantMatch3]);
                                    $equipeGagnante3 = $statement->fetch();
                                    $statement->execute(['idEquipe' => $idGagnantMatch4]);
                                    $equipeGagnante4 = $statement->fetch();
                                }                                

                            }?>" class="bouton_vue_tournoi demi_vue">

                             Demi

                            </a>   
                            <?php if($minuteur){ ?>
                            <button onclick="debutMinuteur(<?php  echo $temps_minuteur; ?>, '<?php echo $equipeGagnante3['nom'] ?>', '<?php echo $equipeGagnante4['nom'] ?>','timer3')" class="boutonTimer">

                            Lancer le minuteur

                            </button>   
                            <div id="timer3"></div> 
                            <?php } ?>
                                </section>

                            <?php } else if($tournoi1->getDiscipline()=="Tennis"){ ?>

                                <section class="section_minuteur_vuematch">

                    <a href="/formulaires/saisie_points_tennis?idMatch=<?php 

                            for($i=0;$i<count($matchs);$i++){

                                if((($matchs[$i]['idEquipe1']== $idGagnantMatch3 && $matchs[$i]['idEquipe2']== $idGagnantMatch4)||($matchs[$i]['idEquipe1']== $idGagnantMatch4 && $matchs[$i]['idEquipe2']==$idGagnantMatch3)) && $matchs[$i]['matchPoule']==0){

                                    echo $matchs[$i]['idMatch'];
                                    unset($statement);
                                    $statement = $pdo->prepare("SELECT * FROM Equipes WHERE idEquipe = :idEquipe");
                                    $statement->execute(['idEquipe' => $idGagnantMatch3]);
                                    $equipeGagnante3 = $statement->fetch();
                                    $statement->execute(['idEquipe' => $idGagnantMatch4]);
                                    $equipeGagnante4 = $statement->fetch();
                                }                               

                            }?>" class="bouton_vue_tournoi demi_vue">

                             Demi

                            </a>   
                            <?php if($minuteur){ ?>
                            <button onclick="debutMinuteur(<?php  echo $temps_minuteur; ?>, '<?php echo $equipeGagnante3['nom'] ?>', '<?php echo $equipeGagnante4['nom'] ?>','timer3')" class="boutonTimer">

                            Lancer le minuteur

                            </button>
                            <div id="timer3"></div>
                            <?php } ?>
                                </section>    

        <?php } ?>

        <div>
    <?php
        if($idGagnant   < 0){
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