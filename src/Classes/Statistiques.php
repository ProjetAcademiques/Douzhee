<?PHP
    /**
     * @author Nathan
     */
    Class Statistiques{

        private int $id;
        private int $nbPartiesGagnees;
        private int $scoreMaximal;
        private String $tempsJeu;
        private float $ratioVictoire;
        private int $nbSucces;
        private int $nbDouzhee;
        private int $nbPartiesJoues;

        /**
         * @param int $id
         * @param int $nbPartiesGagnees
         * @param int $scoreMaximal
         * @param string $tempsJeu
         * @param float $ratioVictoire
         * @param int $nbSucces
         * @param int $nbDouzhee
         * @param int $nbPartiesJoues
         */
        public function __construct(int $id, int $nbPartiesGagnees, int $scoreMaximal, string $tempsJeu, float $ratioVictoire, int $nbSucces, int $nbDouzhee, int $nbPartiesJoues) {
            $this->id = $id;
            $this->nbPartiesGagnees = $nbPartiesGagnees;
            $this->scoreMaximal = $scoreMaximal;
            $this->tempsJeu = $tempsJeu;
            $this->ratioVictoire = $ratioVictoire;
            $this->nbSucces = $nbSucces;
            $this->nbDouzhee = $nbDouzhee;
            $this->nbPartiesJoues = $nbPartiesJoues;
        }

        /**
         * @return int
         */
        public function getId(): int {
            return $this->id;
        }
        
        /**
         * @param int $id 
         * @return self
         */
        public function setId(int $id): self {
            $this->id = $id;
            return $this;
        }

        /**
         * @return int
         */
        public function getNbPartiesGagnees(): int {
            return $this->nbPartiesGagnees;
        }
        
        /**
         * @param int $nbPartiesGagnees 
         * @return self
         */
        public function setNbPartiesGagnees(int $nbPartiesGagnees): self {
            $this->nbPartiesGagnees = $nbPartiesGagnees;
            return $this;
        }

        /**
         * @return int
         */
        public function getScoreMaximal(): int {
            return $this->scoreMaximal;
        }
        
        /**
         * @param int $scoreMaximal 
         * @return self
         */
        public function setScoreMaximal(int $scoreMaximal): self {
            $this->scoreMaximal = $scoreMaximal;
            return $this;
        }

        /**
         * @return string
         */
        public function getTempsJeu(): string {
            return $this->tempsJeu;
        }
        
        /**
         * @param string $tempsJeu 
         * @return self
         */
        public function setTempsJeu(string $tempsJeu): self {
            $this->tempsJeu = $tempsJeu;
            return $this;
        }

        /**
         * @return float
         */
        public function getRatioVictoire(): float {
            return $this->ratioVictoire;
        }
        
        /**
         * @param float $ratioVictoire 
         * @return self
         */
        public function setRatioVictoire(float $ratioVictoire): self {
            $this->ratioVictoire = $ratioVictoire;
            return $this;
        }

        /**
         * @return int
         */
        public function getNbSucces(): int {
            return $this->nbSucces;
        }
        
        /**
         * @param int $nbSucces 
         * @return self
         */
        public function setNbSucces(int $nbSucces): self {
            $this->nbSucces = $nbSucces;
            return $this;
        }
    
        /**
         * @return int
         */
        public function getNbDouzhee(): int {
            return $this->nbDouzhee;
        }
        
        /**
         * @param int $nbDouzhee 
         * @return self
         */
        public function setNbDouzhee(int $nbDouzhee): self {
            $this->nbDouzhee = $nbDouzhee;
            return $this;
        }

        /**
         * @return int
         */
        public function getNbPartiesJoues(): int {
            return $this->nbPartiesJoues;
        }
        
        /**
         * @param int $nbPartiesJoues 
         * @return self
         */
        public function setNbPartiesJoues(int $nbPartiesJoues): self {
            $this->nbPartiesJoues = $nbPartiesJoues;
            return $this;
        }
    }