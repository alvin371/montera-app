# Modules Seeder Documentation

## Overview

The modules seeder creates all application modules required for the RBAC (Role-Based Access Control) permission system. These modules correspond to the actual controllers in the application and are used to control user access to different features.

## What Gets Created

### Total: 73 Modules

The seeder creates modules organized into 7 categories:

| Category | Count | Description |
|----------|-------|-------------|
| **System Management** | 22 | Core system features (Dashboard, Users, Roles, + 15 dashboard cards) |
| **HR Management** | 7 | Quest system, positions, benefits, recruitment |
| **Marketing** | 21 | Influencers, endorsements, campaigns, ads platforms, CRM |
| **Operations** | 14 | Transactions, inventory, products, marketplace |
| **Reports & Analytics** | 3 | Reporting and analytics features |
| **Google Integration** | 2 | Google Meet and Docs integration |
| **API Modules** | 4 | API endpoints (v1, v2, v3, AJAX) |

## Module Structure

Each module includes:

- **ID**: Unique identifier
- **Name**: System name (lowercase, matches controller)
- **Display Name**: Human-readable name
- **Controller**: Corresponding controller file name
- **Icon**: FontAwesome 5 icon class
- **Parent ID**: For hierarchical organization (NULL = parent module)
- **Sort Order**: Controls menu ordering
- **Is Active**: Enable/disable module (1 = active)

## Detailed Module List

### System Management (IDs: 1-7, 100-114)

```
Core System:
1.   dashboard        - Dashboard              (fas fa-tachometer-alt)
2.   user             - User Management        (fas fa-users)
3.   roles            - Role Management        (fas fa-user-shield)
4.   modules          - Module Management      (fas fa-th-large)
5.   profile          - My Profile             (fas fa-user-circle)
6.   auth             - Authentication         (fas fa-lock)
7.   home             - Home                   (fas fa-home)

Dashboard Cards (Widget-level Permissions):
100. dashboard_card_jumlah_order           - Total Orders
101. dashboard_card_order_belum_proses     - Unprocessed Orders
102. dashboard_card_order_belum_cairkan    - Unpaid Orders
103. dashboard_card_belum_cairkan          - Uncashed
104. dashboard_card_penjualan_kotor        - Gross Sales
105. dashboard_card_diskon                 - Discounts
106. dashboard_card_penjualan_bersih       - Net Sales
107. dashboard_card_laba_bersih            - Net Profit
108. dashboard_card_marketplace_fee        - Marketplace Fees
109. dashboard_card_pengeluaran            - Expenses
110. dashboard_card_hpp_produk             - Cost of Goods Sold
111. dashboard_card_order_return           - Return Orders
112. dashboard_card_nilai_produk           - Product Value
113. dashboard_card_ongkir                 - Shipping Costs
114. dashboard_card_penjualan_return       - Return Sales
```

### HR Management (IDs: 10-16)

```
10. quest            - Quest Management       (fas fa-tasks) [PARENT]
11.   quest_level    - Quest Levels           (fas fa-layer-group)
12. position         - Positions              (fas fa-briefcase)
13. benefit          - Benefits               (fas fa-gift)
14. milestone        - Milestones             (fas fa-flag-checkered)
15. recruitment      - Recruitment            (fas fa-user-plus) [PARENT]
16.   interview      - Interview              (fas fa-comments)
```

### Marketing (IDs: 20-34, 280-284, 310-311)

