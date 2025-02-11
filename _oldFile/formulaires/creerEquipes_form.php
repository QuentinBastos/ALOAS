<?php


 if(!isset($_SESSION['connecté'])){
     $_SESSION['connecté'] = false;
     header('Location: /index.');
   }
   include ROOT . '/include/pdo.php' ; 
$_SESSION['creer']=true ; 
$_SESSION['dejala']=false;


/**
 * On récupère les données du formulaire
 */
switch ($_POST['icones_liste']) {
    case 1:
        $_SESSION['stock_icones_chemin']="/icones/fourmi.svg";
        $_SESSION['stock_icones_alt']="Icône de fourmis";
        break;
    case 2:
        $_SESSION['stock_icones_chemin']="/icones/ours.svg";
        $_SESSION['stock_icones_alt']="Icône d'Ours'";
        break;
    case 3:
        $_SESSION['stock_icones_chemin']="/icones/oiseau.svg";
        $_SESSION['stock_icones_alt']="Icône d'oiseau'";
        break;
    case 4:
        $_SESSION['stock_icones_chemin']="/icones/papillon.svg";
        $_SESSION['stock_icones_alt']="Icône de papillon";
        break;
    case 5:
        $_SESSION['stock_icones_chemin']="/icones/chat.svg";
        $_SESSION['stock_icones_alt']="Icône de chat";
        break;
    case 6:
        $_SESSION['stock_icones_chemin']="/icones/vache.svg";
        $_SESSION['stock_icones_alt']="Icône de vache";
        break;
    case 7:
        $_SESSION['stock_icones_chemin']="/icones/crocodile.svg";
        $_SESSION['stock_icones_alt']="Icône de crocodile";
        break;
    case 8:
        $_SESSION['stock_icones_chemin']="/icones/chien.svg";
        $_SESSION['stock_icones_alt']="Icône de chien";
        break;
    case 9:
        $_SESSION['stock_icones_chemin']="/icones/canard.svg";
        $_SESSION['stock_icones_alt']="Icône de canard";
        break;
    case 10:
        $_SESSION['stock_icones_chemin']="/icones/elephant.svg";
        $_SESSION['stock_icones_alt']="Icône d'elephants'";
        break;
    case 11:
        $_SESSION['stock_icones_chemin']="/icones/poisson.svg";
        $_SESSION['stock_icones_alt']="Icône de poisson";
        break;
    case 12:
        $_SESSION['stock_icones_chemin']="/icones/girafe.svg";
        $_SESSION['stock_icones_alt']="Icône de girafe";
        break;
    case 13:
        $_SESSION['stock_icones_chemin']="/icones/hérisson.svg";
        $_SESSION['stock_icones_alt']="Icône de hérisson";
        break;
    case 14:
        $_SESSION['stock_icones_chemin']="/icones/abeille.svg";
        $_SESSION['stock_icones_alt']="Icône d'abeille";
        break;
    case 15:
        $_SESSION['stock_icones_chemin']="/icones/chevaux.svg";
        $_SESSION['stock_icones_alt']="Icône de cheval";
        break;
    case 16:
        $_SESSION['stock_icones_chemin']="/icones/singe.svg";
        $_SESSION['stock_icones_alt']="Icône de singe";
        break;
    case 17:
        $_SESSION['stock_icones_chemin']="/icones/souris.svg";
        $_SESSION['stock_icones_alt']="Icône de souris";
        break;
    case 18:
        $_SESSION['stock_icones_chemin']="/icones/pingouin.svg";
        $_SESSION['stock_icones_alt']="Icône de pingouin";
        break;
    case 19:
        $_SESSION['stock_icones_chemin']="/icones/cochon.svg";
        $_SESSION['stock_icones_alt']="Icône de cochon";
        break;
    case 20:
        $_SESSION['stock_icones_chemin']="/icones/lapin.svg";
        $_SESSION['stock_icones_alt']="Icône de lapin";
        break;
    case 21:
        $_SESSION['stock_icones_chemin']="/icones/coq.svg";
        $_SESSION['stock_icones_alt']="Icône de coq";
        break;
    case 22:
        $_SESSION['stock_icones_chemin']="/icones/mouton.svg";
        $_SESSION['stock_icones_alt']="Icône de mouton";
        break;
    case 23:
        $_SESSION['stock_icones_chemin']="/icones/serpent.svg";
        $_SESSION['stock_icones_alt']="Icône de serpent";
        break;
    case 24:
        $_SESSION['stock_icones_chemin']="/icones/araignée.svg";
        $_SESSION['stock_icones_alt']="Icône d'araignée";
        break;
    case 25:
        $_SESSION['stock_icones_chemin']="/icones/tortue.svg";
        $_SESSION['stock_icones_alt']="Icône de tortue";
        break;
    case 26:
        $_SESSION['stock_icones_chemin']="/icones/aigle.svg";
        $_SESSION['stock_icones_alt']="Icône d'aigle";
        break;
    case 27:
        $_SESSION['stock_icones_chemin']="/icones/baleine.svg";
        $_SESSION['stock_icones_alt']="Icône de baleine";
        break;
    case 28:
        $_SESSION['stock_icones_chemin']="/icones/castor.svg";
        $_SESSION['stock_icones_alt']="Icône de castor";
        break;
    case 29:
        $_SESSION['stock_icones_chemin']="/icones/cerf.svg";
        $_SESSION['stock_icones_alt']="Icône de cerf";
        break;
    case 30:
        $_SESSION['stock_icones_chemin']="/icones/chameau.svg";
        $_SESSION['stock_icones_alt']="Icône de chameau";
        break;
    case 31:
        $_SESSION['stock_icones_chemin']="/icones/chauve_souris.svg";
        $_SESSION['stock_icones_alt']="Icône de chauve_souris";
        break;
    case 32:
        $_SESSION['stock_icones_chemin']="/icones/chenille.svg";
        $_SESSION['stock_icones_alt']="Icône de chenille";
        break;
    case 33:
        $_SESSION['stock_icones_chemin']="/icones/crabe.svg";
        $_SESSION['stock_icones_alt']="Icône de crabe";
        break;
    case 34:
        $_SESSION['stock_icones_chemin']="/icones/escargot.svg";
        $_SESSION['stock_icones_alt']="Icône d'escargot";
        break;
    case 35:
        $_SESSION['stock_icones_chemin']="/icones/flammant_rose.svg";
        $_SESSION['stock_icones_alt']="Icône de flammant rose";
        break;
    case 36:
        $_SESSION['stock_icones_chemin']="/icones/hibou.svg";
        $_SESSION['stock_icones_alt']="Icône de hibou";
        break;
    case 37:
        $_SESSION['stock_icones_chemin']="/icones/koala.svg";
        $_SESSION['stock_icones_alt']="Icône de koala";
        break;
    case 38:
        $_SESSION['stock_icones_chemin']="/icones/lezard.svg";
        $_SESSION['stock_icones_alt']="Icône de lezard";
        break;
    case 39:
        $_SESSION['stock_icones_chemin']="/icones/loutre.svg";
        $_SESSION['stock_icones_alt']="Icône de loutre";
        break;
    case 40:
        $_SESSION['stock_icones_chemin']="/icones/mammouth.svg";
        $_SESSION['stock_icones_alt']="Icône de mammouth";
        break;
    case 41:
        $_SESSION['stock_icones_chemin']="/icones/meduse.svg";
        $_SESSION['stock_icones_alt']="Icône de meduse";
        break;
    case 42:
        $_SESSION['stock_icones_chemin']="/icones/moustique.svg";
        $_SESSION['stock_icones_alt']="Icône de moustique";
        break;
    case 43:
        $_SESSION['stock_icones_chemin']="/icones/perroquet.svg";
        $_SESSION['stock_icones_alt']="Icône de perroquet";
        break;
    case 44:
        $_SESSION['stock_icones_chemin']="/icones/phoque.svg";
        $_SESSION['stock_icones_alt']="Icône de phoque";
        break;
    case 45:
        $_SESSION['stock_icones_chemin']="/icones/pieuvre.svg";
        $_SESSION['stock_icones_alt']="Icône de pieuvre";
        break;
    case 46:
        $_SESSION['stock_icones_chemin']="/icones/requin.svg";
        $_SESSION['stock_icones_alt']="Icône de requin";
        break;
    case 47:
        $_SESSION['stock_icones_chemin']="/icones/rhinoceros.svg";
        $_SESSION['stock_icones_alt']="Icône de rhinoceros";
        break;
    case 48:
        $_SESSION['stock_icones_chemin']="/icones/scarabee.svg";
        $_SESSION['stock_icones_alt']="Icône de scrabee";
        break;
    case 49:
        $_SESSION['stock_icones_chemin']="/icones/tigre.svg";
        $_SESSION['stock_icones_alt']="Icône de tigre";
        break;
    case 50:
        $_SESSION['stock_icones_chemin']="/icones/ver.svg";
        $_SESSION['stock_icones_alt']="Icône de ver";
        break;
}


$_SESSION['stock_nom_cr'] = $_POST['nomEquipe'];
$_SESSION['pageTournoiDejaVisite']=false;

header("location:  /organiser/organiser");