#  Ballroom Event Reservation System

This is a full-stack web application I built for managing event venue reservations. The goal of the project was to digitize the manual booking process, allowing clients to create an account, check available rooms, and book events such as weddings or corporate parties.

## Tech Stack
* Frontend: HTML, CSS
* Backend: PHP
* Database: MySQL / MariaDB

## Database Structure
The database is fully normalized and consists of 7 interconnected tables:
* Client: Stores user details and login credentials.
* Eveniment (Event): The main junction table that links a client's reservation to specific rooms and menus.
* Sala (Room) & Meniu (Menu): Catalogs storing capacities and prices.
* Personal (Staff) & Personal_Eveniment: Many-to-many relationship linking employees to specific events.
* Plata (Payment): Tracks financial records for the reservations.

## Main Features
* User Authentication: Simple login system. If an email is not found in the database, a new account is automatically created (auto-register).
* Dynamic Dashboard: Uses complex SQL queries (JOINs, SUM, MAX, AVG, and subqueries) to display user statistics, such as total amount spent, largest event, and average guest count.
* CRUD Operations:
  * Create: Users can book a new event by selecting the date, room, menu, and guest count.
  * Read: Users can view their active reservations and history.
  * Update: Users can modify their profile phone number or update the guest count for an upcoming event.
  * Delete: Users can cancel reservations. I also implemented a cascaded delete logic: if a user deletes their account, all their associated events and payments are automatically removed to prevent orphaned data.

## How to run locally
1. Install a local server environment like XAMPP.
2. Start the Apache and MySQL modules.
3. Open phpMyAdmin and import the `database.sql` file.
4. Place the `.php` files in your `htdocs` directory.
5. Access `http://localhost/login.php` in your web browser.
