<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reply to your message | ISETKR Family</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9fafb;
      color: #111827;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #ffffff;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      overflow: hidden;
    }

    .header {
      background-color: #2d3480; /* deep blue */
      color: white;
      text-align: center;
      padding: 24px;
    }

    .logo {
      font-size: 1.8rem;
      font-weight: bold;
    }

    .subtitle {
      font-size: 1rem;
      margin-top: 4px;
      color: #fcd34d; /* soft gold accent */
    }

    .content {
      padding: 24px;
    }

    .section-title {
      font-size: 1rem;
      font-weight: 600;
      color: #2d3480; /* blue title */
      margin-bottom: 8px;
    }

    .reply-box,
    .original-message {
      background-color: #f3f4f6;
      padding: 16px;
      border-left: 4px solid #2d3480;
      margin: 20px 0;
      border-radius: 4px;
      white-space: pre-line;
    }

    .original-message {
      border-left-color: #3f4c9a; /* lighter blue */
    }

    .footer {
      background-color: #2d3480;
      color: white;
      text-align: center;
      font-size: 0.85rem;
      padding: 16px;
    }

    .footer strong {
      color: #f59e0b; /* gold highlight */
    }

    @media (max-width: 600px) {
      .container {
        margin: 20px;
      }
      .content, .header, .footer {
        padding: 16px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <div class="logo">ISETKR Family</div>
      <div class="subtitle">Reply to your message</div>
    </div>

    <div class="content">
      <p>Hello,</p>
      <p>Thank you for contacting us. We have received your message:</p>
       <div class="original-message">
        <div class="section-title">Your message:</div>
        {{ $originalMessage }}
      </div>
      <div class="reply-box">
        {{ $replyMessage }}
      </div>

      <p style="margin-top: 20px;">If you have any other questions, please feel free to write to us again.</p>
      <p>Sincerely,<br><strong>The ISETKR Family Team</strong></p>
    </div>

    <div class="footer">
      &copy; 2025 <strong>ISETKR Family</strong>. All rights reserved.
    </div>
  </div>
</body>
</html>
