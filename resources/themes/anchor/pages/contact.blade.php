<?php
    use function Laravel\Folio\{name};
    name('contact');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Test</title>
    <style>
        body { 
            background: linear-gradient(45deg, red, blue); 
            color: white; 
            font-family: Arial; 
            text-align: center; 
            padding: 50px; 
        }
        .test-box { 
            background: yellow; 
            color: black; 
            padding: 30px; 
            margin: 20px; 
            border: 5px solid green;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <h1 style="font-size: 60px; color: yellow;">🚨 CONTACT PAGE TEST 🚨</h1>
    <div class="test-box">
        <p>Dacă vezi această pagină, Folio funcționează!</p>
        <p>Fișier: resources/themes/anchor/pages/contact.blade.php</p>
        <p>Data modificării: {{ now()->format('Y-m-d H:i:s') }}</p>
        <p>Cache Cleared: {{ rand(1000, 9999) }}</p>
    </div>
    
    <div style="background: white; color: black; padding: 20px; margin: 20px;">
        <h2>FORMULAR DE CONTACT SIMPLU</h2>
        <form action="/contact" method="POST" style="text-align: left; max-width: 500px; margin: 0 auto;">
            @csrf
            <p><label>Prenume: <input type="text" name="first_name" required style="width: 100%; padding: 10px;"></label></p>
            <p><label>Nume: <input type="text" name="last_name" required style="width: 100%; padding: 10px;"></label></p>
            <p><label>Email: <input type="email" name="email" required style="width: 100%; padding: 10px;"></label></p>
            <p><label>Telefon: <input type="tel" name="phone" style="width: 100%; padding: 10px;"></label></p>
            <p><label>Subiect: <input type="text" name="subject" required style="width: 100%; padding: 10px;"></label></p>
            <p><label>Mesaj: <textarea name="message" required style="width: 100%; padding: 10px; height: 100px;"></textarea></label></p>
            <p><button type="submit" style="background: red; color: white; padding: 15px 30px; font-size: 18px; border: none;">TRIMITE MESAJUL</button></p>
        </form>
    </div>
    
    <div style="background: black; color: yellow; padding: 20px; margin: 20px;">
        <h3>INFORMAȚII DE CONTACT</h3>
        <p>📞 Telefon: <a href="tel:0723644822" style="color: yellow;">0723 644 822</a></p>
        <p>✉️ Email: <a href="mailto:office@ccbor.ro" style="color: yellow;">office@ccbor.ro</a></p>
    </div>
</body>
</html>
