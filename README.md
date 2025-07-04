# Task Manager Laravel Project

This is a simple task management website built with Laravel.

## Setup Instructions for Collaborators

1.  **Clone the repository:**
    ```
    git clone https://github.com/Khedai/Laravel-Tasks
    cd task-manager
    ```

2.  **Install PHP dependencies:**
    ```
    composer install
    ```

3.  **Create your local environment file:**
    ```
    cp .env.example .env
    ```

4.  **Generate your application key:**
    ```
    php artisan key:generate
    ```

5.  **Set up the SQLite database:**
    *   Create the database file:
        ```
        touch database/database.sqlite
        ```
    *   Run the database migrations:
        ```
        php artisan migrate
        ```

6.  **Install and compile frontend assets:**
    ```
    npm install
    npm run dev
    ```

7.  **Run the development server:**
    ```
    php artisan serve
    ```

The application will be available at `http://127.0.0.1:8000`
