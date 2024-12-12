<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to cityguide</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        /* Background Image */
        .hero-section {
            background: url('{{ asset('assets/images/bg-fintrack.jpg') }}') no-repeat center center;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            position: relative;
        }

        .hero-content {
            background: rgba(0, 0, 0, 0.6);
            padding: 30px 50px;
            border-radius: 10px;
            text-align: center;
        }

        .hero-content h1 {
            font-size: 3rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .btn-custom {
            font-size: 1.1rem;
            padding: 12px 30px;
            border-radius: 5px;
            border: none;
            margin: 10px;
            transition: background-color 0.3s;
        }

        .btn-login {
            background-color: #007bff;
            color: white;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .btn-register {
            background-color: #28a745;
            color: white;
        }

        .btn-register:hover {
            background-color: #218838;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1>Welcome to cityguide</h1>
        <p>Manage your company's expenses with ease. Let's get started!</p>
        <div>
            <a href="http://localhost:8000/login" class="btn btn-custom btn-login">Login</a>
            <a href="http://localhost:8000/register" class="btn btn-custom btn-register">Register</a>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2024 cityguide. All rights reserved.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
