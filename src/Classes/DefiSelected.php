<?php
 class DefiSelected{
    private int $id;
    private String $nom;
    private String $description;

    private int $gain;
    function __construct(int $id, String $nom, String $description, int $gain) {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->gain = $gain;
    
}

    function getId() : int {
        return $this->id;
    }
    
    function getNom() : String {
        return $this->nom;
    }
    
    function getDescription() : String {
        return $this->description;
    }
    
    function getGain() : int {
        return $this->gain;
    }
 }
?>