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
    <x-marketing.sections.contact />
</x-layouts.marketing>