```
Marketing Overview:
20.  marketing       - Marketing Overview     (fas fa-chart-line) [Maps to Overview.php]

Influencer Management:
21.  influencer      - Influencer Management  (fas fa-user-friends) [PARENT]
22.    influencer_dummy - Influencer Dummy    (fas fa-users)

Endorsement:
23.  endorse         - Endorsement            (fas fa-handshake) [PARENT]
24.    endorse_campaign - Endorsement Campaigns (fas fa-bullhorn)
25.    review_endorse   - Review Endorsement  (fas fa-clipboard-check)

Payment & Calendar:
26.  payment         - Payment Management     (fas fa-money-bill-wave)
27.  calendar        - Calendar               (fas fa-calendar-alt)

Ads Management:
28.  ads             - Ads Management         (fas fa-ad) [PARENT - Maps to Ads.php]
280.   ads_tiktok    - TikTok Ads             (fab fa-tiktok)
281.   ads_meta      - Meta Ads               (fab fa-facebook)
282.   ads_shopee    - Shopee Ads             (fas fa-shopping-bag)
283.   ads_lazada    - Lazada Ads             (fas fa-store)
284.   advertiser    - Advertiser Accounts    (fas fa-user-tie)

Marketplace Accounts:
29.  marketplace_account - Marketplace Accounts (fas fa-store-alt)
30.    meta_account      - Meta Accounts       (fab fa-facebook)

CRM:
31.  crm             - CRM                     (fas fa-user-tie) [PARENT]
310.   crm_mg        - CRM - Montera Glowing  (fas fa-comments)
311.   crm_pome      - CRM - Pome Glow        (fas fa-comments-dollar)
32.    customer      - Customer Management    (fas fa-users)
33.    group_wa      - WhatsApp Groups        (fab fa-whatsapp)

Codeboost:
34.  codeboost       - Codeboost              (fas fa-rocket)
```

### Operations (IDs: 40-53)

```
Transactions:
40. transaction         - Transaction Management (fas fa-shopping-cart) [PARENT]
41.   transaction_item  - Transaction Items     (fas fa-list)
51.   order_customer    - Customer Orders       (fas fa-receipt)

Products:
42. product             - Product Management    (fas fa-box) [PARENT]
43.   product_3rd       - 3rd Party Products    (fas fa-boxes)

Inventory & Operations:
44. stock               - Stock Management      (fas fa-warehouse)
45. marketplace         - Marketplace           (fas fa-shopping-bag)
46. shipping            - Shipping              (fas fa-shipping-fast)
47. discount            - Discount              (fas fa-percent)
48. label               - Label                 (fas fa-tag)
49. expense             - Expense               (fas fa-money-check-alt)
50. testimoni           - Testimonials          (fas fa-comment-dots)
52. admin_fee_configuration - Admin Fee Config (fas fa-percentage)
53. operasional         - Operational           (fas fa-cogs)
```

### Reports & Analytics (IDs: 60-62)

```
60. report           - Reports                (fas fa-file-alt)
61. notifications    - Notifications          (fas fa-bell)
62. scraper          - Web Scraper            (fas fa-spider)
```

### Google Integration (IDs: 70-71)

```
70. googlemeet       - Google Meet            (fas fa-video)
71. googlemou        - Google Docs MOU        (fas fa-file-contract)
```

### API Modules (IDs: 80-83)

```
80. api              - API v1                 (fas fa-plug)
81. api_v2           - API v2                 (fas fa-plug)
82. api_v3           - API v3                 (fas fa-plug)
83. ajax             - AJAX Endpoints         (fas fa-exchange-alt)
```

## Import Instructions

### Method 1: Windows Batch Script (Easiest)

```bash
cd database_seeders
import_modules_seeder.bat
```

### Method 2: MySQL Command Line

```bash
mysql -u root -p your_database < database_seeders/modules_seeder.sql
```

### Method 3: phpMyAdmin

1. Open http://localhost/phpmyadmin
2. Select your database
3. Import tab → Choose file → `modules_seeder.sql` → Go

## After Import

### 1. Verify Modules

Login as admin and navigate to Module Management:
```
http://localhost/montera-app/modules
```

You should see all 49 modules listed.

### 2. Assign Permissions to Roles

Modules are imported but **NOT automatically granted to roles**. You must assign permissions:

**Option A: Via Application UI**
1. Login as admin
2. Navigate to: Roles → Edit → Permissions
3. Select modules and assign permissions (view, create, edit, delete)

**Option B: Via SQL (Quick Setup)**
```sql
-- Grant all permissions on all modules to Super Admin (role_id = 1)
INSERT INTO role_permissions (role_id, module_id, can_view, can_create, can_edit, can_delete, can_approve)
SELECT 1, id, 1, 1, 1, 1, 1
FROM modules
WHERE id NOT IN (SELECT module_id FROM role_permissions WHERE role_id = 1);
```

