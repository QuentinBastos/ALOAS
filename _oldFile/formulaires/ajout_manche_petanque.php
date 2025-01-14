<?php

include ROOT . '/include/pdo.php' ; 
$idMatch=$_GET['idMatch'];
$nbManche=$_GET['nbManche'];
/**
 * Récupère les équipes et le match
 */
unset($statement);
$statement = $pdo->prepare("select * from Equipes join Matchs on Equipes.idEquipe=Matchs.idEquipe1 or Equipes.idEquipe=Matchs.idEquipe2 where Matchs.idMatch =" . intval($idMatch) . "");
$statement->execute();
$matchs = $statement->fetchAll();
echo "<div>";
echo '<label for="points_marques_A_manche';
echo $nbManche;
echo'">Point marqués pour ';
echo $matchs[0]['nom'];
echo '</label>';
echo '<input type="number" id="points_marques_A_manche';
echo $nbManche;
echo '" name="points_marques_A_manche';
echo $nbManche;
echo '"  min="0" max="6" value="0" placeholder="Point de la manche" required>';
echo '</div><div>';
echo '<label for="points_marques_B_manche';
echo $nbManche;
echo '">Point marqués pour ';
echo $matchs[1]['nom'];
echo '</label>';
echo '<input type="number" id="points_marques_B_manche';
echo $nbManche;
echo '" name="points_marques_B_manche';
echo $nbManche;
echo '"  min="0" max="6" value="0" placeholder="Point de la manche" required>';
echo '</div>';