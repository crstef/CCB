# Sistem de Management Documente

## Prezentare Generală

Sistemul de management al documentelor oferă o interfață administrativă completă pentru gestionarea documentelor organizaționale prin intermediul Filament Admin Panel.

## Funcționalități

### 📄 Gestionarea Documentelor
- **Titlu și Descriere**: Fiecare document are un titlu obligatoriu și o descriere opțională
- **Categorii Dinamice**: 
  - Categoriile sunt complet administrabile din interfața admin
  - Poți crea, edita și șterge categorii
  - Fiecare categorie are nume, descriere, culoare și ordine de sortare
  - Doar categoriile active pot fi selectate la documente
  - **Categorii predefinite incluse**:
    - General, Contracte, Facturi, Rapoarte
    - Prezentări, Regulamente, Proceduri, Alte Documente

### 📎 Gestionarea Fișierelor
- **Număr controlat de fișiere**: Poți specifica numărul maxim de fișiere care pot fi atașate (1-10)
- **Tipuri de fișiere acceptate**: Doar PDF și Word (.doc, .docx)
- **Upload securizat**: Fișierele sunt stocate în directorul `storage/app/public/documents`
- **Metadata completă**: Se stochează numele, dimensiunea, tipul și data încărcării pentru fiecare fișier

### � Gestionarea Categoriilor
- **Administrare completă**: Creează, editează și șterge categorii din admin
- **Culori personalizate**: Fiecare categorie poate avea o culoare specifică pentru badge-uri
- **Sortare controlată**: Ordinea categoriilor în dropdown-uri
- **Protecție la ștergere**: Nu poți șterge o categorie care are documente asociate
- **Status activ/inactiv**: Doar categoriile active apar în selectori

### �🔍 Funcționalități de Administrare
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
- document_category_id (foreign key to document_categories)
- max_files (integer, default: 1, range: 1-10)
- files (json, stores file metadata)
- is_active (boolean, default: true)
- timestamps
```

### Model (`App\Models\DocumentCategory`)
```php
- id (primary key)
- name (string, unique, required)
- slug (string, unique, auto-generated)
- description (text, nullable)
- color (string, hex color for badges)
- sort_order (integer, for ordering)
- is_active (boolean, default: true)
- timestamps
```

### Resursa Filament (`App\Filament\Resources\DocumentResource` & `DocumentCategoryResource`)
- **Form complet** cu validare pentru toate câmpurile
- **Tabel interactiv** cu filtrare și căutare
- **Pagini dedicate** pentru Create, Edit, View, List
- **Încărcare controlată de fișiere** cu respectarea limitelor stabilite
- **Gestionare categorii** cu culori, sortare și protecție la ștergere

### Factory și Seeder
- **DocumentFactory & DocumentCategoryFactory**: Generează date de test realiste
- **DocumentSeeder & DocumentCategorySeeder**: Populează baza de date cu categorii și documente

## Cum să Folosești Sistemul

### 1. Accesarea Interfața Admin
- Navighează la `/admin` 
- Secțiunea "Management Conținut" → "Categorii Documente" (pentru categorii)
- Secțiunea "Management Conținut" → "Documente" (pentru documente)

### 2. Gestionarea Categoriilor
1. Accesează "Categorii Documente"
2. Click pe "Adaugă Categorie"
3. Completează numele (obligatoriu)
4. Adaugă o descriere (opțional)
5. Alege o culoare pentru badge (hex color)
6. Setează ordinea de sortare
7. Marchează ca activ/inactiv
8. Salvează categoria

### 3. Crearea unui Document Nou
1. Click pe "Adaugă Document"
2. Completează titlul (obligatoriu)
3. Adaugă o descriere (opțional)
4. Selectează categoria (din dropdown cu categoriile active) sau creează una nouă
5. Specifică numărul maxim de fișiere (1-10)
6. Marchează ca activ/inactiv
7. Încarcă fișierele (PDF/Word doar)
8. Salvează documentul

### 4. Gestionarea Documentelor Existente
- **Vizualizare**: Click pe iconița de ochi pentru detalii complete
- **Editare**: Modifică informațiile și fișierele
- **Ștergere**: Șterge documentele individuale sau în bulk

### 5. Filtrarea și Căutarea
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
