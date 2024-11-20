<?php

class SkinAchete {

    private int $idAchat;
    private int $idSkin;
    private string $dateAchat;
    private string $etatSkin;
    private string $typeSkin;


    function __construct(int $idAchat, int $idSkin, string $date, string $etat, string $type) {
        $this->idAchat = $idAchat;
        $this->idSkin = $idSkin;
        $this->dateAchat = $date;
        $this->etatSkin = $etat;
        $this->typeSkin = $type;
    }

    function getEtatSkin():string {
        return $this->etatSkin;
    }

    function setEtatSkin(string $etatSkin):void {
        $this->etatSkin = $etatSkin;
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

    function getIdAchat():int {
        return $this->idAchat;
    }

    function setIdAchat(int $idAchat):void {
        $this->idAchat = $idAchat;
    }
}