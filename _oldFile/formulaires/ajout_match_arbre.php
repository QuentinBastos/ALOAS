<?php
$equipequalifier[]=array();

unset($statement);
/**
 * Récupèrer les informations du match
 */
$statement = $pdo->prepare("select * from Matchs where idMatch= :idMatch");
$statement->execute(
    [
        'idMatch'=>$idMatch
    ]
);
$match = $statement->fetchALL();
$idTournoi=$match[0]["idTournoi"];


unset($statement);
/**
 * Récupère id des équipes du tournoi
 */
$statement = $pdo->prepare("select idEquipe from Equipes where idTournoi= :idTournoi");
$statement->execute(
    [
        'idTournoi'=>$idTournoi
    ]
);
$infoequipe = $statement->fetchALL();
unset($statement);
/**
 * Récupère le nombre d'équipes à passer
 */
$statement = $pdo->prepare("select nbEquipesSelec from Tournois where idTournoi= :idTournoi");
$statement->execute(
    [
        'idTournoi'=>$idTournoi
    ]
);
$nbAqualifie=$statement->fetch();
$nbAqualifie=$nbAqualifie[0];
unset($statement);
/**
 * Nombre d'équipe
 */
$statement = $pdo->prepare("select count(*) as nb from Equipes where idTournoi= :idTournoi");
$statement->execute(
    [
        'idTournoi'=>$idTournoi
    ]
);
$nbequipe = $statement->fetchALL();

unset($statement);
/**
 * Récupère information des matchs du tournoi
 */
$statement = $pdo->prepare("SELECT * from Matchs where idTournoi= :idTournoi");
$statement->execute(
    [
        'idTournoi' =>  $idTournoi
    ]
);
$matchs=$statement->fetch();
unset($statement);
/**
 * Récupère la discipline du tournoi
 */
$statement = $pdo->prepare("SELECT discipline from Tournois where idTournoi= :idTournoi");
$statement->execute(
    [
        'idTournoi' =>  $idTournoi
    ]
);
$discipline=$statement->fetch();
$discipline=$discipline[0];

//-------------------------------------------------------------------------------
unset($statement);
/**
 * Récupère l'id des équipes, leurs goal-average dans le tournoi par ordre décroissant du goal-average
 */
$statement = $pdo->prepare("SELECT idEquipe,goalaverage AS points from Equipes where idTournoi=:idTournoi order by goalaverage desc;");
$statement->execute(
    [
        'idTournoi' =>  $idTournoi
    ]
);
$totalEquipes = $statement->fetchall();
/**
 * pour le football
 */
