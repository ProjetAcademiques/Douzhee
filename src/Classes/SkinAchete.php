<?php
/**
 * @author Mael
 * @brief Modélise un skin Acheté par un utilisateur
 */
class SkinAchete {

    private int $idJoueur ;
    private int $idSkin;
    private string $dateAchat;
    private string $typeSkin;


    function __construct(int $idJoueur , int $idSkin, string $date, string $type) {
        $this->idJoueur  = $idJoueur ;
        $this->idSkin = $idSkin;
        $this->dateAchat = $date;
        $this->typeSkin = $type;
    }

    function getTypeSkin():string {
        return $this->typeSkin;
    }

    function setTypeSkin(string $tsk):void {
        $this->typeSkin = $tsk;
    }

    function getDateAchat():string {
        return $this->dateAchat;
    }

    function setDateAchat(string $dateAchat):void {
        $this->dateAchat = $dateAchat;
    }

    function getIdSkin():int {
        return $this->idSkin;
    }

    function setIdSkin(int $idsk):void {
        $this->idSkin = $idsk;
    }

    function getidJoueur ():int {
        return $this->idJoueur ;
    }

    function setidJoueur (int $idJoueur ):void {
        $this->idJoueur  = $idJoueur ;
    }
}