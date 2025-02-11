<?php
$titre="Match";
include ROOT . "/modules/header.php"; 
include ROOT . '/include/pdo.php' ; 

$idMatch = $_GET['idMatch'];

if(!empty($idMatch)){
  
/* Récupération des équipes du match */
$statement = $pdo->prepare("select idEquipe1,idEquipe2 from Matchs where idMatch =:idMatch");
$statement->execute([
    ":idMatch"=>$idMatch
]);
$equipes = $statement->fetch();


/* Récupération des informations du match */
$statement = $pdo->prepare("select * from Equipes where idEquipe =:idEquipe");
$statement->execute([
    ":idEquipe"=>$equipes["idEquipe1"]
]);
$eq1 = $statement->fetch();

$statement = $pdo->prepare("select * from Equipes where idEquipe =:idEquipe");
$statement->execute([
    ":idEquipe"=>$equipes["idEquipe2"]
]);
$eq2 = $statement->fetch();

$statement = $pdo->prepare("SELECT * from Match_foot where idMatch=$idMatch;");
$statement->execute();
$match = $statement->fetchALL();

$equipe1 = $eq1["idEquipe"];
$equipe2 = $eq2["idEquipe"];


/* Récupération des informations des équipes */
$statement = $pdo->prepare("SELECT * from Equipes where idEquipe= $equipe1 or idEquipe=$equipe2 ;");
$statement->execute();
$equipes = $statement->fetchALL();
}

?>
    <html lang="fr">
    <body>

<main class="match">
    <?php if(!empty($idMatch) && !empty($match)){ ?>
    
<div class="confrontation">
    <!-- Affichage des équipes -->
    <?php
    
    
    echo "<h1>".$eq1['nom']."</h1>"; ?>
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

        echo "<tr>";
        echo "<td> BUTS </td>";
        echo "<td>".$match[0]['butsEquipe1']."</td>";
        echo "<td>".$match[0]['butsEquipe2']."</td>";
        echo "</tr>";

        ?>

    </table>
    <?php }else { ?>
        <p> Ce match n'existe pas </p>
   <?php } ?>
</section>
</main>
<?php include ROOT . "/modules/footer.php"; ?>
    </body>
    </html>
