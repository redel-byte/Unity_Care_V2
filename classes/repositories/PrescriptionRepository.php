<?php

class PrescriptionRepository extends BaseRepository
{
    protected string $table = 'prescriptions';

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO prescriptions
            (date, doctor_id, patient_id, medication_id, dosage_instructions)
            VALUES
            (:date, :doctor_id, :patient_id, :medication_id, :dosage)
        ");

        $stmt->execute([
            'date' => $data['date'],
            'doctor_id' => $data['doctor_id'],
            'patient_id' => $data['patient_id'],
            'medication_id' => $data['medication_id'],
            'dosage' => $data['dosage_instructions']
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function findByPatient(int $patientId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM prescriptions WHERE patient_id = :id"
        );
        $stmt->execute(['id' => $patientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
