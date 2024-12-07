<?php

/**
 * @author Mael
 * @contributors Cédric, Milan
 * @brief Modélise un joueur
 */

class Joueur {

    private string $pseudo;
    private string $mdp;
    private int $douzCoin;
    private string $email;
    private string $bio;
    private string $dateInsc;
    private int $idPartieEnCours;

    function __construct(string $pseudo, string $mdp, int $douzCoin, string $email, string $bio, string $dateInsc, int $idPartie) {
        $this->pseudo = $pseudo;
        $this->mdp = $mdp;
        $this->douzCoin = $douzCoin;
        $this->email = $email;
        $this->bio = $bio;
        $this->dateInsc = $dateInsc;
        $this->idPartieEnCours = $idPartie;
    }

    // PSEUDO
    function getPseudo():string {
        return $this->pseudo;
    }

    function setPseudo(string $psd):void {
        $this->pseudo = $psd;
    }

    // MDP
    function setMDP(string $mdp): void {
        $this->mdp = $mdp;
    } 

    function getMDP() :string {
        return $this->mdp;
    }

    // DOUZCOIN
    function getDouzCoin():int {
        return $this->douzCoin;
    }

    function setDouzCoin(int $douzCoin):void {
        $this->douzCoin = $douzCoin;
    }

    // EMAIL
    function getEmail() :string {
        return $this->email;
    }

    function setEmail(string $email) :void {
        $this->email = $email;
    }

    // BIO
    function getBio() :string {
        return $this->bio;
    }

    function setBio(string $bio) {
        $this->bio = $bio; 
    } 

    // dateInsc
    function getDateInsc(): string {
        return $this->dateInsc;
    }

    function setDateInsc($date): void {
        $this->dateInsc = $date;
    }

    function getIdPartie():int {
        return $this->idPartieEnCours;
    }

    function setIdPartie(int $idPartie):void {
        $this->idPartieEnCours = $idPartie;
    }
}