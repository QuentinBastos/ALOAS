<?php


include_once ROOT. "/classes/classe_tournoi.php";
include_once ROOT. "/classes/classe_equipe.php";
$titre="Organiser tournoi";
include ROOT . "/modules/header.php"; 
?>

<html lang="fr">
<body>
<?php 





if (!isset($_SESSION['TestTournoi'])||$_SESSION['pageTournoiDejaVisite']===true){
    $_SESSION['TestTournoi'] = new Tournoi(0,"testTournoi","lieu","sport");
    $TestTournoi=$_SESSION['TestTournoi'];
    $_SESSION['dejala']=false;
    $_SESSION['pageTournoiDejaVisite']=true;
} 



if(isset($_SESSION['creer'])){

    $TestTournoi=$_SESSION['TestTournoi'];

    if($_SESSION['stock_icones_alt']!=0){
        $equipe = new Equipe(0,$_SESSION['stock_nom_cr'], $_SESSION['stock_icones_chemin'], $_SESSION['stock_icones_alt'], 0, 0,0);
    }
    
    for($i=0; $i<$TestTournoi->getNbEquipes(); $i++){
        if($equipe->getNom()===$TestTournoi->getEquipe($i)->getNom()){
            $_SESSION['dejala']=true;
        }
    }

    if($_SESSION['dejala']===false && $_SESSION['stock_nom_cr']!=NULL && $TestTournoi->getNbEquipes()<=21 && $_SESSION['stock_icones_alt']!=0){
        $TestTournoi->ajoutEquipe($equipe);

    }
    
} 

?>


<main>
    
    <form id="FormOrganiser" action="/formulaires/initTournoi_form" method="post">
        <div id="admin_rect_orga"><!-- id du div du rectangle noir en interface administrateur  -->
            <div class="nom_lieu_tourn">
                <div class="element_lieu">
                    <input id="ID" type="text" name="nomTournoi" class="taille_input_form" placeholder="Entrer le nom du tournoi">
                    <div class="barre_classe_orga"></div>
                </div>
                <div class="element_lieu">
                    <input id="lieuTournoi" type="text" name="lieuTournoi" class="taille_input_form" placeholder="Entrer le lieu du tournoi">
                    <div class="barre_classe_orga"></div>
                </div>
            </div>
            <div id="choisir_sport">
                <label id="label_sport" for="sport">Choisir un sport :</label>
                <select name="sport" size="1">
                    <option value="Pétanque">Pétanque
                    <option value="Tennis"> Tennis
                    <option value="Foot"> Football
                </select>
            </div>
            
            <div id="tableau_et_bouton">
                <div class="tableau_orga">
                    <table>
                        <tbody>
                            <tr>
                                <th>Numéro</th>
                                <th>Icône</th>
                                <th>Nom de l'équipe</th>
                                <th>Supprimer équipe</th>
                            </tr>
                            <?php
                                for($i=0;$i<$TestTournoi->getNbEquipes();$i++){
                                    $id=$i+1;
                                    echo "<tr><td>".$id."</td>";
                                    echo "<td><img src=\"".$TestTournoi->getEquipe($i)->getCheminIcone()."\"></td>";
                                    echo "<td>".$TestTournoi->getEquipe($i)->getNom()."</td>";
                                    echo "<td><a href=\"/organiser/supprEqu?id=".$i."\" ><img src=\"/img/cross.svg\" class=\"croixRouge\"></td></tr>";
                                } 
                            ?>
                        </tbody>
                    </table>
                </div>

                <div id="bouton_orga">
                    <div id="btnOuvrCreeEqui" class="bouton_orga">Créer une nouvelle équipe</div>
                    
                </div>
            </div>
            <div id="modalites">  
                <label id="label_modal" for="modal">Modalités de victoire :</label>
                <input type="checkbox" name="modal" value="temps" id = "modal" onChange=affiche_bloc(modal)> Ajouter chrono
                <div id="orga_caché">
                    <label  for="modal_temps" >Donner le temps d'une manche en minutes
                    <input id="label_temps" type="number" name="modal_temps" min="1" max="99" step="1">
                </div> 
                   
            </div>
            <button class="glow-on-hover" type=”submit” >Créer tournoi</button>  
        </div>
    </form>

    <dialog id="popUpCreeEqui" class="popUpEqui">
        <div id="btnFermCreeEqui" class="btnFermEqui">Fermer</div>
        <div id="form_creeEqu">
            <form  action="/formulaires/creerEquipes_form" method="post">
            <!-- Liste des icônes -->
                <div id="creer_equipes">
                    <label id="label_equipes" for="tableauTest">Choisir un logo :</label>
                    <div id="listeIcones"> 
                        
                        <div class="autourIconesListe">
                        <input type="radio" name="icones_liste" class="inputCreaEqui" value=1 id="icone_fourmis_1" required/>

