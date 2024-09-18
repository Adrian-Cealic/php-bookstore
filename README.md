# PHP Bookstore

A simple PHP application to manage a bookstore, allowing users to browse books, add them to their cart, and proceed to checkout. This project demonstrates core PHP functionality and database operations using MySQL.

## Features

- Browse books by category
- Add books to cart
- View cart and modify quantities
- Checkout and complete orders
- User authentication (login, register)
- Admin panel to manage books and orders

## Installation

### Prerequisites

- PHP 7.4+
- MySQL or MariaDB
- Composer (for managing dependencies)

### Setup

1. Clone the repository:
    ```bash
    git clone https://github.com/Adrian-Cealic/php-bookstore.git
    ```

2. Navigate to the project directory:
    ```bash
    cd php-bookstore
    ```

3. Install dependencies:
    ```bash
    composer install
    ```

4. Set up the `.env` file with your database credentials:
    ```bash
    cp .env.example .env
    ```
    Edit the `.env` file to configure the database connection:
    ```
    DB_HOST=localhost
    DB_DATABASE=bookstore_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. Create the database and import the schema:
    ```bash
    php artisan migrate
    ```

6. Run the application:
    ```bash
    php -S localhost:8000
    ```

7. Open your browser and navigate to:
    ```
    http://localhost:8000
    ```

## Usage

### User Features

- **Browse Books**: View books by category or search by title.
- **Add to Cart**: Select books and add them to your shopping cart.
- **Checkout**: Complete the order by filling in payment details.

### Admin Features

- **Manage Books**: Add, update, and delete book entries in the admin panel.
- **Manage Orders**: View and manage customer orders.

## Folder Structure

