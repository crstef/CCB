<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ImportUsersSeeder extends Seeder
{
    /**
     * Lista utilizatorilor de importat
     * Format raw: "Nume Prenume - parola"
     */
    protected $usersData = [
        'Dan Zloteanu - danzlot11',
        'Adrian Tigla - tiglaad12',
        'Gabriel Panoiu - pangab22',
        'Cosmin Pop Moldovan - cpmold66',
        'Flavius Bajan - flaviusbaj69',
        'Attila Toth - attilat66',
        'Adrian Mihalache - adimih101',
        'Alexandru Bondar - bondal235',
        'Alexandru Davidescu - davidal68',
        'Ana Parvu - anapar808',
        'Andrei Butuman - butuman902',
        'Antonia Pop Moldovan - apmold66',
        'Maria Berbecaru - berbemar11',
        'Ovidiu Berbecaru - berbeovi22',
        'Bogdan Ivanescu - bogivan300',
        'Ioana Calinoiu - calio899',
        'Mircea Calota - calomir456',
        'Florin Calusaru - florincal800',
        'Ionut Chirovan - chiroion800',
        'Ciprian Cordos - cipcordos800',
        'Ciprian Duca - cipduca802',
        'Ciprian Nechita - cipnec999',
        'Alexandru Costachescu - costalex33',
        'Cristina Trifu - cristrf525',
        'Sorin Dragomir - sorindrg156',
        'Gabriela Denisov - gabdsv1124',
        'Ioana Gaciu - ioagac901',
        'Marius Groza - margrz125',
        'Ionela Mos - ionem569',
        'Tudor Ionescu - tudion901',
        'Iulia Moldovan - iulmold404',
        'Ion Mot Tudor - ionmot234',
        'Oleksandr Kyurchev - sasha405',
        'Leonard Sumlea - leos3033',
        'Petru Manea - petmn2027',
        'Maria Rogoz - margoz69',
        'Maria Tudor - martdr100',
        'Razvan Mircea - razvmrc202',
        'Cristea Oprisan - crsopr900',
        'Dragos Pasculescu - drapasc600',
        'Mihai Pasculescu - mihpasc505',
        'Vasile Pravdencu - vasprvd7001',
        'Adela Predescu - adelaprd699',
        'Florin Predescu - flopred899',
        'Raluca Gutiu - ralgut401',
        'Raluca Marcu - ralmrc602',
        'Rares Rusu - rarrsu3999',
        'Robert Caraman - robcar999',
        'Roxana Bajan - roxbaj2006',
        'Roxana Zamfir - roxzmf895',
        'Rusu Georgiana - rsugrg400',
        'Silviu Nedelcu - silvned222',
        'Livia Stan - stanli999',
        'Stefan Ciobanu - stefc600',
        'Stefan Wrabeli Tarziu - stefwtz1011',
        'Traian Ciordas - traciord2090',
    ];

    /**
     * Adresa email a administratorului care nu trebuie șters
     */
    protected $adminEmail = 'stef.cristian3@gmail.com';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Încep procesul de import utilizatori...');

        // Șterge toți utilizatorii în afară de admin
        $this->deleteExistingUsers();

        // Procesează și creează noii utilizatori
        $this->processAndCreateUsers();

        $this->command->info('Importul utilizatorilor s-a finalizat cu succes!');
    }

    /**
     * Șterge toți utilizatorii în afară de admin
     */
    protected function deleteExistingUsers(): void
    {
        $deletedCount = User::where('email', '!=', $this->adminEmail)->delete();
        $this->command->info("Au fost șterși {$deletedCount} utilizatori.");
    }

    /**
     * Procesează datele raw și creează utilizatorii
     */
    protected function processAndCreateUsers(): void
    {
        foreach ($this->usersData as $userData) {
            $parsedUser = $this->parseUserData($userData);
            if ($parsedUser) {
                $this->createUser($parsedUser);
            }
        }
    }

    /**
     * Parsează un string în format "Nume Prenume - parola"
     */
    protected function parseUserData(string $userData): ?array
    {
        // Împarte datele pe " - " pentru a separa numele de parolă
        $parts = explode(' - ', trim($userData));
        
        if (count($parts) !== 2) {
            $this->command->error("Format invalid pentru: {$userData}");
            return null;
        }

        $namePart = trim($parts[0]);
        $password = trim($parts[1]);

        // Împarte numele în nume și prenume
        $nameParts = explode(' ', $namePart);
        
        if (count($nameParts) < 2) {
            $this->command->error("Nume invalid pentru: {$userData}");
            return null;
        }

        // Prima parte este numele, restul sunt prenumele
        $nume = $nameParts[0];
        $prenume = implode(' ', array_slice($nameParts, 1));

        return [
            'nume' => $nume,
            'prenume' => $prenume,
            'password' => $password,
            'full_name' => $namePart
        ];
    }

    /**
     * Generează username din nume și prenume
     */
    protected function generateUsername(string $nume, string $prenume): string
    {
        // Curăță caracterele speciale românești
        $nume = $this->cleanRomanianChars($nume);
        $prenume = $this->cleanRomanianChars($prenume);
        
        // Creează username de bază
        $baseUsername = strtolower($nume . '_' . str_replace(' ', '_', $prenume));
        
        // Verifică dacă username-ul există deja și adaugă număr dacă e necesar
        $username = $baseUsername;
        $counter = 1;
        
        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . '_' . $counter;
            $counter++;
        }
        
        return $username;
    }

    /**
     * Curăță caracterele speciale românești
     */
    protected function cleanRomanianChars(string $text): string
    {
        $search = ['ă', 'â', 'î', 'ș', 'ț', 'Ă', 'Â', 'Î', 'Ș', 'Ț'];
        $replace = ['a', 'a', 'i', 's', 't', 'a', 'a', 'i', 's', 't'];
        
        return str_replace($search, $replace, $text);
    }

    /**
     * Creează un utilizator nou
     */
    protected function createUser(array $userData): void
    {
        try {
            $username = $this->generateUsername($userData['nume'], $userData['prenume']);
            
            $user = User::create([
                'name' => $userData['full_name'],
                'username' => $username,
                'email' => $username . '@temp.ccb', // Email temporar
                'password' => Hash::make($userData['password']),
                'verified' => 1,
                'avatar' => 'demo/default.png',
            ]);

            // Atribuie rolul de bază (membru)
            $user->assignRole('basic');

            $this->command->info("Utilizator creat: {$userData['full_name']} (username: {$username})");
            
        } catch (\Exception $e) {
            $this->command->error("Eroare la crearea utilizatorului {$userData['full_name']}: " . $e->getMessage());
        }
    }
}