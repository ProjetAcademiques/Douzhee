<?PHP
    /**
     * @author Nathan
     */
    Class Partie{
        private int $id;
        private String $date;
        private String $score;
        private int $scoreTotalPartie;
    
        /**
         * @param int $id
         * @param string $date
         * @param string $score
         * @param int $scoreTotalPartie
         */
        public function __construct(int $id, string $date, string $score, int $scoreTotalPartie) {
            $this->id = $id;
            $this->date = $date;
            $this->score = $score;
            $this->scoreTotalPartie = $scoreTotalPartie;
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
         * @return string
         */
        public function getDate(): string {
            return $this->date;
        }
        
        /**
         * @param string $date 
         * @return self
         */
        public function setDate(string $date): self {
            $this->date = $date;
            return $this;
        }

        /**
         * @return string
         */
        public function getScore(): string {
            return $this->score;
        }
        
        /**
         * @param string $score 
         * @return self
         */
        public function setScore(string $score): self {
            $this->score = $score;
            return $this;
        }

        /**
         * @return int
         */
        public function getScoreTotalPartie(): int {
            return $this->scoreTotalPartie;
        }
        
        /**
         * @param int $scoreTotalPartie 
         * @return self
         */
        public function setScoreTotalPartie(int $scoreTotalPartie): self {
            $this->scoreTotalPartie = $scoreTotalPartie;
            return $this;
        }
    }