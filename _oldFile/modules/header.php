<?php 

$urlactive = $_SERVER['REQUEST_URI'];
if($urlactive == "/modules/header"){
  header('Location: /index');
} 

set_time_limit(7200);



/* Fonction qui permet de mettre en surbrillance le lien de la page active */
function active($urlactive, $url)
{
    if ($urlactive == $url) {
        echo "active";
    }else{
        echo "";

    }
}



if(!($urlactive == "/formulaires/connexion")){
  if(!isset($_SESSION['connecté'])){
    $_SESSION['connecté'] = false;
  }
}

?>

<header>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $titre ?></title>
  <link href="/css/style.css" rel="stylesheet">
  <nav >
  
    <div class="conteneur">
    <!-- Logo de l'association -->
      <a href="/index"><img src="/img/logo.png" id="logo_association" alt="logo de l'association"></a>

    <!-- Barre de navigation -->
      <div class="navB">
      <input type="checkbox" id="hamburger" onclick="logo_invisible()">
      <label id="hamburger_logo" for="hamburger">
      <span id="barre1"></span>
      <span id="barre2"></span>
      <span id="barre3"></span>
      </label>
        <ul class="navbar">
          <li class="navbar_item <?php active($urlactive,"/index")  ?><?php active($urlactive,"/")  ?><?php active($urlactive,"/affichage_tournoi/index")  ?>" >
              <a href="/index">
              <img src="/img/accueil.svg" class="logo" alt="logo d'une maison">
              </a>
              <a href="/index" class="a_nav">Accueil</a>
           
          </li>




          <?php 
          /* Si l'utilisateur est connecté, on donne l'accès au lien vers la page organiser */
          if(isset($_SESSION['connecté'])&& $_SESSION['connecté'] === true){
            if($urlactive == "/organiser/organiser"){
            echo '<li class="navbar_item active"><a href="/organiser/organiser"><img src="/img/organiser.svg" class ="logo" alt="logo d\'un presse papier"></a> <a class="a_nav" href="/organiser/organiser">Organiser</a> </li>';
            }else{
              echo '<li class="navbar_item"><a href="/organiser/organiser"><img src="/img/organiser.svg" class ="logo" alt="logo d\'un presse papier"> <a/> <a class="a_nav" href="/organiser/organiser">Organiser</a> </li>';
            }
          }else {
            echo '<li class="navbar_item"><img src="/img/organiser.svg" id="organiser_logo" alt="logo d\'un presse papier"> <a class="a_nav" id="organiser_texte" href="#">Organiser</a> </li>';
          }          
          ?>
          <!-- Lien vers la page de classement -->
          <li class="navbar_item <?php active($urlactive,"/classement/classement") ?><?php active($urlactive,"/classement/classement_fairplay") ?><?php active($urlactive,"/classement/classement_goalaverage") ?>" >
              <a href="/classement/classement">
              <img src="/img/classement.svg" class="logo" alt="logo d'un podium">
              </a>
              <a href="/classement/classement" class="a_nav ">Classement</a>
           
          </li>
          
          

          <?php 
          if(!isset($_SESSION['connecté']) || $_SESSION['connecté'] === false){  
            /* Si l'utilisateur n'est pas connecté, on lui donne l'accès au lien vers la page de connexion */
            if($urlactive == "/formulaires/connexion"){
              echo '<li class="navbar_item active">
              <a href="/formulaires/connexion">
              <img src="/img/se_connecter.svg" class ="logo" alt="logo d\'un homme">
              </a>
              <a href="/formulaires/connexion" class="a_nav" >Se connecter</a>
              </li>';
              }else{
                
                echo '<li class="navbar_item ">
                <a href="/formulaires/connexion">
                <img src="/img/se_connecter.svg" class ="logo" alt="logo d\'un homme">
                </a>
                <a href="/formulaires/connexion" class="a_nav" >Se connecter</a>
                </li>';
          }
        }

        /* Si l'utilisateur est connecté, on lui donne l'accès au lien vers la page de déconnexion et vers la page de création de comtpe*/
        if(isset($_SESSION['connecté'])&& $_SESSION['connecté'] === true ){
          if($urlactive == "/formulaires/creationCompte"){
            echo '<li class="navbar_item active"><a href="/formulaires/creationCompte"><img src="/img/se_connecter.svg" class ="logo" alt="logo d\'un homme"></a> <a class="a_nav" href="/formulaires/creationCompte">Admin</a> </li>';
          }else{
            echo '<li class="navbar_item"><a href="/formulaires/creationCompte"><img src="/img/se_connecter.svg" class ="logo" alt="logo d\'un homme"></a> <a class="a_nav" href="/formulaires/creationCompte">Admin</a> </li>';
          }
        }

       if( isset($_SESSION['connecté'])&& $_SESSION['connecté'] === true){ 

           echo ' <li class="navbar_item"> <a class="a_nav" href="/formulaires/deconnexion">Déconnexion</a> <a href="/formulaires/deconnexion"> <img src="/img/signout.svg" class ="logo " alt="signout logo"></a> </li>';
      }?>
        </ul>
      </div>

    </div>

  </nav>
  <div>
    <img src="/img/Banniere.svg" id ="banniere" alt="banniere de l'association">

  </div>
</header>
