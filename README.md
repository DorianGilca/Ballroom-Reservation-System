# Ballroom Event Reservation System

This is a full-stack web application I built for managing event venue reservations. The goal of the project was to digitize the booking process, allowing clients to check available rooms and book events like weddings or corporate parties.

## Tech Stack
* **Frontend:** HTML, CSS
* **Backend:** PHP
* **Database:** MySQL / MariaDB

## Database Structure
The database is fully normalized and consists of 7 interconnected tables:
* `Client`: Stores user details and credentials.
* `Eveniment`: The main junction table linking a client's reservation to specific rooms and menus.
* `Sala` & `Meniu`: Catalogs storing capacities and prices.
* `Personal` & `Personal_Eveniment`: Many-to-many relationship linking employees to specific events.
* `Plata`: Tracks financial records for the reservations.

## Main Features
* **Authentication:** Simple login system with an auto-register feature if the email isn't found in the database.
* **Dynamic Dashboard:** Uses complex SQL queries (JOINs, SUM, MAX, AVG, and subqueries) to display user statistics (amount spent, largest event, average guest count).
* **CRUD Operations:** Complete flow for creating, reading, updating, and canceling reservations.
* **Cascaded Deletion:** If a user deletes their account, all associated events and payments are automatically removed to prevent orphaned data in the database.

## How to run locally
1. Install a local server environment (e.g., XAMPP).
2. Start Apache and MySQL.
3. Import the `database.sql` file via phpMyAdmin.
4. Place the `.php` files in your `htdocs` directory.
5. Access `http://localhost/login.php` in your browser.
