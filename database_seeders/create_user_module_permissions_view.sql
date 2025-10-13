-- ============================================================================
-- Create User Module Permissions View
-- ============================================================================
-- This view creates a denormalized representation of user permissions by
-- joining users → user_roles → role_permissions → modules
--
-- Purpose:
-- - Fast permission lookups for sidebar generation
-- - Used by Permission library to check user access
-- - Combines multiple role permissions for users with multiple roles
--
-- Usage:
-- SELECT * FROM user_module_permissions WHERE user_id = 1;
-- ============================================================================

-- Drop view if it exists
DROP VIEW IF EXISTS `user_module_permissions`;

-- Create the view
CREATE OR REPLACE VIEW `user_module_permissions` AS
SELECT
    u.id AS user_id,
    m.id AS module_id,
    m.name AS module_name,
    m.display_name AS module_display_name,
    m.controller,
    m.icon,
    m.parent_id,
    m.sort_order,
    m.is_active,
    -- Aggregate permissions from all user roles (OR logic)
    -- If user has multiple roles and ANY role grants permission, they get it
    MAX(rp.can_view) AS can_view,
    MAX(rp.can_create) AS can_create,
    MAX(rp.can_edit) AS can_edit,
    MAX(rp.can_delete) AS can_delete,
    MAX(rp.can_approve) AS can_approve,
    -- Track if user has override permissions (for future use)
    0 AS has_override
FROM
    user u
    INNER JOIN user_roles ur ON u.id = ur.user_id
    INNER JOIN roles r ON ur.role_id = r.id
    INNER JOIN role_permissions rp ON r.id = rp.role_id
    INNER JOIN modules m ON rp.module_id = m.id
WHERE
    m.is_active = 1
    AND r.is_active = 1
GROUP BY
    u.id, m.id, m.name, m.display_name, m.controller, m.icon, m.parent_id, m.sort_order, m.is_active
ORDER BY
    u.id, m.sort_order, m.display_name;

-- ============================================================================
-- View Created Successfully!
-- ============================================================================
--
-- This view will automatically update when:
-- - User roles are assigned/removed (user_roles table)
-- - Role permissions are modified (role_permissions table)
-- - Modules are added/removed (modules table)
-- - Roles are activated/deactivated (roles.is_active)
--
-- Example Queries:
--
-- 1. Get all permissions for user ID 1:
--    SELECT * FROM user_module_permissions WHERE user_id = 1;
--
-- 2. Check if user 1 can view dashboard:
--    SELECT can_view FROM user_module_permissions
--    WHERE user_id = 1 AND module_name = 'dashboard';
--
-- 3. Get all modules user 1 can create:
--    SELECT module_name FROM user_module_permissions
--    WHERE user_id = 1 AND can_create = 1;
--
-- 4. Get sidebar menu structure for user 1:
--    SELECT * FROM user_module_permissions
--    WHERE user_id = 1 AND (can_view = 1 OR can_create = 1 OR can_edit = 1 OR can_delete = 1)
--    ORDER BY sort_order;
--
-- ============================================================================
