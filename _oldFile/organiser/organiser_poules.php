<?php
include_once ROOT . "/classes/classe_tournoi.php";
include_once ROOT . "/classes/classe_equipe.php";
$titre="Organiser Poules";
include ROOT . "/modules/header.php"; 
$TestTournoi=$_SESSION['TestTournoi'];
?>

<html lang="fr">
<body>

<main>
<!-- Choix du nombre de poules et d'équipes -->
    <div id="admin_rect_orga">
        <form id="FormNbPoules" action="/formulaires/initPoules_form" method="post">
            <?php
            $nbEqu=$TestTournoi->getNbEquipes();
            switch(true){
                case $nbEqu >= 2 && $nbEqu <= 3:
                    echo "<label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre de poules :</label>
                        <select name=\"nbPoules\" size=\"1\">
                            <option value=1>1
                        </select>
                        <div>
                        <label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre d'équipes séléctionnées :</label>
                        <select name=\"nbEquSelect\" size=\"1\">
                            <option value=2>2
                        </select>
                    </div>";
                break;
                case $nbEqu >= 4 && $nbEqu <= 5 :
                    echo "<label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre de poules :</label>
                        <select name=\"nbPoules\" size=\"1\">
                            <option value=1>1
                            <option value=2>2
                        </select>
                        <div>
                            <label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre d'équipes séléctionnées :</label>
                            <select name=\"nbEquSelect\" size=\"1\">
                                <option value=2>2
                                <option value=4>4
                            </select>
                        </div>";
                break;
                case $nbEqu == 6 :
                    echo "<label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre de poules :</label>
                        <select name=\"nbPoules\" size=\"1\">
                            <option value=1>1
                            <option value=2>2
                            <option value=3>3
                        </select>
                        <div>
                        <label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre d'équipes séléctionnées :</label>
                        <select name=\"nbEquSelect\" size=\"1\">
                            <option value=2>2
                            <option value=4>4
                        </select>
                        </div>";
                break;
                break;
                case $nbEqu >= 8 && $nbEqu <= 12 :
                    echo "<label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre de poules :</label>
                        <select name=\"nbPoules\" size=\"1\">
                            <option value=2>2
                            <option value=3>3
                            <option value=4>4
                        </select>
                        <div>
                        <label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre d'équipes séléctionnées :</label>
                        <select name=\"nbEquSelect\" size=\"1\">
                            <option value=2>2
                            <option value=4>4
                            <option value=8>8
                        </select>
                        </div>";
                break;
                case $nbEqu >= 13 && $nbEqu <= 19 :
                    echo "<label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre de poules :</label>
                        <select name=\"nbPoules\" size=\"1\">
                            <option value=3>3
                            <option value=4>4
                        </select>
                        <div>
                        <label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre d'équipes séléctionnées :</label>
                        <select name=\"nbEquSelect\" size=\"1\">
                            <option value=2>2
                            <option value=4>4
                            <option value=8>8
                        </select>
                        </div>";
                break;
                case $nbEqu >= 20 && $nbEqu <= 22 :
                    echo "<label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre de poules :</label>
                        <select name=\"nbPoules\" size=\"1\">
                            <option value=4>4
                        </select>
                        <div>
                        <label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre d'équipes séléctionnées :</label>
                        <select name=\"nbEquSelect\" size=\"1\">
                            <option value=2>2
                            <option value=4>4
                            <option value=8>8
                        </select>
                        </div>";
                break;
             case $nbEqu == 7 :
                    echo "<label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre de poules :</label>
                        <select name=\"nbPoules\" size=\"1\">
                            <option value=2>2
                            <option value=3>3
                        </select>
                        <div>
                            <label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre d'équipes séléctionnées :</label>
                            <select name=\"nbEquSelect\" size=\"1\">
                                <option value=2>2
                                <option value=4>4
                            </select>
                            </div>";
                break;
                case $nbEqu >= 8 && $nbEqu <= 12 :
                    echo "<label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre de poules :</label>
                        <select name=\"nbPoules\" size=\"1\">
                            <option value=2>2
                            <option value=3>3
                            <option value=4>4
                        </select>
                        <div>
                        <label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre d'équipes séléctionnées :</label>
                        <select name=\"nbEquSelect\" size=\"1\">
                            <option value=2>2
                            <option value=4>4
                            <option value=8>8
                        </select>
                        </div>";
                break;
                case $nbEqu >= 13 && $nbEqu <= 19 :
                    echo "<label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre de poules :</label>
                        <select name=\"nbPoules\" size=\"1\">
                            <option value=3>3
                            <option value=4>4
                        </select>
                        <div>
                        <label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre d'équipes séléctionnées :</label>
                        <select name=\"nbEquSelect\" size=\"1\">
                            <option value=2>2
                            <option value=4>4
                            <option value=8>8
                        </select>
                        </div>";
                break;
                case $nbEqu >= 20 && $nbEqu <= 22 :
                    echo "<label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre de poules :</label>
                        <select name=\"nbPoules\" size=\"1\">
                            <option value=4>4
                        </select>
                        <div>
                        <label id=\"label_selec\" for=\"nbEquSelect\">Choisir le nombre d'équipes séléctionnées :</label>
                        <select name=\"nbEquSelect\" size=\"1\">
                            <option value=2>2
                            <option value=4>4
                            <option value=8>8
                        </select>
                        </div>";
                break;
            }
            
            ?>
            <button class="glow-on-hover" type=”submit”>Confirmer</button>
        </form>
        
        
        <form id="FormRepartPoules " action="/formulaires/creerPoulesTournoi_form" method="post">
            <?php 
                if($_SESSION['nbPoules']==0){
                    echo "<p id=\"mess_orga_p\"> Merci de choisir un nombre de poules et de confirmer pour faire apparaître les équipes</p>";
                }else{
                    echo "<div class=\"tableau_orga\"> <table> <tbody>";

                            echo "<tr>
                                    <th>Numéro</th>
                                    <th>Icône</th>
                                    <th>Nom de l'équipe</th>
                                    <th>Choisir numéro de poule</th>
                                 </tr>";
                        for($i=0;$i<$TestTournoi->getNbEquipes();$i++){
                            $id=$i+1;
                            echo "<tr><td>".$id."</td>";
                            echo "<td><img src=\"".$TestTournoi->getEquipe($i)->getCheminIcone()."\"></td>";
                            echo "<td>".$TestTournoi->getEquipe($i)->getNom()."</td>";
                            switch($_SESSION['nbPoules']){
                                case "1" :
                                    echo "<td> 1 </td><tr>";
                                break;

                                case 2 :
                                    echo "<td><select name=\"pouleEq".$i."\" size=\"1\">
                                            <option value=1>1
                                            <option value=2>2
                                          </select></td></tr>";
                                break;

                                case 3 :
                                    echo "<td><select name=\"pouleEq".$i."\" size=\"1\">
                                            <option value=1>1
                                            <option value=2>2
                                            <option value=3>3
                                          </select></td></tr>";
                                break;

                                case 4 :
                                    echo "<td><select name=\"pouleEq".$i."\" size=\"1\">
                                            <option value=1>1
                                            <option value=2>2
                                            <option value=3>3
                                            <option value=4>4
                                          </select></td></tr>";
                                break;


                            }
                            
                        } 
                            
                    echo "</tbody> </table> </div>";

                    echo "<button class=\"glow-on-hover\" type=\”submit\”>Créer Tournoi</button>";
                }
                $_SESSION['TestTournoi']=$TestTournoi;
            ?>
            
            
        </form>
    </div>
