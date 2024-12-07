<?
/**
 * @author Mael
 * @brief Modélisation d'une table d'association
 */

class ParticiperA {

    private int $idJoueurJoue;
    private int $idPartieJoue;
    private int $idJoueur;


    function __construct(int $idJJ, int $idPJ, int $idJ) {
        $this->idJoueurJoue = $idJJ;
        $this->idPartieJoue = $idPJ;
        $this->idJoueur = $idJ;
    }


    function getIdJoueurJoue(): int {
        return $this->idJoueurJoue;
    }

    function setIdJoueurJoue(int $idJJ) : void {
        $this->idJoueurJoue = $idJJ;
    }

    function getIdPartieJoue():int {
        return $this->idPartieJoue;
    }

    function setIdPartieJoue(int $idPJ) : void {
        $this->idPartieJoue = $idPJ;
    }

    function getIdJoueur() : int {
        return $this->idJoueur;
    } 

    function setIdJoueur(int $idJ) : void {
        $this->idJoueur = $idJ;
    }
}