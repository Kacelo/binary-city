# binary-city

## Data Capturing System

### Overview
This is a data capturing system designed for managing client and contact information. The application uses a server setup via XAMPP and an SQL database to store the data. The backend is built entirely in PHP, while the frontend leverages HTML, JavaScript, and Bootstrap for a clean, responsive design.

### Features
Add, view, update, and delete clients and their associated contacts.
Validate form inputs dynamically using JavaScript and server-side PHP.
Relational linking between clients and contacts.
Uses Bootstrap for a modern and mobile-friendly UI.
### Technologies Used
Backend: PHP
Frontend: HTML, JavaScript, Bootstrap CSS
Database: MySQL
Server Environment: XAMPP
Setup Instructions

### Project Structure
/config: Configuration files for database connection and session handling.
/models: PHP classes for interacting with the database (e.g., contacts, clients).
/controllers: Logic for handling requests and performing actions like CRUD operations.
/views: HTML forms and pages rendered for the user interface.
/includes: PHP scripts for handling form submissions and linking the backend.

#### 1. Prerequisites
Before running this project, ensure the following are installed:

XAMPP (for Apache server and MySQL)
A modern web browser

#### 2. Clone the Repository
Clone this repository to your local machine using:

bash
Copy code
git clone <repository-url>
#### 3. Configure the Database
Open phpMyAdmin in your browser (usually at http://localhost/phpmyadmin).
Create a new database, e.g., data_capturing_system.
Import the provided SQL file:
Locate the database.sql file in the project root.
Use the Import feature in phpMyAdmin to upload this file to your database.
#### 4. Update Configuration
Go to the config folder in the project directory.
Edit the database.php file and update the following with your database details:
php
define('DB_HOST', 'localhost');
define('DB_NAME', 'data_capturing_system');
define('DB_USER', 'root');
define('DB_PASS', '');
#### 5. Start the Server
Open the XAMPP Control Panel.
Start the Apache and MySQL modules.
Place the project folder in the htdocs directory of your XAMPP installation (e.g., C:/xampp/htdocs/data_capturing_system).

#### 6. Access the Application
Open your browser and navigate to:
for windows: http://localhost/binary-city
for linux: http://localhost:81/binary-city 

#### Usage
Navigate to the main page of the application in your browser.
Use the form interfaces to:
Add new clients and contacts.
Link contacts to clients.
View and manage existing data.
Errors and validations will display dynamically if inputs are missing or invalid.
