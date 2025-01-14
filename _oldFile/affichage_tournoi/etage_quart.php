<?php 
$urlactive = $_SERVER["PHP_SELF"];
if($urlactive == "/affichage_tournoi/etage_quart.php"){
    header('Location: /index');
  } ?>
  
<div class="barres_quart_container">
    <section class="barres_quart"></section>
    <section class="barres_quart"></section>
    <section class="barres_quart"></section>
    <section class="barres_quart"></section>
</div>
<!-- Affichage des 8 équipes séléctionnées-->
<div class="icones_etage1">
    <div>
        <img src="<?php echo $qualif[0]["icones"] ?>" />
    </div>
    <div>
        <img src="<?php echo $qualif[7]["icones"] ?>" />
    </div>

    <div>
        <img src="<?php echo $qualif[1]["icones"] ?>" />
    </div>

    <div>
        <img src="<?php echo $qualif[6]["icones"] ?>" />
    </div>

    <div>
        <img src="<?php echo $qualif[2]["icones"] ?>" />
    </div>

    <div>
        <img src="<?php echo $qualif[5]["icones"] ?>" />
    </div>

    <div>
        <img src="<?php echo $qualif[3]["icones"] ?>" />
    </div>

    <div>
        <img src="<?php echo $qualif[4]["icones"] ?>" />
    </div>
</div>