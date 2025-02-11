<?php
$titre="Saisie points tennis";
include ROOT . "/modules/header.php";
include ROOT . '/include/pdo.php' ;

$idMatch=$_GET['idMatch'];
/**
 *  Récupération des informations du match
 */
if(!empty($idMatch)){
    
unset($statement);
$statement = $pdo->prepare("select * from Equipes join Matchs on Equipes.idEquipe=Matchs.idEquipe1 or Equipes.idEquipe=Matchs.idEquipe2 where Matchs.idMatch =" . intval($idMatch) . "");
$statement->execute();
$matchs = $statement->fetchAll();

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
function iconesEquipes()
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
            <?php iconesEquipes();?>
        </div>
        <div>
            <?php if(empty($equipe1['nom']) || empty($equipe2['nom'])){ ?>
                <p> Ce match n'existe pas </p>
            <?php }else{ ?>
                <form id="formTennis" action="traitement_points_tennis?idMatch=<?php echo $idMatch?>" method="post" enctype="multipart/from-data">
                    <div>
                        <div>
                            <label for="tennis_points_marques1">Sets marqués pour <?php echo $matchs[0]['nom']?></label>
                            <input type="number" id="tennis_points_marques1" name="tennis_points_marques1"  min="0" max="7" placeholder="Nombre de sets" required>
                        </div>

                        <div>
                            <label for="tennis_points_marques2">Sets marqués pour <?php echo $matchs[1]['nom']?></label>
                            <input type="number" id="tennis_points_marques2" name="tennis_points_marques2"  min="0" max="7" placeholder="Nombre de sets" required>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="fair-play1"></label>
                            <input type="number" id="fair-play1" name="fair-play1"  min="0" max="100" placeholder="fair-play marqués" required>
                        </div>
                        <div>
                            <label for="fair-play"></label>
                            <input type="number" id="fair-play2" name="fair-play2"  min="0" max="100" placeholder="fair-play marqués" required>
                        </div>
                    </div>
                    <input type="submit" value="Envoyer" onclick="return validerTennis()">
                </form>
            <?php } ?>


        </div>
</main>
<?php
include ROOT . "/modules/footer.php";
?>
</body>
<script type="text/javascript" src="../js/code.js"></script>
</html>


