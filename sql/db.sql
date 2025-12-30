CREATE DATABASE unity_care_clinic
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE unity_care_clinic;

CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    location VARCHAR(255),
);
CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    specialization VARCHAR(100),
    phone VARCHAR(20),
    email VARCHAR(100),
    department_id INT,

    CONSTRAINT fk_doctor_department
        FOREIGN KEY (department_id)
        REFERENCES departments(id)
        ON DELETE SET NULL
);
CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    gender ENUM('M', 'F', 'chle7'),
    date_of_birth DATE,
    phone VARCHAR(20),
    email VARCHAR(100),
    address TEXT,
);
CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    time TIME NOT NULL,
    doctor_id INT NOT NULL,
    patient_id INT NOT NULL,
    reason TEXT,
    status ENUM('scheduled', 'done', 'cancelled') DEFAULT 'scheduled',

    CONSTRAINT fk_appointment_doctor
        FOREIGN KEY (doctor_id)
        REFERENCES doctors(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_appointment_patient
        FOREIGN KEY (patient_id)
        REFERENCES patients(id)
        ON DELETE CASCADE
);
CREATE TABLE medications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    instructions TEXT,
);
CREATE TABLE prescriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    doctor_id INT NOT NULL,
    patient_id INT NOT NULL,
    medication_id INT NOT NULL,
    dosage_instructions TEXT,

    CONSTRAINT fk_prescription_doctor
        FOREIGN KEY (doctor_id)
        REFERENCES doctors(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_prescription_patient
        FOREIGN KEY (patient_id)
        REFERENCES patients(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_prescription_medication
        FOREIGN KEY (medication_id)
        REFERENCES medications(id)
        ON DELETE CASCADE
);

--fake data to test this db:
-- Insert departments
INSERT INTO departments (name, location) VALUES
('Cardiology', 'First Floor, Wing A'),
('Pediatrics', 'Second Floor, Wing B'),
('Orthopedics', 'First Floor, Wing C'),
('Neurology', 'Third Floor, Wing A'),
('Dermatology', 'Ground Floor, Wing B'),
('Oncology', 'Second Floor, Wing D'),
('Emergency', 'Ground Floor, Main Building'),
('General Medicine', 'First Floor, Wing B');

-- Insert doctors
INSERT INTO doctors (first_name, last_name, specialization, phone, email, department_id) VALUES
('James', 'Wilson', 'Cardiologist', '555-0101', 'james.wilson@unityclinic.com', 1),
('Sarah', 'Miller', 'Pediatrician', '555-0102', 'sarah.miller@unityclinic.com', 2),
('Robert', 'Chen', 'Orthopedic Surgeon', '555-0103', 'robert.chen@unityclinic.com', 3),
('Lisa', 'Garcia', 'Neurologist', '555-0104', 'lisa.garcia@unityclinic.com', 4),
('Michael', 'Brown', 'Dermatologist', '555-0105', 'michael.brown@unityclinic.com', 5),
('Jennifer', 'Taylor', 'Oncologist', '555-0106', 'jennifer.taylor@unityclinic.com', 6),
('David', 'Lee', 'Emergency Physician', '555-0107', 'david.lee@unityclinic.com', 7),
('Emily', 'Davis', 'General Practitioner', '555-0108', 'emily.davis@unityclinic.com', 8),
('Thomas', 'Martinez', 'Cardiac Surgeon', '555-0109', 'thomas.martinez@unityclinic.com', 1),
('Jessica', 'Robinson', 'Pediatric Neurologist', '555-0110', 'jessica.robinson@unityclinic.com', 2);

-- Insert patients
INSERT INTO patients (first_name, last_name, gender, date_of_birth, phone, email, address) VALUES
('John', 'Smith', 'M', '1985-03-15', '555-0201', 'john.smith@email.com', '123 Maple Street, Springfield'),
('Maria', 'Johnson', 'F', '1990-07-22', '555-0202', 'maria.j@email.com', '456 Oak Avenue, Shelbyville'),
('David', 'Williams', 'M', '1978-11-30', '555-0203', 'david.w@email.com', '789 Pine Road, Capital City'),
('Sophia', 'Brown', 'F', '2005-01-10', '555-0204', 'sophia.b@email.com', '321 Elm Drive, Ogdenville'),
('Michael', 'Jones', 'M', '1995-09-05', '555-0205', 'michael.j@email.com', '654 Birch Lane, North Haverbrook'),
('Emma', 'Garcia', 'F', '1982-12-18', '555-0206', 'emma.g@email.com', '987 Cedar Blvd, Brockway'),
('Daniel', 'Martinez', 'M', '1970-04-25', '555-0207', 'daniel.m@email.com', '147 Walnut Street, Springfield'),
('Olivia', 'Davis', 'F', '1998-06-12', '555-0208', 'olivia.d@email.com', '258 Spruce Court, Shelbyville'),
('Ethan', 'Rodriguez', 'M', '2008-08-08', '555-0209', 'ethan.r@email.com', '369 Aspen Way, Capital City'),
('Ava', 'Wilson', 'F', '1987-02-28', '555-0210', 'ava.w@email.com', '741 Redwood Road, Ogdenville'),
('Liam', 'Taylor', 'M', '1975-10-15', '555-0211', 'liam.t@email.com', '852 Magnolia Drive, North Haverbrook'),
('Isabella', 'Thomas', 'F', '1993-03-03', '555-0212', 'isabella.t@email.com', '963 Sycamore Lane, Brockway'),
('Noah', 'Moore', 'M', '1965-05-20', '555-0213', 'noah.m@email.com', '159 Fir Circle, Springfield'),
('Mia', 'Jackson', 'F', '2001-11-11', '555-0214', 'mia.j@email.com', '753 Poplar Street, Shelbyville'),
('Lucas', 'White', 'M', '1991-09-30', '555-0215', 'lucas.w@email.com', '357 Willow Avenue, Capital City');

-- Insert medications
INSERT INTO medications (name, instructions) VALUES
('Amoxicillin', 'Take every 8 hours with food'),
('Lisinopril', 'Take once daily in the morning'),
('Metformin', 'Take twice daily with meals'),
('Atorvastatin', 'Take once daily at bedtime'),
('Levothyroxine', 'Take on empty stomach, 30 minutes before breakfast'),
('Albuterol', 'Use as needed for shortness of breath'),
('Ibuprofen', 'Take every 6-8 hours as needed for pain'),
('Omeprazole', 'Take once daily before breakfast'),
('Sertraline', 'Take once daily, may cause drowsiness'),
('Warfarin', 'Take exactly as prescribed, monitor diet'),
('Insulin Glargine', 'Inject once daily at the same time'),
('Prednisone', 'Take with food, taper as directed'),
('Hydrochlorothiazide', 'Take in the morning'),
('Losartan', 'Take once daily, with or without food'),
('Metoprolol', 'Take twice daily, do not suddenly stop');

-- Insert appointments (mix of past and future)
INSERT INTO appointments (date, time, doctor_id, patient_id, reason, status) VALUES
('2024-01-15', '09:00:00', 1, 1, 'Routine heart checkup', 'done'),
('2024-01-15', '10:30:00', 2, 4, 'Childhood vaccination', 'done'),
('2024-01-16', '14:00:00', 3, 3, 'Knee pain consultation', 'done'),
('2024-01-17', '11:15:00', 4, 2, 'Migraine follow-up', 'done'),
('2024-01-18', '15:45:00', 5, 5, 'Skin rash evaluation', 'done'),
('2024-01-19', '08:30:00', 6, 6, 'Post-chemotherapy check', 'done'),
('2024-01-20', '13:00:00', 7, 7, 'Emergency follow-up', 'done'),
('2024-01-22', '10:00:00', 8, 8, 'General health check', 'scheduled'),
('2024-01-23', '14:30:00', 9, 9, 'Heart murmur evaluation', 'scheduled'),
('2024-01-24', '09:45:00', 10, 10, 'Pediatric neurological assessment', 'scheduled'),
('2024-01-25', '16:00:00', 1, 11, 'Blood pressure monitoring', 'scheduled'),
('2024-01-26', '11:00:00', 2, 12, 'Annual pediatric exam', 'scheduled'),
('2024-01-15', '13:30:00', 3, 13, 'Follow-up for hip replacement', 'cancelled'),
('2024-01-16', '15:00:00', 4, 14, 'Seizure monitoring', 'done'),
('2024-01-17', '08:00:00', 5, 15, 'Acne treatment follow-up', 'scheduled'),
('2024-01-18', '12:00:00', 6, 1, 'Cancer screening consultation', 'scheduled'),
('2024-01-19', '14:15:00', 7, 2, 'Injury assessment', 'scheduled'),
('2024-01-20', '10:45:00', 8, 3, 'Diabetes management', 'scheduled'),
('2024-01-22', '15:30:00', 9, 4, 'Cardiac stress test', 'scheduled'),
('2024-01-23', '09:15:00', 10, 5, 'Developmental assessment', 'scheduled');

-- Insert prescriptions
INSERT INTO prescriptions (date, doctor_id, patient_id, medication_id, dosage_instructions) VALUES
('2024-01-15', 1, 1, 2, '10mg once daily in the morning'),
('2024-01-15', 2, 4, 1, '250mg every 8 hours for 10 days'),
('2024-01-16', 3, 3, 7, '400mg every 6 hours as needed for pain'),
('2024-01-17', 4, 2, 9, '50mg once daily in the morning'),
('2024-01-18', 5, 5, 8, '20mg once daily before breakfast'),
('2024-01-19', 6, 6, 12, '20mg daily for 5 days, then taper'),
('2024-01-20', 7, 7, 6, '2 puffs every 4-6 hours as needed'),
('2024-01-15', 8, 8, 3, '500mg twice daily with meals'),
('2024-01-16', 1, 9, 4, '40mg once daily at bedtime'),
('2024-01-17', 2, 10, 1, '125mg every 8 hours for 7 days'),
('2024-01-18', 3, 11, 14, '50mg once daily'),
('2024-01-19', 4, 12, 15, '25mg twice daily'),
('2024-01-20', 5, 13, 5, '100mcg daily on empty stomach'),
('2024-01-15', 6, 14, 10, '5mg daily, monitor INR weekly'),
('2024-01-16', 7, 15, 13, '25mg once daily in the morning');