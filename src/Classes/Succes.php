<?PHP
    /**
     * @author Nathan
     */
    Class Succes{
        private int $id;
        private String $name;
        private String $condition;
        private String $type;
    
        /**
         * @param int $id
         * @param string $name
         * @param string $condition
         * @param string $type
         */
        public function __construct(int $id, string $name, string $condition, string $type) {
            $this->id = $id;
            $this->name = $name;
            $this->condition = $condition;
            $this->type = $type;
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
        public function getName(): string {
            return $this->name;
        }
        
        /**
         * @param string $name 
         * @return self
         */
        public function setName(string $name): self {
            $this->name = $name;
            return $this;
        }

        /**
         * @return string
         */
        public function getCondition(): string {
            return $this->condition;
        }
        
        /**
         * @param string $condition 
         * @return self
         */
        public function setCondition(string $condition): self {
            $this->condition = $condition;
            return $this;
        }

        /**
         * @return string
         */
        public function getType(): string {
            return $this->type;
        }
        
        /**
         * @param string $type 
         * @return self
         */
        public function setType(string $type): self {
            $this->type = $type;
            return $this;
        }
}