<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thank You for Contacting Us</title>
</head>
<body>
    <h2>Thank You for Your Message</h2>
    
    <p>Dear {{ $submission->name }},</p>
    
    <p>Thank you for reaching out! I have received your message and will get back to you as soon as possible.</p>
    
    <p>Best regards,<br>{{ config('app.name') }}</p>
</body>
</html>

