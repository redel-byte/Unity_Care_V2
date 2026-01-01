<?php

class AppointmentRepository extends BaseRepository
{
    protected string $table = 'appointments';

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO appointments
            (date, time, doctor_id, patient_id, reason, status)
            VALUES
            (:date, :time, :doctor_id, :patient_id, :reason, :status)
        ");

        $stmt->execute([
            'date' => $data['date'],
            'time' => $data['time'],
            'doctor_id' => $data['doctor_id'],
            'patient_id' => $data['patient_id'],
            'reason' => $data['reason'],
            'status' => $data['status']
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function findByDoctor(int $doctorId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM appointments WHERE doctor_id = :id"
        );
        $stmt->execute(['id' => $doctorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus(int $id, string $status): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE appointments SET status = :status WHERE id = :id"
        );
        return $stmt->execute([
            'status' => $status,
            'id' => $id
        ]);
    }
}
