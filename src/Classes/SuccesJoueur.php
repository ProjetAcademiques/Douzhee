<?php

class SuccesJoueur {
    private $idJoueur;
    private $idSucces;

    public function __construct(int $idJ, int $idS) {
        $this->idJoueur = $idJ;
        $this->idSucces = $idS;
    }

    public function getIdJoueur():int {
        return $this->idJoueur;
    }

    public function getIdSucces():int {
        return $this->idSucces;
    }

    public function setIdSucces($idS):void {
        $this->idSucces = $idS;
    }

    public function setIdJoueur($idJ):void {
        $this->idJoueur = $idJ;
    }

} 