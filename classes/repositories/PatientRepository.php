<?php

class PatientRepository extends BaseRepository
{
    protected string $table = 'patients';

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO patients
            (user_id, first_name, last_name, gender, date_of_birth, phone, address)
            VALUES
            (:user_id, :first_name, :last_name, :gender, :date_of_birth, :phone, :address)
        ");

        $stmt->execute([
            'user_id' => $data['user_id'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'gender' => $data['gender'],
            'date_of_birth' => $data['date_of_birth'],
            'phone' => $data['phone'],
            'address' => $data['address']
        ]);

        return (int) $this->pdo->lastInsertId();
    }
}
