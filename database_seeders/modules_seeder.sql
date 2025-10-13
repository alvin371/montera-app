-- ============================================================================
-- Modules Seeder for Montera Application
-- ============================================================================
-- This seeder creates all application modules for the RBAC permission system
-- Created based on actual controllers and CLAUDE.md documentation
--
-- Module Categories:
-- 1. System Management - Core system functionality
-- 2. HR Management - Quest system, positions, benefits
-- 3. Marketing - Influencers, endorsements, campaigns, ads
-- 4. Operations - Inventory, transactions, products, orders
-- 5. Reports & Analytics - Reporting and analytics features
--
-- All modules are mapped to their corresponding controllers
-- Icons use FontAwesome 5 icon classes
-- ============================================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ============================================================================
-- SYSTEM MANAGEMENT MODULES
-- ============================================================================

-- Dashboard (Parent Module)
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(1, 'dashboard', 'Dashboard', 'dashboard', 'fas fa-tachometer-alt', NULL, 1, 1);

-- Dashboard Cards (Granular widget permissions)
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(100, 'dashboard_card_jumlah_order', 'Card: Total Orders', 'dashboard', 'fas fa-shopping-cart', 1, 101, 1),
(101, 'dashboard_card_order_belum_proses', 'Card: Unprocessed Orders', 'dashboard', 'fas fa-hourglass-half', 1, 102, 1),
(102, 'dashboard_card_order_belum_cairkan', 'Card: Unpaid Orders', 'dashboard', 'fas fa-money-bill-wave', 1, 103, 1),
(103, 'dashboard_card_belum_cairkan', 'Card: Uncashed', 'dashboard', 'fas fa-hand-holding-usd', 1, 104, 1),
(104, 'dashboard_card_penjualan_kotor', 'Card: Gross Sales', 'dashboard', 'fas fa-dollar-sign', 1, 105, 1),
(105, 'dashboard_card_diskon', 'Card: Discounts', 'dashboard', 'fas fa-percentage', 1, 106, 1),
(106, 'dashboard_card_penjualan_bersih', 'Card: Net Sales', 'dashboard', 'fas fa-chart-line', 1, 107, 1),
(107, 'dashboard_card_laba_bersih', 'Card: Net Profit', 'dashboard', 'fas fa-hand-holding-usd', 1, 108, 1),
(108, 'dashboard_card_marketplace_fee', 'Card: Marketplace Fees', 'dashboard', 'fas fa-credit-card', 1, 109, 1),
(109, 'dashboard_card_pengeluaran', 'Card: Expenses', 'dashboard', 'fas fa-receipt', 1, 110, 1),
(110, 'dashboard_card_hpp_produk', 'Card: COGS', 'dashboard', 'fas fa-box', 1, 111, 1),
(111, 'dashboard_card_order_return', 'Card: Return Orders', 'dashboard', 'fas fa-undo', 1, 112, 1),
(112, 'dashboard_card_nilai_produk', 'Card: Product Value', 'dashboard', 'fas fa-tags', 1, 113, 1),
(113, 'dashboard_card_ongkir', 'Card: Shipping Costs', 'dashboard', 'fas fa-shipping-fast', 1, 114, 1),
(114, 'dashboard_card_penjualan_return', 'Card: Return Sales', 'dashboard', 'fas fa-exchange-alt', 1, 115, 1);

-- User Management
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(2, 'user', 'User Management', 'user', 'fas fa-users', NULL, 2, 1);

-- Role Management
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(3, 'roles', 'Role Management', 'roles', 'fas fa-user-shield', NULL, 3, 1);

-- Module Management
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(4, 'modules', 'Module Management', 'modules', 'fas fa-th-large', NULL, 4, 1);

-- Profile
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(5, 'profile', 'My Profile', 'profile', 'fas fa-user-circle', NULL, 5, 1);

-- Authentication
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(6, 'auth', 'Authentication', 'auth', 'fas fa-lock', NULL, 99, 1);

-- Home
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(7, 'home', 'Home', 'home', 'fas fa-home', NULL, 0, 1);

-- ============================================================================
-- HR MANAGEMENT MODULES
-- ============================================================================

-- Quest System (Parent)
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(10, 'quest', 'Quest Management', 'quest', 'fas fa-tasks', NULL, 10, 1);

-- Quest Levels
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(11, 'quest_level', 'Quest Levels', 'quest_level', 'fas fa-layer-group', 10, 11, 1);

-- Position Management
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(12, 'position', 'Positions', 'position', 'fas fa-briefcase', NULL, 12, 1);

-- Benefits
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(13, 'benefit', 'Benefits', 'benefit', 'fas fa-gift', NULL, 13, 1);

