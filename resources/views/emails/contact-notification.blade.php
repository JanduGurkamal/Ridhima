<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Form Submission</title>
</head>
<body>
    <h2>New Contact Form Submission</h2>
    
    <p><strong>Name:</strong> {{ $submission->name }}</p>
    <p><strong>Email:</strong> {{ $submission->email }}</p>
    @if($submission->subject)
    <p><strong>Subject:</strong> {{ $submission->subject }}</p>
    @endif
    <p><strong>Message:</strong></p>
    <p>{{ $submission->message }}</p>
    
    <p><small>Received: {{ $submission->created_at->format('F j, Y g:i A') }}</small></p>
</body>
</html>

