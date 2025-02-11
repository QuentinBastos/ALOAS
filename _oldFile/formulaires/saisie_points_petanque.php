<?php
$titre="Saisie points petanque";
include ROOT . "/modules/header.php";
include ROOT . '/include/pdo.php' ;
$idMatch=$_GET['idMatch'];
$nbManche=1;
/**
 *  Récupération des équipes et des matchs
 */
unset($statement);

if(!empty($idMatch)){
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
                <form id="formPetanque"action="traitement_points_petanque?idMatch=<?php echo $idMatch?>"name="formPetanque" " method="post" enctype="multipart/from-data">
                <div id="zone_ajout_manche">
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
                    <div>

                        <div>
                            <label for="points_marques_A_manche<?php echo $nbManche?>">Point marqués pour <?php echo $matchs[0]['nom']?></label>
                            <input type="number" id="points_marques_A_manche<?php echo $nbManche?>" name="points_marques_A_manche<?php echo $nbManche?>"  min="0" max="6" value="0" placeholder="Point de la manche" required>
                        </div>
                        <div>
                            <label for="points_marques_B_manche<?php echo $nbManche?>">Point marqués pour <?php echo $matchs[1]['nom']?></label>
                            <input type="number" id="points_marques_B_manche<?php echo $nbManche?>" name="points_marques_B_manche<?php echo $nbManche;?>"  min="0" max="6" value="0" placeholder="Point de la manche" required>
                        </div>
                    </div>
                </div>

                <input type="submit" value="Envoyer" onclick="return valider()">
                </form>
                <button id="ajouter_manche">Ajouter une manche</button>
            <?php } ?>

        </div>

    </div>
</main>
<?php
include ROOT . "/modules/footer.php";
?>
</body>

<script>


    var idMatch = <?php echo $idMatch?>;
    var nbManche= <?php echo $nbManche?>;
    var ROOT = "<?php echo ROOT; ?>";
    var pointMancheA=[];
    var pointMancheB=[];
    document.getElementById('ajouter_manche').addEventListener('click', function() {


        var manche = new XMLHttpRequest();

        manche.onreadystatechange = function() {

            if (manche.readyState == 4 && manche.status == 200) {
                var nouvelleManche = document.createElement('div');
                nouvelleManche.innerHTML = manche.responseText;

                document.getElementById('zone_ajout_manche').appendChild(nouvelleManche);
            }

        };

        
        manche.open('GET', 'ajout_manche_petanque?idMatch=' + idMatch +'&nbManche='+(nbManche+1), true);
        pointMancheA[nbManche] = document.getElementById('points_marques_A_manche' + nbManche);
        pointMancheB[nbManche] = document.getElementById('points_marques_B_manche' + nbManche);

        if ( (pointMancheA[nbManche].value != 0 && pointMancheB[nbManche].value==0) || (pointMancheB[nbManche].value != 0 && pointMancheA[nbManche].value==0)) {
            nbManche++
            manche.send();
        }
        else {
            alert("Saisissez les points");
        }
    });
    function  valider() {
        var totalPointsA;
        var totalPointsB;
        for(var i=1;i<=nbManche;i++){
            totalPointsA=pointMancheA[i];
            totalPointsB=pointMancheB[i];
        }
        return true;
    }
</script>

</html>

