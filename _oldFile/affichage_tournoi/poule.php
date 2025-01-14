<?php 

$urlactive = $_SERVER["PHP_SELF"];
if($urlactive == "/affichage_tournoi/poule.php"){
    header('Location: /index');
  } ?>
  <?php
    $vraiQualif = $qualif;
    $vraiQualif = array_splice($vraiQualif,0,$nbEquSelec);
  ?>
  <!-- Affichage des poules -->
  <div class="poule">
<a href="/affichage_tournoi/affichage_poules?idTournoi=<?php echo $idTournoi; ?>" class="lien_affichage_poules">
    <ul class="liste_poule">
        
        
        <li class="equipe_poule">
            <p> <?php if ($equipe1) echo $equipe1["nom"]; ?> </p> 
            <img src="<?php if ($equipe1) echo $equipe1["icones"]; ?>" class="icone_poule"/> <?php $cpt = 1;

            foreach ($vraiQualif as $equipeP) {
                
                if ($equipeP && $equipe1) {
                    if ($equipeP["idEquipe"] == $equipe1["idEquipe"]) {
                        echo "<img src=/icones/etoile.svg class=icone_etoile> ";
                    }
                }

                
                if($nbEquSelec > 8 && $cpt >= 8){
                    break;
                }elseif($nbEquSelec < 8 && $nbEquSelec>=4 && $cpt >= 4){
                    break;
                }
                elseif($nbEquSelec < 4 &&  $cpt >= 2){
                    break;
                }
                $cpt++;
            }
                ?>
        </li>
        <li class="equipe_poule">
            <p> <?php if ($equipe2) echo $equipe2["nom"]; ?> </p> 
            <img src="<?php if ($equipe2) echo $equipe2["icones"]; ?>" class="icone_poule"/> <?php $cpt = 1;foreach ($vraiQualif as $equipeP) {
                
                if ($equipeP && $equipe2) {
                    if ($equipeP["idEquipe"] == $equipe2["idEquipe"]) {
                        echo "<img src=/icones/etoile.svg class=icone_etoile> ";
                    }
                }

                
                if($nbEquSelec > 8 && $cpt >= 8){
                    break;
                }elseif($nbEquSelec < 8 && $nbEquSelec>=4 && $cpt >= 4){
                    break;
                }
                elseif($nbEquSelec < 4 &&  $cpt >= 2){
                    break;
                }
                $cpt++;
            }
                ?>
        </li>
        <li class="equipe_poule">
            <p> <?php if ($equipe3) echo $equipe3["nom"]; ?> </p> 
            <img src="<?php if ($equipe3) echo $equipe3["icones"]; ?>" class="icone_poule"/> <?php $cpt = 1;foreach ($vraiQualif as $equipeP) {
                if ($equipeP && $equipe3) {
                    if ($equipeP["idEquipe"] == $equipe3["idEquipe"]) {
                        echo "<img src=/icones/etoile.svg class=icone_etoile> ";
                    }
                }
                
                if($nbEquSelec > 8 && $cpt >= 8){
                    break;
                }elseif($nbEquSelec < 8 && $nbEquSelec>=4 && $cpt >= 4){
                    break;
                }
                elseif($nbEquSelec < 4 &&  $cpt >= 2){
                    break;
                }
                $cpt++;
            }  ?>
        </li>
        <li class="equipe_poule">
            <p> <?php if ($equipe4) echo $equipe4["nom"]; ?> </p> 
            <img src="<?php if ($equipe4) echo $equipe4["icones"]; ?>" class="icone_poule"/> <?php $cpt = 1;foreach ($vraiQualif as $equipeP) {
                if ($equipeP && $equipe4) {
                    if ($equipeP["idEquipe"] == $equipe4["idEquipe"]) {
                        echo "<img src=/icones/etoile.svg class=icone_etoile> ";
                    }
                }
                
                if($nbEquSelec > 8 && $cpt >= 8){
                    break;
                }elseif($nbEquSelec < 8 && $nbEquSelec>=4 && $cpt >= 4){
                    break;
                }
                elseif($nbEquSelec < 4 &&  $cpt >= 2){
                    break;
                }
                $cpt++;
            }  ?>
        </li>
        <li class="equipe_poule">
            <p> <?php if ($equipe5) echo $equipe5["nom"]; ?> </p> 
            <img src="<?php if ($equipe5) echo $equipe5["icones"]; ?>" class="icone_poule"/> <?php $cpt = 1;foreach ($vraiQualif as $equipeP) {
                if ($equipeP && $equipe5) {
                    if ($equipeP["idEquipe"] == $equipe5["idEquipe"]) {
                        echo "<img src=/icones/etoile.svg class=icone_etoile> ";
                    }
                }
                
                if($nbEquSelec > 8 && $cpt >= 8){
                    break;
                }elseif($nbEquSelec < 8 && $nbEquSelec>=4 && $cpt >= 4){
                    break;
                }
                elseif($nbEquSelec < 4 &&  $cpt >= 2){
                    break;
                }
                $cpt++;
            }  ?>
        </li>
        <li class="equipe_poule">
            <p> <?php if ($equipe6) echo $equipe6["nom"]; ?> </p> 
            <img src="<?php if ($equipe6) echo $equipe6["icones"]; ?>" class="icone_poule" /> <?php $cpt = 1;foreach ($vraiQualif as $equipeP) {
                if ($equipeP && $equipe6) {
                    if ($equipeP["idEquipe"] == $equipe6["idEquipe"]) {
                        echo "<img src=/icones/etoile.svg class=icone_etoile> ";
                    }
                }
                if($nbEquSelec > 8 && $cpt >= 8){
                    break;
                }elseif($nbEquSelec < 8 && $nbEquSelec>=4 && $cpt >= 4){
                    break;
                }
                elseif($nbEquSelec < 4 &&  $cpt >= 2){
                    break;
                }
                $cpt++;
            }  ?>
        </li>
    </ul>
        </a>
</div>