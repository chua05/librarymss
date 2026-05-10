<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registration Successful</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #0f172a;">

    <h2 style="margin-bottom:10px;">Welcome to Library Management System</h2>

    <p>Hello {{ $user->name }},</p>

    <p>
        Your account has been successfully registered in the Library Management System.
    </p>

    <p>
        You may now log in using your registered email address.
    </p>

    <p style="margin-top:20px;">
        Thank you.
    </p>

</body>
</html>