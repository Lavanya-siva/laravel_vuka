<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 20px;
        }
        .container {
            max-width: 520px;
            margin: auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
        }
        .header {
            text-align: center;
            color: #333;
        }
        .otp-box {
            text-align: center;
            font-size: 26px;
            font-weight: bold;
            letter-spacing: 6px;
            margin: 20px 0;
            color: #2d6cdf;
        }
        .footer {
            font-size: 12px;
            color: #777;
            text-align: center;
            margin-top: 25px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="header">Verify Your Account</h2>

    <p>Hello {{ $user->firstname }},</p>

    <p>
        Thank you for creating your account.  
        Please use the OTP below to verify your email address.
    </p>

    <div class="otp-box">
        {{ $otp }}
    </div>

    <p>
        This OTP is valid for <strong>10 minutes</strong>.  
        Do not share this OTP with anyone.
    </p>

    <p> If you did not request this, please ignore this email.</p>

    <div class="footer">
        © {{ date('Y') }} VUKA. All rights reserved.
    </div>
</div>

</body>
</html>
