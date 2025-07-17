# Task Manager Laravel Project

A comprehensive task management system built with modern web technologies. This application allows users to create, manage, and track tasks with priority levels, status updates, and user assignments.

## Technologies Used

- **Backend Framework:** Laravel 10.x
- **Frontend Framework:** Bootstrap 5.3
- **Database:** SQLite
- **Authentication:** Laravel Breeze
- **JavaScript Libraries:** 
  - Chart.js (for analytics visualization)
  - Bootstrap Bundle (for UI components)
- **CSS:** Tailwind CSS
- **Email Service:** Gmail SMTP

## Features

- User authentication and authorization
- Task creation and management
- Priority levels (High, Medium, Low)
- Task status tracking
- User assignment
- Real-time analytics
- Email notifications for task deadlines
- Administrative controls

## Setup Instructions

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

## Email Configuration

To enable email notifications:

1. Update your `.env` file with your Gmail SMTP credentials:
   ```
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your-email@gmail.com
   MAIL_PASSWORD=your-app-specific-password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=your-email@gmail.com
   MAIL_FROM_NAME="${APP_NAME}"
   ```


## Using the Application

### User Registration and Login
1. Visit the homepage and click "Register"
2. Fill in your details (name, email, password)
3. Log in with your credentials

### Task Management
1. **Creating Tasks:**
   - Click "+ New Task" button
   - Fill in task details (title, description)
   - Select priority level
   - Submit the form

2. **Managing Tasks:**
   - View all tasks on the dashboard
   - Update task status using "Mark Completed/Pending"
   - Edit tasks using the "Edit" button
   - Change priority levels using the dropdown
   - Delete tasks using the "Delete" button

3. **Task Priority Levels:**
   - High Priority (HP) - Red
   - Medium Priority (MP) - Yellow
   - Low Priority (LP) - Green

### Administrative Functions
Administrators have additional capabilities:
1. Access to all tasks across users
2. User management capabilities
3. Analytics dashboard access
4. System-wide notifications

### Analytics
The analytics tab provides:
- Daily interaction metrics
- Top contributors chart
- Task completion statistics

## Contributing

1. Fork the repository
2. Create your feature branch: `git checkout -b feature/AmazingFeature`
3. Commit your changes: `git commit -m 'Add some AmazingFeature'`
4. Push to the branch: `git push origin feature/AmazingFeature`
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.
