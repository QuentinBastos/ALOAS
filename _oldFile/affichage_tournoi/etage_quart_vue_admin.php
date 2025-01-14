<?php 

$urlactive = $_SERVER["PHP_SELF"];
if($urlactive == "/affichage_tournoi/etage_quart_vue_admin.php"){
    header('Location: /index');
  } 

  ?>
<div class="barres_quart_container_vueadmin">
    <section class="barres_quart_vueadmin"></section>
    <section class="barres_quart_vueadmin"></section>
    <section class="barres_quart_vueadmin"></section>
    <section class="barres_quart_vueadmin"></section>
</div>

<div class="icones_etage1">
    <div>
        <img src="<?php echo $qualif[0]["icones"] ?>" />
        <p> <?php echo $qualif[0]["nom"] ?> </p>
    </div>
    <!-- Bouton pour accéder à la page de saisie des points -->
    <?php if ($tournoi1->getDiscipline()=="Pétanque") { ?>
        <section class="section_minuteur_vuematch">
                            <a href="/formulaires/saisie_points_petanque?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[0]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[7]['idEquipe'])|| ($matchs[$i]['idEquipe1']== $qualif[7]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[0]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                 
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a>     
                            <?php if($minuteur){ ?>
                            <button onclick="debutMinuteur(<?php echo $temps_minuteur; ?>, '<?php echo $qualif[0]['nom'] ?>', '<?php echo $qualif[7]['nom'] ?>','timer4')" class="boutonTimer">
                            Lancer le minuteur
                            </button>  
                            <div id="timer4"></div> 
                            <?php } ?>
        </section>                             
                            <?php } else if($tournoi1->getDiscipline()=="Foot"){ ?>
                                <section class="section_minuteur_vuematch">
                    <a href="/formulaires/saisie_points_foot?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[0]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[7]['idEquipe'])|| ($matchs[$i]['idEquipe1']== $qualif[7]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[0]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a> 
                            <?php if($minuteur){ ?>
                            <button onclick="debutMinuteur(<?php echo $temps_minuteur; ?>, '<?php echo $qualif[0]['nom'] ?>', '<?php echo $qualif[7]['nom'] ?>','timer4')" class="boutonTimer">
                            Lancer le minuteur
                            </button>  
                            <div id="timer4"></div>
                            <?php } ?>
                                </section>
                     <?php } else if($tournoi1->getDiscipline()=="Tennis"){  ?>
                        <section class="section_minuteur_vuematch">
                        <a href="/formulaires/saisie_points_tennis?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[0]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[7]['idEquipe'])|| ($matchs[$i]['idEquipe1']== $qualif[7]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[0]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a> 
                            <?php if($minuteur){ ?>
                            <button onclick="debutMinuteur(<?php echo $temps_minuteur; ?>, '<?php echo $qualif[0]['nom'] ?>', '<?php echo $qualif[7]['nom'] ?>','timer4')" class="boutonTimer">
                            Lancer le minuteur
                            </button> 
                            <div id="timer4"></div>
                            <?php } ?>
                        </section>
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
        <section class="section_minuteur_vuematch">
                            <a href="/formulaires/saisie_points_petanque?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[1]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[6]['idEquipe'])|| ($matchs[$i]['idEquipe1']== $qualif[6]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[1]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                 
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a>      
                            <?php if($minuteur){ ?>
                            <button onclick="debutMinuteur(<?php echo $temps_minuteur; ?>, '<?php echo $qualif[1]['nom'] ?>', '<?php echo $qualif[6]['nom'] ?>','timer5')" class="boutonTimer">
                            Lancer le minuteur
                            </button>  
                            <div id="timer5"></div>
                            <?php } ?> 
        </section>                             
                            <?php } else if($tournoi1->getDiscipline()=="Foot"){ ?>
                                <section class="section_minuteur_vuematch">
                    <a href="/formulaires/saisie_points_foot?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[1]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[6]['idEquipe'])|| ($matchs[$i]['idEquipe1']== $qualif[6]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[1]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a> 
                            <?php if($minuteur){ ?>
                            <button onclick="debutMinuteur(<?php echo $temps_minuteur; ?>, '<?php echo $qualif[1]['nom'] ?>', '<?php echo $qualif[6]['nom'] ?>','timer5')" class="boutonTimer">
                            Lancer le minuteur
                            </button>  
                            <div id="timer5"></div>
                            <?php } ?>
                                </section>
                     <?php } else if($tournoi1->getDiscipline()=="Tennis"){  ?>
                        <section class="section_minuteur_vuematch">
                        <a href="/formulaires/saisie_points_tennis?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[1]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[6]['idEquipe'])|| ($matchs[$i]['idEquipe1']== $qualif[6]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[1]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                 
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a> 
                            <?php if($minuteur){ ?>
                            <button onclick="debutMinuteur(<?php echo $temps_minuteur; ?>, '<?php echo $qualif[1]['nom'] ?>', '<?php echo $qualif[6]['nom'] ?>','timer5')" class="boutonTimer">
                            Lancer le minuteur
                            </button> 
                            <div id="timer5"></div>
                            <?php } ?>
                        </section>
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
        <section class="section_minuteur_vuematch">
                            <a href="/formulaires/saisie_points_petanque?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[2]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[5]['idEquipe'])|| ($matchs[$i]['idEquipe1']== $qualif[5]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[2]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                 
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a> 
                            <?php if($minuteur){ ?>
                            <button onclick="debutMinuteur(<?php echo $temps_minuteur; ?>, '<?php echo $qualif[2]['nom'] ?>', '<?php echo $qualif[5]['nom'] ?>')" class="boutonTimer">
                            Lancer le minuteur
                            </button>
                            <div id="timer6"></div> 
                            <?php } ?>
        </section>                                      
                   <?php } else if($tournoi1->getDiscipline()=="Foot"){ ?>
                    <section class="section_minuteur_vuematch">
                    <a href="/formulaires/saisie_points_foot?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[2]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[5]['idEquipe'])|| ($matchs[$i]['idEquipe1']== $qualif[5]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[2]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a> 
                            <?php if($minuteur){ ?>
                            <button onclick="debutMinuteur(<?php echo $temps_minuteur; ?>, '<?php echo $qualif[2]['nom'] ?>', '<?php echo $qualif[5]['nom'] ?>','timer6')" class="boutonTimer">
                            Lancer le minuteur
                            </button>  
                            <div id="timer6"></div>
                            <?php } ?>
                    </section>
                     <?php } else if($tournoi1->getDiscipline()=="Tennis"){  ?>
                        <section class="section_minuteur_vuematch">
                        <a href="/formulaires/saisie_points_tennis?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[2]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[5]['idEquipe'])|| ($matchs[$i]['idEquipe1']== $qualif[5]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[2]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                 
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a> 
                            <?php if($minuteur){ ?>
                            <button onclick="debutMinuteur(<?php echo $temps_minuteur; ?>, '<?php echo $qualif[2]['nom'] ?>', '<?php echo $qualif[5]['nom'] ?>','timer6')" class="boutonTimer">
                            Lancer le minuteur
                            </button> 
                            <div id="timer6"></div>
                            <?php } ?>
                        </section>
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
        <section class="section_minuteur_vuematch">
                            <a href="/formulaires/saisie_points_petanque?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[3]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[4]['idEquipe'])|| ($matchs[$i]['idEquipe1']== $qualif[4]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[3]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                 
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a>  
                            <?php if($minuteur){ ?>    
                                <button onclick="debutMinuteur(<?php echo $temps_minuteur; ?>, '<?php echo $qualif[3]['nom'] ?>', '<?php echo $qualif[4]['nom'] ?>','timer7')" class="boutonTimer">
                            Lancer le minuteur
                            </button>   
                            <div id="timer7"></div>
                            <?php } ?>
        </section>                             
                            <?php } else if($tournoi1->getDiscipline()=="Foot"){ ?>
                                <section class="section_minuteur_vuematch">
                    <a href="/formulaires/saisie_points_foot?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[3]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[4]['idEquipe'])|| ($matchs[$i]['idEquipe1']== $qualif[4]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[3]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a> 
                            <?php if($minuteur){ ?>
                                <button onclick="debutMinuteur(<?php echo $temps_minuteur; ?>, '<?php echo $qualif[3]['nom'] ?>', '<?php echo $qualif[4]['nom'] ?>','timer7')" class="boutonTimer">
                            Lancer le minuteur
                            </button>  
                            <div id="timer7"></div>
                            <?php } ?>
                                </section>
                     <?php } else if($tournoi1->getDiscipline()=="Tennis"){  ?>
                        <section class="section_minuteur_vuematch">
                        <a href="/formulaires/saisie_points_tennis?idMatch=<?php 
                            for($i=0;$i<count($matchs);$i++){
                                if((($matchs[$i]['idEquipe1']== $qualif[3]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[4]['idEquipe'])|| ($matchs[$i]['idEquipe1']== $qualif[4]['idEquipe'] && $matchs[$i]['idEquipe2']==$qualif[3]['idEquipe'])) && $matchs[$i]['matchPoule']==0){
                                    echo $matchs[$i]['idMatch'];
                                }                                 
                            }?>" class="bouton_vue_tournoi quart_vue">
                             Quart
                            </a> 
                            <?php if($minuteur){ ?>
                            <button onclick="debutMinuteur(<?php echo $temps_minuteur; ?>, '<?php echo $qualif[3]['nom'] ?>', '<?php echo $qualif[4]['nom'] ?>','timer7')" class="boutonTimer">
                            Lancer le minuteur
                            </button> 
                            <div id="timer7"></div>
                            <?php } ?>
                            
                        </section>
                        <?php }  ?>
    <div>
        <img src="<?php echo $qualif[4]["icones"] ?>" />
        <p> <?php echo $qualif[4]["nom"] ?></p>
    </div>
</div>