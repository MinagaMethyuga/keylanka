<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #f42525;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #111827;
            margin-bottom: 20px;
        }
        .message {
            font-size: 16px;
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .code-container {
            background-color: #f9fafb;
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
        }
        .code {
            font-size: 36px;
            font-weight: bold;
            color: #f42525;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
        }
        .note {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.5;
        }
        .footer {
            background-color: #f9fafb;
            padding: 20px 30px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="header">
        <h1>Key Lanka</h1>
    </div>
    <div class="content">
        <div class="greeting">
            Hello{{ $userName ? ' ' . $userName : '' }},
        </div>
        <div class="message">
            Thank you for choosing Key Lanka! To complete your email verification, please use the following 6-digit code:
        </div>
        <div class="code-container">
            <div class="code">{{ $code }}</div>
        </div>
        <div class="note">
            <strong>Important:</strong> This code will expire in 15 minutes. If you didn't request this code, please ignore this email.
        </div>
    </div>
    <div class="footer">
        © {{ date('Y') }} Key Lanka. All rights reserved.<br>
        This is an automated email, please do not reply.
    </div>
</div>
</body>
</html>
