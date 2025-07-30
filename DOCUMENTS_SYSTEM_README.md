# Sistem de Management Documente

## Prezentare Generală

Sistemul de management al documentelor oferă o interfață administrativă completă pentru gestionarea documentelor organizaționale prin intermediul Filament Admin Panel.

## Funcționalități

### 📄 Gestionarea Documentelor
- **Titlu și Descriere**: Fiecare document are un titlu obligatoriu și o descriere opțională
- **Categorii Predefinite**: 
  - General
  - Contracte
  - Facturi
  - Rapoarte
  - Prezentări
  - Regulamente
  - Proceduri
  - Alte Documente

### 📎 Gestionarea Fișierelor
- **Număr controlat de fișiere**: Poți specifica numărul maxim de fișiere care pot fi atașate (1-10)
- **Tipuri de fișiere acceptate**: Doar PDF și Word (.doc, .docx)
- **Upload securizat**: Fișierele sunt stocate în directorul `storage/app/public/documents`
- **Metadata completă**: Se stochează numele, dimensiunea, tipul și data încărcării pentru fiecare fișier

### 🔍 Funcționalități de Administrare
- **Vizualizare completă**: Tabel cu toate documentele cu informații relevante
- **Filtrare avansată**: După categorie și status (activ/inactiv)
- **Căutare**: În titlul documentelor
- **Sortare**: După data creării, categorie, status
- **Operații bulk**: Ștergere multiplă

### 📊 Dashboard și Monitoring
- **Status fișiere**: Indicator vizual pentru documentele care au atins numărul maxim de fișiere
- **Informații detaliate**: Vizualizare completă a metadatelor pentru fiecare document
- **Preview-uri**: Posibilitatea de a vedea informațiile despre fișiere înainte de download

## Structura Tehnică

### Model (`App\Models\Document`)
```php
- id (primary key)
- title (string, required)
- description (text, nullable)
- category (string, default: 'General')
- max_files (integer, default: 1, range: 1-10)
- files (json, stores file metadata)
- is_active (boolean, default: true)
- timestamps
```

### Resursa Filament (`App\Filament\Resources\DocumentResource`)
- **Form complet** cu validare pentru toate câmpurile
- **Tabel interactiv** cu filtrare și căutare
- **Pagini dedicate** pentru Create, Edit, View, List
- **Încărcare controlată de fișiere** cu respectarea limitelor stabilite

### Factory și Seeder
- **DocumentFactory**: Generează documente de test cu date realistice
- **DocumentSeeder**: Populează baza de date cu exemple pentru fiecare categorie

## Cum să Folosești Sistemul

### 1. Accesarea Interfața Admin
- Navighează la `/admin` 
- Secțiunea "Management Conținut" → "Documente"

### 2. Crearea unui Document Nou
1. Click pe "Adaugă Document"
2. Completează titlul (obligatoriu)
3. Adaugă o descriere (opțional)
4. Selectează categoria
5. Specifică numărul maxim de fișiere (1-10)
6. Marchează ca activ/inactiv
7. Încarcă fișierele (PDF/Word doar)
8. Salvează documentul

### 3. Gestionarea Documentelor Existente
- **Vizualizare**: Click pe iconița de ochi pentru detalii complete
- **Editare**: Modifică informațiile și fișierele
- **Ștergere**: Șterge documentele individuale sau în bulk

### 4. Filtrarea și Căutarea
- Folosește filtrele pentru categorie și status
- Caută după titlu în bara de căutare
- Sortează după coloanele disponibile

## Siguranță și Validare

### Upload Fișiere
- ✅ Doar PDF și Word (.doc, .docx)
- ✅ Respectă limita de fișiere stabilită
- ✅ Validare pe client și server
- ✅ Stocare securizată cu paths randomizate

### Validare Date
- ✅ Titlu obligatoriu (max 255 caractere)
- ✅ Categorie din lista predefinită
- ✅ Număr max fișiere între 1-10
- ✅ Status boolean valid

## Integrare cu Sistemul Existent

Sistemul se integrează perfect cu:
- **Wave Framework**: Folosește aceleași convenții și structuri
- **Filament Admin**: Interface administrativă consistentă
- **Laravel Storage**: Gestionare securizată a fișierelor
- **Spatie Permissions**: Compatibil cu sistemul de permisiuni (dacă este implementat)

## Extensibilitate

Sistemul poate fi ușor extins cu:
- **Permisiuni granulare**: Control bazat pe roluri
- **Categorii dinamice**: Adăugare categorii din interfață
- **Tipuri de fișiere**: Extinderea tipurilor acceptate
- **Workflow-uri**: Sisteme de aprobare pentru documente
- **Versioning**: Istoric al modificărilor documentelor
- **Full-text search**: Căutare în conținutul documentelor

---

**Nota**: Sistemul este gata de utilizare și respectă toate practicile de securitate și usabilitate ale Wave Framework.