<label for="icone_fourmis_1"><img class ="iconeListeOrga"src="/icones/fourmi.svg" alt="Icône de fourmis"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=2 id="icone_ours_2" required/>

<label for="icone_ours_2"><img class ="iconeListeOrga"src="/icones/ours.svg" alt="Icône d'Ours'"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=3 id="icone_oiseau_3" required/>

<label for="icone_oiseau_3"><img class ="iconeListeOrga"src="/icones/oiseau.svg" alt="Icône d'oiseau"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=4 id="icone_papillon_4" required/>

<label for="icone_papillon_4"><img class ="iconeListeOrga"src="/icones/papillon.svg" alt="Icône de papillon"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=5 id="icone_chat_5" required/>

<label for="icone_chat_5"><img class ="iconeListeOrga"src="/icones/chat.svg" alt="Icône de chat"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=6 id="icone_vache_6" required/>

<label for="icone_vache_6"><img class ="iconeListeOrga"src="/icones/vache.svg" alt="Icône de vache"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=7 id="icone_crocodile_7" required/>

<label for="icone_crocodile_7"><img class ="iconeListeOrga"src="/icones/crocodile.svg" alt="Icône de crocodile"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=8 id="icone_chien_8" required/>

<label for="icone_chien_8"><img class ="iconeListeOrga"src="/icones/chien.svg" alt="Icône de chien"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=9 id="icone_canard_9" required/>

<label for="icone_canard_9"><img class ="iconeListeOrga"src="/icones/canard.svg" alt="Icône de canard"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=10 id="icone_elephant_10" required/>

<label for="icone_elephant_10"><img class ="iconeListeOrga"src="/icones/elephant.svg" alt="Icône d'elephants'"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=11 id="icone_poisson_11" required/>

<label for="icone_poisson_11"><img class ="iconeListeOrga"src="/icones/poisson.svg" alt="Icône de poisson'"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=12 id="icone_girafe_12" required/>

<label for="icone_girafe_12"><img class ="iconeListeOrga"src="/icones/girafe.svg" alt="Icône de girafe"/></label>

</div>

<div margin: 3%; class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=13 id="icone_hérisson_13" required/>

<label for="icone_hérisson_13"><img class ="iconeListeOrga"src="/icones/herisson.svg" alt="Icône de hérisson"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=14 id="icone_abeille_14" required/>

<label for="icone_abeille_14"><img class ="iconeListeOrga"src="/icones/abeille.svg" alt="Icône d'abeille'"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=15 id="icone_cheval_15" required/>

<label for="icone_cheval_15"><img class ="iconeListeOrga"src="/icones/chevaux.svg" alt="Icône de cheval'"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=16 id="icone_singe_16" required/>

<label for="icone_singe_16"><img class ="iconeListeOrga"src="/icones/singe.svg" alt="Icône de singe'"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=17 id="icone_souris_17" required/>

<label for="icone_souris_17"><img class ="iconeListeOrga"src="/icones/souris.svg" alt="Icône de souris'"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=18 id="icone_pingouin_18" required/>

<label for="icone_pingouin_18"><img class ="iconeListeOrga"src="/icones/manchot.svg" alt="Icône de pingouin"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=19 id="icone_cochon_19" required/>

<label for="icone_cochon_19"><img class ="iconeListeOrga"src="/icones/cochon.svg" alt="Icône de cochon"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=20 id="icone_lapin_20" required/>

<label for="icone_lapin_20"><img class ="iconeListeOrga"src="/icones/lapin.svg" alt="Icône de lapin'"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=21 id="icone_coq_21" required/>

<label for="icone_coq_21"><img class ="iconeListeOrga"src="/icones/coq.svg" alt="Icône de coq"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=22 id="icone_mouton_22" required/>

<label for="icone_mouton_22"><img class ="iconeListeOrga"src="/icones/mouton.svg" alt="Icône de mouton"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=23 id="icone_serpent_23" required/>

<label for="icone_serpent_23"><img class ="iconeListeOrga"src="/icones/serpent.svg" alt="Icône de serpent"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=24 id="icone_araignée_24"required/>

<label for="icone_araignée_24"><img class ="iconeListeOrga"src="/icones/araignee.svg" alt="Icône d'araignée"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=25 id="icone_tortue_25" required/>

<label for="icone_tortue_25"><img class ="iconeListeOrga"src="/icones/tortue.svg" alt="Icône de tortue"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=26 id="icone_aigle_26" required/>

<label for="icone_aigle_26"><img class ="iconeListeOrga"src="/icones/aigle.svg" alt="Icône d'aigle'"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=27 id="icone_baleine_27" required/>

<label for="icone_baleine_27"><img class ="iconeListeOrga"src="/icones/baleine.svg" alt="Icône de baleine"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=28 id="icone_castor_28" required/>

