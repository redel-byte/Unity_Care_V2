<?php

class MedicationRepository extends BaseRepository
{
    protected string $table = 'medications';

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO medications (name, instructions)
            VALUES (:name, :instructions)
        ");

        $stmt->execute([
            'name' => $data['name'],
            'instructions' => $data['instructions']
        ]);

        return (int) $this->pdo->lastInsertId();
    }
}