### 3. Test Permission System

```php
// In your controllers
$user_id = $_SESSION['user']['id'];

if ($this->permission->has_module_access($user_id, 'influencer')) {
    // User has access to influencer module
}
```

## Module Hierarchy

Modules have parent-child relationships for better navigation and permission management:

```
dashboard (Parent)
  ├── dashboard_card_jumlah_order
  ├── dashboard_card_order_belum_proses
  ├── dashboard_card_order_belum_cairkan
  ├── dashboard_card_belum_cairkan
  ├── dashboard_card_penjualan_kotor
  ├── dashboard_card_diskon
  ├── dashboard_card_penjualan_bersih
  ├── dashboard_card_laba_bersih
  ├── dashboard_card_marketplace_fee
  ├── dashboard_card_pengeluaran
  ├── dashboard_card_hpp_produk
  ├── dashboard_card_order_return
  ├── dashboard_card_nilai_produk
  ├── dashboard_card_ongkir
  └── dashboard_card_penjualan_return

quest (Parent)
  └── quest_level

recruitment (Parent)
  └── interview

influencer (Parent)
  └── influencer_dummy

endorse (Parent)
  ├── endorse_campaign
  └── review_endorse

ads (Parent)
  ├── ads_tiktok
  ├── ads_meta
  ├── ads_shopee
  ├── ads_lazada
  ├── advertiser
  └── meta_account

crm (Parent)
  ├── crm_mg
  ├── crm_pome
  ├── customer
  └── group_wa

transaction (Parent)
  ├── transaction_item
  └── order_customer

product (Parent)
  └── product_3rd
```

## Icon Reference

All icons use **FontAwesome 5** classes:

- **fas** = FontAwesome Solid
- **fab** = FontAwesome Brands

Examples:
- `fas fa-users` = Users icon
- `fas fa-tachometer-alt` = Dashboard icon
- `fab fa-whatsapp` = WhatsApp brand icon

To use in views:
```html
<i class="fas fa-users"></i> User Management
```

## Customization

### Adding New Modules

To add a new module to the seeder:

```sql
-- Add after the last module
INSERT IGNORE INTO `modules`
(`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`)
VALUES
(100, 'my_module', 'My Module', 'my_module', 'fas fa-star', NULL, 100, 1);
```

Then update AUTO_INCREMENT:
```sql
ALTER TABLE `modules` AUTO_INCREMENT = 101;
```

### Disabling Modules

To disable a module without deleting:

```sql
UPDATE modules SET is_active = 0 WHERE name = 'module_name';
```

### Changing Icons

Update the icon class:

```sql
UPDATE modules
SET icon = 'fas fa-new-icon'
WHERE name = 'module_name';
```

## Integration with RBAC

The modules work with the RBAC system:

### Database Tables

```
modules
  └── role_permissions (assigns modules to roles)
        └── roles (defines user roles)
              └── user_roles (assigns roles to users)
```

### Permission Check Flow

1. User logs in → Session stores user data
2. User accesses a page → Controller checks permission
3. Permission library checks:
   - User's role(s)
   - Role permissions for the module
   - Returns true/false

### Permission Library Usage

```php
// Check if user has access to module
$has_access = $this->permission->has_module_access($user_id, 'module_name');

// Check specific permission type
$can_edit = $this->permission->can_edit($user_id, 'module_name');
$can_delete = $this->permission->can_delete($user_id, 'module_name');
```

## Troubleshooting

### Modules Not Showing in Menu

1. **Check module is active**:
```sql
SELECT * FROM modules WHERE is_active = 0;
```

2. **Check role has permissions**:
```sql
SELECT m.display_name, rp.*
FROM role_permissions rp
JOIN modules m ON rp.module_id = m.id
WHERE rp.role_id = 1;
```

3. **Check user has role assigned**:
```sql
SELECT * FROM user_roles WHERE user_id = 1;
```

### Duplicate Entry Error

This is normal if modules already exist. The seeder uses `INSERT IGNORE` to skip duplicates safely.

