# Import Documente din Site-ul Vechi (Wave 2.0 → Wave 3.0)

## Descriere
Command Artisan pentru importul documentelor din site-ul vechi Wave 2.0 cu Voyager în noul site Wave 3.0 cu Filament.

## Pregătire

### 1. Export din site-ul vechi
```sql
-- Pe site-ul vechi, exportează tabelul documents
SELECT * FROM documents;
```

### 2. Upload export-ul pe server nou
- Plasează fișierul `documents_export.sql` în root-ul proiectului Laravel
- Asigură-te că fișierul conține INSERT statements complete

## Rulare pe Server

### 1. Test (Dry Run)
```bash
# Vezi ce ar fi importat fără a face modificări
php artisan documents:import --dry-run
```

### 2. Import Real
```bash
# Rulează importul efectiv
php artisan documents:import
```

## Ce face command-ul:

### 1. **Parsează fișierul SQL**
- Extrage datele din INSERT statements
- Parsează structura complexă JSON a fișierelor

### 2. **Creează categoriile automat**
- Mapează `type` din site vechi → `DocumentCategory` în site nou
- Creează categorii noi pentru tipurile găsite:
  - decizie → roșu
  - hotarare → verde  
  - regulament → albastru
  - statut → mov
  - convocator → portocaliu
  - procedura → cyan
  - etc.

### 3. **Importă documentele**
- Verifică dacă documentul există deja (după titlu)
- Convertește structura fișierelor din format vechi în format nou
- Păstrează datele originale (created_at, updated_at)

### 4. **Gestionează fișierele**
- Convertește căile: `documents\May2023\file.pdf` → `public/documents/May2023/file.pdf`
- Păstrează numele originale ale fișierelor
- Suportă multiple fișiere per document (file + file1)

## Structura Mapping

### Site Vechi (Wave 2.0)
```sql
CREATE TABLE documents (
  id bigint,
  title varchar(191),
  type varchar(191),           -- devine DocumentCategory
  file varchar(255),           -- JSON cu fișiere
  file1 varchar(255),          -- JSON cu fișiere suplimentare
  created_at timestamp,
  updated_at timestamp
);
```

### Site Nou (Wave 3.0)
```sql
CREATE TABLE documents (
  id bigint,
  title varchar(255),
  description text,            -- NULL (nu există în vechi)
  document_category_id bigint, -- din type
  max_files integer,           -- calculat din numărul de fișiere
  files json,                  -- combinat din file + file1
  is_active boolean,           -- TRUE
  created_at timestamp,
  updated_at timestamp
);
```

## Verificare Post-Import

### 1. Verifică categoriile create
```sql
SELECT * FROM document_categories ORDER BY name;
```

### 2. Verifică documentele importate
```sql
SELECT d.title, dc.name as category, d.created_at 
FROM documents d 
JOIN document_categories dc ON d.document_category_id = dc.id 
ORDER BY d.created_at DESC;
```

### 3. Verifică fișierele
```sql
SELECT title, JSON_LENGTH(files) as file_count 
FROM documents 
WHERE files IS NOT NULL;
```

## Note Importante

### Pentru Fișiere
- **Fișierele fizice trebuie copiate manual** din storage/app/public al site-ului vechi în storage/app/public al site-ului nou
- Command-ul doar convertește căile, nu copiază fișierele
- Verifică că path-urile din JSON să corespundă cu locația reală a fișierelor

### Pentru Categorii
- Categoriile se creează automat pe baza câmpului `type`
- Poți modifica culorile și ordinea din admin panel după import
- Categoria "Diverse" se creează pentru documente fără tip

### Backup
- **OBLIGATORIU**: Fă backup la baza de date înainte de import
- Command-ul nu șterge date existente, doar adaugă

## Comanda Completă pentru Server

```bash
# 1. Navigare în directorul proiectului
cd /path/to/ccb-project

# 2. Test import
php artisan documents:import --dry-run

# 3. Import real (doar dacă dry-run este OK)
php artisan documents:import

# 4. Verificare rapida
php artisan tinker
>>> App\Models\Document::count()
>>> App\Models\DocumentCategory::count()
```

## Troubleshooting

### Erori comune:
1. **SQL parse error**: Verifică că fișierul SQL este complet și valid
2. **Category creation failed**: Verifică permisiunile bazei de date
3. **File path issues**: Ajustează path-urile în parseFileJson() dacă e necesar

### Logs:
Command-ul afișează progresul în timp real:
- ✓ pentru documente importate cu succes
- - pentru documente omise (există deja sau fără fișiere)  
- ✗ pentru erori cu detalii

## Finalizare
După import, verifică în admin panel Filament:
- Categoriile de documente
- Documentele importate
- Funcționalitatea de preview în carousel și index
