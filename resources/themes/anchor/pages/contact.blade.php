<?php
    use function Laravel\Folio\{name};
    name('contact');
?>

<x-layouts.marketing
    :seo="[
        'title'         => 'Contact - CCB',
        'description'   => 'Contactează-ne pentru orice întrebări sau asistență. Suntem aici să te ajutăm!',
        'image'         => url('/og_image.png'),
        'type'          => 'website'
    ]"
>
    <div style="background: red; color: white; padding: 50px; text-align: center;">
        <h1 style="font-size: 48px;">🔴 PAGINA DE CONTACT ANCHOR TEMA 🔴</h1>
        <p style="font-size: 24px;">Dacă vezi asta, pagina anchor funcționează!</p>
        <p style="font-size: 18px;">Data: {{ date('Y-m-d H:i:s') }}</p>
    </div>
    <x-marketing.sections.contact />
</x-layouts.marketing>
