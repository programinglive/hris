<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Verification Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #000;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
        }
        .verification-code {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            letter-spacing: 5px;
            margin: 30px 0;
            color: #000;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>BeautyWorld HRIS</h1>
        </div>
        <div class="content">
            <h2>Your Verification Code</h2>
            <p>Thank you for registering with BeautyWorld HRIS. Please use the following verification code to complete your registration:</p>
            
            <div class="verification-code">{{ $verificationCode }}</div>
            
            <p>This code will expire in 10 minutes. If you did not request this code, please ignore this email.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} BeautyWorld HRIS. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