-- Milestones
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(14, 'milestone', 'Milestones', 'milestone', 'fas fa-flag-checkered', NULL, 14, 1);

-- Recruitment
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(15, 'recruitment', 'Recruitment', 'recruitment', 'fas fa-user-plus', NULL, 15, 1);

-- Interview
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(16, 'interview', 'Interview', 'interview', 'fas fa-comments', 15, 16, 1);

-- ============================================================================
-- MARKETING MODULES
-- ============================================================================

-- Marketing Overview (Maps to Overview.php controller)
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(20, 'marketing', 'Marketing Overview', 'overview', 'fas fa-chart-line', NULL, 20, 1);

-- Influencer Management (Parent)
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(21, 'influencer', 'Influencer Management', 'influencer', 'fas fa-user-friends', NULL, 21, 1);

-- Influencer Dummy Data
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(22, 'influencer_dummy', 'Influencer Dummy', 'influencer_dummy', 'fas fa-users', 21, 22, 1);

-- Endorsement (Parent)
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(23, 'endorse', 'Endorsement', 'endorse', 'fas fa-handshake', NULL, 23, 1);

-- Endorsement Campaigns
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(24, 'endorse_campaign', 'Endorsement Campaigns', 'endorse_campaign', 'fas fa-bullhorn', 23, 24, 1);

-- Review Endorsement
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(25, 'review_endorse', 'Review Endorsement', 'review_endorse', 'fas fa-clipboard-check', 23, 25, 1);

-- Payment Management
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(26, 'payment', 'Payment Management', 'payment', 'fas fa-money-bill-wave', NULL, 26, 1);

-- Calendar
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(27, 'calendar', 'Calendar', 'calendar', 'fas fa-calendar-alt', NULL, 27, 1);

-- Ads Management (Parent - Maps to Ads.php controller)
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(28, 'ads', 'Ads Management', 'ads', 'fas fa-ad', NULL, 28, 1);

-- Ads Platform Views (Sub-pages within Ads controller)
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(280, 'ads_tiktok', 'TikTok Ads', 'ads', 'fab fa-tiktok', 28, 281, 1),
(281, 'ads_meta', 'Meta Ads', 'ads', 'fab fa-facebook', 28, 282, 1),
(282, 'ads_shopee', 'Shopee Ads', 'ads', 'fas fa-shopping-bag', 28, 283, 1),
(283, 'ads_lazada', 'Lazada Ads', 'ads', 'fas fa-store', 28, 284, 1);

-- Advertiser Management (Used for TikTok advertiser accounts)
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(284, 'advertiser', 'Advertiser Accounts', 'ads', 'fas fa-user-tie', 28, 285, 1);

-- Marketplace Accounts
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(29, 'marketplace_account', 'Marketplace Accounts', 'marketplace_account', 'fas fa-store-alt', NULL, 29, 1);

-- Meta Accounts
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(30, 'meta_account', 'Meta Accounts', 'meta_account', 'fab fa-facebook', 28, 30, 1);

-- CRM (Parent)
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(31, 'crm', 'CRM', 'crm', 'fas fa-user-tie', NULL, 31, 1);

-- CRM Sub-modules (Brand-specific CRM)
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(310, 'crm_mg', 'CRM - Montera Glowing', 'crm', 'fas fa-comments', 31, 311, 1),
(311, 'crm_pome', 'CRM - Pome Glow', 'crm', 'fas fa-comments-dollar', 31, 312, 1);

-- Customer Management
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(32, 'customer', 'Customer Management', 'customer', 'fas fa-users', 31, 32, 1);

-- WhatsApp Groups
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(33, 'group_wa', 'WhatsApp Groups', 'group_wa', 'fab fa-whatsapp', 31, 33, 1);

-- Codeboost
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(34, 'codeboost', 'Codeboost', 'codeboost', 'fas fa-rocket', NULL, 34, 1);

-- ============================================================================
-- OPERATIONS MODULES
-- ============================================================================

-- Transaction Management (Parent)
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(40, 'transaction', 'Transaction Management', 'transaction', 'fas fa-shopping-cart', NULL, 40, 1);

-- Transaction Items
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(41, 'transaction_item', 'Transaction Items', 'transaction_item', 'fas fa-list', 40, 41, 1);

-- Product Management (Parent)
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(42, 'product', 'Product Management', 'product', 'fas fa-box', NULL, 42, 1);

-- 3rd Party Products
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(43, 'product_3rd', '3rd Party Products', 'product_3rd', 'fas fa-boxes', 42, 43, 1);

-- Stock Management
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(44, 'stock', 'Stock Management', 'stock', 'fas fa-warehouse', NULL, 44, 1);

