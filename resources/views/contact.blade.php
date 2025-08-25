<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - CCB</title>
    <meta name="description" content="Contactează-ne pentru orice întrebări sau asistență. Suntem aici să te ajutăm!">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('theme::partials.header')
    
    <main>
        <x-marketing.sections.contact />
    </main>
    
    @include('theme::partials.footer')
</body>
</html>
