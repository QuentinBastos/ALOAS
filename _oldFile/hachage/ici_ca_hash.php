
 <?php
 
 if(!isset($_SESSION['connecté'])){
  $_SESSION['connecté'] = false;
  header('location: ../affichage_tournoi/index.php');
  exit;
  }
/* Permet de hacher les mots de passe de la base de donnée  */
/*
require ROOT . '/include/pdo.php' ; 

$statement = $pdo->prepare('SELECT * FROM Admin');

$statement->execute();



while($row = $statement->fetch()){

  set_time_limit(30);

  $mdpCrypte = password_hash($row['MotDePasse'], PASSWORD_DEFAULT);

  $statement2 = $pdo->prepare('UPDATE Admin SET MotDePasse = :password WHERE ID = :id');

  $statement2->execute(

    [

      'password' => $mdpCrypte,

      'id' => $row['ID'],

    ]

  );

}*/  

header('location: ../affichage_tournoi/index');
exit;