-- Marketplace Integration
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(45, 'marketplace', 'Marketplace', 'marketplace', 'fas fa-shopping-bag', NULL, 45, 1);

-- Shipping
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(46, 'shipping', 'Shipping', 'shipping', 'fas fa-shipping-fast', NULL, 46, 1);

-- Discount Management
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(47, 'discount', 'Discount', 'discount', 'fas fa-percent', NULL, 47, 1);

-- Label Management
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(48, 'label', 'Label', 'label', 'fas fa-tag', NULL, 48, 1);

-- Expense Management
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(49, 'expense', 'Expense', 'expense', 'fas fa-money-check-alt', NULL, 49, 1);

-- Testimonials
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(50, 'testimoni', 'Testimonials', 'testimoni', 'fas fa-comment-dots', NULL, 50, 1);

-- Order Customer (Customer Orders Management)
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(51, 'order_customer', 'Customer Orders', 'order_customer', 'fas fa-receipt', 40, 51, 1);

-- Admin Fee Configuration
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(52, 'admin_fee_configuration', 'Admin Fee Config', 'admin_fee_configuration', 'fas fa-percentage', NULL, 52, 1);

-- Operational Management
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(53, 'operasional', 'Operational', 'operasional', 'fas fa-cogs', NULL, 53, 1);

-- ============================================================================
-- REPORTS & ANALYTICS MODULES
-- ============================================================================

-- Reports
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(60, 'report', 'Reports', 'report', 'fas fa-file-alt', NULL, 60, 1);

-- Notifications
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(61, 'notifications', 'Notifications', 'notifications', 'fas fa-bell', NULL, 61, 1);

-- Web Scraper
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(62, 'scraper', 'Web Scraper', 'scraper', 'fas fa-spider', NULL, 62, 1);

-- ============================================================================
-- GOOGLE INTEGRATION MODULES (UTILITY)
-- ============================================================================

-- Google Meet Integration
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(70, 'googlemeet', 'Google Meet', 'googlemeet', 'fas fa-video', NULL, 70, 1);

-- Google MOU/Docs
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(71, 'googlemou', 'Google Docs MOU', 'googlemou', 'fas fa-file-contract', NULL, 71, 1);

-- ============================================================================
-- API MODULES (SYSTEM)
-- ============================================================================

-- API v1
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(80, 'api', 'API v1', 'api', 'fas fa-plug', NULL, 80, 1);

-- API v2
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(81, 'api_v2', 'API v2', 'api_v2', 'fas fa-plug', NULL, 81, 1);

-- API v3
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(82, 'api_v3', 'API v3', 'api_v3', 'fas fa-plug', NULL, 82, 1);

-- AJAX Endpoints
INSERT IGNORE INTO `modules` (`id`, `name`, `display_name`, `controller`, `icon`, `parent_id`, `sort_order`, `is_active`) VALUES
(83, 'ajax', 'AJAX Endpoints', 'ajax', 'fas fa-exchange-alt', NULL, 83, 1);

-- ============================================================================
-- Update Auto Increment
-- ============================================================================

-- Set auto increment to start after our seeded modules
ALTER TABLE `modules` AUTO_INCREMENT = 320;

COMMIT;

-- ============================================================================
-- SEEDER COMPLETE
-- ============================================================================
-- Modules created successfully!
--
-- Summary by Category:
-- ┌─────────────────────────┬───────┐
-- │ Category                │ Count │
-- ├─────────────────────────┼───────┤
-- │ System Management       │  22   │ (includes 15 dashboard cards)
-- │ HR Management           │   7   │
-- │ Marketing               │  21   │ (includes ads platforms + advertiser)
-- │ Operations              │  14   │ (includes order_customer, admin_fee, operasional)
-- │ Reports & Analytics     │   3   │
-- │ Google Integration      │   2   │
-- │ API Modules             │   4   │
-- ├─────────────────────────┼───────┤
-- │ TOTAL                   │  73   │
-- └─────────────────────────┴───────┘
--
-- All modules are mapped to their corresponding controllers
-- Icons use FontAwesome 5 classes
-- Parent-child relationships established for hierarchical navigation
--
-- Next Steps:
-- 1. Assign module permissions to roles using role_permissions table
-- 2. Use the permission library to check access:
--    $this->permission->has_module_access($user_id, 'module_name')
-- 3. Update role_permissions seeder to grant appropriate access
--
-- To use this seeder:
-- mysql -u root -p your_database < database_seeders/modules_seeder.sql
--
-- Or via Windows batch:
-- cd database_seeders
-- import_modules_seeder.bat
-- ============================================================================
