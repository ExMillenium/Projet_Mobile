<?php

class Classe {

    public string $idClass;
    public string $ClassName;
    public ?string $Curriculum;
    public ?string $idLevel;
    public ?string $StartYear;
    public ?string $EndYear;

    public function __construct(array $data) {
        $this->idClass = $data['idClass'];
        $this->ClassName = $data['ClassName'];
        $this->Curriculum = $data['Curriculum'] ?? null;
        $this->idLevel = $data['idLevel'] ?? null;
        $this->StartYear = $data['StartYear'] ?? null;
        $this->EndYear = $data['EndYear'] ?? null;
    }
}
