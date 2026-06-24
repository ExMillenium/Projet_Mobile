<?php

class EnrollManager {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAllEnrollments(): array {
        $sql = "
            SELECT 
                E.StudentINE,
                E.ClassEnrolled,
                E.Enroll_date,
                E.End_date,
                E.statuts,
                S.Fname,
                S.Lname,
                C.ClassName
            FROM enroll E
            INNER JOIN students S ON S.INE = E.StudentINE
            INNER JOIN classes C ON C.idClass = E.ClassEnrolled
            ORDER BY E.Enroll_date DESC
        ";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEnrollmentsByStudent(string $ine): array {
        $sql = "
            SELECT 
                E.*,
                C.ClassName
            FROM enroll E
            INNER JOIN classes C ON C.idClass = E.ClassEnrolled
            WHERE E.StudentINE = :ine
            ORDER BY E.Enroll_date DESC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['ine' => $ine]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEnrollmentsByClass(string $idClass): array {
        $sql = "
            SELECT 
                E.*,
                S.Fname,
                S.Lname
            FROM enroll E
            INNER JOIN students S ON S.INE = E.StudentINE
            WHERE E.ClassEnrolled = :id
            ORDER BY S.Lname, S.Fname
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $idClass]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function enrollStudent(Enroll $enroll): bool {
        $sql = "
            INSERT INTO enroll (StudentINE, ClassEnrolled, Enroll_date, End_date, statuts)
            VALUES (:StudentINE, :ClassEnrolled, :Enroll_date, :End_date, :statuts)
        ";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'StudentINE' => $enroll->StudentINE,
            'ClassEnrolled' => $enroll->ClassEnrolled,
            'Enroll_date' => $enroll->Enroll_date,
            'End_date' => $enroll->End_date,
            'statuts' => $enroll->statuts
        ]);
    }

    public function updateEnrollment(Enroll $enroll): bool
    {
        $sql = "
            UPDATE enroll SET
                Enroll_date = :Enroll_date,
                End_date = :End_date,
                statuts = :statuts
            WHERE StudentINE = :StudentINE
            AND ClassEnrolled = :ClassEnrolled
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'Enroll_date' => $enroll->Enroll_date,
            'End_date' => $enroll->End_date,
            'statuts' => $enroll->statuts,
            'StudentINE' => $enroll->StudentINE,
            'ClassEnrolled' => $enroll->ClassEnrolled
        ]);
    }

    public function getEnrollment(string $ine, string $class): array {
    $sql = "SELECT * FROM enroll WHERE StudentINE = :ine AND ClassEnrolled = :class";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['ine' => $ine, 'class' => $class]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}



    public function getHistoryByStudent(string $ine): array {
        $sql = "
            SELECT e.*, c.ClassName
            FROM enroll e
            JOIN classes c ON c.idClass = e.ClassEnrolled
            WHERE e.StudentINE = :ine
            ORDER BY e.Enroll_date ASC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['ine' => $ine]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
