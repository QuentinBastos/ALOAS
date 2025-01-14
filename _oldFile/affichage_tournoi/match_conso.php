<?php 
session_start();
$urlactive = $_SERVER["PHP_SELF"];
if($urlactive == "/affichage_tournoi/match_conso"){
    header('Location: /index');
  } ?>
  <!-- Affichage d'un match de consolante -->
<?php if(!$_SESSION['connecté']){ ?>
<div class="match_conso"> 
<?php }else{ ?>
    <div class="match_conso_admin"> 
    <?php } ?>

    
    <h4> Match <?php echo $cptConso; ?></h4>
    <div class="match_conso_infos">
        <div class="vs_conso">
            <img src=<?php echo $equipeConso1["icones"]; ?> >
            <div>VS</div>
            <img src=<?php echo $equipeConso2["icones"]; ?> >
        </div>
        <?php if(!$_SESSION['connecté'] || $titre == "vueTournoi"){ ?>
            <p> <?php echo $pointsEquipe1Conso; ?> </p>
            <div> - </div>
            <p> <?php echo $pointsEquipe2Conso; ?> </p>
        </div>
        <?php } ?>
    
</div>