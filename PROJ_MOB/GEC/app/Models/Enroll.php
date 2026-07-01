<?php

class Enroll {

    public string $StudentINE;
    public string $ClassEnrolled;
    public string $Enroll_date;
    public string $End_date;
    public ?string $statuts;

    public function __construct(array $data) {
        $this->StudentINE = $data['StudentINE'];
        $this->ClassEnrolled = $data['ClassEnrolled'];
        $this->Enroll_date = $data['Enroll_date'];
        $this->End_date = $data['End_date'];
        $this->statuts = $data['statuts'] ?? null;
    }
}
