# Import Utilizatori - Wave 2.0 → Wave 3.0

## 📊 **Structura Tabelelor**

### **Site VECHI (Wave 2.0 + Voyager):**
```sql
-- Exportează aceste tabele din phpMyAdmin/cPanel:
users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, avatar, settings)
roles (id, name, display_name, created_at, updated_at)  
user_roles (user_id, role_id)
permissions (id, key, table_name, created_at, updated_at)
permission_groups (id, name)
permission_roles (permission_id, role_id)
```

### **Site NOU (Wave 3.0):**
```sql
-- Structura simplificată:
users (id, name, email, username, role_id, password, email_verified_at, avatar, created_at, updated_at)
roles (id, name, guard_name, created_at, updated_at)
-- Fără permissions (mai simplu)
```

## 🎯 **Maparea Rolurilor**

| Site Vechi | Site Nou | Descriere |
|------------|----------|-----------|
| `admin` | `admin` (ID: 1) | Administrator complet |
| `moderator` | `registered` (ID: 2) | Utilizator înregistrat |
| `editor` | `registered` (ID: 2) | Utilizator înregistrat |
| `user` | `registered` (ID: 2) | Utilizator standard |

## 📁 **Pași pentru Export SQL**

### **1. Pe site-ul vechi (cPanel/phpMyAdmin):**

#### **Varianta A - Export Manual (Recomandat):**
```sql
-- Exportă fiecare tabelă separat:
SELECT * FROM users;
SELECT * FROM roles; 
SELECT * FROM user_roles;
```

#### **Varianta B - Export phpMyAdmin:**
1. Selectează bazele de date
2. Alege tabelele: `users`, `roles`, `user_roles`
3. Export → SQL → Include structure and data
4. Salvează ca `users_export.sql`

### **2. Format SQL așteptat:**
```sql
INSERT INTO `roles` VALUES 
(1,'admin','Administrator','2023-01-01 00:00:00','2023-01-01 00:00:00'),
(2,'user','User','2023-01-01 00:00:00','2023-01-01 00:00:00');

INSERT INTO `users` VALUES 
(1,'John Doe','john@example.com','2023-01-01 00:00:00','$2y$10$hash','token','2023-01-01 00:00:00','2023-01-01 00:00:00','avatar.jpg',NULL),
(2,'Jane Smith','jane@example.com',NULL,'$2y$10$hash',NULL,'2023-01-01 00:00:00','2023-01-01 00:00:00',NULL,NULL);

INSERT INTO `user_roles` VALUES 
(1,1),
(2,2);
```

## 🚀 **Rularea Importului**

### **1. Copiază fișierul SQL:**
```bash
# Uploadează users_export.sql în root-ul proiectului
/path/to/ccb-project/users_export.sql
```

### **2. Test dry-run:**
```bash
cd /path/to/ccb-project
php artisan users:import --dry-run
```

### **3. Import real:**
```bash
php artisan users:import
```

### **4. Cu fișier custom:**
```bash
php artisan users:import my_users_export.sql --dry-run
```

## 📋 **Output Așteptat**

```
Starting import of users from old site...

Parsing SQL export file...
Found:
- 3 roles
- 25 users  
- 25 user-role assignments

Creating role mapping...
  → admin (ID: 1) → admin (ID: 1)
  → user (ID: 2) → registered (ID: 2)
  → moderator (ID: 3) → registered (ID: 2)

Importing users...
  ✓ Imported: John Doe (john@example.com) as admin
  ✓ Imported: Jane Smith (jane@example.com) as registered
  - Skipped: existing@example.com (already exists)

+----------+-------+
| Status   | Count |
+----------+-------+
| Imported | 23    |
| Skipped  | 2     |
| Errors   | 0     |
| Total    | 25    |
+----------+-------+

Import completed!
```

## ⚠️ **Considerații Importante**

### **1. Passwords:**
- Păstrează hash-urile originale din Wave 2.0
- Utilizatorii vor putea să se logheze cu aceleași parole

### **2. Email unique:**
- Saltă utilizatorii cu email-uri duplicate
- Afișează lista utilizatorilor săriti

### **3. Username generation:**
- Generează automat username din name
- Adaugă numere pentru unicitate (ex: `johnsmith`, `johnsmith1`)

### **4. Role mapping:**
- Admin → admin (acces complet)  
- Toate celelalte → registered (acces standard)
- Poți modifica manual rolurile după import

### **5. Avatar și Settings:**
- Păstrează avatar-urile existente
- Ignoră settings (Wave 3.0 e diferit)

## 🔧 **Troubleshooting**

### **Eroare: File not found**
```bash
# Verifică că fișierul există:
ls -la users_export.sql

# Sau specifică path complet:
php artisan users:import /full/path/to/users_export.sql
```

### **Eroare: SQL parsing**
```bash
# Verifică formatul SQL - trebuie să conțină:
grep "INSERT INTO.*users" users_export.sql
grep "INSERT INTO.*roles" users_export.sql  
grep "INSERT INTO.*user_roles" users_export.sql
```

### **Verificare după import:**
```bash
# Numărul utilizatorilor
php artisan tinker --execute="echo 'Users count: ' . \App\Models\User::count();"

# Utilizatori pe roluri  
php artisan tinker --execute="
\App\Models\User::join('roles', 'users.role_id', '=', 'roles.id')
->selectRaw('roles.name, count(*) as count')
->groupBy('roles.name')
->get()
->each(function(\$r) { echo \$r->name . ': ' . \$r->count . PHP_EOL; });
"
```

## 📈 **Post-Import**

### **1. Verifică admin panel:**
- Login cu contul admin importat
- Verifică lista utilizatorilor în `/admin`
- Testează funcționalitățile

### **2. Test login:**
- Încearcă login cu utilizatori importați
- Verifică că parolele funcționează
- Testează rolurile și permisiunile

### **3. Cleanup (opțional):**
```bash
# Șterge fișierul SQL după import
rm users_export.sql
```

## 🎯 **Rezultat Final**

După import vei avea:
- ✅ Toți utilizatorii din site-ul vechi
- ✅ Rolurile mapate la Wave 3.0
- ✅ Parolele funcționale  
- ✅ Avatar-urile păstrate
- ✅ Username-uri generate automat
- ✅ Datele de creare păstrate
