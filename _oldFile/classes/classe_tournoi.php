<?php 
    include_once ROOT . "/classes/classe_equipe.php";
    include_once ROOT . "/classes/classe_poule.php";
        
    $urlactive = $_SERVER["PHP_SELF"];
    if($urlactive == "/classes/classe_tournoi.php"){
        header('Location: /index');
      } 

    class Tournoi
    {
        private int $id;
        private string $nom;
        private string $lieu;
        private string $discipline;
        private $liste_equipes = array();
 
        /**
         * constructeur d'un tournoi
         * @param int $id : id du tournoi
         * @param string $nom : nom du tournoi
         * @param string $lieu : lieu du tournoi
         * @param string $discipline : discipline du tournoi
         */
        public function __construct(int $id, string $nom, string $lieu, string $discipline){
            $this->id = $id;
            $this->nom = $nom;
            $this->lieu = $lieu;
            $this->discipline = $discipline;

        }

        /**
         * Ajoute une équipe à la liste des équipes du tournoi
         * @param int $id : change l'id du tournoi
         */
        public function setId(int $id){
            $this->id = $id;
        }

        /**
         * Retourne l'id du tournoi
         * @return int : id du tournoi
         */
        public function getId(){
            return $this->id;
        }

        /**
         * Change le nom du tournoi
         * @param string $nom : change le nom du tournoi
         */
        public function setNom(String $nom){
            $this->nom = $nom;
        }

        /**
         * Retourne le nom du tournoi
         * @return string : nom du tournoi
         */
        public function getNom(){
            return $this->nom;
        }

        /**
         * Change le lieu du tournoi
         * @param string $lieu : change le lieu du tournoi
         */
        public function setLieu(String $lieu){
            $this->lieu = $lieu;
        }

        /**
         * Retourne le lieu du tournoi
         * @return string : lieu du tournoi
         */
        public function getLieu(){
            return $this->lieu;
        }

        /**
         * Change la discipline du tournoi
         * @param string $discipline : change la discipline du tournoi
         */
        public function setDiscipline(String $discipline){
            $this->discipline = $discipline;
        }

        /**
         * Retourne la discipline du tournoi
         * @return string : discipline du tournoi
         */
        public function getDiscipline(){
            return $this->discipline;
        }

        /**
         * Ajoute une équipe à la liste des équipes du tournoi
         * @param Equipe $equipe : équipe à ajouter
         */
        public function ajoutEquipe(Equipe $equipe){
            array_push($this->liste_equipes, $equipe);
        }


        /**
         * Retourne une équipe de la liste des équipes du tournoi
         * @param int $id : id de l'équipe
         * @return Equipe : équipe
         */
        public function getEquipe(int $id){
            return $this->liste_equipes[$id];
        }

        /**
         * Retourne la liste des équipes du tournoi
         * @return array : liste des équipes
         */
        public function getEquipes(){
            return $this->liste_equipes;
        }

        /**
         * Retourne le nombre d'équipes du tournoi
         * @return int : nombre d'équipes
         */
        public function getNbEquipes(){
            return sizeof($this->liste_equipes);
        }

        /**
         * Retourne le nombre de poules du tournoi
         * @return int : nombre de poules
         */
        public function getNbPoules(){
            return sizeof($this->liste_poules);
        }


        /**
         * Supprime une équipe de la liste des équipes du tournoi
         * @param int $id : id de l'équipe à supprimer
         */
        public function supprimerEquipe(int $id){

            array_splice($this->liste_equipes, $id ,1);

        }

        /**
         * Supprime une équipe de la liste des équipes du tournoi
         * @param Equipe $equipe : équipe à supprimer
         */

        public function supprimerEquipes(Equipe $equipe){

            for($i=0;$i<sizeof($this->liste_equipes);$i++){

                if($this->liste_equipes[$i] == $equipe){

                    unset($this->liste_equipes[$i]);

                }

            }

        }


        


    }