### Foreign Key Constraint Error

Ensure the `roles` table exists and has records before importing modules seeder.

## Best Practices

### 1. Module Naming Convention
- Use lowercase, underscores for multi-word
- Match controller name exactly
- Example: `endorse_campaign` → `Endorse_campaign.php`

### 2. Parent-Child Hierarchy
- Use parent_id for related modules
- Parent modules appear in main menu
- Child modules appear as sub-menu items

### 3. Sort Order
- Use increments of 10 for easy reordering
- Lower numbers appear first
- Example: 10, 20, 30... (easy to insert 15 between 10 and 20)

### 4. Icon Selection
- Use semantic icons (shopping cart for orders, users for people)
- Keep icon style consistent (solid vs regular vs brands)
- Reference: https://fontawesome.com/icons

### 5. Permission Assignment
- Super Admin gets all permissions
- Admin gets most permissions
- Other roles get selective permissions
- Guest/Employee gets minimal permissions

## Related Files

- **User Seeder**: `user_seeder.sql` (creates test users)
- **Role Permissions Seeder**: Coming soon (assigns modules to roles)
- **CLAUDE.md**: Architecture documentation
- **README.md**: General seeder documentation

## Support

If you encounter issues:

1. Check application logs: `application/logs/`
2. Check MySQL error log: `C:\xampp\mysql\data\`
3. Verify database structure matches schema
4. Review CLAUDE.md troubleshooting section

## Key Changes & Naming Conventions

### Important Module Naming Notes

1. **`marketing` module** - Maps to `Overview.php` controller (not Marketing.php)
   - This provides marketing overview and reporting features
   - Access via: `http://localhost/montera-app/overview`

2. **`endorse` module** - The correct name (NOT `endorsement`)
   - Maps to `Endorse.php` controller
   - Roles.php previously had both `endorse` and `endorsement` - now unified as `endorse`

3. **Ads platform modules** - Sub-modules of `ads` parent:
   - `ads_tiktok`, `ads_meta`, `ads_shopee`, `ads_lazada` - Platform-specific views
   - All map to the same `Ads.php` controller with different parameters
   - Use `?m=tiktok`, `?m=meta`, etc. to access different platforms

4. **CRM brand modules**:
   - `crm_mg` - CRM for Montera Glowing brand
   - `crm_pome` - CRM for Pome Glow brand
   - Both map to `Crm.php` controller with brand filtering

5. **Dashboard cards** - Granular widget permissions:
   - Allow fine-grained control over which dashboard metrics users can see
   - All child modules of `dashboard` parent
   - View-only permissions (no create/edit/delete)

### Synchronization Status

As of this update, the following files are now synchronized:

✅ **`modules_seeder.sql`** - Contains all 73 modules
✅ **`Roles.php` `get_module_permissions()`** - Defines permissions for all 73 modules
✅ **`Roles.php` `get_module_category()`** - Categorizes all 73 modules correctly
✅ **`README_MODULES.md`** - Documents all 73 modules

### Controller to Module Mapping Reference

| Controller | Module Name | Notes |
|------------|-------------|-------|
| Overview.php | `marketing` | Marketing overview & reporting |
| Ads.php | `ads`, `ads_*` | Parent + platform-specific modules |
| Endorse.php | `endorse` | NOT `endorsement` |
| Crm.php | `crm`, `crm_mg`, `crm_pome` | Parent + brand-specific |
| Dashboard.php | `dashboard`, `dashboard_card_*` | Parent + 15 widget cards |

## Next Steps

After importing modules:

1. ✅ Import user seeder (if not done)
2. ✅ Import modules seeder (this file)
3. ⬜ Create role_permissions seeder (assign modules to roles)
4. ⬜ Test login with different user roles
5. ⬜ Verify permission checks in controllers
6. ⬜ Configure module-specific permissions
7. ⬜ Test dashboard card visibility based on permissions

---

**Version**: 2.0
**Last Updated**: 2025-10-13
**Changes**: Added 24 new modules (dashboard cards, ads platforms, CRM brands, operations)
**Based on**: CLAUDE.md, actual controllers, Roles.php analysis
