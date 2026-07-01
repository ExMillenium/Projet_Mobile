<?php

class ClassManager
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllClasses(): array
    {
        $sql = "SELECT * FROM classes ORDER BY StartYear DESC, ClassName ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClass(string $idClass): ?array
    {
        $sql = "SELECT * FROM classes WHERE idClass = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $idClass]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function addClass(Classe $class): bool
    {
        $sql = "INSERT INTO classes 
                (idClass, ClassName, Curriculum, idLevel, StartYear, EndYear)
                VALUES (:idClass, :ClassName, :Curriculum, :idLevel, :StartYear, :EndYear)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'idClass' => $class->idClass,
            'ClassName' => $class->ClassName,
            'Curriculum' => $class->Curriculum,
            'idLevel' => $class->idLevel,
            'StartYear' => $class->StartYear,
            'EndYear' => $class->EndYear
        ]);
    }

    public function updateClass(Classe $class): bool
    {
        $sql = "UPDATE classes SET 
                    ClassName = :ClassName,
                    Curriculum = :Curriculum,
                    idLevel = :idLevel,
                    StartYear = :StartYear,
                    EndYear = :EndYear
                WHERE idClass = :idClass";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'idClass' => $class->idClass,
            'ClassName' => $class->ClassName,
            'Curriculum' => $class->Curriculum,
            'idLevel' => $class->idLevel,
            'StartYear' => $class->StartYear,
            'EndYear' => $class->EndYear
        ]);
    }

    public function deleteClass(string $idClass): bool
    {
        $sql = "DELETE FROM classes WHERE idClass = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $idClass]);
    }
}
