# hospital-management-system
A comprehensive web-based Hospital Management System (HMS) designed as a course project for web technologies. This application is built using a classic LAMP stack (PHP and MySQL) and features a complete user registration and login system with role-based access control for three distinct user types: Admins, Doctors, and Patients.

Key Features
User Registration: Secure user registration with client-side (JavaScript) and server-side (PHP) validation.

Role-Based Access Control: The system supports three user roles:

Admin: Can view and manage all Doctor and Patient accounts.

Doctor: Has a personal dashboard to view their information.

Patient: Has a personal dashboard to view their details.

Secure Login: User authentication with password hashing (password_hash) to ensure data security.

Admin Dashboard: A central panel for the administrator to view lists of all registered doctors and patients, with the ability to delete user accounts.

Dynamic User Dashboards: Separate, tailored dashboard pages for each user role upon successful login.

Session Management: Securely manages user sessions to maintain login status and protect private pages.

Technology Stack
Frontend: HTML5, CSS3, JavaScript (for client-side validation)

Backend: PHP

Database: MySQL

Server: Apache (via XAMPP)

Setup and Installation
To run this project locally, you will need to have a local server environment like XAMPP installed.

Step 1: Clone the Repository
Clone this repository to your local machine inside your XAMPP htdocs folder:

git clone https://github.com/your-username/hospital-management-system.git
cd hospital-management-system

Step 2: Start XAMPP
Open your XAMPP Control Panel and start the Apache and MySQL modules.

Step 3: Create the Database
Open your web browser and navigate to http://localhost/phpmyadmin.

Click on the Databases tab.

Create a new database named hospital_db.

Step 4: Import the SQL Tables
Select the hospital_db database you just created.

Click on the SQL tab.

Copy and paste the following SQL code into the query box and click Go.

-- Create the table for Admins

-- Create the table for Doctors

-- Create the table for Patients

Step 5: Run the Application
Open your web browser and navigate to http://localhost/hospital-management-system/ to see the registration page.

File Structure
/hospital-management-system
│
├── index.html              # User registration page
├── login.php               # Login page and logic
├── register.php            # Handles registration form submission
│
├── admin_dashboard.php     # Admin's private dashboard
├── doctor_dashboard.php    # Doctor's private dashboard
├── patient_dashboard.php   # Patient's private dashboard
│
├── db_config.php           # Database connection configuration
├── delete_user.php         # Script for admin to delete users
├── logout.php              # Destroys the user session
│
├── style.css               # Main stylesheet for all pages
└── script.js               # JavaScript for client-side validation

