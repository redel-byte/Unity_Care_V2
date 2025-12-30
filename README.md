#  Unity Care Clinic – Backoffice V2

Unity Care Clinic V2 est une application **Backoffice médicale** développée en **PHP 8 avec une architecture orientée objet (OOP)** et utilisant **PDO** pour l’accès à la base de données.  
Cette version vise à couvrir l’ensemble du parcours patient : **authentification, gestion des rendez-vous, consultations et prescriptions médicales**, tout en respectant les bonnes pratiques de sécurité web.

---

##  Objectifs du projet

- Implémenter un système d’authentification sécurisé avec `$_SESSION`
- Mettre en place un contrôle d’accès basé sur les rôles (RBAC)
- Gérer les rendez-vous médicaux
- Gérer les prescriptions et les médicaments
- Sécuriser l’application contre les attaques XSS, CSRF et SQL Injection
- Enrichir les statistiques du dashboard
- Consolider et structurer une architecture OOP propre et maintenable

---

##  Types d’utilisateurs

| Rôle    | Description                                                                |
|---------|----------------------------------------------------------------------------|
|  Admin  | Gestion globale du système (médecins, patients, médicaments, statistiques) |
|  Doctor | Gestion de ses rendez-vous et création de prescriptions                    |
|  Patient| Prise de rendez-vous et consultation de ses prescriptions                  |

---

##  Authentification & Sessions

- Connexion via **Email + Mot de passe**
- Mots de passe hashés avec `password_hash()`
- Vérification avec `password_verify()`
- Gestion des sessions via `$_SESSION`
- Redirection automatique selon le rôle
- Accès protégé à toutes les pages sensibles

---

##  Contrôle d’accès par rôle (RBAC)

Chaque fonctionnalité est accessible uniquement selon le rôle de l’utilisateur.

| Fonctionnalité            | Admin | Doctor | Patient |
|---------------------------|-------|--------|---------|
| Gérer les départements    | ✓ | ✗   | ✗ |
| Gérer les médecins        | ✓ | ✗ | ✗ |
| Gérer les patients        | ✓ | Lecture seule | ✗ |
| Gérer les médicaments     | ✓ | ✗ | ✗ |
| Voir tous les rendez-vous | ✓ | ✗ | ✗ |
| Voir ses rendez-vous      | ✓ | ✓ | ✓ |
| Créer un rendez-vous      | ✓ | ✓ | ✓ |
| Annuler un rendez-vous    | ✓ | ✓ (les siens) | ✓ (les siens) |
| Créer une prescription    | ✗ | ✓ | ✗ |
| Voir les prescriptions    | ✗ | ✓ (créées) | ✓ (reçues) |
| Voir les statistiques     | ✓ | ✓ (limitées) | ✗ |

---

##  Gestion des rendez-vous

### Entité Appointment
Un rendez-vous contient :
- Date
- Heure
- Médecin
- Patient
- Motif
- Statut (`scheduled`, `done`, `cancelled`)

### Fonctionnalités
- Création, consultation, annulation
- Marquage d’un rendez-vous comme effectué (Doctor)
- Consultation globale (Admin)

---

##  Système de réservation intelligent (Bonus)

- Horaires par défaut : **09:00 – 17:00**
- Créneaux de **30 minutes**
- Lors de la prise de rendez-vous :
  - Affichage uniquement des créneaux disponibles
  - Mise à jour dynamique via **AJAX**

---

##  Gestion des prescriptions

### Entités principales
- **Medication**
- **Prescription**

Une prescription lie :
- Un médecin
- Un patient
- Un médicament
- Des instructions de dosage

### Accès
- Doctor : créer des prescriptions
- Patient : consulter ses prescriptions
- Admin : gérer le catalogue des médicaments

---

##  Sécurité

- **Protection XSS** : échappement systématique des données affichées
- **Protection CSRF** : token CSRF sur tous les formulaires
- **SQL Injection** : requêtes préparées avec PDO
- **Mots de passe** : hashage sécurisé
- **Accès restreint** par rôle utilisateur

---

##  Dashboard & Statistiques

- Statistiques des rendez-vous par statut
- Statistiques par médecin
- Évolution mensuelle des rendez-vous
- Médicaments les plus prescrits

---

##  Architecture du projet

```text
/Config
/Core
    ├── Database.php
    ├── BaseModel.php
    ├── Auth.php
/Models
    ├── User.php
    ├── Admin.php
    ├── Doctor.php
    ├── Patient.php
    ├── Appointment.php
    ├── Prescription.php
    ├── Medication.php
/Controllers
/Views
/Public
index.php



classes/
 ├── models/ → Les données (propriétés, getters/setters, validation) 
 │ ├── User.php (abstract) 
 │ ├── Admin.php 
 │ ├── Doctor.php 
 │ ├── Patient.php 
 │ ├── Appointment.php 
 │ ├── Prescription.php 
 │ └── Medication.php 
 │ └── repositories/ → Les opérations BDD (save, delete, find...) 
 ├── BaseRepository.php (abstract) 
 ├── UserRepository.php 
 ├── PatientRepository.php 
 ├── DoctorRepository.php 
 ├── AppointmentRepository.php 
 ├── PrescriptionRepository.php 
 └── MedicationRepository.php
