<?php 

$urlactive = $_SERVER["PHP_SELF"];
if($urlactive == "/classes/classe_equipe.php"){
    header('Location: /index');
  } 
    class Equipe
    {
        private int $id;
        private string $nom;
        private string $cheminIcone;
        private string $descIcone;
        private float $noteGoalAverage;
        private float $noteFairPlay;
        private float $idPoule;

        /**
         * constructeur d'une équipe
         * @param int $id : id de l'équipe
         * @param string $nom : nom de l'équipe
         * @param string $cheminIcone : chemin de l'icone de l'équipe
         * @param string $descIcone : description de l'icone de l'équipe
         * @param float $noteGoalAverage : note goal average de l'équipe
         * @param float $noteFairPlay : note fair play de l'équipe
         * @param float $idP : id de la poule
         */
        public function __construct(int $id, string $nom, string $cheminIcone, string $descIcone, float $noteGoalAverage, float $noteFairPlay, float $idP){
            $this->id = $id;
            $this->nom = $nom;
            $this->cheminIcone = $cheminIcone;
            $this->descIcone = $descIcone;
            $this->noteGoalAverage = $noteGoalAverage;
            $this->noteFairPlay = $noteFairPlay;
            $this->idPoule=$idP;
        }

        /**
         * Retourne l'id de l'équipe
         * @return int : id de l'équipe
         */
        public function getId(){
            if($this != NULL){
                return $this->id;
            }else{
                return NULL;
            }
        }

        /**
         * Retourne le nom de l'équipe
         * @return string : nom de l'équipe
         */
        public function getNom(): string{
            return $this->nom;
        }

        /**
         * Retourne le chemin de l'icone de l'équipe
         * @return string : chemin de l'icone de l'équipe
         */
        public function getCheminIcone(): string{
            return $this->cheminIcone;
        }

        /**
         * Retourne la description de l'icone de l'équipe
         * @return string : description de l'icone de l'équipe
         */
        public function getDescIcone(): string{
            return $this->descIcone;
        }

        /**
         * Retourne la note goal average de l'équipe
         * @return float : note goal average de l'équipe
         */
        public function getNoteGoalAverage() : float{
            return $this->noteGoalAverage;
        }

        /**
         * Retourne la note fair play de l'équipe
         * @return float : note fair play de l'équipe
         */
        public function getNoteFairPlay() : float{
            return $this->noteFairPlay;
        }

        /**
         * Change l'id de la poule
         * @param int $id : id de la poule
         */
        public function getIdPoule() : float{
            return $this->idPoule;
        }

        /**
         * Change l'id de la poule
         * @param int $id : id de la poule
         */
        public function setIdPoule(float $id) : void{
             $this->idPoule=$id;
        }

        /**
         * Change l'id de l'équipe
         * @param int $id : id de l'équipe
         */
        public function setId(float $id) : void{
            $this->id=$id;
       }
        
        


    }
