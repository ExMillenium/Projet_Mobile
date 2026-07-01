<?php
class Student {

    public string $INE;
    public string $Fname;
    public string $Lname;
    public ?string $Birthdate;
    public string $Gender;
    public ?string $PhoneNumber;
    public ?string $Email;

    public function __construct(array $data) {
        $this->INE = $data['INE'];
        $this->Fname = $data['Fname'];
        $this->Lname = $data['Lname'];
        $this->Birthdate = $data['Birthdate'] ?? null;
        $this->Gender = $data['Gender'];
        $this->PhoneNumber = $data['PhoneNumber'] ?? null;
        $this->Email = $data['Email'] ?? null; // DB trigger will override this anyway
    }
}
