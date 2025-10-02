<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Răspuns la mesajul dumneavoastră</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8fafc;
        }
        .email-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="white" opacity="0.1"/><circle cx="80" cy="40" r="1.5" fill="white" opacity="0.1"/><circle cx="60" cy="80" r="1" fill="white" opacity="0.1"/><circle cx="40" cy="60" r="1.5" fill="white" opacity="0.1"/></svg>');
        }
        .logo-container {
            position: relative;
            z-index: 1;
            margin-bottom: 15px;
        }
        .logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 24px;
            color: #1e40af;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .header h1 {
            position: relative;
            z-index: 1;
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header p {
            position: relative;
            z-index: 1;
            margin: 8px 0 0 0;
            font-size: 16px;
            opacity: 0.9;
        }
        .content {
            padding: 40px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 25px;
            color: #374151;
        }
        .reply-message {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            padding: 25px;
            border-radius: 12px;
            border-left: 4px solid #3b82f6;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.1);
        }
        .reply-message h3 {
            margin: 0 0 15px 0;
            color: #1e40af;
            font-size: 16px;
            font-weight: 600;
        }
        .original-message {
            background: #f8fafc;
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid #64748b;
            margin-top: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .original-message h3 {
            margin: 0 0 15px 0;
            color: #475569;
            font-size: 16px;
            font-weight: 600;
        }
        .message-meta {
            background: #e2e8f0;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
            color: #475569;
        }
        .footer {
            background: #1e293b;
            color: #94a3b8;
            padding: 30px;
            text-align: center;
        }
        .footer h4 {
            margin: 0 0 15px 0;
            color: white;
            font-size: 18px;
        }
        .contact-info {
            font-size: 14px;
            line-height: 1.8;
        }
        .contact-info a {
            color: #60a5fa;
            text-decoration: none;
        }
        .contact-info a:hover {
            text-decoration: underline;
        }
        .divider {
            border: none;
            border-top: 2px solid #e2e8f0;
            margin: 30px 0;
            opacity: 0.6;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="logo-container">
                <img src="{{ asset('images/ccb-logo.png') }}" alt="CCB Logo" class="logo" style="width: 80px; height: 80px; border-radius: 50%; background: white; padding: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);">
            </div>
            <h1>Clubul de Ciobănești Belgieni</h1>
            <p>Răspuns la mesajul dumneavoastră</p>
        </div>

        <div class="content">
            <div class="greeting">
                Bună ziua <strong>{{ $contact->full_name }}</strong>,
            </div>
            
            <div class="reply-message">
                <h3>📧 Răspunsul nostru:</h3>
                {!! nl2br(e($replyMessage)) !!}
            </div>

            <p style="color: #6b7280; font-size: 16px;">
                Vă mulțumim că ne-ați contactat și sperăm că răspunsul nostru vă este de ajutor!
            </p>

            <hr class="divider">

            <div class="original-message">
                <h3>📩 Mesajul dumneavoastră original:</h3>
                <div class="message-meta">
                    <strong>Subiect:</strong> {{ $contact->subject }}<br>
                    <strong>Data:</strong> {{ $contact->created_at->format('d.m.Y la H:i') }}<br>
                    <strong>De la:</strong> {{ $contact->email }}
                </div>
                <div style="color: #374151; font-size: 15px;">
                    {!! nl2br(e($originalMessage)) !!}
                </div>
            </div>
        </div>

        <div class="footer">
            <h4>Clubul de Ciobănești Belgieni</h4>
            <div class="contact-info">
                📍 Str. Lt. Grigore Stamatescu nr. 11, Sector 1, București<br>
                📞 <a href="tel:0723644822">0723 644 822</a> | 
                ✉️ <a href="mailto:office@ccbor.ro">office@ccbor.ro</a><br>
                🆔 CIF: 39333841
            </div>
        </div>
    </div>
</body>
</html>