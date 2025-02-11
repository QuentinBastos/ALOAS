/*---------------------------------------------------------------*/
/*------------------------ORGANISER------------------------------*/
/*---------------------------------------------------------------*/
/* Affiche ou cache le choix de mettre un minuteur sur le tournoi */
function affiche_bloc(CheckBox) {
    if (CheckBox.checked)
   {
    document.getElementById("orga_caché").style.display="block";
   } 
   else
   {
    document.getElementById("orga_caché").style.display="none";
   } 
} 


const popUpCreeEqui1 = document.getElementById('popUpCreeEqui');
const btnOuvrCreeEqui1 = document.getElementById('btnOuvrCreeEqui');
const btnFermCreeEqui1 = document.getElementById('btnFermCreeEqui');

/* Ouverture et fermeture de la pop-up de création d'équipe */
btnOuvrCreeEqui1.addEventListener('click', function() {
	popUpCreeEqui1.setAttribute('open', true);
})

btnFermCreeEqui1.addEventListener('click', function() {
	popUpCreeEqui1.removeAttribute('open');
});


/*---------------------------------------------------------------*/
/*---------------------------foot--------------------------------*/
/*---------------------------------------------------------------*/
/* Vérifie que les points et le fair_play sont positifs */
    function  validerFoot() {

        let foot_points_marques1 = document.getElementById('foot_points_marques1');
        let foot_points_marques2 = document.getElementById('foot_points_marques2');
        let fair_play1 = document.getElementById('fair_play1');
        let fair_play2 = document.getElementById('fair_play2');
    if (foot_points_marques1.value<0 || foot_points_marques2.value<0) {
    alert("Points impossible");
    return false;
}else if(fair_play1.value<0 || fair_play2.value<0){
        alert("Fair_play impossible");
        return false;
    }

}
/*---------------------------------------------------------------*/
/*--------------------------Tennis-------------------------------*/
/*---------------------------------------------------------------*/
/* Vérifie que les points et le fair_play sont positifs */
function  validerTennis() {

    let tennis_points_marques1 = document.getElementById('tennis_points_marques1');
    let tennis_points_marques2 = document.getElementById('tennis_points_marques2');
    let fair_play1 = document.getElementById('fair_play1');
    let fair_play2 = document.getElementById('fair_play2');
tennis_points_marques1 = tennis_points_marques1.value;
tennis_points_marques2 = tennis_points_marques2.value;


if (!((tennis_points_marques1 == 3 && tennis_points_marques2 < 3) || (tennis_points_marques2 == 3 && tennis_points_marques1 < 3) )) {
    alert("Points impossible");
    return false;

}else if(fair_play1.value<0 || fair_play2.value<0){
    alert("Fair_play impossible");
    return false;
}
}


/*---------------------------------------------------------------*/
/*--------------------------HEADER-------------------------------*/
/*---------------------------------------------------------------*/
/* Rend le logo invisible si le menu hamburger est coché */

function logo_invisible(){
    var checkbox = document.getElementById('hamburger');
    var logo = document.getElementById('logo_association');

    checkbox.addEventListener('change', function() {
        if(this.checked) {
            logo.style.display = 'none';
        } else {
            logo.style.display = 'block';
        }
    });
}


/*---------------------------------------------------------------*/
/*------------------------MINUTEUR-------------------------------*/
/*---------------------------------------------------------------*/
/* Lance le minuteur *//*
function debutMinuteur(durationInMinutes, equipe1,equipe2) {
    var durationInSeconds = durationInMinutes * 60;
    var startTime = Date.now();
    

    var intervalId = setInterval(function() {
        var elapsedTimeInSeconds = Math.floor((Date.now() - startTime) / 1000);

        if (elapsedTimeInSeconds >= durationInSeconds) {
            clearInterval(intervalId);
            alert("Le match entre "+ equipe1 + " et "+equipe2+ "  est terminé !");
        }
    }, 1000);
}*/
function debutMinuteur(duree, equipe1, equipe2,idTimer) {
    duree = duree * 60;
    var timer = duree, minutes, seconds;
    var display = document.querySelector('#'+idTimer);

    var intervalId = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);
    
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
    
        display.textContent = minutes + ":" + seconds;
    
        timer--;
    
        if (timer < 0) {
            clearInterval(intervalId); // Arrête le décompte quand le temps est écoulé
            alert("Le match entre "+ equipe1 + " et "+equipe2+ "  est terminé !");
            
        }
    }, 1000);
}
///////////////////////// VUE_TOURNOI_ADMIN /////////////////////////

/* Affiche ou cache le formulaire de suppression de tournoi */
function openDialog() {
    document.getElementById('popSupprTournoi').showModal();
}

function closeDialog() {
    document.getElementById('popSupprTournoi').close();
}


