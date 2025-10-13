# Database Seeders

This directory contains database seeders for the Montera application. Seeders help populate the database with test data for development and testing purposes.

## Available Seeders

### 1. User Seeder (`user_seeder.sql`)

Creates 3 test users with different roles for development:

| Username   | Password          | Email                    | Role              | Description                                    |
|------------|-------------------|--------------------------|-------------------|------------------------------------------------|
| admin      | `Admin123!@#`     | admin@montera.com        | Super Admin       | Full system access with all permissions        |
| marketing  | `Marketing123!@#` | marketing@montera.com    | Marketing Manager | Manage influencers, endorsements, and campaigns|
| operations | `Operations123!@#`| operations@montera.com   | Operations        | Manage transactions, inventory, and products   |

**📖 Documentation**: See [User Seeder Details](#user-seeder-details) below

### 2. Modules Seeder (`modules_seeder.sql`)

Creates all application modules for the RBAC permission system (49 modules total):

| Category | Modules | Description |
|----------|---------|-------------|
| System Management | 7 | Dashboard, Users, Roles, Modules, Profile, Auth, Home |
| HR Management | 7 | Quest, Quest Levels, Positions, Benefits, Milestones, Recruitment |
| Marketing | 15 | Influencers, Endorsements, Campaigns, Ads, CRM, Customers |
| Operations | 11 | Transactions, Products, Stock, Marketplace, Shipping |
| Reports & Analytics | 3 | Reports, Notifications, Web Scraper |
| Google Integration | 2 | Google Meet, Google Docs MOU |
| API Modules | 4 | API v1, v2, v3, AJAX endpoints |

**📖 Documentation**: See [README_MODULES.md](README_MODULES.md) for complete module list

**⚠️ Important**: After importing modules, you must assign permissions to roles via `role_permissions` table.

## Quick Start Guide

### Import Both Seeders (Recommended Order)

```bash
cd database_seeders

# 1. Import users first
import_seeder.bat

# 2. Import modules second
import_modules_seeder.bat
```

Or use MySQL directly:
```bash
mysql -u root -p your_database < database_seeders/user_seeder.sql
mysql -u root -p your_database < database_seeders/modules_seeder.sql
```

## How to Use

### Method 1: MySQL Command Line

```bash
# Navigate to project root
cd C:\xampp\htdocs\montera-app

# Import the seeder (replace with your database name from .env)
mysql -u root -p your_database_name < database_seeders/user_seeder.sql
```

### Method 2: phpMyAdmin

1. Open phpMyAdmin in your browser: `http://localhost/phpmyadmin`
2. Select your database (check your `.env` file for `DB_DATABASE` value)
3. Click on "Import" tab
4. Choose file: Browse to `database_seeders/user_seeder.sql`
5. Click "Go" button at the bottom

### Method 3: Using XAMPP MySQL Admin

```bash
# From XAMPP MySQL command line
mysql -u root
USE your_database_name;
source C:/xampp/htdocs/montera-app/database_seeders/user_seeder.sql;
```

## Password Hash Generator

If you need to generate new password hashes or change the default passwords:

```bash
php database_seeders/generate_password_hashes.php
```

This will generate:
- Password hashes for all users
- SQL UPDATE statements for easy copy-paste
- Verification tests to ensure hashes work correctly

### Customizing Passwords

Edit `generate_password_hashes.php` and modify the `$users` array:

```php
$users = [
    'admin' => 'YourNewPassword123!',
    'marketing' => 'AnotherPassword456!',
    'operations' => 'ThirdPassword789!'
];
```

Then run the script and copy the generated hashes into `user_seeder.sql`.

## What the User Seeder Does

1. **Creates Roles** (if they don't exist):
   - Super Admin (ID: 1)
   - Admin (ID: 2)
   - Marketing Manager (ID: 3)
   - Marketing Staff (ID: 4)
   - Operations (ID: 5)
   - Employee (ID: 6)
   - HR (ID: 7)
   - Guest (ID: 10)

2. **Creates 3 Users**:
   - Each user has proper field values per schema
   - Passwords use secure `password_hash()` format
   - All timestamps are set to current date/time
   - Status set to 'Aktif' (Active)
   - Created by and updated by set to user ID 1 (admin)

3. **Assigns Roles via RBAC**:
   - Inserts records into `user_roles` table
   - Links users to their respective roles
   - Sets assignment timestamp

4. **Sets Auto Increment**:
   - Updates user table auto increment to start at ID 4
   - Prevents ID conflicts with future users

## Testing the Seeded Users

After running the seeder, test login with any of the credentials:

1. Navigate to: `http://localhost/montera-app/auth/login`
2. Use any of the usernames and passwords from the table above
3. Verify that you're redirected to the appropriate dashboard based on role

### Expected Behavior by Role

- **admin**: Redirected to main dashboard (`/dashboard`)
- **marketing**: Redirected to influencer management (`/influencer`) or CRM
- **operations**: Redirected to transaction management (`/transaction`) or products

## Troubleshooting

### "Duplicate entry" Error

If you see duplicate entry errors, users already exist. You can:

**Option 1**: Delete existing test users first
```sql
DELETE FROM user_roles WHERE user_id IN (1, 2, 3);
DELETE FROM user WHERE id IN (1, 2, 3);
```

**Option 2**: Use UPDATE statements instead
```sql
-- See generate_password_hashes.php output for UPDATE statements
```

### Login Not Working

1. **Check password format**: The seeder uses `password_hash()` format
2. **Verify Auth controller**: Should support both MD5 (legacy) and password_hash()
3. **Check user status**: Must be 'Aktif' in database
4. **Clear sessions**: Delete session files in `application/cache/sessions/`

### Permission Denied After Login

1. **Check user_roles table**: Verify user has role assignment
2. **Check modules table**: Ensure modules exist for the features
3. **Check role_permissions**: Verify role has access to required modules
4. **Check Auth controller**: `get_user_default_page()` method handles redirects

## Security Notes

⚠️ **IMPORTANT**: These are DEVELOPMENT credentials only!

- **DO NOT** use these credentials in production
- **DO NOT** commit `.env` file with real credentials
- **CHANGE** all passwords immediately when deploying to production
- **ENABLE** CSRF protection in `config.php` for production
- **DISABLE** error display and enable logging in production
- **USE** strong, unique passwords for production users

## User Seeder Details

The information below applies specifically to the **user_seeder.sql** file.

## Files in This Directory

```
database_seeders/
├── user_seeder.sql                 # User seeder (3 test users)
├── modules_seeder.sql              # Modules seeder (49 modules)
├── generate_password_hashes.php    # Password hash generator script
├── import_seeder.bat               # Windows batch import for users
├── import_modules_seeder.bat       # Windows batch import for modules
├── CREDENTIALS.txt                 # Quick reference card for users
├── README.md                       # This file (main documentation)
├── README_MODULES.md               # Detailed modules documentation
└── SEEDER_SUMMARY.md              # Technical summary
```

## Creating Additional Seeders

To create more seeders for other tables:

1. Create a new `.sql` file in this directory
2. Follow the same structure as `user_seeder.sql`:
   - Transaction blocks
   - INSERT IGNORE for reference data
   - Proper timestamps
   - Foreign key relationships
   - Auto increment updates

3. Document the seeder in this README

## Related Documentation

- See `CLAUDE.md` in project root for architecture overview
- See `SETUP.md` for initial environment setup
- See `README.md` (credentials directory) for environment variables

## Support

If you encounter issues:
1. Check application logs: `application/logs/`
2. Check Apache error logs: `C:\xampp\apache\logs\error.log`
3. Enable error display in `index.php` during development
4. Refer to CLAUDE.md troubleshooting section
