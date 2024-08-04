 Setup and Installation

 1. Database Setup

1. Install PostgreSQL**: Follow instructions for your operating system to install PostgreSQL.
   
2. Create Database**: Create a new PostgreSQL database called `hospital` using the following command:

   ```bash
   createdb hospital

Run SQL Script: Execute the SQL script database.sql to set up the database tables and insert sample data:
bash
Copy code
psql -U postgres -d hospital -f database.sql
This command will create the necessary tables (admins and patients) and insert sample patients and admin credentials.
Database Credentials: Make sure to replace the database connection details in db.php with your PostgreSQL username and password:
php
Copy code
$user = 'postgres';  // Replace with your DB username
$pass = 'yourpassword';  // Replace with your DB password
2. Web Server Setup
Install PHP: Ensure PHP is installed and available in your command line.
Host Files: Place the project files in your web server's root directory. If you're using the built-in PHP server, navigate to the project directory and start the server:
bash
Copy code
php -S localhost:8000
Access the Application: Open your web browser and visit http://localhost:8000/index.html to access the application.
Usage

Admin Login
Username: admin
Password: password
Log in as an admin to view and manage the patient queue. The admin panel will display a list of all patients sorted by severity and wait time.

Patient Sign-In
Patients can sign in using the form by providing their name, a 3-letter code, and selecting the severity of their injury. Upon signing in, the system will calculate and display the approximate wait time based on the current queue status.