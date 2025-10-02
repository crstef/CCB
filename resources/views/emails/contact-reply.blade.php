<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Răspuns la mesajul dumneavoastră</title>
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
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background: #f8fafc;
            padding: 30px;
            border: 1px solid #e2e8f0;
        }
        .reply-message {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #3b82f6;
            margin-bottom: 20px;
        }
        .original-message {
            background: #f1f5f9;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #64748b;
            font-size: 14px;
            color: #475569;
        }
        .footer {
            background: #1e293b;
            color: #94a3b8;
            padding: 20px;
            text-align: center;
            border-radius: 0 0 8px 8px;
            font-size: 14px;
        }
        .contact-info {
            margin-top: 15px;
            font-size: 13px;
        }
        .contact-info a {
            color: #60a5fa;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Clubul de Canotaj București</h1>
        <p>Răspuns la mesajul dumneavoastră</p>
    </div>

    <div class="content">
        <p>Bună ziua <strong>{{ $contact->full_name }}</strong>,</p>
        
        <div class="reply-message">
            {!! nl2br(e($replyMessage)) !!}
        </div>

        <p>Vă mulțumim că ne-ați contactat!</p>

        <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 25px 0;">

        <div class="original-message">
            <strong>Mesajul dumneavoastră original:</strong><br>
            <em>Subiect: {{ $contact->subject }}</em><br>
            <em>Data: {{ $contact->created_at->format('d.m.Y H:i') }}</em><br><br>
            {{ $originalMessage }}
        </div>
    </div>

    <div class="footer">
        <strong>Clubul de Canotaj București</strong>
        <div class="contact-info">
            <p>
                📍 Str. Lt. Grigore Stamatescu nr. 11, Sector 1, București<br>
                📞 <a href="tel:0723644822">0723 644 822</a> | 
                ✉️ <a href="mailto:office@ccbor.ro">office@ccbor.ro</a><br>
                🆔 CIF: 39333841
            </p>
        </div>
    </div>
</body>
</html>