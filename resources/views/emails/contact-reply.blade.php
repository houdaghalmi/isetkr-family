<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Réponse à votre message | ISET Link</title>
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
      background-color: #3f51b5;
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
    }

    .content {
      padding: 24px;
    }

    .section-title {
      font-size: 1rem;
      font-weight: 600;
      color: #3f51b5;
      margin-bottom: 8px;
    }

    .reply-box,
    .original-message {
      background-color: #f3f4f6;
      padding: 16px;
      border-left: 4px solid #3f51b5;
      margin: 20px 0;
      border-radius: 4px;
      white-space: pre-line;
    }

    .original-message {
      border-left-color: #5c6bc0;
    }

    .footer {
      background-color: #3f51b5;
      color: white;
      text-align: center;
      font-size: 0.85rem;
      padding: 16px;
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
      <div class="logo">ISET Link</div>
      <div class="subtitle">Réponse à votre message</div>
    </div>

    <div class="content">
      <p>Bonjour,</p>
      <p>Merci de nous avoir contactés. Nous avons bien reçu votre message :</p>
       <div class="original-message">
        <div class="section-title">Votre message :</div>
        {{ $originalMessage }}
      </div>
      <div >
        {{ $replyMessage }}
      </div>

     

      <p style="margin-top: 20px;">Si vous avez d'autres questions, n'hésitez pas à nous écrire de nouveau.</p>
      <p>Cordialement,<br><strong>L'équipe ISET Link</strong></p>
    </div>

    
  </div>
</body>
</html>
