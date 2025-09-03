# Analiza Utilizatori - Site Vechi Wave 2.0

## 🔍 **Scopul Analizei**

Înainte de import, trebuie să înțelegem:
1. **Ce roluri** există pe site-ul vechi
2. **Câți utilizatori** are fiecare rol  
3. **Probleme potențiale** (duplicate, roluri multiple)
4. **Structura permissions** (pentru referință)

## 📊 **Pașii de Analiză**

### **1. Rulează Query-urile de Analiză**

Deschide **phpMyAdmin** sau **cPanel Database** și rulează query-urile din `users_analysis.sql`:

#### **A. Analiza Rolurilor:**
```sql
-- Vedere roluri
SELECT id, name, display_name FROM roles ORDER BY id;

-- Statistici utilizatori pe roluri  
SELECT r.name, COUNT(ur.user_id) as users_count
FROM roles r LEFT JOIN user_roles ur ON r.id = ur.role_id
GROUP BY r.id ORDER BY users_count DESC;
```

#### **B. Analiza Utilizatorilor:**
```sql
-- Utilizatori cu rolurile lor (primii 20)
SELECT u.name, u.email, r.name as role_name
FROM users u
LEFT JOIN user_roles ur ON u.id = ur.user_id  
LEFT JOIN roles r ON ur.role_id = r.id
ORDER BY u.created_at DESC LIMIT 20;
```

#### **C. Verificări Probleme:**
```sql
-- Utilizatori fără roluri
SELECT u.name, u.email FROM users u
LEFT JOIN user_roles ur ON u.id = ur.user_id
WHERE ur.user_id IS NULL;

-- Utilizatori cu multiple roluri  
SELECT u.name, COUNT(ur.role_id) as roles_count
FROM users u JOIN user_roles ur ON u.id = ur.user_id
GROUP BY u.id HAVING roles_count > 1;

-- Email-uri duplicate
SELECT email, COUNT(*) FROM users 
GROUP BY email HAVING COUNT(*) > 1;
```

## 📋 **Template Analiza Rezultate**

### **1. Roluri Găsite:**
```
| ID | Nume | Display Name | Utilizatori |
|----|------|--------------|-------------|
| 1  | admin | Administrator | 2 |
| 2  | user  | User         | 45 |  
| 3  | moderator | Moderator | 3 |
```

### **2. Probleme Identificate:**
```
❌ Utilizatori fără roluri: 2
❌ Utilizatori cu multiple roluri: 1  
❌ Email-uri duplicate: 0
✅ Integritate OK: Da/Nu
```

### **3. Maparea Propusă:**
```
Site Vechi → Site Nou (Wave 3.0)
admin → admin (ID: 1)
moderator → registered (ID: 2)  
user → registered (ID: 2)
```

## 🎯 **Scenarii Comune**

### **Scenariu 1: Site Standard**
```
Roluri: admin, user
Probleme: Minime
Acțiune: Import direct
```

### **Scenariu 2: Site Complex**  
```
Roluri: admin, moderator, editor, user, guest
Probleme: Multiple roluri per utilizator
Acțiune: Cleanup înainte de import
```

### **Scenariu 3: Site Problematic**
```
Roluri: Multe roluri custom
Probleme: Utilizatori fără roluri, duplicate  
Acțiune: Curățenie manuală necesară
```

## 🛠️ **Rezolvarea Problemelor**

### **1. Utilizatori fără roluri:**
```sql
-- Asignează rol default
INSERT INTO user_roles (user_id, role_id) 
SELECT id, 2 FROM users u
LEFT JOIN user_roles ur ON u.id = ur.user_id
WHERE ur.user_id IS NULL;
```

### **2. Multiple roluri per utilizator:**
```sql
-- Păstrează doar primul rol (cel mai important)
DELETE ur1 FROM user_roles ur1
INNER JOIN user_roles ur2 
WHERE ur1.user_id = ur2.user_id AND ur1.role_id > ur2.role_id;
```

### **3. Email-uri duplicate:**
```sql
-- Adaugă suffix la duplicate
UPDATE users SET email = CONCAT(email, '.dup', id) 
WHERE id IN (
    SELECT id FROM (
        SELECT id FROM users WHERE email IN (
            SELECT email FROM users GROUP BY email HAVING COUNT(*) > 1
        ) AND id NOT IN (
            SELECT MIN(id) FROM users GROUP BY email HAVING COUNT(*) > 1
        )
    ) AS temp
);
```

## 📁 **Export Final**

### **După cleanup, exportă în această ordine:**

#### **1. Export Roles:**
```sql
SELECT * FROM roles ORDER BY id;
-- Salvează ca roles_data.sql
```

#### **2. Export Users:**  
```sql
SELECT * FROM users ORDER BY id;
-- Salvează ca users_data.sql
```

#### **3. Export User_Roles:**
```sql
SELECT * FROM user_roles ORDER BY user_id;
-- Salvează ca user_roles_data.sql
```

#### **4. Combină în users_export.sql:**
```sql
-- Format final pentru import:
INSERT INTO `roles` VALUES 
(1,'admin','Administrator','2023-01-01','2023-01-01'),
(2,'user','User','2023-01-01','2023-01-01');

INSERT INTO `users` VALUES 
(1,'John Admin','admin@site.com','2023-01-01','$2y$10$hash',NULL,'2023-01-01','2023-01-01',NULL,NULL),
(2,'Jane User','user@site.com',NULL,'$2y$10$hash',NULL,'2023-01-01','2023-01-01','avatar.jpg',NULL);

INSERT INTO `user_roles` VALUES 
(1,1),
(2,2);
```

## ✅ **Checklist Înainte de Import**

- [ ] Am rulat toate query-urile de analiză
- [ ] Am identificat toate rolurile  
- [ ] Am verificat problemele (duplicate, fără roluri)
- [ ] Am făcut cleanup dacă a fost necesar
- [ ] Am exportat datele în formatul corect
- [ ] Am combinat într-un fișier `users_export.sql`
- [ ] Am testat query-urile pe o copie a bazei de date

## 🚨 **Red Flags**

### **Atenție la:**
- **Parole goale** sau NULL
- **Email-uri invalide** (@example.com, etc.)  
- **Roluri custom** care nu se mapează
- **Utilizatori cu over 1000 de permisiuni**
- **Conturi test** care nu trebuie importate

### **Excluziuni Recomandate:**
```sql
-- Excluziuni în export:
WHERE email NOT LIKE '%@example.com'
AND email NOT LIKE '%test%'  
AND name NOT LIKE '%test%'
AND created_at < NOW() -- exclude accounts created today (tests)
```

## 📊 **Raportul Final**

### **Template pentru rezultate:**
```
=== ANALIZA SITE VECHI ===
Roluri găsite: X
Utilizatori totali: Y  
Utilizatori verificați: Z
Probleme identificate: W

=== MAPAREA ROLURILOR ===
admin (X users) → admin
user (Y users) → registered  
moderator (Z users) → registered

=== ACȚIUNI NECESARE ===
□ Cleanup utilizatori fără roluri
□ Rezolvare email-uri duplicate  
□ Testare mapare roluri
□ Export final

=== READY FOR IMPORT ===
✅ users_export.sql pregătit
✅ Probleme rezolvate  
✅ Mapare confirmată
```

**După completarea analizei, poți proceda cu importul în siguranță! 🎯**
