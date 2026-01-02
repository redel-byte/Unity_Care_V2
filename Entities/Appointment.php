<?php
// - Propriétés : id, date, time, doctorId, patientId, reason, status
// - Méthodes : , markAsDone()

class Appointment
{
    private $id;
    private $date;
    private $time;
    private $doctorId;
    private $patientId;
    private $reason;
    private $status;

    public function __construct($id, $date, $time, $doctorId, $patientId, $reason, $status)
    {
        $this->id = $id;
        $this->date = $date;
        $this->time = $time;
        $this->doctorId = $doctorId;
        $this->patientId = $patientId;
        $this->reason = $reason;
        $this->status = $status;
    }
    public function cancel()
    {
        $this->status = 'cancelled';
    }

    public function markAsDone()
    {
        $this->status = 'done';
    }
}
