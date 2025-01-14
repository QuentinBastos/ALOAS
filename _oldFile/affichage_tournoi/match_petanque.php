<?php
$titre="Match";
include ROOT . "/modules/header.php"; 
include ROOT . '/include/pdo.php' ; 
$idMatch = $_GET['idMatch'];

if(!empty($idMatch)&& !empty($match)){
/* Récupération des équipes du match */
$statement = $pdo->prepare("SELECT idEquipe1,idEquipe2 from Matchs where idMatch=:idM;");
$statement->execute(
    [
        "idM"=>$idMatch
    ]
);
$equipes_match = $statement->fetchALL();

/* Récupération des informations du match */
$statement = $pdo->prepare("select * from Equipes where idEquipe =:idEquipe");
$statement->execute([
    "idEquipe"=>$equipes_match[0]["idEquipe1"]
]);
$eq1 = $statement->fetch();

$statement = $pdo->prepare("select * from Equipes where idEquipe =:idEquipe");
$statement->execute([
    "idEquipe"=>$equipes_match[0]["idEquipe2"]
]);
$eq2 = $statement->fetch();

$statement = $pdo->prepare("SELECT * from Manches_petanque where idMatch=:idM order by num_manche;");
$statement->execute(
    [
        "idM"=>$idMatch
    ]
);
$manches = $statement->fetchALL();


$equipe1 = $eq1["idEquipe"];
$equipe2 = $eq2["idEquipe"];

/* Récupération des informations des équipes */
$statement = $pdo->prepare("SELECT * from Equipes where idEquipe=:idEqu1 or idEquipe=:idEqu2;");
$statement->execute(
    [
        "idEqu1"=>$equipe1,
        "idEqu2"=>$equipe2
    ]
);
$equipes = $statement->fetchALL();
/* Récupération du nombre de manches */
$statement = $pdo->prepare("SELECT count(*) from Manches_petanque where idMatch=:idMatch;");
$statement->execute(
    [
        'idMatch' => $idMatch
    ]
);
$nb_manches = $statement->fetchALL();
}
?>
    <html lang="fr">
    <body>

<main class="match">
    <!-- Affichage des équipes -->
    <?php if(!empty($manches)){ ?>
<div class="confrontation">
    <?php echo "<h1>".$eq1['nom']."</h1>"; ?>
    <img src="<?php echo $eq1['icones'] ?>" alt="<?php echo $eq1['alt'] ?>">
    <p>VS</p>
    <img src="<?php echo $eq2['icones'] ?>" alt="<?php echo $eq2['alt'] ?>">
    <?php echo "<h1>".$eq2['nom']."</h1>"; ?>
</div>
<section class ="tableau_score">
    <!-- Affichage des scores -->
    
    <table>
        <tr class="ligne_tableau">
            <th>

            </th>
            <th>
                <img src="<?php echo $eq1['icones'] ?>" alt="<?php echo $eq1['alt'] ?>">

            </th>
            <th>
                <img src="<?php echo $eq2['icones'] ?>" alt="<?php echo $eq2['alt'] ?>">


            </th>
        </tr>
        <?php 
            /* Affichage des manches */
            for($i=0;$i<$nb_manches[0][0];$i++){
                echo "<tr>";
                echo "<td>".($i+1)."</td>";
                echo "<td>".$manches[$i]['pointsEquipe1']."</td>";
                echo "<td>".$manches[$i]['pointsEquipe2']."</td>";
                echo "</tr>";
            }
            /* calcul du total de l'équipe 1 */
            $total1=0;
            for($i=0;$i<$nb_manches[0][0];$i++){
                $total1+=$manches[$i]['pointsEquipe1'];
            }

            /* calcul du total de l'équipe 2 */
            $total2=0;
            for($i=0;$i<$nb_manches[0][0];$i++){
                $total2+=$manches[$i]['pointsEquipe2'];
            }

            /* Affichage des totaux */
            echo "<tr>";
            echo "<td>Total</td>";
            echo "<td> $total1 </td>";
            echo "<td> $total2 </td>";
            echo "</tr>";
        ?>
    </table>   
</section>
<?php }else { ?>
        <p> Ce match n'existe pas </p>
   <?php } ?>
</main>
<?php include ROOT . "/modules/footer.php"; ?>
    </body>
    </html>
