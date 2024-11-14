<?PHP
    /**
     * @author Nathan
     */
    Class AppartientA{
        private int $idPartie;
        private int $idPartieJoue;
        private int $idJoueurJoue;
    
        /**
         * @param int $idPartie
         * @param int $idPartieJoue
         * @param int $idJoueurJoue
         */
        public function __construct(int $idPartie, int $idPartieJoue, int $idJoueurJoue) {
            $this->idPartie = $idPartie;
            $this->idPartieJoue = $idPartieJoue;
            $this->idJoueurJoue = $idJoueurJoue;
        }

        /**
         * @return int
         */
        public function getIdPartie(): int {
            return $this->idPartie;
        }
        
        /**
         * @param int $idPartie 
         * @return self
         */
        public function setIdPartie(int $idPartie): self {
            $this->idPartie = $idPartie;
            return $this;
        }

        /**
         * @return int
         */
        public function getIdPartieJoue(): int {
            return $this->idPartieJoue;
        }
        
        /**
         * @param int $idPartieJoue 
         * @return self
         */
        public function setIdPartieJoue(int $idPartieJoue): self {
            $this->idPartieJoue = $idPartieJoue;
            return $this;
        }

        /**
         * @return int
         */
        public function getIdJoueurJoue(): int {
            return $this->idJoueurJoue;
        }
        
        /**
         * @param int $idJoueurJoue 
         * @return self
         */
        public function setIdJoueurJoue(int $idJoueurJoue): self {
            $this->idJoueurJoue = $idJoueurJoue;
            return $this;
        }
    }