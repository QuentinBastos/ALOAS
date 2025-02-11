<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$urlactive = $_SERVER["PHP_SELF"];
if($urlactive == "/affichage_tournoi/etage_quart_vue.php"){
    header('Location: /index');
  } ?>
<div class="barres_quart_container">
    <section class="barres_quart"></section>
    <section class="barres_quart"></section>
    <section class="barres_quart"></section>
    <section class="barres_quart"></section>
</div>
<div class="icones_etage1">
    <div>
        <img src="<?php echo $qualif[0]["icones"] ?>" />
        <p> <?php echo $qualif[0]["nom"] ?> </p>
    </div>
    <!-- affichage des boutons vers la vue du match -->
    <?php if ($tournoi1->getDiscipline()=="Pétanque") { ?>
                            <a href="/affichage_tournoi/match_petanque?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[0]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[7]['idEquipe']) || ($matchs[$i]['idEquipe1']== $qualif[7]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[0]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                 
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a>                                 
                   <?php } else if ($tournoi1->getDiscipline() == "Foot"){ ?>
                    <a href="/affichage_tournoi/match_foot?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[0]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[7]['idEquipe']) || ($matchs[$i]['idEquipe1']== $qualif[7]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[0]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                 
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a> 
                     <?php } else if($tournoi1->getDiscipline()=="Tennis"){  ?>
                        <a href="/affichage_tournoi/match_tennis?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[0]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[7]['idEquipe']) || ($matchs[$i]['idEquipe1']== $qualif[7]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[0]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                 
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a> 
                        <?php }  ?>
    <div>
        <img src="<?php echo $qualif[7]["icones"] ?>" />
        <p> <?php echo $qualif[7]["nom"] ?> </p>
    </div>

    <div>
        <img src="<?php echo $qualif[1]["icones"] ?>" />
        <p> <?php echo $qualif[1]["nom"] ?> </p>
    </div>
    <?php if ($tournoi1->getDiscipline()=="Pétanque") { ?>
                            <a href="/affichage_tournoi/match_petanque?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[1]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[6]['idEquipe']) || ($matchs[$i]['idEquipe1']== $qualif[6]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[1]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                 
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a>                                 
                            <?php } else if ($tournoi1->getDiscipline() == "Foot"){ ?>
                    <a href="/affichage_tournoi/match_foot?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[1]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[6]['idEquipe']) || ($matchs[$i]['idEquipe1']== $qualif[6]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[1]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                 
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a> 
                     <?php } else if($tournoi1->getDiscipline()=="Tennis"){  ?>
                        <a href="/affichage_tournoi/match_tennis?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[1]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[6]['idEquipe']) || ($matchs[$i]['idEquipe1']== $qualif[6]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[1]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                 
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a> 
                        <?php }  ?>
    <div>
        <img src="<?php echo $qualif[6]["icones"] ?>" />
        <p> <?php echo $qualif[6]["nom"] ?> </p>
    </div>

    <div>
        <img src="<?php echo $qualif[2]["icones"] ?>" />
        <p> <?php echo $qualif[2]["nom"] ?> </p>
    </div>
    <?php if ($tournoi1->getDiscipline()=="Pétanque") { ?>
                            <a href="/affichage_tournoi/match_petanque?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[2]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[5]['idEquipe']) || ($matchs[$i]['idEquipe1']== $qualif[5]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[2]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                 
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a>                                    
                            <?php } else if ($tournoi1->getDiscipline() == "Foot"){ ?>
                    <a href="/affichage_tournoi/match_foot?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[2]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[5]['idEquipe']) || ($matchs[$i]['idEquipe1']== $qualif[5]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[2]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                 
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a> 
                     <?php } else if($tournoi1->getDiscipline()=="Tennis"){  ?>
                        <a href="/affichage_tournoi/match_tennis?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[2]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[5]['idEquipe']) || ($matchs[$i]['idEquipe1']== $qualif[5]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[2]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                 
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a> 
                        <?php }  ?>
    <div>
        <img src="<?php echo $qualif[5]["icones"] ?>" />
        <p> <?php echo $qualif[5]["nom"] ?> </p>
    </div>

    <div>
        <img src="<?php echo $qualif[3]["icones"] ?>" />
        <p> <?php echo $qualif[3]["nom"] ?> </p>
    </div>
    <?php if ($tournoi1->getDiscipline()=="Pétanque") { ?>
                            <a href="/affichage_tournoi/match_petanque?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[3]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[4]['idEquipe']) || ($matchs[$i]['idEquipe1']== $qualif[4]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[3]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                 
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a>                                 
                            <?php } else if ($tournoi1->getDiscipline() == "Foot"){ ?>
                    <a href="/affichage_tournoi/match_foot?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[3]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[4]['idEquipe']) || ($matchs[$i]['idEquipe1']== $qualif[4]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[3]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                 
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a> 
                     <?php } else if($tournoi1->getDiscipline()=="Tennis"){  ?>
                        <a href="/affichage_tournoi/match_tennis?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[3]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[4]['idEquipe']) || ($matchs[$i]['idEquipe1']== $qualif[4]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[3]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                 
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a> 
                        <?php }  ?>
    <div>
        <img src="<?php echo $qualif[4]["icones"] ?>" />
        <p> <?php echo $qualif[4]["nom"] ?></p>
    </div>
</div>