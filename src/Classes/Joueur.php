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
    private string|null $bio;
    private string $dateInsc;
    private int $idPartieEnCours;
    private int $idTheme;
    private string $avatarChemin;
    private string $musiqueChemin;

    function __construct(string $pseudo, string $mdp, int $douzCoin, string $email, string|null $bio, string $dateInsc, int $idPartie, int $idTheme, string $avatarChemin, string $musiqueChemin) {
        $this->pseudo = $pseudo;
        $this->mdp = $mdp;
        $this->douzCoin = $douzCoin;
        $this->email = $email;
        $this->bio = $bio;
        $this->dateInsc = $dateInsc;
        $this->idPartieEnCours = $idPartie;
        $this->idTheme = $idTheme;
        $this->avatarChemin = $avatarChemin;
        $this->musiqueChemin = $musiqueChemin;
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

    // idPartie
    function getIdPartie():int {
        return $this->idPartieEnCours;
    }

    function setIdPartie(int $idPartie):void {
        $this->idPartieEnCours = $idPartie;
    }

    // idTheme
    function getIdTheme():int {
        return $this->idTheme;
    }

    function setIdTheme(int $idTheme):void {
        $this->idTheme = $idTheme;
    }

    // avatarChemin
    function getAvatarChemin():string {
        return $this->avatarChemin;
    }

    function setAvatarChemin(string $avatarChemin):void {
        $this->avatarChemin = $avatarChemin;
    }

    // musiqueChemin
    function getMusiqueChemin():string {
        return $this->musiqueChemin;
    }

    function setMusiqueChemin(string $musiqueChemin):void {
        $this->musiqueChemin = $musiqueChemin;
    }

    // idPartieEnCours
    function getIdPartieEnCours(){
        return $this->idPartieEnCours;
    }

    function setIdPartieEnCours(int $idPartieEnCours){
        $this->idPartieEnCours = $idPartieEnCours;
    }
}