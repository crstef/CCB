-- ==========================================
-- EXPORT COMPLET - 6 TABELE PENTRU IMPORT
-- Wave 2.0 → Wave 3.0 Users Migration
-- ==========================================

-- Rulează aceste query-uri în phpMyAdmin/cPanel pentru export complet
-- Copiază rezultatele în users_export.sql în ordinea de mai jos

-- ==========================================
-- 1. EXPORT ROLES
-- ==========================================
-- Copiază și rulează:

SELECT 
    CONCAT(
        '(',
        id, ',\'', 
        REPLACE(name, '\'', '\\\''), '\',\'',
        REPLACE(IFNULL(display_name, ''), '\'', '\\\''), '\',\'',
        IFNULL(created_at, 'NULL'), '\',\'',
        IFNULL(updated_at, 'NULL'), '\')'
    ) as export_data
FROM roles
ORDER BY id;

-- SAU mai simplu:
SELECT * FROM roles ORDER BY id;

-- ==========================================
-- 2. EXPORT USERS
-- ==========================================
-- Copiază și rulează:

SELECT 
    CONCAT(
        '(',
        id, ',\'', 
        REPLACE(name, '\'', '\\\''), '\',\'',
        REPLACE(email, '\'', '\\\''), '\',',
        CASE 
            WHEN email_verified_at IS NULL THEN 'NULL' 
            ELSE CONCAT('\'', email_verified_at, '\'') 
        END, ',\'',
        password, '\',',
        CASE 
            WHEN remember_token IS NULL THEN 'NULL' 
            ELSE CONCAT('\'', REPLACE(remember_token, '\'', '\\\''), '\'') 
        END, ',',
        CASE 
            WHEN created_at IS NULL THEN 'NULL' 
            ELSE CONCAT('\'', created_at, '\'') 
        END, ',',
        CASE 
            WHEN updated_at IS NULL THEN 'NULL' 
            ELSE CONCAT('\'', updated_at, '\'') 
        END, ',',
        CASE 
            WHEN avatar IS NULL THEN 'NULL' 
            ELSE CONCAT('\'', REPLACE(avatar, '\'', '\\\''), '\'') 
        END, ',',
        CASE 
            WHEN settings IS NULL THEN 'NULL' 
            ELSE CONCAT('\'', REPLACE(REPLACE(settings, '\'', '\\\''), '\\', '\\\\'), '\'') 
        END,
        ')'
    ) as export_data
FROM users
ORDER BY id;

-- SAU mai simplu:
SELECT * FROM users ORDER BY id;

-- ==========================================
-- 3. EXPORT USER_ROLES
-- ==========================================
-- Copiază și rulează:

SELECT 
    CONCAT('(', user_id, ',', role_id, ')') as export_data
FROM user_roles
ORDER BY user_id, role_id;

-- SAU mai simplu:
SELECT * FROM user_roles ORDER BY user_id;

-- ==========================================
-- 4. EXPORT PERMISSIONS (pentru referință)
-- ==========================================
-- Copiază și rulează:

SELECT 
    CONCAT(
        '(',
        id, ',\'', 
        REPLACE(`key`, '\'', '\\\''), '\',\'',
        REPLACE(IFNULL(table_name, ''), '\'', '\\\''), '\',\'',
        IFNULL(created_at, 'NULL'), '\',\'',
        IFNULL(updated_at, 'NULL'), '\')'
    ) as export_data
FROM permissions
ORDER BY id;

-- SAU mai simplu:
SELECT * FROM permissions ORDER BY id;

-- ==========================================
-- 5. EXPORT PERMISSION_GROUPS (pentru referință)  
-- ==========================================
-- Copiază și rulează:

SELECT 
    CONCAT(
        '(',
        id, ',\'', 
        REPLACE(name, '\'', '\\\''), '\')'
    ) as export_data
FROM permission_groups
ORDER BY id;

-- SAU mai simplu:
SELECT * FROM permission_groups ORDER BY id;

-- ==========================================
-- 6. EXPORT PERMISSION_ROLES (pentru referință)
-- ==========================================
-- Copiază și rulează:

