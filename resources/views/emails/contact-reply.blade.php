<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Your Contact Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #e5e7eb;
            color: #333;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4F46E5;
            margin-bottom: 8px;
        }
        .content {
            background-color: #f9fafb;
            padding: 20px;
            border: 1px solid #e5e7eb;
        }
        .original-message {
            background-color: #fff;
            padding: 15px;
            border-left: 4px solid #4F46E5;
            margin: 15px 0;
            border-radius: 4px;
        }
        .footer {
            background-color: #6b7280;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 0 0 8px 8px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">ISET Link</div>
        <h2 style="margin: 0; color: #333;">Reply to Your Contact Message</h2>
    </div>

    <div class="content">
        <p>Hello,</p>
        
        <p>Thank you for contacting us. We have received your message and here is our reply:</p>
        
        <div style="background-color: #f8f9fa; padding: 15px; border-radius: 4px; margin: 20px 0;">
            <strong>Our Reply:</strong>
            <p style="margin-top: 10px; white-space: pre-line;">{{ $replyMessage }}</p>
        </div>

        <div class="original-message">
            <strong>Your Original Message:</strong>
            <p style="margin-top: 10px; white-space: pre-line;">{{ $originalMessage }}</p>
        </div>

        <p style="margin-top: 20px;">If you have any further questions, please don't hesitate to contact us.</p>
        
        <p>Best regards,<br>
        <strong>ISET Link Team</strong></p>
    </div>

    <div class="footer">
        <p>This is an automated response from ISET Link. Please do not reply directly to this email.</p>
        <p>&copy; {{ date('Y') }} ISET Link. All rights reserved.</p>
    </div>
</body>
</html> 