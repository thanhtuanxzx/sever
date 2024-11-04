<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
</head>
<body>
    <p>Hi {{ $user->first_name }},</p>
    <p>Please verify your email by clicking the link below:</p>
<a href="http://localhost:8000/api/auth/verify-email?token={{ $token }}">Verify Email</a>

</body>
</html>
