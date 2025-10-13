# User Seeder - Summary

## What Was Created

Based on the `CLAUDE.md` documentation, I've created a complete database seeding system for the Montera application with 3 test users covering different roles.

### Files Created

```
database_seeders/
├── user_seeder.sql              # Main SQL seeder file
├── generate_password_hashes.php # Password hash generator
├── import_seeder.bat            # Windows import script
├── CREDENTIALS.txt              # Quick reference card
├── README.md                    # Complete documentation
└── SEEDER_SUMMARY.md           # This file
```

## Users Created

| ID | Username   | Password          | Role              | Email                    |
|----|------------|-------------------|-------------------|--------------------------|
| 1  | admin      | `Admin123!@#`     | Super Admin       | admin@montera.com        |
| 2  | marketing  | `Marketing123!@#` | Marketing Manager | marketing@montera.com    |
| 3  | operations | `Operations123!@#`| Operations        | operations@montera.com   |

### Role Assignments

All users are properly assigned to their roles via the RBAC `user_roles` table:
- **User 1** → Role 1 (Super Admin)
- **User 2** → Role 3 (Marketing Manager)
- **User 3** → Role 5 (Operations)

## Features

### ✅ Security Best Practices
- **Secure Password Hashing**: Uses PHP `password_hash()` with `PASSWORD_DEFAULT`
- **Password Strength**: All passwords meet complexity requirements (8+ chars, uppercase, lowercase, numbers, special chars)
- **Hybrid Compatibility**: Works with the application's hybrid password system (MD5 legacy + password_hash modern)
- **Development Only Warnings**: Multiple security warnings about not using in production

### ✅ Database Integrity
- **Foreign Keys**: Properly links users to roles via `user_roles` table
- **Required Fields**: All required fields populated per schema
- **Timestamps**: Uses MySQL `NOW()` for accurate timestamps
- **Status Values**: Follows application conventions ('Aktif' for active users)
- **Auto Increment**: Sets proper starting point for future users

### ✅ Role-Based Access
Each user has appropriate access based on their role:

**Super Admin**:
- Full system access
- All dashboard analytics
- User management
- System configuration

**Marketing Manager**:
- Influencer database
- Endorsement campaigns
- CRM features
- Marketing analytics

**Operations Staff**:
- Transaction management
- Inventory tracking
- Product catalog
- Order fulfillment

### ✅ Easy to Use
- **3 Import Methods**: SQL command line, phpMyAdmin, batch script
- **Auto-Detection**: Batch script reads database name from `.env`
- **Error Handling**: Clear error messages and troubleshooting guidance
- **Quick Reference**: `CREDENTIALS.txt` for easy copy-paste

## Quick Start

### Fastest Method (Windows):
```bash
# Navigate to seeders directory
cd database_seeders

# Double-click or run:
import_seeder.bat
```

### Alternative Methods:

**MySQL Command Line:**
```bash
mysql -u root -p your_database < database_seeders/user_seeder.sql
```

**phpMyAdmin:**
1. Open http://localhost/phpmyadmin
2. Select database
3. Import → user_seeder.sql → Go

## Testing

After importing, test each user:

```
1. Navigate to: http://localhost/montera-app/auth/login
2. Login as 'admin' with password 'Admin123!@#'
3. Verify dashboard access
4. Logout and repeat with other users
```

### Expected Redirects (per CLAUDE.md)

Based on `Auth::get_user_default_page()` method:
- **admin**: → `base_url()` (main dashboard)
- **marketing**: → `base_url() . 'influencer'` or CRM
- **operations**: → `base_url() . 'transaction'` or products

## Customization

### Change Passwords

1. Edit `generate_password_hashes.php`:
```php
$users = [
    'admin' => 'YourNewPassword',
    'marketing' => 'AnotherPassword',
    'operations' => 'ThirdPassword'
];
```

2. Run the generator:
```bash
php database_seeders/generate_password_hashes.php
```

3. Copy generated hashes into `user_seeder.sql`

### Add More Users

Follow the same pattern in `user_seeder.sql`:

