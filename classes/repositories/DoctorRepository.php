<?php

class DoctorRepository extends BaseRepository
{
    protected string $table = 'doctors';

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO doctors
            (user_id, first_name, last_name, specialization, phone, department_id)
            VALUES
            (:user_id, :first_name, :last_name, :specialization, :phone, :department_id)
        ");

        $stmt->execute([
            'user_id' => $data['user_id'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'specialization' => $data['specialization'],
            'phone' => $data['phone'],
            'department_id' => $data['department_id']
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function findByDepartment(int $departmentId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM doctors WHERE department_id = :dep"
        );
        $stmt->execute(['dep' => $departmentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