SELECT 
    CONCAT('(', permission_id, ',', role_id, ')') as export_data
FROM permission_roles
ORDER BY permission_id, role_id;

-- SAU mai simplu:
SELECT * FROM permission_roles ORDER BY permission_id;

-- ==========================================
-- ALTERNATIVA: EXPORT DIRECT CU INSERT
-- ==========================================

-- 1. ROLES cu INSERT complet:
SELECT 
    CONCAT(
        'INSERT INTO `roles` VALUES (',
        id, ',\'', 
        REPLACE(name, '\'', '\\\''), '\',\'',
        REPLACE(IFNULL(display_name, ''), '\'', '\\\''), '\',\'',
        IFNULL(created_at, 'NULL'), '\',\'',
        IFNULL(updated_at, 'NULL'), '\');'
    ) as sql_statement
FROM roles
ORDER BY id;

-- 2. USERS cu INSERT complet:
SELECT 
    CONCAT(
        'INSERT INTO `users` VALUES (',
        id, ',\'', 
        REPLACE(name, '\'', '\\\''), '\',\'',
        REPLACE(email, '\'', '\\\''), '\',',
        CASE WHEN email_verified_at IS NULL THEN 'NULL' ELSE CONCAT('\'', email_verified_at, '\'') END, ',\'',
        password, '\',',
        CASE WHEN remember_token IS NULL THEN 'NULL' ELSE CONCAT('\'', REPLACE(remember_token, '\'', '\\\''), '\'') END, ',',
        CASE WHEN created_at IS NULL THEN 'NULL' ELSE CONCAT('\'', created_at, '\'') END, ',',
        CASE WHEN updated_at IS NULL THEN 'NULL' ELSE CONCAT('\'', updated_at, '\'') END, ',',
        CASE WHEN avatar IS NULL THEN 'NULL' ELSE CONCAT('\'', REPLACE(avatar, '\'', '\\\''), '\'') END, ',',
        CASE WHEN settings IS NULL THEN 'NULL' ELSE CONCAT('\'', REPLACE(REPLACE(settings, '\'', '\\\''), '\\', '\\\\'), '\'') END,
        ');'
    ) as sql_statement
FROM users
ORDER BY id;

-- 3. USER_ROLES cu INSERT complet:
SELECT 
    CONCAT(
        'INSERT INTO `user_roles` VALUES (',
        user_id, ',', role_id, ');'
    ) as sql_statement
FROM user_roles
ORDER BY user_id;

-- ==========================================
-- EXPORT RAPID - TOTUL ÎNTR-UN QUERY
-- ==========================================

-- Pentru export rapid, folosește phpMyAdmin Export:
-- 1. Selectează tabelele: roles, users, user_roles, permissions, permission_groups, permission_roles
-- 2. Format: SQL
-- 3. Structure: Nu (doar date)
-- 4. Data: Da (doar INSERT)
-- 5. Export method: Quick
-- 6. Descarcă ca users_export.sql

-- ==========================================
-- VERIFICARE EXPORT
-- ==========================================

-- După export, verifică că ai aceste linii în users_export.sql:
-- INSERT INTO `roles` VALUES (...)
-- INSERT INTO `users` VALUES (...)  
-- INSERT INTO `user_roles` VALUES (...)
-- INSERT INTO `permissions` VALUES (...) [opțional]
-- INSERT INTO `permission_groups` VALUES (...) [opțional]
-- INSERT INTO `permission_roles` VALUES (...) [opțional]

-- Verifică numărul de înregistrări:
SELECT 
    'roles' as table_name, COUNT(*) as count FROM roles
UNION ALL
SELECT 
    'users' as table_name, COUNT(*) as count FROM users  
UNION ALL
SELECT 
    'user_roles' as table_name, COUNT(*) as count FROM user_roles
UNION ALL
SELECT 
    'permissions' as table_name, COUNT(*) as count FROM permissions
UNION ALL
SELECT 
    'permission_groups' as table_name, COUNT(*) as count FROM permission_groups
UNION ALL
SELECT 
    'permission_roles' as table_name, COUNT(*) as count FROM permission_roles;