```sql
INSERT INTO `user` (...) VALUES (
    4,                        -- id
    'New User Name',          -- full_name
    'USR001',                 -- code
    '1995-01-01',            -- birth_date
    'Jakarta',               -- address
    'newuser',               -- username
    'newuser@montera.com',   -- email
    '$2y$10$...',           -- password (generate with PHP)
    6,                       -- role (6 = employee)
    'Employee',              -- role_text
    'Description',           -- desc
    'default-avatar.png',    -- img
    1,                       -- created_by
    1,                       -- updated_by
    NOW(),                   -- created_at
    NOW(),                   -- updated_at
    'Aktif',                 -- status
    '081234567893'           -- phone
);

-- Don't forget to assign role
INSERT INTO `user_roles` (`user_id`, `role_id`, `assigned_by`, `assigned_at`)
VALUES (4, 6, 1, NOW());
```

## Technical Details

### Password Hash Format
```
Algorithm: PASSWORD_DEFAULT (currently bcrypt)
Format:    $2y$10$[22-character salt][31-character hash]
Example:   $2y$10$8X/73ca/Sl.kqDbzY6liH.FA5praDgBI.Cj90mUU6ctEk4uR0IKSa
```

### Database Schema Compliance

The seeder follows the exact schema from `u388059875_bhskin.sql`:

**user table fields:**
- `id`, `full_name`, `code`, `birth_date`, `address`
- `username`, `email`, `password`
- `role`, `role_text`, `desc`, `img`
- `created_by`, `updated_by`, `created_at`, `updated_at`
- `status`, `phone`

**user_roles table fields:**
- `id`, `user_id`, `role_id`, `assigned_by`, `assigned_at`

**roles table fields:**
- `id`, `name`, `display_name`, `description`, `level`, `is_active`
- `created_at`, `updated_at`

## Compatibility

### Application Requirements
- CodeIgniter 3.x
- PHP 7.4 or 8.0+
- MySQL 5.7+
- Auth controller with hybrid password support

### Password System Compatibility

The seeder works with the application's hybrid authentication system documented in CLAUDE.md:

```php
// From Auth::login_process()
if (password_verify($password, $user['password'])) {
    // Modern password_hash - Works ✓
} else if ($user['password'] === md5($password)) {
    // Legacy MD5 - Auto-upgrades to password_hash
}
```

## Security Reminders

⚠️ **DEVELOPMENT ONLY**
- These credentials are for testing and development
- Never use in production environments
- Change all passwords before deployment

⚠️ **Production Checklist**
- [ ] Generate unique, strong passwords
- [ ] Enable CSRF protection (`config.php`)
- [ ] Enable XSS filtering for production
- [ ] Set proper error reporting (no display in production)
- [ ] Review and set proper permissions per module
- [ ] Consider implementing 2FA for admin accounts
- [ ] Use environment-specific `.env` files

## Troubleshooting

### Common Issues

**Issue**: Duplicate entry error
**Solution**: Users already exist. Delete first or use UPDATE statements from `generate_password_hashes.php`

**Issue**: Login fails
**Solution**:
1. Check user status is 'Aktif'
2. Clear sessions in `application/cache/sessions/`
3. Verify Auth controller supports password_hash()

**Issue**: Permission denied after login
**Solution**:
1. Verify `user_roles` table has role assignment
2. Check `modules` table has required modules
3. Check `role_permissions` table grants access

**Issue**: Can't find database
**Solution**: Check `.env` file for correct `DB_DATABASE` value

## Related Documentation

- **CLAUDE.md** - Complete architecture and development guide
- **SETUP.md** - Initial environment setup
- **README.md** (credentials/) - Environment variable guide
- **README.md** (this directory) - Detailed seeder documentation
- **CREDENTIALS.txt** - Quick reference card

## Version History

- **v1.0** (2025-10-13) - Initial creation
  - 3 users with different roles
  - Secure password hashing
  - Full RBAC integration
  - Multiple import methods
  - Comprehensive documentation

## Credits

Created based on `CLAUDE.md` documentation for the Montera Application.
Follows CodeIgniter 3 best practices and application security guidelines.
