<?php 

$urlactive = $_SERVER["PHP_SELF"];
if($urlactive == "/classes/classe_match.php"){
    header('Location: /index');
  } 
    
    include_once ROOT."/classes/classe_equipe.php";
    class Matchs 
    {
        private int $idMatch;
        private Equipe $equipe1;
        private Equipe $equipe2;
        private int $idTournoi;
        private int $matchpoule;
        

        /**
         * constructeur d'un match
         * @param int $idMatch : id du match
         * @param Equipe $equipe1 : equipe 1
         * @param Equipe $equipe2 : equipe 2
         * @param int $idTournoi : id du tournoi
         * @param int $matchpoule : 1 si match de poule, 0 si match de classement
         */
        public function __construct(int $idMatch, Equipe $equipe1, Equipe $equipe2, int $idTournoi, int $matchpoule){
            $this->idMatch = $idMatch;
            $this->equipe1 = $equipe1;
            $this->equipe2 = $equipe2;
            $this->idTournoi = $idTournoi;
            $this->matchpoule = $matchpoule;
        }

        /**
         * Retourne l'id du match
         * @return int : id du match
         */
        public function getIdMatch(){
            return $this->idMatch;
        }
        
        /**
         * Retourne l'id du tournoi
         * @return int : id du tournoi
         */
        public function getIdTournoi(): int{
            return $this->idTournoi;
        }

        /**
         * Retourne si le match est un match de poule ou de classement
         * @return int : 1 si match de poule, 0 si match de classement
         */
        public function getMatchPoule() : int{
            return $this->matchpoule;
        }

        /**
         * Change l'id du match
         * @param int $idMatch : id du match
         */
        public function setIdMatch(int $idMatch){
            $this->idMatch = $idMatch;
        }
        
        /**
         * Change l'id du tournoi
         * @param int $idTournoi : id du tournoi
         */
        public function setIdTournoi(int $idTournoi){
            $this->idTournoi = $idTournoi;
        }

        /**
         * Change si le match est un match de poule ou de classement
         * @param int $matchpoule : 1 si match de poule, 0 si match de classement
         */
        public function setMatchPoule(int $matchpoule){
            $this->matchpoule = $matchpoule;
        }
        
        /**
         * Retourne l'équipe 1
         * @return Equipe : equipe 1
         */
        public function getEquipe1(){
            return $this->equipe1;
        }

        /**
         * Retourne l'équipe 2
         * @return Equipe : equipe 2
         */
        public function getEquipe2(){
            return $this->equipe2;
        }

        
        
        

    }
