@echo off
REM ============================================================================
REM Modules Seeder Import Script for Montera Application
REM ============================================================================
REM This batch file imports the modules seeder into the MySQL database
REM Usage: Double-click this file or run from command prompt
REM ============================================================================

SETLOCAL EnableDelayedExpansion

echo.
echo ============================================================================
echo          Montera Application - Modules Seeder Import
echo ============================================================================
echo.

REM Get database name from .env file
set DB_DATABASE=
for /f "tokens=2 delims==" %%a in ('findstr /B "DB_DATABASE" ..\.env 2^>nul') do set DB_DATABASE=%%a

REM Get MySQL username from .env file
set DB_USERNAME=root
for /f "tokens=2 delims==" %%a in ('findstr /B "DB_USERNAME" ..\.env 2^>nul') do set DB_USERNAME=%%a

REM Check if database name was found
if "%DB_DATABASE%"=="" (
    echo [ERROR] Could not find DB_DATABASE in .env file
    echo.
    echo Please ensure .env file exists and contains DB_DATABASE setting
    echo Example: DB_DATABASE=your_database_name
    echo.
    pause
    exit /b 1
)

echo Found database: %DB_DATABASE%
echo Using MySQL user: %DB_USERNAME%
echo.

REM Check if MySQL is accessible
C:\xampp\mysql\bin\mysql.exe --version >nul 2>&1
if errorlevel 1 (
    echo [ERROR] MySQL not found at C:\xampp\mysql\bin\mysql.exe
    echo.
    echo Please ensure XAMPP is installed and MySQL is in the correct location
    echo.
    pause
    exit /b 1
)

echo MySQL found successfully!
echo.
echo This will import 49 application modules into your database.
echo.
echo Modules include:
echo   - System Management (Dashboard, Users, Roles, etc.)
echo   - HR Management (Quest, Positions, Benefits)
echo   - Marketing (Influencers, Endorsements, Campaigns)
echo   - Operations (Transactions, Products, Stock)
echo   - Reports and Analytics
echo.
echo ============================================================================
echo.

REM Prompt for confirmation
set /p CONFIRM="Import modules seeder into database '%DB_DATABASE%'? (Y/N): "
if /i not "%CONFIRM%"=="Y" (
    echo.
    echo Import cancelled by user.
    echo.
    pause
    exit /b 0
)

echo.
echo Importing modules seeder...
echo.

REM Import the seeder (will prompt for password if needed)
C:\xampp\mysql\bin\mysql.exe -u %DB_USERNAME% -p %DB_DATABASE% < modules_seeder.sql

if errorlevel 1 (
    echo.
    echo [ERROR] Import failed!
    echo.
    echo Possible reasons:
    echo   - Incorrect MySQL password
    echo   - Database does not exist
    echo   - Modules already exist (this is OK - uses INSERT IGNORE)
    echo.
    pause
    exit /b 1
)

echo.
echo ============================================================================
echo                    Import Completed Successfully!
echo ============================================================================
echo.
echo 49 application modules have been imported into: %DB_DATABASE%
echo.
echo Modules by Category:
echo ───────────────────────────────────────────────────────────────────────
echo   • System Management:     7 modules
echo   • HR Management:         7 modules
echo   • Marketing:            15 modules
echo   • Operations:           11 modules
echo   • Reports & Analytics:   3 modules
echo   • Google Integration:    2 modules
echo   • API Modules:           4 modules
echo ───────────────────────────────────────────────────────────────────────
echo.
echo Next Steps:
echo.
echo 1. Import role_permissions seeder to grant module access to roles
echo 2. Login as admin to verify modules appear in system
echo 3. Configure module permissions via: Roles ^> Edit ^> Permissions
echo.
echo [!] NOTE: Modules are imported but NOT automatically granted to roles.
echo     You must assign module permissions via role_permissions table.
echo.
echo ============================================================================
echo.
pause
