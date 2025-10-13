@echo off
REM ============================================================================
REM User Seeder Import Script for Montera Application
REM ============================================================================
REM This batch file imports the user seeder into the MySQL database
REM Usage: Double-click this file or run from command prompt
REM ============================================================================

SETLOCAL EnableDelayedExpansion

echo.
echo ============================================================================
echo            Montera Application - User Seeder Import
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
echo ============================================================================
echo.

REM Prompt for confirmation
set /p CONFIRM="Import user seeder into database '%DB_DATABASE%'? (Y/N): "
if /i not "%CONFIRM%"=="Y" (
    echo.
    echo Import cancelled by user.
    echo.
    pause
    exit /b 0
)

echo.
echo Importing user seeder...
echo.

REM Import the seeder (will prompt for password if needed)
C:\xampp\mysql\bin\mysql.exe -u %DB_USERNAME% -p %DB_DATABASE% < user_seeder.sql

if errorlevel 1 (
    echo.
    echo [ERROR] Import failed!
    echo.
    echo Possible reasons:
    echo   - Incorrect MySQL password
    echo   - Database does not exist
    echo   - Users already exist (duplicate entry error)
    echo.
    echo To fix duplicate entry error, delete existing test users first:
    echo   DELETE FROM user_roles WHERE user_id IN (1, 2, 3);
    echo   DELETE FROM user WHERE id IN (1, 2, 3);
    echo.
    pause
    exit /b 1
)

echo.
echo ============================================================================
echo                       Import Completed Successfully!
echo ============================================================================
echo.
echo 3 test users have been created in database: %DB_DATABASE%
echo.
echo Login Credentials:
echo ───────────────────────────────────────────────────────────────────────
echo.
echo User 1 - Super Admin:
echo   Username: admin
echo   Password: Admin123!@#
echo   Email:    admin@montera.com
echo.
echo User 2 - Marketing Manager:
echo   Username: marketing
echo   Password: Marketing123!@#
echo   Email:    marketing@montera.com
echo.
echo User 3 - Operations Staff:
echo   Username: operations
echo   Password: Operations123!@#
echo   Email:    operations@montera.com
echo.
echo ───────────────────────────────────────────────────────────────────────
echo.
echo You can now login at: http://localhost/montera-app/auth/login
echo.
echo [!] IMPORTANT: These are DEVELOPMENT credentials only!
echo     Change all passwords before deploying to production.
echo.
echo ============================================================================
echo.
pause
