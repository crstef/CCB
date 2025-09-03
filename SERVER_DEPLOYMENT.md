# Server Deployment Instructions - CCB Documents Import

## Pre-deployment Checklist

### 1. Current State
- ✅ Documents carousel with modal view implemented
- ✅ Eye icons sized correctly (w-4 h-4)
- ✅ Import command created (`ImportOldDocuments`)
- ✅ Export SQL file ready (`documents_export.sql`)

### 2. Files to Commit
```bash
git add app/Console/Commands/ImportOldDocuments.php
git add documents_export.sql
git add IMPORT_DOCUMENTS.md
git add SERVER_DEPLOYMENT.md
git commit -m "feat: Add documents import command from Wave 2.0 to 3.0

- Created ImportOldDocuments command for automated migration
- Added complete SQL export from old site
- Document mapping: type -> DocumentCategory
- File structure conversion for new storage
- Modal view implementation for carousel
- Fixed Livewire multiple root elements issue"
```

## Server Deployment Steps

### 1. Deploy Code
```bash
# Pull latest changes
git pull origin feature/customizations

# Install/update dependencies if needed
composer install --no-dev --optimize-autoloader

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### 2. Run Documents Import

#### Step A: Test Import (Dry Run)
```bash
cd /path/to/ccb-project
php artisan documents:import --dry-run
```

Expected output:
```
Starting import of documents from old site...
Found X documents to import.
Creating categories...
+ Created category: decizie
+ Created category: hotarare
+ Created category: regulament
...
Would import: Document Title with X files
...
Import completed!
┌──────────┬───────┐
│ Status   │ Count │
├──────────┼───────┤
│ Imported │ 0     │
│ Skipped  │ X     │
│ Errors   │ 0     │
│ Total    │ X     │
└──────────┴───────┘
```

#### Step B: Real Import (if dry-run successful)
```bash
php artisan documents:import
```

### 3. Post-Import Verification

#### Database Check
```sql
-- Check categories created
SELECT id, name, slug, color FROM document_categories ORDER BY name;

-- Check documents imported  
SELECT COUNT(*) as total_docs FROM documents;

-- Check files structure
SELECT title, JSON_LENGTH(files) as file_count 
FROM documents 
WHERE files IS NOT NULL 
LIMIT 5;
```

#### Admin Panel Check
1. Login to `/admin`
2. Navigate to Documents section
3. Verify categories are visible
4. Check document listing
5. Test document preview (modal)

#### Frontend Check
1. Visit homepage
2. Check documents carousel functionality
3. Test inline view (eye icon) - should open modal
4. Verify auto-play works
5. Check documents index page `/documents`

### 4. File Migration (Manual Step)

The import command only migrates database records. Physical files need manual copy:

```bash
# From old server storage
/old-site/storage/app/public/documents/

# To new server storage  
/new-site/storage/app/public/documents/

# Use rsync or similar
rsync -av /old-site/storage/app/public/documents/ /new-site/storage/app/public/documents/
```

### 5. Final Verification

#### Test Document Access
1. Open carousel on homepage
2. Click eye icon on a document
3. Verify modal opens with document content
4. Test different file types (PDF, DOC, images)
5. Check download functionality

#### Performance Check
```bash
# Check storage permissions
ls -la storage/app/public/documents/

# Verify file links work
php artisan storage:link

# Clear any caches
php artisan cache:clear
```

## Rollback Plan

If import fails or causes issues:

### 1. Database Rollback
```sql
-- Delete imported documents (if needed)
DELETE FROM documents WHERE created_at >= 'IMPORT_DATE';

-- Delete created categories (if needed)  
DELETE FROM document_categories WHERE description LIKE '%Importat din site-ul vechi%';
```

### 2. Code Rollback
```bash
git revert HEAD~1  # Revert last commit
# or
git checkout previous-working-commit
```

## Monitoring

### Key Metrics to Watch
- Documents carousel load time
- Modal opening speed  
- File download success rate
- No JavaScript errors in browser console

### Log Files to Monitor
- `storage/logs/laravel.log` - General application errors
- Web server error logs - 404s, permission issues
- Browser developer tools - JavaScript/CSS issues

## Success Criteria

✅ All old documents visible in admin panel  
✅ Categories properly created and organized  
✅ Carousel displays documents with correct info  
✅ Eye icon opens modal with document preview  
✅ Download buttons work for all file types  
✅ No JavaScript errors in browser console  
✅ Page load times acceptable (<3s)  
✅ Mobile responsive design maintained  

## Contact Info

For any deployment issues:
- Check logs first: `tail -f storage/logs/laravel.log`
- Verify command worked: `php artisan documents:import --dry-run`
- Test specific functionality: carousel, modal, download
- Monitor browser console for JavaScript errors

## Post-Go-Live Tasks

1. **Content Review**: Admin should review imported documents for accuracy
2. **Category Organization**: Adjust category colors/order in admin panel  
3. **SEO Update**: Update sitemap if documents have public URLs
4. **User Communication**: Notify users about new document system
5. **Performance Monitoring**: Watch for any slowdown in carousel/modal
