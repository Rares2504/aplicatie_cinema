# Cinema Booking System

## Overview

Cinema Booking System is a PHP-based web application designed using the MVC (Model-View-Controller) architecture. This project enables efficient management of cinema operations, including movie scheduling, ticket booking, and real-time seat availability tracking. The application supports two types of users:

- **Admins**: Manage movies, screenings, cinema halls, and schedules.
- **Regular Users**: Browse movies, book tickets, select seats in real time, and receive tickets via email or print them.

## Features

- **Custom MVC Structure**: Organized models, views, and controllers for clean, maintainable code.
- **User Authentication**: Different access levels for admins and regular users.
- **Movie & Screening Management**: Admins can add, update, and schedule movies and screenings.
- **Seat Selection & Booking**: Users can view available seats and select their preferred ones.
- **Email Ticket Delivery**: Tickets can be printed or received via email.
- **Routing System**: Centralized route management with `.htaccess` for URL rewriting.
- **Database Interaction with PDO**: Secure and flexible database access.
- **Migration System**: SQL-based migrations for structured database updates.

## Folder Structure

- `config/` - Configuration files, including database and routing setup.
- `controllers/` - Handles application logic and communication between models and views.
- `models/` - Represents data and business logic.
- `views/` - Displays UI elements for users.
- `migrations/` - SQL-based migrations for updating the database structure.
- `public/` - Contains publicly accessible files like the entry point (`index.php`).
- `phpmailer/` - Library for sending ticket confirmation emails.

## Setup

### Prerequisites

- **PHP** 7.4 or later
- **XAMPP** (or any server with Apache & MySQL)
- **Composer** (for dependency management)

### Installation

#### 1. Install XAMPP

- Download and install [XAMPP](https://www.apachefriends.org/index.html).
- Start Apache and MySQL services.

#### 2. Clone the Repository

Navigate to your `htdocs` directory and clone the project:

```sh
cd /path/to/xampp/htdocs
 git clone https://github.com/your-repo/cinema-booking.git
cd cinema-booking
```

#### 3. Configure the Database

- Open phpMyAdmin and create a database named `cinema_booking`.
- Import the SQL schema from `migrations/cinema_app.sql`.
- Update `config/pdo.php` with your database credentials.

#### 4. Set Up Routing

- Ensure `.htaccess` is enabled in Apache by modifying `httpd.conf`:

```sh
LoadModule rewrite_module modules/mod_rewrite.so
```

- Restart Apache to apply changes.

#### 5. Run Migrations

Use the SQL files in `migrations/` to set up the database schema.

## Running the Application

- Open a browser and navigate to:

```
http://localhost/cinema-booking/
```

## Usage

### Admin Capabilities

- Add, edit, and delete **movies**.
- Manage **screenings** and set up schedules.
- Configure **cinema halls** and seat arrangements.

### User Capabilities

- Browse available **movies** and their screening times.
- View **real-time seat availability** and select preferred seats.
- **Book tickets** securely.
- Receive tickets via **email** or print them.

## Adding a New Route

Define a new route in `config/routes.php`:

```php
$routes = [
  'path/to/your/route' => ['ControllerName', 'methodName'],
];
```

Add the corresponding method in the specified controller.

## Database Queries

The application uses **PDO** for secure database interactions. See `config/pdo.php` for connection setup and example queries.
