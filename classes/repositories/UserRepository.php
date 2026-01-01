<?php

class UserRepository extends BaseRepository
{
    protected string $table = 'users';

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO users (email, username, password_hash, role)
            VALUES (:email, :username, :password_hash, :role)
        ");

        $stmt->execute([
            'email' => $data['email'],
            'username' => $data['username'],
            'password_hash' => $data['password_hash'],
            'role' => $data['role']
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM users WHERE email = :email"
        );
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
