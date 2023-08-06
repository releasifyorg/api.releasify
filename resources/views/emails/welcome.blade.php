<!DOCTYPE html>
<html lang="EN">
<head>
    <title>Welcome to Releasify</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            margin-bottom: 20px;
        }

        h1 {
            color: #007bff;
        }

        p {
            margin-bottom: 20px;
        }

        .cta-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Welcome to Releasify</h1>
    <p>Thank you for registering on our website. We are thrilled to have you join our community!</p>
    <p>If you have any questions or need assistance, feel free to reach out to our support team.</p>
    <p>Get started by exploring our awesome features.</p>

    <p>Your login <strong>{{ $username  }}</strong> </p>
    <p>Your password <strong>{{ $password  }}</strong> </p>
    <a href="@php config('app.frontend_url') @endphp" class="cta-button">Go to Dashboard</a>
</div>
</body>
</html>
