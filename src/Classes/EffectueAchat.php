<?php
/**
 * @author Mael
 * @brief Modélise un enregistrement d'achat d'un joueur
 */
class EffectueAchat {

    private int $idJoueur;
    private int $idAchat;

    function __construct(int $idJ, int $idA) {
        $this->idJoueur = $idJ;
        $this->idAchat = $idA;
    }

    function getIdJoueur() :int {
        return $this->idJoueur;
    }

    function setIdJoueur(int $idJ) :void {
        $this->idJoueur = $idJ;
    }

    function getIdAchat() :int {
        return $this->idAchat;
    }

    function setIdAchat(int $idA) {
        $this->idAchat = $idA;
    }

}