if($discipline=="Foot") {

    /**
     * Détecte si le match est un match de consolant ou un match d'arbre
     */
    if (!$match[0]["matchPoule"]) {


        $arbreconsolante = false;

        $totalEquipes[] = array();

        for ($i = 0; $i < $nbAqualifie; $i++) {
            if ($match[0]["idEquipe1"] == $totalEquipes[$i]["idEquipe"] or $match[0]["idEquipe2"] == $totalEquipes[$i]["idEquipe"]) {
                $arbreconsolante = true;

            }
            $equipequalifier[$i] = $totalEquipes[$i]["idEquipe"];
        }

    }

    /**
     * Pour match poule
     */
    if ($match[0]["matchPoule"]){

        //var_dump("match poule");
        unset($statement);
        /**
         * Nombre de match arbre déjà joué
         */
        $statement = $pdo->prepare("SELECT count(idMatch) as nb from Match_foot where idMatch in(select idMatch from Matchs where idTournoi= :idTournoi and matchPoule=1);");
        $statement->execute(
            [
                'idTournoi' => $idTournoi
            ]
        );

        $nbMatchPoule=$statement->fetch();
        unset($statement);
        /**
         * Nombre de poules
         */
        $statement = $pdo->prepare("SELECT count(idTournoi) as nb from Poules where idTournoi= :idTournoi ");
        $statement->execute(
            [
                'idTournoi' => $idTournoi
            ]
        );
        $nbPoules=$statement->fetch();
        unset($statement);
        /**
         * Nombre d'équipes dans les poules
         */
        $statement = $pdo->prepare("SELECT COUNT(idEquipe) AS nombreEquipes
FROM (
    SELECT idPoule, idEquipe1 AS idEquipe FROM Poules WHERE idTournoi = :idTournoi
    UNION ALL
    SELECT idPoule, idEquipe2 FROM Poules WHERE idTournoi = :idTournoi
    UNION ALL
    SELECT idPoule, idEquipe3 FROM Poules WHERE idTournoi = :idTournoi
    UNION ALL
    SELECT idPoule, idEquipe4 FROM Poules WHERE idTournoi = :idTournoi
    UNION ALL
    SELECT idPoule, idEquipe5 FROM Poules WHERE idTournoi = :idTournoi
    UNION ALL
    SELECT idPoule, idEquipe6 FROM Poules WHERE idTournoi = :idTournoi
) AS EquipesTournoi
GROUP BY idPoule; ");
        $statement->execute(
            [
                'idTournoi' => $idTournoi
            ]
        );
        $nbDansPoules=$statement->fetchall();

        $nbMatchNormalement=0;


        for($i=0;$i<$nbPoules['nb'];$i++){
            $nbMatchNormalement+=((int)$nbDansPoules[$i]['nombreEquipes']*((int)$nbDansPoules[$i]['nombreEquipes']-1))/2;
        }

        /**
         * Tous les matchs des poules sont fini
         */
        //var_dump("attention");

        if(($nbMatchPoule['nb']== $nbMatchNormalement)){
            //var_dump("ok");

            for($i=0;$i<$nbAqualifie;$i++) {
                $listeEquipePasse[$i]=$totalEquipes[$i]['idEquipe'];
            }


            /**
             * Possibilité de crée des consolantes
             */
            if(((int)$nbequipe[0]['nb']-(int)$nbAqualifie)>1) {


                for ($i = 0; $i < (int)$nbequipe[0]['nb']-(int)$nbAqualifie; $i++) {
                    $listeEquipePoule[$i] = $totalEquipes[$i+(int)$nbAqualifie]['idEquipe'];
                }


                /**
                 * Création des consolante
                 */
                for ($i = 0; $i< count($listeEquipePoule); $i++) {

                    for ($j = $i +
                        1; $j < count($listeEquipePoule);
                         $j++) {
                        unset($insertMatchVide);

                        $insertMatchVide = $pdo->prepare("INSERT
INTO Matchs(idEquipe1, idEquipe2, idTournoi, matchPoule) values(:varEqu1,:varEqu2,:varIdT,0)");

                        $insertMatchVide->execute(

                            [

                                "varIdT" => $idTournoi,

                                "varEqu1" => $listeEquipePoule[$i],

                                "varEqu2" => $listeEquipePoule[$j]

                            ]

                        );

                    }

                }
            }
            /**
             * Création des matchs du premier niveau d'arbre
             */
            for($i=0;$i<$nbAqualifie/2;$i++) {

                unset($insertMatchVide);

                $insertMatchVide = $pdo->prepare("INSERT INTO Matchs(idEquipe1, idEquipe2, idTournoi, matchPoule) values(:varEqu1,:varEqu2,:varIdT,0)");

                $insertMatchVide->execute(

                    [

                        "varIdT" => $idTournoi,

                        "varEqu1" => $listeEquipePasse[$i],

                        "varEqu2" => $listeEquipePasse[$nbAqualifie-1-$i]

                    ]

                );


            }

        }





    }

    /**
     * Match d'arbre
     */
    if (!$match[0]["matchPoule"] && $arbreconsolante) {
        $valeurArbre = 0;
        for ($i = 0; $i < $nbAqualifie; $i++) {

            unset($statement);
            $statement = $pdo->prepare("SELECT count(*) as nb from Match_foot where idMatch in(select idMatch from Matchs where idEquipe1= :equipe and matchPoule=0)");
            $statement->execute(
                [
                    'equipe' => $equipequalifier[$i]
                ]
            );
            $count = $statement->fetch();
            $valeurArbre =$valeurArbre+ (int)$count["nb"];


        }
        /**
         * donne le niveau d'arbre au quel le tournoi est
         */
        if ($nbAqualifie == 16)
            $niveauMaxArbre = 3;
        if ($nbAqualifie == 8)
            $niveauMaxArbre = 2;
        if ($nbAqualifie == 4)
            $niveauMaxArbre = 1;
        if ($nbAqualifie == 2)
            $niveauMaxArbre = 0;
        /**
         * étage 1
         */
        if ((int)$valeurArbre == $nbAqualifie / 2 && $niveauMaxArbre > 0) {

            unset($statement);
            /**
             * Récupère id des équipes, id des matchs et du tournoi des matchs de poule du tournoi des qualifiés
             */
            $statement = $pdo->prepare("SELECT idEquipe1, idEquipe2,idMatch, idTournoi from Matchs where idTournoi = :idTournoi and matchPoule=0 order by idMatch desc limit " . intval($nbAqualifie / 2) . "");
            $statement->execute(
                [
                    'idTournoi' => $idTournoi
                ]
            );
            $matchsArbreNiv1 = $statement->fetchall();


            $tableauGagnant = array();
            for ($i = 0; $i < $nbAqualifie / 2; $i++) {
                unset($statement);
                /**
                 * Récupère les informations du match des équipes sélectionné
                 */
                $statement = $pdo->prepare("select idMatch ,idEquipe1,idEquipe2 from Matchs where idTournoi= :idTournoi and matchPoule =0 and (idEquipe1= :idEquipe1 or idEquipe1= :idEquipe2) and (idEquipe2= :idEquipe1 or idEquipe2= :idEquipe2);");
                $statement->execute(
                    [
                        'idTournoi' => $idTournoi,
                        'idEquipe1' => $matchsArbreNiv1[$i]["idEquipe1"],
                        'idEquipe2' => $matchsArbreNiv1[$i]["idEquipe2"]
                    ]
                );

                $matchEtEquipe= $statement->fetch();
                $tempMatchETEquipe = $matchEtEquipe;
                unset($statement);
                //var_dump($matchEtEquipe);
                $statement = $pdo->prepare("select butsEquipe1,butsEquipe2 from Match_foot where idMatch= :idMatch;");
                $statement->execute(
                    [
                        'idMatch' => $matchEtEquipe["idMatch"]
                    ]
                );
                $pointMatch = $statement->fetch();

                if($pointMatch["butsEquipe1"]>$pointMatch["butsEquipe2"]){
                    $tableauGagnant[$i] = $matchEtEquipe["idEquipe1"];
                }else{
                    $tableauGagnant[$i] = $matchEtEquipe["idEquipe2"];
                }
            }
//2 passe a 4
            for ($i = 0; $i <= $nbAqualifie / 4; $i++) {
                unset($statement);
//var_dump($tableauGagnant);
//var_dump($i);
//var_dump($nbAqualifie/4+$i);

                var_dump($tableauGagnant);
                $statement = $pdo->prepare("insert into Matchs (idEquipe1,idEquipe2,idTournoi,matchPoule)values ( :equipe1, :equipe2, :idTournoi,0);");
                $statement->execute(
                    [
                        'idTournoi' => $idTournoi,
                        'equipe1' => $tableauGagnant[1+$i],
                        'equipe2' => $tableauGagnant[$i]
                        //-----------------------------------------------------------------------------------------------------------------
                    ]
                );
                $i++;
            }
        }
        if ($valeurArbre == $nbAqualifie / 4 + $nbAqualifie / 2 && $niveauMaxArbre > 1) {
            var_dump("etage 2");
            unset($statement);
            $statement = $pdo->prepare("SELECT idEquipe1, idEquipe2,idMatch, idTournoi from Matchs where idTournoi = :idTournoi and matchPoule=0 order by idMatch desc limit " . intval($nbAqualifie / 4) . "");
            $statement->execute(
                [
                    'idTournoi' => $idTournoi
                ]
            );
            $matchsArbreNiv1 = $statement->fetchall();


            $tableauGagnant = array();
            for ($i = 0; $i < $nbAqualifie / 4; $i++) {
                unset($statement);
                /*
                $statement = $pdo->prepare("select getGagnantFoot( " . intval($matchsArbreNiv1[$i]["idEquipe1"]) . " , " . intval($matchsArbreNiv1[$i]["idEquipe2"]) . " , " . intval($idTournoi) . " ,0) as idEquipe");
               */
                $statement = $pdo->prepare("select idMatch ,idEquipe1,idEquipe2 from Matchs where idTournoi= :idTournoi and matchPoule =0 and (idEquipe1= :idEquipe1 or idEquipe1= :idEquipe2) and (idEquipe2= :idEquipe1 or idEquipe2= :idEquipe2);");
                $statement->execute(
                    [
                        'idTournoi' => $idTournoi,
                        'idEquipe1' => $matchsArbreNiv1[$i]["idEquipe1"],
                        'idEquipe2' => $matchsArbreNiv1[$i]["idEquipe2"]
                    ]
                );
                $matchEtEquipe= $statement->fetch();
                //var_dump($idTournoi);
                //var_dump("i");
                //var_dump($i);
                //var_dump($matchsArbreNiv1);
                unset($statement);
                $statement = $pdo->prepare("select butsEquipe1,butsEquipe2 from Match_foot where idMatch= :idMatch;");
                $statement->execute(
                    [
                        'idMatch' => $matchEtEquipe["idMatch"]
                    ]
                );
                $pointMatch = $statement->fetch();

                if($pointMatch["butsEquipe1"]>$pointMatch["butsEquipe2"]){
                    $tableauGagnant[$i] = $matchEtEquipe["idEquipe1"];
                }else{
                    $tableauGagnant[$i] = $matchEtEquipe["idEquipe2"];
                }
            }

            for ($i = 0; $i < $nbAqualifie / 8; $i++) {
                //var_dump($tableauGagnant);
                //var_dump($i);
                //var_dump($nbAqualifie/8+$i);
                //var_dump($tableauGagnant);
                unset($statement);
                $statement = $pdo->prepare("insert into Matchs (idEquipe1,idEquipe2,idTournoi,matchPoule)values ( :equipe1, :equipe2, :idTournoi,0);");
                $statement->execute(
                    [
                        'idTournoi' => $idTournoi,
                        'equipe1' => $tableauGagnant[1+$i],
                        'equipe2' => $tableauGagnant[$i]
                    ]
                );
                $i++;
            }


        }
        if ($valeurArbre == $nbAqualifie / 8 + $nbAqualifie / 4 + $nbAqualifie / 2 && $niveauMaxArbre > 2) {
            //var_dump("etage 3");
            unset($statement);
            $statement = $pdo->prepare("SELECT idEquipe1, idEquipe2,idMatch, idTournoi from Matchs where idTournoi = :idTournoi and matchPoule=0 order by idMatch desc limit " . intval($nbAqualifie / 8 + $nbAqualifie / 4 + $nbAqualifie / 2) . "");
            $statement->execute(
                [
                    'idTournoi' => $idTournoi
                ]
            );
            $matchsArbreNiv1 = $statement->fetchall();


            $tableauGagnant = array();
            for ($i = 0; $i < $nbAqualifie / 16; $i++) {
                unset($statement);
                /*
                $statement = $pdo->prepare("select getGagnantFoot( " . intval($matchsArbreNiv1[$i]["idEquipe1"]) . " , " . intval($matchsArbreNiv1[$i]["idEquipe2"]) . " , " . intval($idTournoi) . " ,0) as idEquipe");
               */
                $statement = $pdo->prepare("select idMatch ,idEquipe1,idEquipe2 from Matchs where idTournoi= :idTournoi and matchPoule =0 and (idEquipe1= :idEquipe1 or idEquipe1= :idEquipe2) and (idEquipe2= :idEquipe1 or idEquipe2= :idEquipe2);");
                $statement->execute(
                    [
                        'idTournoi' => $idTournoi,
                        'idEquipe1' => $matchsArbreNiv1[$i]["idEquipe1"],
                        'idEquipe2' => $matchsArbreNiv1[$i]["idEquipe2"]
                    ]
                );
                $matchEtEquipe= $statement->fetch();

                unset($statement);
                $statement = $pdo->prepare("select butsEquipe1,butsEquipe2 from Match_foot where idMatch= :idMatch;");
                $statement->execute(
                    [
                        'idMatch' => $matchEtEquipe["idMatch"]
                    ]
                );
                $pointMatch = $statement->fetch();

                if($pointMatch["butsEquipe1"]>$pointMatch["butsEquipe2"]){
                    $tableauGagnant[$i] = $matchEtEquipe["idEquipe1"];
                }else{
                    $tableauGagnant[$i] = $matchEtEquipe["idEquipe2"];
                }
            }

            for ($i = 0; $i < $nbAqualifie / 16; $i++) {
                unset($statement);
                $statement = $pdo->prepare("insert into Matchs (idEquipe1,idEquipe2,idTournoi,matchPoule)values ( :equipe1, :equipe1, :idTournoi,0);");
                $statement->execute(
                    [
                        'idTournoi' => $idTournoi,
                        'equipe1' => $tableauGagnant[1+$i],
                        'equipe2' => $tableauGagnant[$i]
                    ]
                );
                $i++;
            }
        }
    }
}
//---------------------------------------------------------------------------------------------------------//
if ($discipline == "Tennis") {
//match arbre ou consolante
    //var_dump("tennis");

    if (!$match[0]["matchPoule"]) {




        //var_dump("match arbre ou consolante");

        $arbreconsolante = false;

        $totalEquipes[] = array();




        for ($i = 0; $i < $nbAqualifie; $i++) {

            if ($match[0]["idEquipe1"] == $totalEquipes[$i]["idEquipe"] or $match[0]["idEquipe2"] == $totalEquipes[$i]["idEquipe"]) {
                $arbreconsolante = true;

            }
            $equipequalifier[$i] = $totalEquipes[$i]["idEquipe"];
        }

    }
//match poule
    if ($match[0]["matchPoule"]){
        // var_dump("match poule");
        unset($statement);
        $statement = $pdo->prepare("SELECT count(idMatch) as nb from Match_tennis where idMatch in(select idMatch from Matchs where idTournoi= :idTournoi and matchPoule=1);");
        $statement->execute(
            [
                'idTournoi' => $idTournoi
            ]
        );

        $nbMatchPoule=$statement->fetch();
        unset($statement);
        $statement = $pdo->prepare("SELECT count(idTournoi) as nb from Poules where idTournoi= :idTournoi ");
        $statement->execute(
            [
                'idTournoi' => $idTournoi
            ]
        );
        $nbPoules=$statement->fetch();
        unset($statement);
        $statement = $pdo->prepare("SELECT COUNT(idEquipe) AS nombreEquipes
FROM (
    SELECT idPoule, idEquipe1 AS idEquipe FROM Poules WHERE idTournoi = :idTournoi
    UNION ALL
    SELECT idPoule, idEquipe2 FROM Poules WHERE idTournoi = :idTournoi
    UNION ALL
    SELECT idPoule, idEquipe3 FROM Poules WHERE idTournoi = :idTournoi
    UNION ALL
    SELECT idPoule, idEquipe4 FROM Poules WHERE idTournoi = :idTournoi
    UNION ALL
    SELECT idPoule, idEquipe5 FROM Poules WHERE idTournoi = :idTournoi
    UNION ALL
    SELECT idPoule, idEquipe6 FROM Poules WHERE idTournoi = :idTournoi
) AS EquipesTournoi
GROUP BY idPoule; ");
        $statement->execute(
            [
                'idTournoi' => $idTournoi
            ]
        );
        $nbDansPoules=$statement->fetchall();

        $nbMatchNormalement=0;


        for($i=0;$i<$nbPoules['nb'];$i++){
            $nbMatchNormalement+=((int)$nbDansPoules[$i]['nombreEquipes']*((int)$nbDansPoules[$i]['nombreEquipes']-1))/2;
        }
        //match poule fini

        if(($nbMatchPoule['nb']== $nbMatchNormalement)){
            //var_dump("match poule fini");


//-----------------------------insert-------------------------------------------------------------------------

            /*//////////////////////////////AJOUTER DES MATCHS//////////////////////////////*/


            for($i=0;$i<$nbAqualifie;$i++) {
                $listeEquipePasse[$i]=$totalEquipes[$i]['idEquipe'];
            }




//consolante

            if(((int)$nbequipe[0]['nb']-(int)$nbAqualifie)>1) {
                //var_dump("creation des consolante");

                for ($i = 0; $i < (int)$nbequipe[0]['nb']-(int)$nbAqualifie; $i++) {
                    $listeEquipePoule[$i] = $totalEquipes[$i+(int)$nbAqualifie]['idEquipe'];
                }



                for ($i = 0; $i< count($listeEquipePoule); $i++) {

                    for ($j = $i +
                        1; $j < count($listeEquipePoule);
                         $j++) {
                        unset($insertMatchVide);

                        $insertMatchVide = $pdo->prepare("INSERT
INTO Matchs(idEquipe1, idEquipe2, idTournoi, matchPoule) values(:varEqu1,:varEqu2,:varIdT,0)");

                        $insertMatchVide->execute(

                            [

                                "varIdT" => $idTournoi,

                                "varEqu1" => $listeEquipePoule[$i],

                                "varEqu2" => $listeEquipePoule[$j]

                            ]

                        );

                    }

                }
            }
            //match arbre
            for($i=0;$i<$nbAqualifie/2;$i++) {

                unset($insertMatchVide);

                $insertMatchVide = $pdo->prepare("INSERT INTO Matchs(idEquipe1, idEquipe2, idTournoi, matchPoule) values(:varEqu1,:varEqu2,:varIdT,0)");

                $insertMatchVide->execute(

                    [

                        "varIdT" => $idTournoi,

                        "varEqu1" => $listeEquipePasse[$i],

                        "varEqu2" => $listeEquipePasse[$nbAqualifie-1-$i]

                    ]

                );


            }

        }

        /*//////////////////////////////////////////////////////////////////////////////*/




    }

//match arbre
    //var_dump($match[0]["matchPoule"]);
    //var_dump($arbreconsolante);
    if (!$match[0]["matchPoule"] && $arbreconsolante) {
        //var_dump("match arbre");


        //var_dump($nbAqualifie);
        $valeurArbre = 0;
        for ($i = 0; $i < $nbAqualifie; $i++) {

            unset($statement);
            $statement = $pdo->prepare("SELECT count(*) as nb from Match_tennis where idMatch in(select idMatch from Matchs where idEquipe1= :equipe and matchPoule=0)");
            $statement->execute(
                [
                    'equipe' => $equipequalifier[$i]
                ]
            );
            $count = $statement->fetch();
            $valeurArbre =$valeurArbre+ (int)$count["nb"];


        }

        if ($nbAqualifie == 16)
            $niveauMaxArbre = 3;
        if ($nbAqualifie == 8)
            $niveauMaxArbre = 2;
        if ($nbAqualifie == 4)
            $niveauMaxArbre = 1;
        if ($nbAqualifie == 2)
            $niveauMaxArbre = 0;
        /*
var_dump($niveauMaxArbre);
var_dump("valeur");
var_dump($valeurArbre);
var_dump($nbAqualifie/2);
        */

        if ((int)$valeurArbre == $nbAqualifie / 2 && $niveauMaxArbre > 0) {

            //var_dump("etage 1");
            unset($statement);
            $statement = $pdo->prepare("SELECT idEquipe1, idEquipe2,idMatch, idTournoi from Matchs where idTournoi = :idTournoi and matchPoule=0 order by idMatch desc limit " . intval($nbAqualifie / 2) . "");
            $statement->execute(
                [
                    'idTournoi' => $idTournoi
                ]
            );
            $matchsArbreNiv1 = $statement->fetchall();


            $tableauGagnant = array();
            for ($i = 0; $i < $nbAqualifie / 2; $i++) {


                //$matchsArbreNiv1[$i]["idEquipe1"]
                unset($statement);
                /*
                $statement = $pdo->prepare("select getGagnantTen( " . intval($matchsArbreNiv1[$i]["idEquipe1"]) . " , " . intval($matchsArbreNiv1[$i]["idEquipe2"]) . " , " . intval($idTournoi) . " ,0) as idEquipe");
               */
                $statement = $pdo->prepare("select idMatch ,idEquipe1,idEquipe2 from Matchs where idTournoi= :idTournoi and matchPoule =0 and (idEquipe1= :idEquipe1 or idEquipe1= :idEquipe2) and (idEquipe2= :idEquipe1 or idEquipe2= :idEquipe2);");
                $statement->execute(
                    [
                        'idTournoi' => $idTournoi,
                        'idEquipe1' => $matchsArbreNiv1[$i]["idEquipe1"],
                        'idEquipe2' => $matchsArbreNiv1[$i]["idEquipe2"]
                    ]
                );
                $matchEtEquipe= $statement->fetch();

//var_dump($idTournoi);
//var_dump("i");
//var_dump($i);
//var_dump($matchsArbreNiv1);

                unset($statement);
                //var_dump($matchEtEquipe);
                $statement = $pdo->prepare("select setEquipe1,setEquipe2 from Match_tennis where idMatch= :idMatch;");
                $statement->execute(
                    [
                        'idMatch' => $matchEtEquipe["idMatch"]
                    ]
                );
                $pointMatch = $statement->fetch();

                if($pointMatch["setEquipe1"]>$pointMatch["setEquipe2"]){
                    $tableauGagnant[$i] = $matchEtEquipe["idEquipe1"];

                }else{
                    $tableauGagnant[$i] = $matchEtEquipe["idEquipe2"];

                }

            }

//2 passe a 4
            for ($i = 0; $i <= $nbAqualifie / 4; $i++) {
                unset($statement);
//var_dump($tableauGagnant);
//var_dump($i);
//var_dump($nbAqualifie/4+$i);


                $statement = $pdo->prepare("insert into Matchs (idEquipe1,idEquipe2,idTournoi,matchPoule)values ( :equipe1, :equipe2, :idTournoi,0);");
                $statement->execute(
                    [
                        'idTournoi' => $idTournoi,
                        'equipe1' => $tableauGagnant[1+$i],
                        'equipe2' => $tableauGagnant[$i]
                    ]
                );
                $i++;
            }
        }
        if ($valeurArbre == $nbAqualifie / 4 + $nbAqualifie / 2 && $niveauMaxArbre > 1) {
            //var_dump("etage 2");
            unset($statement);
            $statement = $pdo->prepare("SELECT idEquipe1, idEquipe2,idMatch, idTournoi from Matchs where idTournoi = :idTournoi and matchPoule=0 order by idMatch desc limit " . intval($nbAqualifie / 4) . "");
            $statement->execute(
                [
                    'idTournoi' => $idTournoi
                ]
            );
            $matchsArbreNiv1 = $statement->fetchall();


            $tableauGagnant = array();
            for ($i = 0; $i < $nbAqualifie / 4; $i++) {
                unset($statement);
                /*
                $statement = $pdo->prepare("select getGagnantTennis( " . intval($matchsArbreNiv1[$i]["idEquipe1"]) . " , " . intval($matchsArbreNiv1[$i]["idEquipe2"]) . " , " . intval($idTournoi) . " ,0) as idEquipe");
               */
                $statement = $pdo->prepare("select idMatch ,idEquipe1,idEquipe2 from Matchs where idTournoi= :idTournoi and matchPoule =0 and (idEquipe1= :idEquipe1 or idEquipe1= :idEquipe2) and (idEquipe2= :idEquipe1 or idEquipe2= :idEquipe2);");
                $statement->execute(
                    [
                        'idTournoi' => $idTournoi,
                        'idEquipe1' => $matchsArbreNiv1[$i]["idEquipe1"],
                        'idEquipe2' => $matchsArbreNiv1[$i]["idEquipe2"]
                    ]
                );
                $matchEtEquipe= $statement->fetch();
                //var_dump($idTournoi);
                //var_dump("i");
                //var_dump($i);
                //var_dump($matchsArbreNiv1);
                unset($statement);
                $statement = $pdo->prepare("select setEquipe1,setEquipe2 from Match_tennis where idMatch= :idMatch;");
                $statement->execute(
                    [
                        'idMatch' => $matchEtEquipe["idMatch"]
                    ]
                );
                $pointMatch = $statement->fetch();

                if($pointMatch["setEquipe1"]>$pointMatch["setEquipe2"]){
                    $tableauGagnant[$i] = $matchEtEquipe["idEquipe1"];
                }else{
                    $tableauGagnant[$i] = $matchEtEquipe["idEquipe2"];
                }
            }

            for ($i = 0; $i < $nbAqualifie / 8; $i++) {
                //var_dump($tableauGagnant);
                //var_dump($i);
                //var_dump($nbAqualifie/8+$i);
                //var_dump($tableauGagnant);
                unset($statement);
                $statement = $pdo->prepare("insert into Matchs (idEquipe1,idEquipe2,idTournoi,matchPoule)values ( :equipe1, :equipe2, :idTournoi,0);");
                $statement->execute(
                    [
                        'idTournoi' => $idTournoi,
                        'equipe1' => $tableauGagnant[1+$i],
                        'equipe2' => $tableauGagnant[$i]
                    ]
                );
                $i++;
            }


        }
        if ($valeurArbre == $nbAqualifie / 8 + $nbAqualifie / 4 + $nbAqualifie / 2 && $niveauMaxArbre > 2) {
            //var_dump("etage 3");
            unset($statement);
            $statement = $pdo->prepare("SELECT idEquipe1, idEquipe2,idMatch, idTournoi from Matchs where idTournoi = :idTournoi and matchPoule=0 order by idMatch desc limit " . intval($nbAqualifie / 8 + $nbAqualifie / 4 + $nbAqualifie / 2) . "");
            $statement->execute(
                [
                    'idTournoi' => $idTournoi
                ]
            );
            $matchsArbreNiv1 = $statement->fetchall();


            $tableauGagnant = array();
            for ($i = 0; $i < $nbAqualifie / 16; $i++) {
                unset($statement);
                /*
                $statement = $pdo->prepare("select getGagnantTennis( " . intval($matchsArbreNiv1[$i]["idEquipe1"]) . " , " . intval($matchsArbreNiv1[$i]["idEquipe2"]) . " , " . intval($idTournoi) . " ,0) as idEquipe");
               */
                $statement = $pdo->prepare("select idMatch ,idEquipe1,idEquipe2 from Matchs where idTournoi= :idTournoi and matchPoule =0 and (idEquipe1= :idEquipe1 or idEquipe1= :idEquipe2) and (idEquipe2= :idEquipe1 or idEquipe2= :idEquipe2);");
                $statement->execute(
                    [
                        'idTournoi' => $idTournoi,
                        'idEquipe1' => $matchsArbreNiv1[$i]["idEquipe1"],
                        'idEquipe2' => $matchsArbreNiv1[$i]["idEquipe2"]
                    ]
                );
                $matchEtEquipe= $statement->fetch();

                unset($statement);
                $statement = $pdo->prepare("select setEquipe1,setEquipe2 from Match_tennis where idMatch= :idMatch;");
                $statement->execute(
                    [
                        'idMatch' => $matchEtEquipe["idMatch"]
                    ]
                );
                $pointMatch = $statement->fetch();

                if($pointMatch["setEquipe1"]>$pointMatch["setEquipe2"]){
                    $tableauGagnant[$i] = $matchEtEquipe["idEquipe1"];
                }else{
                    $tableauGagnant[$i] = $matchEtEquipe["idEquipe2"];
                }
            }

            for ($i = 0; $i < $nbAqualifie / 16; $i++) {
                unset($statement);
                $statement = $pdo->prepare("insert into Matchs (idEquipe1,idEquipe2,idTournoi,matchPoule)values ( :equipe1, :equipe1, :idTournoi,0);");
                $statement->execute(
                    [
                        'idTournoi' => $idTournoi,
                        'equipe1' => $tableauGagnant[1+$i],
                        'equipe2' => $tableauGagnant[$i]
                    ]
                );
                $i++;
            }
        }
    }
}
//---------------------------------------------------------------------------------------------------------------------------------------------
if ($discipline=="Pétanque"){
//match arbre ou consolante
    //var_dump("petanque");
    if (!$match[0]["matchPoule"]) {
        //var_dump("match arbre ou consolante");

        $arbreconsolante = false;

        $totalEquipes[] = array();




        for ($i = 0; $i < $nbAqualifie; $i++) {
            if ($match[0]["idEquipe1"] == $totalEquipes[$i]["idEquipe"] or $match[0]["idEquipe2"] == $totalEquipes[$i]["idEquipe"]) {
                $arbreconsolante = true;

            }
            $equipequalifier[$i] = $totalEquipes[$i]["idEquipe"];
        }

    }

//match poule
    if ($match[0]["matchPoule"]){
        //var_dump("match poule");
        unset($statement);
        $statement = $pdo->prepare("SELECT count(distinct idMatch) as nb from Manches_petanque where idMatch in(select idMatch from Matchs where idTournoi= :idTournoi and matchPoule=1);");
        $statement->execute(
            [
                'idTournoi' => $idTournoi
            ]
        );

        $nbMatchPoule=$statement->fetch();
        unset($statement);
        $statement = $pdo->prepare("SELECT count(idTournoi) as nb from Poules where idTournoi= :idTournoi ");
        $statement->execute(
            [
                'idTournoi' => $idTournoi
            ]
        );
        $nbPoules=$statement->fetch();
        unset($statement);
        $statement = $pdo->prepare("SELECT COUNT(idEquipe) AS nombreEquipes
FROM (
    SELECT idPoule, idEquipe1 AS idEquipe FROM Poules WHERE idTournoi = :idTournoi
    UNION ALL
    SELECT idPoule, idEquipe2 FROM Poules WHERE idTournoi = :idTournoi
    UNION ALL
    SELECT idPoule, idEquipe3 FROM Poules WHERE idTournoi = :idTournoi
    UNION ALL
    SELECT idPoule, idEquipe4 FROM Poules WHERE idTournoi = :idTournoi
    UNION ALL
    SELECT idPoule, idEquipe5 FROM Poules WHERE idTournoi = :idTournoi
    UNION ALL
    SELECT idPoule, idEquipe6 FROM Poules WHERE idTournoi = :idTournoi
) AS EquipesTournoi
GROUP BY idPoule; ");
        $statement->execute(
            [
                'idTournoi' => $idTournoi
            ]
        );
        $nbDansPoules=$statement->fetchall();

        $nbMatchNormalement=0;


        for($i=0;$i<$nbPoules['nb'];$i++){
            $nbMatchNormalement+=((int)$nbDansPoules[$i]['nombreEquipes']*((int)$nbDansPoules[$i]['nombreEquipes']-1))/2;
        }
        //match poule fini

        if(($nbMatchPoule['nb']== $nbMatchNormalement)){
            //var_dump("match poule fini");



//-----------------------------insert-------------------------------------------------------------------------

            /*//////////////////////////////AJOUTER DES MATCHS//////////////////////////////*/


            for($i=0;$i<$nbAqualifie;$i++) {
                $listeEquipePasse[$i]=$totalEquipes[$i]['idEquipe'];
            }




//consolante

            if(((int)$nbequipe[0]['nb']-(int)$nbAqualifie)>1) {
                //var_dump("creation des consolante");

                for ($i = 0; $i < (int)$nbequipe[0]['nb']-(int)$nbAqualifie; $i++) {
                    $listeEquipePoule[$i] = $totalEquipes[$i+(int)$nbAqualifie]['idEquipe'];
                }



                for ($i = 0; $i< count($listeEquipePoule); $i++) {

                    for ($j = $i +
                        1; $j < count($listeEquipePoule);
                         $j++) {
                        unset($insertMatchVide);

                        $insertMatchVide = $pdo->prepare("INSERT
INTO Matchs(idEquipe1, idEquipe2, idTournoi, matchPoule) values(:varEqu1,:varEqu2,:varIdT,0)");

                        $insertMatchVide->execute(

                            [

                                "varIdT" => $idTournoi,

                                "varEqu1" => $listeEquipePoule[$i],

                                "varEqu2" => $listeEquipePoule[$j]

                            ]

                        );

                    }

                }
            }
            //match arbre
            for($i=0;$i<$nbAqualifie/2;$i++) {

                unset($insertMatchVide);

                $insertMatchVide = $pdo->prepare("INSERT INTO Matchs(idEquipe1, idEquipe2, idTournoi, matchPoule) values(:varEqu1,:varEqu2,:varIdT,0)");

                $insertMatchVide->execute(

                    [

                        "varIdT" => $idTournoi,

                        "varEqu1" => $listeEquipePasse[$i],

                        "varEqu2" => $listeEquipePasse[$nbAqualifie-1-$i]

                    ]

                );


            }

        }

        /*//////////////////////////////////////////////////////////////////////////////*/




    }

//match arbre
    if (!$match[0]["matchPoule"] && $arbreconsolante) {
        //var_dump("match arbre");

        //var_dump($nbAqualifie);
        $valeurArbre = 0;
        for ($i = 0; $i < $nbAqualifie; $i++) {

            unset($statement);
            $statement = $pdo->prepare("SELECT count(distinct idMatch) as nb from Manches_petanque where idMatch in(select idMatch from Matchs where idEquipe1= :equipe and matchPoule=0)");
            $statement->execute(
                [
                    'equipe' => $equipequalifier[$i]
                ]
            );
            $count = $statement->fetch();
            $valeurArbre =$valeurArbre+ (int)$count["nb"];


        }

        if ($nbAqualifie == 16)
            $niveauMaxArbre = 3;
        if ($nbAqualifie == 8)
            $niveauMaxArbre = 2;
        if ($nbAqualifie == 4)
            $niveauMaxArbre = 1;
        if ($nbAqualifie == 2)
            $niveauMaxArbre = 0;
        /*
var_dump($niveauMaxArbre);
var_dump("valeur");
var_dump($valeurArbre);
var_dump($nbAqualifie/2);
        */
        if ((int)$valeurArbre == $nbAqualifie / 2 && $niveauMaxArbre > 0) {
//var_dump("etage 1");
            unset($statement);
            $statement = $pdo->prepare("SELECT idEquipe1, idEquipe2,idMatch, idTournoi from Matchs where idTournoi = :idTournoi and matchPoule=0 order by idMatch desc limit " . intval($nbAqualifie / 2) . "");
            $statement->execute(
                [
                    'idTournoi' => $idTournoi
                ]
            );
            $matchsArbreNiv1 = $statement->fetchall();


            $tableauGagnant = array();
            for ($i = 0; $i < $nbAqualifie / 2; $i++) {
                //$matchsArbreNiv1[$i]["idEquipe1"]
                unset($statement);

                $statement = $pdo->prepare("select idMatch ,idEquipe1,idEquipe2 from Matchs where idTournoi= :idTournoi and matchPoule =0 and (idEquipe1= :idEquipe1 or idEquipe1= :idEquipe2) and (idEquipe2= :idEquipe1 or idEquipe2= :idEquipe2);");
                $statement->execute(
                    [
                        'idTournoi' => $idTournoi,
                        'idEquipe1' => $matchsArbreNiv1[$i]["idEquipe1"],
                        'idEquipe2' => $matchsArbreNiv1[$i]["idEquipe2"]
                    ]
                );
                $matchEtEquipe= $statement->fetch();
//var_dump($idTournoi);
//var_dump("i");
//var_dump($i);
//var_dump($matchsArbreNiv1);

                unset($statement);
                //var_dump($matchEtEquipe);
                $statement = $pdo->prepare("select sum(pointsEquipe1) as butsEquipe1,sum(pointsEquipe2) as butsEquipe2 from Manches_petanque where idMatch=  :idMatch;");
                $statement->execute(
                    [
                        'idMatch' => $matchEtEquipe["idMatch"]
                    ]
                );
                $pointMatch = $statement->fetch();

                if($pointMatch["butsEquipe1"]>$pointMatch["butsEquipe2"]){
                    $tableauGagnant[$i] = $matchEtEquipe["idEquipe1"];
                }else{
                    $tableauGagnant[$i] = $matchEtEquipe["idEquipe2"];
                }
            }
//2 passe a 4
            for ($i = 0; $i <= $nbAqualifie / 4; $i++) {
                unset($statement);
//var_dump($tableauGagnant);
//var_dump($i);
//var_dump($nbAqualifie/4+$i);


                $statement = $pdo->prepare("insert into Matchs (idEquipe1,idEquipe2,idTournoi,matchPoule)values ( :equipe1, :equipe2, :idTournoi,0);");
                $statement->execute(
                    [
                        'idTournoi' => $idTournoi,
                        'equipe1' => $tableauGagnant[1+$i],
                        'equipe2' => $tableauGagnant[$i]
                    ]
                );
                $i++;
            }
        }
        if ($valeurArbre == $nbAqualifie / 4 + $nbAqualifie / 2 && $niveauMaxArbre > 1) {
            //var_dump("etage 2");
            unset($statement);
            $statement = $pdo->prepare("SELECT idEquipe1, idEquipe2,idMatch, idTournoi from Matchs where idTournoi = :idTournoi and matchPoule=0 order by idMatch desc limit " . intval($nbAqualifie / 4) . "");
            $statement->execute(
                [
                    'idTournoi' => $idTournoi
                ]
            );
            $matchsArbreNiv1 = $statement->fetchall();


            $tableauGagnant = array();
            for ($i = 0; $i < $nbAqualifie / 4; $i++) {
                unset($statement);

                $statement = $pdo->prepare("select idMatch ,idEquipe1,idEquipe2 from Matchs where idTournoi= :idTournoi and matchPoule =0 and (idEquipe1= :idEquipe1 or idEquipe1= :idEquipe2) and (idEquipe2= :idEquipe1 or idEquipe2= :idEquipe2);");
                $statement->execute(
                    [
                        'idTournoi' => $idTournoi,
                        'idEquipe1' => $matchsArbreNiv1[$i]["idEquipe1"],
                        'idEquipe2' => $matchsArbreNiv1[$i]["idEquipe2"]
                    ]
                );
                $matchEtEquipe= $statement->fetch();
                //var_dump($idTournoi);
                //var_dump("i");
                //var_dump($i);
                //var_dump($matchsArbreNiv1);
                unset($statement);
                $statement = $pdo->prepare("select sum(pointsEquipe1) as butsEquipe1,sum(pointsEquipe2) as butsEquipe2 from Manches_petanque where idMatch=  :idMatch;");
                $statement->execute(
                    [
                        'idMatch' => $matchEtEquipe["idMatch"]
                    ]
                );
                $pointMatch = $statement->fetch();

                if($pointMatch["butsEquipe1"]>$pointMatch["butsEquipe2"]){
                    $tableauGagnant[$i] = $matchEtEquipe["idEquipe1"];
                }else{
                    $tableauGagnant[$i] = $matchEtEquipe["idEquipe2"];
                }
            }

            for ($i = 0; $i < $nbAqualifie / 8; $i++) {
                //var_dump($tableauGagnant);
                //var_dump($i);
                //var_dump($nbAqualifie/8+$i);
                //var_dump($tableauGagnant);
                unset($statement);
                $statement = $pdo->prepare("insert into Matchs (idEquipe1,idEquipe2,idTournoi,matchPoule)values ( :equipe1, :equipe2, :idTournoi,0);");
                $statement->execute(
                    [
                        'idTournoi' => $idTournoi,
                        'equipe1' => $tableauGagnant[1+$i],
                        'equipe2' => $tableauGagnant[$i]
                    ]
                );
                $i++;
            }


        }
        if ($valeurArbre == $nbAqualifie / 8 + $nbAqualifie / 4 + $nbAqualifie / 2 && $niveauMaxArbre > 2) {
            //var_dump("etage 3");
            unset($statement);
            $statement = $pdo->prepare("SELECT idEquipe1, idEquipe2,idMatch, idTournoi from Matchs where idTournoi = :idTournoi and matchPoule=0 order by idMatch desc limit " . intval($nbAqualifie / 8 + $nbAqualifie / 4 + $nbAqualifie / 2) . "");
            $statement->execute(
                [
                    'idTournoi' => $idTournoi
                ]
            );
            $matchsArbreNiv1 = $statement->fetchall();


            $tableauGagnant = array();
            for ($i = 0; $i < $nbAqualifie / 16; $i++) {
                unset($statement);

                $statement = $pdo->prepare("select idMatch ,idEquipe1,idEquipe2 from Matchs where idTournoi= :idTournoi and matchPoule =0 and (idEquipe1= :idEquipe1 or idEquipe1= :idEquipe2) and (idEquipe2= :idEquipe1 or idEquipe2= :idEquipe2);");
                $statement->execute(
                    [
                        'idTournoi' => $idTournoi,
                        'idEquipe1' => $matchsArbreNiv1[$i]["idEquipe1"],
                        'idEquipe2' => $matchsArbreNiv1[$i]["idEquipe2"]
                    ]
                );
                $matchEtEquipe= $statement->fetch();

                unset($statement);
                $statement = $pdo->prepare("select sum(pointsEquipe1) as butsEquipe1,sum(pointsEquipe2) as butsEquipe2 from Manches_petanque where idMatch=  :idMatch;");
                $statement->execute(
                    [
                        'idMatch' => $matchEtEquipe["idMatch"]
                    ]
                );
                $pointMatch = $statement->fetch();

                if($pointMatch["butsEquipe1"]>$pointMatch["butsEquipe2"]){
                    $tableauGagnant[$i] = $matchEtEquipe["idEquipe1"];
                }else{
                    $tableauGagnant[$i] = $matchEtEquipe["idEquipe2"];
                }
            }

            for ($i = 0; $i < $nbAqualifie / 16; $i++) {
                unset($statement);
                $statement = $pdo->prepare("insert into Matchs (idEquipe1,idEquipe2,idTournoi,matchPoule)values ( :equipe1, :equipe1, :idTournoi,0);");
                $statement->execute(
                    [
                        'idTournoi' => $idTournoi,
                        'equipe1' => $tableauGagnant[1+$i],
                        'equipe2' => $tableauGagnant[$i]
                    ]
                );
                $i++;
            }
        }
    }
}