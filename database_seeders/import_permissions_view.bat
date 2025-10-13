@echo off
REM ============================================================================
REM Import User Module Permissions View
REM ============================================================================
REM This batch file imports the user_module_permissions view into MySQL
REM
REM Prerequisites:
REM 1. MySQL must be running
REM 2. Database must exist
REM 3. Tables must be created: user, user_roles, roles, role_permissions, modules
REM 4. .env file must be configured with correct credentials
REM
REM Usage: Double-click this file or run from command line
REM ============================================================================

echo.
echo ============================================================================
echo   Montera App - Import User Module Permissions View
echo ============================================================================
echo.

REM Get database credentials from .env file (you'll need to update these)
set MYSQL_PATH=C:\xampp\mysql\bin\mysql.exe
set DB_HOST=localhost
set DB_USER=root
set DB_PASSWORD=
set DB_NAME=u388059875_bhskin

echo [1/3] Checking MySQL connection...
"%MYSQL_PATH%" -h %DB_HOST% -u %DB_USER% %DB_PASSWORD_FLAG% -e "SELECT 1;" 2>nul
if %errorlevel% neq 0 (
    echo [ERROR] Cannot connect to MySQL. Please check:
    echo   - MySQL is running
    echo   - Credentials are correct
    echo   - XAMPP MySQL service is started
    pause
    exit /b 1
)
echo [OK] MySQL connection successful
echo.

echo [2/3] Importing user_module_permissions view...
"%MYSQL_PATH%" -h %DB_HOST% -u %DB_USER% %DB_PASSWORD_FLAG% %DB_NAME% < "create_user_module_permissions_view.sql"
if %errorlevel% neq 0 (
    echo [ERROR] Failed to create view. Check the SQL file for errors.
    pause
    exit /b 1
)
echo [OK] View created successfully
echo.

echo [3/3] Verifying view...
"%MYSQL_PATH%" -h %DB_HOST% -u %DB_USER% %DB_PASSWORD_FLAG% %DB_NAME% -e "SELECT COUNT(*) AS total_permissions FROM user_module_permissions;"
if %errorlevel% neq 0 (
    echo [ERROR] View verification failed
    pause
    exit /b 1
)
echo [OK] View verified successfully
echo.

echo ============================================================================
echo   Import Complete!
echo ============================================================================
echo.
echo Next steps:
echo 1. Assign roles to users in the 'user_roles' table
echo 2. Configure role permissions in the 'role_permissions' table
echo 3. Test sidebar visibility with different user roles
echo.
echo View created: user_module_permissions
echo Location: Your database ^> Views ^> user_module_permissions
echo.
pause
