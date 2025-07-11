<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MyProject</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            height: 100vh;
            background: linear-gradient(-45deg, #0d6efd, #6610f2, #6f42c1, #20c997);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .welcome-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }

        .welcome-container h1 {
            font-weight: 600;
        }

        .btn-primary {
            transition: transform 0.3s ease-in-out;
        }

        .btn-primary:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body>

    <div class="welcome-container">
        <h1 class="text-primary mb-3">Welcome to Task-Manager App</h1>
        <p class="lead text-secondary mb-4">Your gateway to modern App development.</p>

        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary px-4 py-2">Register</a>
        </div>
    </div>

</body>

</html>