<?PHP
    /**
     * @author Nathan
     */
    Class Obtient{
        private int $idUser;
        private int $idSucces;
    
        /**
         * @param int $idUser
         * @param int $idSucces
         */
        public function __construct(int $idUser, int $idSucces) {
            $this->idUser = $idUser;
            $this->idSucces = $idSucces;
        }

        /**
         * @return int
         */
        public function getIdUser(): int {
            return $this->idUser;
        }
        
        /**
         * @param int $idUser 
         * @return self
         */
        public function setIdUser(int $idUser): self {
            $this->idUser = $idUser;
            return $this;
        }

        /**
         * @return int
         */
        public function getIdSucces(): int {
            return $this->idSucces;
        }
        
        /**
         * @param int $idSucces 
         * @return self
         */
        public function setIdSucces(int $idSucces): self {
            $this->idSucces = $idSucces;
            return $this;
        }
    }