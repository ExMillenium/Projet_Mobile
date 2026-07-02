<?php

class StudentManager
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllStudents(): array
    {
        $sql = "SELECT * FROM students ORDER BY Lname, Fname";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStudent(string $ine): ?array
    {
        $sql = "SELECT * FROM students WHERE INE = :ine";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['ine' => $ine]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    public function getStudentsByClass(string $idClass): array
    {
        $sql = "
            SELECT 
                S.INE,
                S.Fname,
                S.Lname,
                S.Sexe,
                S.email_initial,
                S.univ_email,
                S.PhoneNumber,
                S.Birthdate
            FROM students S
            INNER JOIN enroll E ON E.StudentINE = S.INE
            INNER JOIN classes C ON C.idClass = E.ClassEnrolled
            WHERE C.idClass = :idClass
            ORDER BY S.Lname, S.Fname
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['idClass' => $idClass]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function addStudent(Student $student): bool
    {
        $sql = "INSERT INTO students (INE, Fname, Lname, Birthdate, Gender, PhoneNumber)
                VALUES (:INE, :Fname, :Lname, :Birthdate, :Gender, :PhoneNumber)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'INE' => $student->INE,
            'Fname' => $student->Fname,
            'Lname' => $student->Lname,
            'Birthdate' => $student->Birthdate,
            'Gender' => $student->Gender,
            'PhoneNumber' => $student->PhoneNumber
        ]);
    }

    public function updateStudent(Student $student): bool
    {
        $sql = "UPDATE students SET 
                    Fname = :Fname,
                    Lname = :Lname,
                    Birthdate = :Birthdate,
                    Gender = :Gender,
                    PhoneNumber = :PhoneNumber
                WHERE INE = :INE";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'INE' => $student->INE,
            'Fname' => $student->Fname,
            'Lname' => $student->Lname,
            'Birthdate' => $student->Birthdate,
            'Gender' => $student->Gender,
            'PhoneNumber' => $student->PhoneNumber
        ]);
    }

    public function deleteStudent(string $ine): bool
    {
        $sql = "DELETE FROM students WHERE INE = :ine";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['ine' => $ine]);
    }
}
