<?php

abstract class BaseRepository
{
    protected PDO $pdo;
    protected string $table;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM {$this->table} WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query(
            "SELECT * FROM {$this->table}"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM {$this->table} WHERE id = :id"
        );
        return $stmt->execute(['id' => $id]);
    }
}