<label for="icone_castor_28"><img class ="iconeListeOrga"src="/icones/castor.svg" alt="Icône de castor"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=29 id="icone_cerf_29" required/>

<label for="icone_cerf_29"><img class ="iconeListeOrga"src="/icones/cerf.svg" alt="Icône de cerf"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=30 id="icone_chameau_30" required/>

<label for="icone_chameau_30"><img class ="iconeListeOrga"src="/icones/chameau.svg" alt="Icône de chameau"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=31 id="icone_chauve_souris_31" required/>

<label for="icone_chauve_souris_31"><img class ="iconeListeOrga"src="/icones/chauve_souris.svg" alt="Icône de chauve-souris"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=32 id="icone_chenille_32" required/>

<label for="icone_chenille_32"><img class ="iconeListeOrga"src="/icones/chenille.svg" alt="Icône de chenille"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=33 id="icone_crabe_33" required/>

<label for="icone_crabe_33"><img class ="iconeListeOrga"src="/icones/crabe.svg" alt="Icône de crabe"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=34 id="icone_escargot_34" required/>

<label for="icone_escargot_34"><img class ="iconeListeOrga"src="/icones/escargot.svg" alt="Icône d'escargot"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=35 id="icone_flammant_rose_35" required/>

<label for="icone_flammant_rose_35"><img class ="iconeListeOrga"src="/icones/flammant_rose.svg" alt="Icône de flammant rose"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=36 id="icone_hibou_36" required/>

<label for="icone_hibou_36"><img class ="iconeListeOrga"src="/icones/hibou.svg" alt="Icône de hibou"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=37 id="icone_koala_37" required/>

<label for="icone_koala_37"><img class ="iconeListeOrga"src="/icones/koala.svg" alt="Icône de koala"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=38 id="icone_lezard_38" required/>

<label for="icone_lezard_38"><img class ="iconeListeOrga"src="/icones/lezard.svg" alt="Icône de lezard"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=39 id="icone_loutre_39" required/>

<label for="icone_loutre_39"><img class ="iconeListeOrga"src="/icones/loutre.svg" alt="Icône de loutre"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=40 id="icone_mammouth_40" required/>

<label for="icone_mammouth_40"><img class ="iconeListeOrga"src="/icones/mammouth.svg" alt="Icône de mammouth"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=41 id="icone_meduse_41" required/>

<label for="icone_meduse_41"><img class ="iconeListeOrga"src="/icones/meduse.svg" alt="Icône de meduse"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=42 id="icone_moustique_42" required/>

<label for="icone_moustique_42"><img class ="iconeListeOrga"src="/icones/moustique.svg" alt="Icône de moustique"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=43 id="icone_perroquet_43" required/>

<label for="icone_perroquet_43"><img class ="iconeListeOrga"src="/icones/perroquet.svg" alt="Icône de perroquet"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=44 id="icone_phoque_44" required/>

<label for="icone_phoque_44"><img class ="iconeListeOrga"src="/icones/phoque.svg" alt="Icône de phoque"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=45 id="icone_pieuvre_45" required/>

<label for="icone_pieuvre_45"><img class ="iconeListeOrga"src="/icones/pieuvre.svg" alt="Icône de pieuvre"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=46 id="icone_requin_46" required/>

<label for="icone_requin_46"><img class ="iconeListeOrga"src="/icones/requin.svg" alt="Icône de requin"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=47 id="icone_rhinoceros_47" required/>

<label for="icone_rhinoceros_47"><img class ="iconeListeOrga"src="/icones/rhinoceros.svg" alt="Icône de rhinoceros"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=48 id="icone_scarabee_48" required/>

<label for="icone_scarabee_48"><img class ="iconeListeOrga"src="/icones/scarabee.svg" alt="Icône de scarabée"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=49 id="icone_tigre_49" required/>

<label for="icone_tigre_49"><img class ="iconeListeOrga"src="/icones/tigre.svg" alt="Icône de tigre"/></label>

</div>

<div class="autourIconesListe">

<input type="radio" name="icones_liste" class="inputCreaEqui" value=50 id="icone_ver_50" required/>

<label for="icone_ver_50"><img class ="iconeListeOrga"src="/icones/ver.svg" alt="Icône de ver"/></label>

</div>
                    </div>    
                </div>
                            </div>
                <div id="flex_creer_tourn">
                    <input id="nomEqu" type="text" name="nomEquipe" class="taille_input_form" placeholder="Entrer le nom de l'équipe">
                    <button type=”submit” id="bouton_ajoutEquipe">Créer une équipe</button>
                </div>
            </form>
        
    </dialog>

</main>
<?php include ROOT . "/modules/footer.php"; ?>
</body>

</html>
