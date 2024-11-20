<?php

class SkinAchetable {

    private int $idSkin;
    private string $nomSkin;
    private int $prixSkin;

    function __construct(int $idSkin, string $nomSkin, int $prixSkin) {
        $this->idSkin = $idSkin;
        $this->nomSkin = $nomSkin;
        $this->prixSkin = $prixSkin;
    }

    function getNomSkin():string {
        return $this->nomSkin;
    }

    function setNomSkin(string $nsk):void {
        $this->nomSkin = $nsk;
    }

    function getIdSkin():int {
        return $this->idSkin;
    }

    function setIdSkin(int $idsk):void {
        $this->idSkin = $idsk;
    }

    function getPrixSkin():int {
        return $this->prixSkin;
    }

    function setPrixSkin(int $psk):void {
        $this->prixSkin = $psk;
    }

}