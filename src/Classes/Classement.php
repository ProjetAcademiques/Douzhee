<?php
/**
 * @author Mael
 * Classe pour représenter une place de classement uniformément.
*/
class Classement implements JsonSerializable {

    private int $rank;
    private string $name;
    private string $stat;

    public function __construct(int $rk, string $nm, string $st) {
        $this->rank = $rk;
        $this->name = $nm;
        $this->stat = $st;
    }

    public function jsonSerialize(): mixed {
        return ["name" => $this->name, 
                "rank" => $this->rank, 
                "stat" => $this->stat];
    }


    /**
     * Get the value of stat
     *
     * @return string
     */
    public function getStat(): string {
        return $this->stat;
    }

    /**
     * Set the value of stat
     *
     * @param string $stat
     *
     * @return self
     */
    public function setStat(string $stat): self {
        $this->stat = $stat;
        return $this;
    }

    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the value of rank
     *
     * @return int
     */
    public function getRank(): int {
        return $this->rank;
    }

    /**
     * Set the value of rank
     *
     * @param int $rank
     *
     * @return self
     */
    public function setRank(int $rank): self {
        $this->rank = $rank;
        return $this;
    }
}