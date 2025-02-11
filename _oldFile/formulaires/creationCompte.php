<?php
$titre = "Créer un compte";
include ROOT . "/modules/header.php"; 


?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title>Se connecter</title>
</head>

<body>

    <main>
        <form id="FormConnexion" action="/formulaires/traitement_creation_compte" method="post">
            <div id="admin_rect"><!-- id du div du rectangle noir en interface administrateur  -->

                

                <input id="ID" class="admin_rect_contenu" type="text" name="ID" class="taille_input_form" placeholder="Identifiant">
                <div id="barre_sous_id" class="barre_classe"></div>
                <div class="mdp">
                    <input id="mdp" type="password" name="mdp" placeholder="Mot de passe">
                    <img src="/img/eye-close.svg" id="oeil" onClick="changer()"/>
                </div>
                <div id="barre_sous_mdp" class="barre_classe"></div>

            
                <button class="admin_rect_contenu" type=”submit” id="bouton_connexion">Créer son compte</button>
            </div>
        </form>
        <script>
            /*fonction pour afficher le mdp ou non*/
            e=true;
            function changer(){
                if(e){
                    document.getElementById("mdp").setAttribute("type","text");
                    document.getElementById("oeil").src="/img/eye-open.svg"
                    e=false;
                }else{
                    document.getElementById("mdp").setAttribute("type","password");
                    document.getElementById("oeil").src="/img/eye-close.svg"
                    e=true;
                }
            }
        </script>
    </main>

    <?php
    include ROOT . "/modules/footer.php";
    ?>
</body>
