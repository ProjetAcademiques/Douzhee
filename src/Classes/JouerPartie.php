<?php

/**
 * @author Mael 
 * @brief Modélise un enregistrement de table JouerPartie
 */
class JouerPartie {

    private int $idJoueurJoue;
    private int $idPartieJoue;
    private int $scoreJoueur;
    private int $positionJoueur;
    private string $dateParticipation;
    private bool $estGagnant;


    function __construct(int $idJoueurJoue, int $idPartieJoue, int $scoreJoueur, int $positionJoueur, string $dateParticipation, bool $estGagnant) {
        $this->idJoueurJoue = $idJoueurJoue;
        $this->idPartieJoue = $idPartieJoue;
        $this->scoreJoueur = $scoreJoueur;
        $this->positionJoueur = $positionJoueur;
        $this->dateParticipation = $dateParticipation;
        $this->estGagnant = $estGagnant; 
    }

    function getIdJoueurJoue():int {
        return $this->idJoueurJoue;
    }

    function setIdJoueurJoue(int $id):void {
        $this->idJoueurJoue = $id;
    }

    function getIdPartieJoue():int {
        return $this->idPartieJoue;
    }

    function setIdPartieJoue(int $id):void {
        $this->idPartieJoue = $id;
    }

    function getScoreJoueur():int {
        return $this->scoreJoueur;
    }

    function setScoreJoueur(int $sj):void {
        $this->scoreJoueur = $sj;
    }

    function getPositionJoueur():int {
        return $this->positionJoueur;
    }

    function setPositionJoueur(int $pos):void {
        $this->positionJoueur = $pos;
    }

    function getDateParticipation():string {
        return $this->dateParticipation;
    }

    function setDateParticipation(string $text):void {
        $this->dateParticipation = $text;
    }

    function isEstGagnant():bool {
        return $this->estGagnant;
    }

    function setEstGagnant(bool $bool):void {
        $this->estGagnant = $bool;
    }

}