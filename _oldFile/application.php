<?php 

const ROOT = __DIR__;

include_once ROOT. "/classes/classe_tournoi.php";
include_once ROOT. "/classes/classe_equipe.php";
session_start();

if(isset($_SERVER['REQUEST_URI'])){
  $PATH_INFO = parse_url($_SERVER['REQUEST_URI']);
  $PATH_INFO = $PATH_INFO["path"];
 

  if($PATH_INFO == '/index' || $PATH_INFO == '/'){
    include(ROOT.'/affichage_tournoi/index.php');
  }
  if($PATH_INFO == '/affichage_tournoi/index'){
    include(ROOT.'/affichage_tournoi/index.php');
  }
  if($PATH_INFO == '/formulaires/connexion'){
    include(ROOT.'/formulaires/connexion.php');
  }
  if($PATH_INFO == '/formulaires/connexion_info'){
    include(ROOT.'/formulaires/connexion_info.php');
  }
  if($PATH_INFO == '/formulaires/deconnexion'){
    $_SESSION = [];
    session_destroy();
    header('location: /index');
    exit;
  }
  if($PATH_INFO == '/organiser/organiser'){
    if($_SESSION['connecté']){
      include(ROOT.'/organiser/organiser.php');
    }else {
      header('location: /formulaires/connexion');
      exit;
    }
    
  }
  if($PATH_INFO == '/organiser/organiser_poules'){
    include(ROOT.'/organiser/organiser_poules.php');
  }
  if($PATH_INFO == '/organiser/supprEqu'){
    include(ROOT.'/organiser/supprEqu.php');
  }
  if($PATH_INFO == '/hachage/ici_ca_hash'){
      include(ROOT.'/hachage/ici_ca_hash.php');
  }
  if($PATH_INFO == '/formulaires/saisie_points_foot'){
    include(ROOT.'/formulaires/saisie_points_foot.php');
  }
  if($PATH_INFO == '/formulaires/saisie_points_tennis'){
    include(ROOT.'/formulaires/saisie_points_tennis.php');
  }
  if($PATH_INFO == '/formulaires/saisie_points_petanque'){
    include(ROOT.'/formulaires/saisie_points_petanque.php');
  }
  if($PATH_INFO == '/formulaires/traitement_points_petanque'){
    include(ROOT.'/formulaires/traitement_points_petanque.php');
  }
  if($PATH_INFO == '/formulaires/traitement_points_foot'){
    include(ROOT.'/formulaires/traitement_points_foot.php');
  }
  if($PATH_INFO == '/formulaires/traitement_points_tennis'){
    include(ROOT.'/formulaires/traitement_points_tennis.php');
  }
  if($PATH_INFO == '/formulaires/supprimer_tournoi'){
    if($_SESSION['connecté']){
      include(ROOT.'/formulaires/supprimer_tournoi.php');
    }else {
      header('location: /formulaires/connexion');
      exit;
    }
    
  }
  if($PATH_INFO == '/formulaires/initTournoi_form'){
    include(ROOT.'/formulaires/initTournoi_form.php');
  }
  if($PATH_INFO == '/formulaires/creerPoulesTournoi_form'){
    include(ROOT.'/formulaires/creerPoulesTournoi_form.php');
  }
  if($PATH_INFO == '/formulaires/creerEquipes_form'){
    include(ROOT.'/formulaires/creerEquipes_form.php');
  }
  if($PATH_INFO == '/formulaires/initPoules_form'){
    include(ROOT.'/formulaires/initPoules_form.php');
  }
  if($PATH_INFO == '/classement/classement'){
    include(ROOT.'/classement/classement.php');
  }
  if($PATH_INFO == '/classement/classement_fairplay'){
    include(ROOT.'/classement/classement_fairplay.php');
  }
  if($PATH_INFO == '/classement/classement_goalaverage'){
    include(ROOT.'/classement/classement_goalaverage.php');
  }
  if($PATH_INFO == '/affichage_tournoi/vue_tournoi'){
    include(ROOT.'/affichage_tournoi/vue_tournoi.php');
  }
  if($PATH_INFO == '/affichage_tournoi/vue_tournoi_admin'){
    if($_SESSION['connecté']){
      include(ROOT.'/affichage_tournoi/vue_tournoi_admin.php');
    }else {
      header('location: /formulaires/connexion');
      exit;
    }
  }
  if($PATH_INFO == '/affichage_tournoi/tournois_finis'){
    include(ROOT.'/affichage_tournoi/tournois_finis.php');
  }
  if($PATH_INFO == '/affichage_tournoi/tournois_en_cours'){
    include(ROOT.'/affichage_tournoi/tournois_en_cours.php');
  }
  if($PATH_INFO == '/affichage_tournoi/match_petanque'){
    include(ROOT.'/affichage_tournoi/match_petanque.php');
  }
  if($PATH_INFO == '/affichage_tournoi/match_foot'){
    include(ROOT.'/affichage_tournoi/match_foot.php');
  }
  if($PATH_INFO == '/affichage_tournoi/match_tennis'){
    include(ROOT.'/affichage_tournoi/match_tennis.php');
  }
  if($PATH_INFO == '/affichage_tournoi/affichage_poules'){
    include(ROOT.'/affichage_tournoi/affichage_poules.php');
  }
  if($PATH_INFO == '/formulaires/ajout_manche_petanque'){
    include(ROOT.'/formulaires/ajout_manche_petanque.php');
  }
  if($PATH_INFO == '/formulaires/creationCompte'){
    if($_SESSION['connecté']){
      include(ROOT.'/formulaires/creationCompte.php');
    }else {
      header('location: /formulaires/connexion');
      exit;
    }

  }
  if($PATH_INFO == '/formulaires/traitement_creation_compte'){
    if($_SESSION['connecté']){
      include(ROOT.'/formulaires/traitement_creation_compte.php');
    }else {
      header('location: /formulaires/connexion');
      exit;
    }
    
  }


}else{
  include(ROOT.'/affichage_tournoi/index.php');
}
