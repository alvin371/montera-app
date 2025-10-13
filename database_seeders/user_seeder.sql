-- ============================================================================
-- User Seeder for Montera Application
-- ============================================================================
-- This seeder creates 3 test users with different roles for development
-- Created based on CLAUDE.md documentation
--
-- Users created:
-- 1. Admin (Super Admin) - Full system access
-- 2. Marketing (Marketing Manager) - Influencer & endorsement management
-- 3. Operations (Operations Staff) - Transaction & inventory management
--
-- All passwords use secure password_hash() format
-- Default password pattern: [Role]123!@#
-- ============================================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ============================================================================
-- 1. Ensure Roles Exist
-- ============================================================================

-- Insert roles if they don't exist (using INSERT IGNORE)
INSERT IGNORE INTO `roles` (`id`, `name`, `display_name`, `description`, `level`, `is_active`, `created_at`) VALUES
(1, 'super_admin', 'Super Admin', 'Full system access with all permissions', 1, 1, NOW()),
(2, 'admin', 'Admin', 'Administrative access to most features', 2, 1, NOW()),
(3, 'marketing_manager', 'Marketing Manager', 'Manage influencers, endorsements, and campaigns', 3, 1, NOW()),
(4, 'marketing_staff', 'Marketing Staff', 'Marketing team member with limited access', 4, 1, NOW()),
(5, 'operations', 'Operations', 'Manage transactions, inventory, and products', 5, 1, NOW()),
(6, 'employee', 'Employee', 'Basic employee access', 6, 1, NOW()),
(7, 'hr', 'HR', 'Human Resources - User management', 7, 1, NOW()),
(10, 'guest', 'Guest', 'Limited access for new sign-ups', 10, 1, NOW());

-- ============================================================================
-- 2. Create Users
-- ============================================================================

-- Note: Passwords are pre-hashed using PHP password_hash() with PASSWORD_DEFAULT
-- To generate these hashes in PHP:
-- password_hash('Admin123!@#', PASSWORD_DEFAULT)
-- password_hash('Marketing123!@#', PASSWORD_DEFAULT)
-- password_hash('Operations123!@#', PASSWORD_DEFAULT)

-- User 1: Super Admin
INSERT INTO `user` (
    `id`,
    `full_name`,
    `code`,
    `birth_date`,
    `address`,
    `username`,
    `email`,
    `password`,
    `role`,
    `role_text`,
    `desc`,
    `img`,
    `created_by`,
    `updated_by`,
    `created_at`,
    `updated_at`,
    `status`,
    `phone`
) VALUES (
    1,
    'Administrator',
    'ADM001',
    '1990-01-01',
    'Jakarta',
    'admin',
    'admin@montera.com',
    '$2y$10$8X/73ca/Sl.kqDbzY6liH.FA5praDgBI.Cj90mUU6ctEk4uR0IKSa', -- Admin123!@#
    1,
    'Super Admin',
    'System administrator with full access',
    'default-avatar.png',
    1,
    1,
    NOW(),
    NOW(),
    'Aktif',
    '081234567890'
);

-- User 2: Marketing Manager
INSERT INTO `user` (
    `id`,
    `full_name`,
    `code`,
    `birth_date`,
    `address`,
    `username`,
    `email`,
    `password`,
    `role`,
    `role_text`,
    `desc`,
    `img`,
    `created_by`,
    `updated_by`,
    `created_at`,
    `updated_at`,
    `status`,
    `phone`
) VALUES (
    2,
    'Marketing Manager',
    'MKT001',
    '1992-05-15',
    'Jakarta',
    'marketing',
    'marketing@montera.com',
    '$2y$10$fgliN/cTtJa41bOE9Bl0rO93dqsmNXHWAfa/L0KLqIB5tOTxB1ydS', -- Marketing123!@#
    3,
    'Marketing Manager',
    'Manages influencer campaigns and endorsements',
    'default-avatar.png',
    1,
    1,
    NOW(),
    NOW(),
    'Aktif',
    '081234567891'
);

-- User 3: Operations Staff
INSERT INTO `user` (
    `id`,
    `full_name`,
    `code`,
    `birth_date`,
    `address`,
    `username`,
    `email`,
    `password`,
    `role`,
    `role_text`,
    `desc`,
    `img`,
    `created_by`,
    `updated_by`,
    `created_at`,
    `updated_at`,
    `status`,
    `phone`
) VALUES (
    3,
    'Operations Staff',
    'OPS001',
    '1993-08-20',
    'Jakarta',
    'operations',
    'operations@montera.com',
    '$2y$10$6wVRkaXntt/LnFHfSN3ziepwmvJyoQ2dADz9.baY.F4M9xNEQP7VO', -- Operations123!@#
    5,
    'Operations',
    'Handles inventory, transactions, and order fulfillment',
    'default-avatar.png',
    1,
    1,
    NOW(),
    NOW(),
    'Aktif',
    '081234567892'
);

-- ============================================================================
-- 3. Assign Roles via RBAC (user_roles table)
-- ============================================================================

-- Assign Super Admin role to User 1
INSERT INTO `user_roles` (`user_id`, `role_id`, `assigned_by`, `assigned_at`) VALUES
(1, 1, 1, NOW());

-- Assign Marketing Manager role to User 2
INSERT INTO `user_roles` (`user_id`, `role_id`, `assigned_by`, `assigned_at`) VALUES
(2, 3, 1, NOW());

-- Assign Operations role to User 3
INSERT INTO `user_roles` (`user_id`, `role_id`, `assigned_by`, `assigned_at`) VALUES
(3, 5, 1, NOW());

-- ============================================================================
-- 4. Update Auto Increment (if needed)
-- ============================================================================

-- Set auto increment to start after our seeded users
ALTER TABLE `user` AUTO_INCREMENT = 4;

COMMIT;

-- ============================================================================
-- SEEDER COMPLETE
-- ============================================================================
-- Users created successfully!
--
-- Login Credentials:
-- ┌────────────┬──────────────┬──────────────────────┬──────────────────────┐
-- │ Username   │ Password     │ Email                │ Role                 │
-- ├────────────┼──────────────┼──────────────────────┼──────────────────────┤
-- │ admin      │ Admin123!@#  │ admin@montera.com    │ Super Admin          │
-- │ marketing  │ Marketing123 │ marketing@montera... │ Marketing Manager    │
-- │ operations │ Operations1  │ operations@montera...│ Operations           │
-- └────────────┴──────────────┴──────────────────────┴──────────────────────┘
--
-- IMPORTANT SECURITY NOTES:
-- 1. These are DEVELOPMENT credentials only
-- 2. Change all passwords immediately in production
-- 3. The password hashes are examples - regenerate for production
-- 4. Consider enabling CSRF protection in config.php for production
-- 5. Enable proper error logging and disable error display in production
--
-- To use this seeder:
-- mysql -u root -p your_database < database_seeders/user_seeder.sql
--
-- Or via CodeIgniter:
-- php index.php migrate seed UserSeeder
-- ============================================================================
