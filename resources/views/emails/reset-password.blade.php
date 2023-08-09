<!DOCTYPE html>
<html lang="EN">
<head>
    <title>Password Reset - Releasify</title>
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
    <h1>Reset your password</h1>

    <p>Hi {{ $username }},</p>
    <p>We received a request to reset your password for your Releasify account.</p>
    <p>Please click the button below to reset your password:</p>
    <!--TODO: fix reset password link-->
    <a href="{{ url('/reset-password/'.$token) }}" class="cta-button">Reset Password</a>

    <p>If you did not request to reset your password, you can safely ignore this email.</p>
    <p>If you have any questions or issues, feel free to reach out to our support team.</p>

    <p>Thanks,
        <br>The Releasify Team</p>
</div>
</body>
</html>
