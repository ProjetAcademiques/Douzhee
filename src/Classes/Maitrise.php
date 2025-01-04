<?php
class Maitrise{
    private int $idDefis;
    private int $idJoueur;
   
    function __construct(int $idJ, int $idD) {
        $this->idDefis = $idD;
        $this->idJoueur = $idJ;

    
}

    function getIdDefis() : int {
        return $this->idDefis;
    }
    
    function getIdJoueur() : int {
        return $this->idJoueur;
    }
    
    
    
}
?>