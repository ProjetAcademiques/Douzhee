<?php
/**
 * @author Mael
 * @brief Une table d'association entre un joueur et un classement
 */
class SeTrouve {

    private int $idJoueur;
    private int $idClassement;

    function __construct(int $idJ, int $idC) {
        $this->idClassement = $idC;
        $this->idJoueur = $idJ;
    }

    function getIdJoueur() : int {
        return $this->idJoueur;
    }

    function getIdClassement() : int {
        return $this->idClassement;
    }

    function setIdClassement(int $idC): void {
        $this->idClassement = $idC;
    }
    
    function setIdJoueur(int $idJ) : void {
        $this->idJoueur = $idJ;
    } 
}