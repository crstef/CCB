<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesaj nou de contact</title>
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
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 50%, #f87171 100%);
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
        .header h1 {
            position: relative;
            z-index: 1;
            margin: 0;
            font-size: 26px;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header p {
            position: relative;
            z-index: 1;
            margin: 8px 0 0 0;
            font-size: 15px;
            opacity: 0.9;
        }
        .content {
            padding: 30px;
        }
        .field {
            margin-bottom: 20px;
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #3b82f6;
        }
        .field label {
            font-weight: 600;
            color: #374151;
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .field .value {
            color: #1f2937;
            font-size: 15px;
        }
        .field .value a {
            color: #3b82f6;
            text-decoration: none;
        }
        .field .value a:hover {
            text-decoration: underline;
        }
        .message-box {
            background-color: #f0f9ff;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #0ea5e9;
            white-space: pre-wrap;
            color: #1e293b;
            font-size: 15px;
            line-height: 1.7;
        }
        .footer {
            background: #1e293b;
            color: #94a3b8;
            padding: 25px;
            text-align: center;
            font-size: 14px;
        }
        .footer h4 {
            margin: 0 0 10px 0;
            color: white;
            font-size: 16px;
        }
        .alert-box {
            background: linear-gradient(135deg, #fef3c7 0%, #fed7aa 100%);
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            color: #92400e;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="logo-container">
                <img src="{{ asset('images/ccb-logo.png') }}" alt="CCB Logo" style="width: 110px; height: 110px; border-radius: 50%; background: white; padding: 15px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);">
            </div>
            <h1>📧 Mesaj nou de contact</h1>
            <p>Primit prin formularul de contact de pe site</p>
        </div>

        <div class="content">
            <div class="alert-box">
                🔔 <strong>Atenție!</strong> Aveți un mesaj nou care necesită răspuns.
            </div>

            <div class="field">
                <label>👤 Nume complet:</label>
                <div class="value">{{ $contact['first_name'] }} {{ $contact['last_name'] }}</div>
            </div>

            <div class="field">
                <label>📧 Email:</label>
                <div class="value">
                    <a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a>
                </div>
            </div>

            @if($contact['phone'])
            <div class="field">
                <label>📞 Telefon:</label>
                <div class="value">
                    <a href="tel:{{ $contact['phone'] }}">{{ $contact['phone'] }}</a>
                </div>
            </div>
            @endif

            <div class="field">
                <label>📋 Subiect:</label>
                <div class="value">{{ $contact['subject'] }}</div>
            </div>

            <div class="field">
                <label>💬 Mesaj:</label>
                <div class="message-box">{{ $contact['message'] }}</div>
            </div>
        </div>

        <div class="footer">
            <h4>Clubul de Ciobănești Belgieni</h4>
            <p>Acest email a fost generat automat prin formularul de contact.</p>
            <p><strong>💡 Tip:</strong> Răspundeți direct din admin panel pentru tracking automat!</p>
        </div>
    </div>
</body>
</html>
