<?php 

$urlactive = $_SERVER["PHP_SELF"];
if($urlactive == "/affichage_tournoi/etage_quart_index.php"){
    header('Location: /index');
  } ?>
<div class="barres_quart_container_index">
    <section class="barres_quart_index"></section>
    <section class="barres_quart_index"></section>
    <section class="barres_quart_index"></section>
    <section class="barres_quart_index"></section>
</div>
<!-- Affichage des 8 équipes qualifiées -->
<div class="icones_etage1_index">
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