<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesaj nou de contact</title>
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
            background-color: #3B82F6;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 30px;
            border: 1px solid #e9ecef;
        }
        .footer {
            background-color: #6B7280;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 0 0 8px 8px;
            font-size: 14px;
        }
        .field {
            margin-bottom: 15px;
        }
        .field label {
            font-weight: bold;
            color: #4B5563;
            display: block;
            margin-bottom: 5px;
        }
        .field .value {
            background-color: white;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #D1D5DB;
        }
        .message-box {
            background-color: white;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #D1D5DB;
            min-height: 100px;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📧 Mesaj nou de contact</h1>
        <p>Primit prin formularul de contact de pe site</p>
    </div>

    <div class="content">
        <div class="field">
            <label>Nume complet:</label>
            <div class="value">{{ $contact['first_name'] }} {{ $contact['last_name'] }}</div>
        </div>

        <div class="field">
            <label>Email:</label>
            <div class="value">
                <a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a>
            </div>
        </div>

        @if($contact['phone'])
        <div class="field">
            <label>Telefon:</label>
            <div class="value">
                <a href="tel:{{ $contact['phone'] }}">{{ $contact['phone'] }}</a>
            </div>
        </div>
        @endif

        <div class="field">
            <label>Subiect:</label>
            <div class="value">{{ $contact['subject'] }}</div>
        </div>

        <div class="field">
            <label>Mesaj:</label>
            <div class="message-box">{{ $contact['message'] }}</div>
        </div>
    </div>

    <div class="footer">
        <p>Acest email a fost generat automat prin formularul de contact de pe {{ config('app.name') }}.</p>
        <p>Pentru a răspunde, folosiți butonul "Reply" din clientul dumneavoastră de email.</p>
    </div>
</body>
</html>
