<?php
class DefisReussis{
    private int $id;
    private int $idDefis;

    private bool $reussi;

    private string $DateDefiReussi;

    function __construct(int $id, int $idDefis, bool $reussi, string $dateDefiReussi) {
        $this->id = $id;
        $this->idDefis = $idDefis;
        $this->reussi = $reussi;
        $this->DateDefiReussi = $dateDefiReussi;
    }
    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }
    public function getIdDefis(): int {
        return $this->idDefis;
    }
    public function setIdDefis(int $idDefis): void {
        $this->idDefis = $idDefis;
    }
    public function getReussi(): bool {
        return $this->reussi;
    }
    public function setReussi(bool $reussi): void {
        $this->reussi = $reussi;
    }
    public function getDateDefiReussi(): string {
        return $this->DateDefiReussi;
    }
    public function setDateDefiReussi(string $dateDefiReussi): void {
        $this->DateDefiReussi = $dateDefiReussi;
    }


   

    
    
    
}
?>