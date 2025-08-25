<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - CCB</title>
    <meta name="description" content="Contactează-ne pentru orice întrebări sau asistență. Suntem aici să te ajutăm!">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <section class="w-full py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <!-- Left Side - Contact Information -->
                <div class="space-y-8">
                    <div>
                        <h2 class="text-3xl font-bold text-blue-700 mb-4">Intră în legătură cu noi</h2>
                        <p class="text-gray-600 text-lg leading-relaxed">
                            Ai întrebări despre serviciile noastre sau ai nevoie de asistență? Suntem aici să te ajutăm! 
                            Contactează-ne prin oricare dintre canalele de mai jos.
                        </p>
                    </div>

                    <!-- Phone Contact -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Sună-ne</h3>
                            <p class="text-gray-600 mb-2">
                                Sună-ne la <a href="tel:0723644822" class="text-blue-600 font-semibold hover:text-blue-800">0723 644 822</a>. 
                                Toate zilele de luni până vineri de la 9:00 la 17:00.
                            </p>
                        </div>
                    </div>

                    <!-- Email Contact -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Trimite-ne un email</h3>
                            <p class="text-gray-600 mb-2">
                                Trimite-ne un email la <a href="mailto:office@ccbor.ro" class="text-blue-600 font-semibold hover:text-blue-800">office@ccbor.ro</a> 
                                și vei primi un răspuns în maxim 24 de ore.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Contact Form -->
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-blue-700 mb-6">Trimite-ne un mesaj</h3>
                    <p class="text-gray-600 mb-6">
                        Completează formularul de mai jos și îți vom răspunde cât mai curând posibil.
                    </p>

                    <form id="contactForm" class="space-y-6" action="/contact" method="POST">
                        @csrf
                        
                        <!-- First and Last Name -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">Prenume <span class="text-red-500">*</span></label>
                                <input type="text" 
                                       id="first_name" 
                                       name="first_name" 
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Introduceți prenumele">
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Nume <span class="text-red-500">*</span></label>
                                <input type="text" 
                                       id="last_name" 
                                       name="last_name" 
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Introduceți numele">
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresa de email <span class="text-red-500">*</span></label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="your@email.com">
                        </div>

                        <!-- Phone (optional) -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Numărul de telefon <span class="text-gray-400">(opțional)</span></label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="+40 123 456 789">
                        </div>

                        <!-- Subject -->
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subiect <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   id="subject" 
                                   name="subject" 
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Despre ce este mesajul?">
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Mesaj <span class="text-red-500">*</span></label>
                            <textarea id="message" 
                                      name="message" 
                                      rows="5" 
                                      required
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Scrieți mesajul dumneavoastră aici..."></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" 
                                    id="submitBtn"
                                    class="w-full bg-blue-600 text-white py-3 px-4 rounded-md font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                                Trimite mesajul
                            </button>
                        </div>
                    </form>

                    <!-- Success/Error Messages -->
                    <div id="formMessages" class="mt-4 hidden">
                        <div id="successMessage" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            Mesajul a fost trimis cu succes! Vă vom contacta în curând.
                        </div>
                        <div id="errorMessage" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            A apărut o eroare la trimiterea mesajului. Vă rugăm să încercați din nou.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');
        const submitBtn = document.getElementById('submitBtn');
        const formMessages = document.getElementById('formMessages');
        const successMessage = document.getElementById('successMessage');
        const errorMessage = document.getElementById('errorMessage');

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Disable submit button and show loading state
            submitBtn.disabled = true;
            submitBtn.textContent = 'Se trimite...';

            // Hide previous messages
            formMessages.classList.add('hidden');
            successMessage.classList.add('hidden');
            errorMessage.classList.add('hidden');

            // Collect form data
            const formData = new FormData(form);
            
            try {
                const response = await fetch('/contact', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Show success message
                    successMessage.classList.remove('hidden');
                    formMessages.classList.remove('hidden');
                    
                    // Reset form
                    form.reset();
                } else {
                    // Show error message
                    errorMessage.textContent = data.message || 'A apărut o eroare la trimiterea mesajului.';
                    errorMessage.classList.remove('hidden');
                    formMessages.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Error:', error);
                errorMessage.textContent = 'A apărut o eroare de conexiune. Vă rugăm să încercați din nou.';
                errorMessage.classList.remove('hidden');
                formMessages.classList.remove('hidden');
            } finally {
                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtn.textContent = 'Trimite mesajul';
            }
        });
    });
    </script>
</body>
</html>
