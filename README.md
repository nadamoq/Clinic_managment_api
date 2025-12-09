 Dental Clinical Management Platform

A full-stack Laravel-based platform designed to streamline the management of 
**students, patients, appointments, supervisors, evaluations, notifications, and clinic operations** 
in dental faculties and clinical training environments.

This system provides a clean, efficient workflow for all roles in the clinic:  
**Admin, Receptionist, Supervisors, Students.**

---

## 🚀 Features

### 👩‍⚕️ Patient Management
- Add, update, delete, and view patient records.
- Upload and manage patient images using a shared **Image Upload Trait**.
- Automatic cleanup of old patient records using **Laravel Scheduler**.
- Export & import patient reports to **Excel**.

### 📅 Appointment Management
- Students can book appointments with patients.
- Automatic calculation of end-time using helper functions.
- Supports **pending, processing, completed, and canceled** states.
- Suggests the earliest available time slot for a new appointment, ensuring it does **not conflict** with any existing bookings for the same supervisor.
 

### 👨‍🎓 Student & Supervisor Module
- Students linked to users with dedicated profiles.
- Supervisors evaluate appointments.
- Clean modular structure using:
  - **Service Classes**
  - **Form Requests**
  - **Observers**
  - **Action-based architecture**

### 📨 Notification System
- Database and email notifications.
- Queued emails using **Queues** for high performance.


### ⚙️ Background Jobs & Scheduling
- Queue system for sending bulk notifications.
- Scheduled tasks for cleaning old appointments.
- Example: Auto-deleting old records every term(3 months).

### 🔐 Authentication & Authorization
- Complete role-based permissions.
- Laravel Policies for resources (patients, appointments, evaluations).

### 🧩 Code Architecture
- Clean Code principles.
- Service Layer .
- Traits for shared functionality (image uploads).
- Observers for model-based actions.
- Jobs + Queues .
- Fully RESTful API structure.

---

## 🛠️ Technologies Used

- **Laravel 12**
- **Queue & Jobs** 
- **Scheduler / Cron Jobs**
- **Laravel Notifications**
- **Events & Listeners**
- **Observers**
- **Form Request Validation**
- **Eloquent Relationships**
- **Migrations & Seeders**
- **Excel Export (Maatwebsite/Excel)**
- **Image Handling with Traits**

---

## 📦 Installation

```bash
git clone <repository-link>
cd dental-clinic-platform
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link