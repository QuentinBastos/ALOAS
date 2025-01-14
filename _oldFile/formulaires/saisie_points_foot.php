<?php
$titre="Saisie points foot";
include ROOT . "/modules/header.php";
include ROOT . '/include/pdo.php' ;
$idMatch=$_GET['idMatch'];
/**
 *  Récupère les équipes du match
 */
unset($statement);

if(!empty($idMatch)){
    

$statement = $pdo->prepare("select idEquipe1,idEquipe2 from Matchs where idMatch =:idMatch");
$statement->execute([
    ":idMatch"=>$idMatch
]);
$equipes = $statement->fetch();

$statement = $pdo->prepare("select * from Equipes where idEquipe =:idEquipe");
$statement->execute([
    ":idEquipe"=>$equipes["idEquipe1"]
]);
$equipe1 = $statement->fetch();

$statement = $pdo->prepare("select * from Equipes where idEquipe =:idEquipe");
$statement->execute([
    ":idEquipe"=>$equipes["idEquipe2"]
]);
$equipe2 = $statement->fetch();
}
function iconesEquipes($idMatch)
{
    if(!empty($idMatch)){
    global $equipe1;
    global $equipe2;
        if (!empty($equipe1)) {
            echo '<img src="';
            echo $equipe1['icones'];
            echo '" alt="';
            echo $equipe1['alt'];
            echo '">';

            echo '<p>vs</p>';

            echo '<img src="';
            echo $equipe2['icones'];
            echo '" alt="';
            echo $equipe2['alt'];
            echo '">';
        }
    }
}


?>
<html lang="fr">
<body>




<main class="saisie_points">
    <div class="zone_insertion">
        <h2>Match</h2>
        
        <div class="confrontation">
            <?php iconesEquipes($idMatch);?>
        </div>
        <div>
            <?php
            if(empty($idMatch)){ ?>

                <p> Ce match n'existe pas </p>
            <?php }else{ ?>
                <form id="formFoot" action="traitement_points_foot?idMatch=<?php echo $idMatch?>" method="post" enctype="multipart/from-data">
                    <div>
                        <label for="foot_points_marques1"></label>
                        <input type="number" id="foot_points_marques1" name="foot_points_marques1"  min="0" max="100" placeholder="Points marqués" required>
                        <label for="points_marques2"></label>
                        <input type="number" id="foot_points_marques2" name="foot_points_marques2"  min="0" max="100" placeholder="Points marqués" required>
                    </div>
                    <div>
                        <label for="fair-play1"></label>
                        <input type="range" id="fair-play1" name="fair-play1"  min="0" max="5" value="0" placeholder="fair-play marqués" required list="markers">

                        <label for="fair-play2"></label>
                        <input type="range" id="fair-play2" name="fair-play2"  min="0" max="5" value="0" placeholder="fair-play marqués" required>
                    </div>
                    <input type="submit" value="Envoyer" onclick="return validerFoot()">
                </form>
            <?php } ?>
        </div>

    </div>
</main>
<?php
include ROOT . "/modules/footer.php";
?>
</body>
<script type="text/javascript" src="../js/code.js"></script>
</html>

