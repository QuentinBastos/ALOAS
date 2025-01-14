<?php 
$titre="Classement";

/* Page similaire à classement_goalaverage mais pour le fairplays */

include ROOT . "/modules/header.php"; 
include ROOT . '/include/pdo.php' ; 

$idTournoi = $_GET['idTournoi'];


unset($statement);

$pdo->exec("SET @row_number = 0");

$statement = $pdo->prepare("
SELECT (@row_number:=@row_number + 1) AS place, idEquipe, nom, goalaverage, fairplay, icones, alt 
FROM Equipes 
WHERE idTournoi = :idTournoi 
ORDER BY fairplay DESC;");

$statement->execute([':idTournoi' => $idTournoi]);
$equipes = $statement->fetchAll();

unset($statement);
$statement = $pdo->prepare("SELECT count(*) from Equipes where idTournoi = $idTournoi;");
$statement->execute();
$nbEquipes = $statement->fetchALL();

?>
<html lang="fr">
<body>


<main class="classement">
<a class ="btn" href=<?php echo "/classement/classement_goalaverage?idTournoi=".$idTournoi."" ?>>Aller au classement selon le goal-average</a>
<section>
<h1>Classement des équipes selon le fairplay</h1>
</section>
<section>
  <div class ="top3">
    <div class = "deux">
    <img class ="img_top3" src="<?php echo $equipes[1]['icones'] ?>" alt="<?php echo $equipes[1]['alt'] ?>">
    <div class="deuxieme"><img src="/img/Medaille_argent.svg" alt="photo medaille d'or"></div>
    </div>
    <div class="un">
    <img class ="img_top3" src="<?php echo $equipes[0]['icones'] ?>" alt="<?php echo $equipes[0]['alt'] ?>">
    <div class="premier"><img src="/img/Medaille_or.svg" alt="photo medaille d'or"></div>
    </div>
    <div class="trois">
    <?php 
      if(count($equipes)>2){ ?>
    <img class ="img_top3" src="<?php echo $equipes[2]['icones'] ?>" alt="<?php echo $equipes[2]['alt'] ?>">
    <?php } else {
      echo "<p>Il n'y a pas de troisième équipe</p>";
    } ?>
    <div class="troisieme"><img src="/img/Medaille_bronze.svg" alt="photo medaille d'or"></div>
    </div>
  </div>

  <div class="tableau">
    <table>
        <tr id ="Titres">
          <th class="tab_gauche">Classement des équipes</th>
          <th class="tab_droit">Place</th>  
        </tr>
        <?php 
        
        for($i=0;$i<$nbEquipes[0][0];$i++){
            echo '<tr class ="tab">';
            echo '<td class="tab_gauche_td"><div><img src="'.$equipes[$i]['icones'].'" alt="'.$equipes[$i]['alt'].'"> <p>'.$equipes[$i]['nom'].'</p></div></td>';
            echo '<td class="tab_droit_td">'.$equipes[$i]['place'].'</td>';
        }



          ?>
      </table>


  </div>

</section>



</main>
<?php
include ROOT . "/modules/footer.php";
?>
</body>
</html>