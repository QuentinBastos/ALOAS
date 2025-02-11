<?php

$urlactive = $_SERVER["PHP_SELF"];
if($urlactive == "/classes/classe_poule.php"){
    header('Location: /index.php');
  } 

include_once ROOT . "/classes/classe_equipe.php";
    
class Poule {
    private $liste_equipe = array();
    private int $idPoule;
    private int $idTournoi;
    

    /**
     * constructeur d'une poule
     * @param int $idPoule : id de la poule
     * @param int $idTournoi : id du tournoi
     */
    public function __construct(int $idPoule, int $idTournoi){
        $this->idPoule = $idPoule;
        $this->idTournoi = $idTournoi;
    }


    /**
     * Retourne l'id de la poule
     * @return int : id de la poule
     */
    public function getId(){
        return $this->idPoule;
    }

    /**
     * Retourne l'id du tournoi
     * @return int : id du tournoi
     */
    public function getIdTournoi(){
        return $this->idTournoi;
    }

    /**
     * Ajoute une équipe à la liste des équipes de la poule
     * @param Equipe $equipe : équipe à ajouter
     */
    public function ajoutEquipe(Equipe $equipe){
        array_push($this->liste_equipe, $equipe);
    }

    /**
     * Retourne une équipe de la liste des équipes de la poule
     * @param int $id : id de l'équipe
     * @return Equipe : équipe
     */
    public function getEquipe(int $id){
        if($this->getNbEquipes()>$id){
            return $this->liste_equipe[$id];
        }else{
            return NULL;
        }
    }

    /**
     * Retourne la liste des équipes de la poule
     * @return array : liste des équipes
     */
    public function getEquipes(){
        return $this->liste_equipe;
    }

    /**
     * Retourne le nombre d'équipes de la poule
     * @return int : nombre d'équipes
     */
    public function getNbEquipes(){
        return sizeof($this->liste_equipe);
    }
    
   


}