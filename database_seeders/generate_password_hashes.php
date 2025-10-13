<?php
/**
 * Password Hash Generator for User Seeder
 *
 * This script generates secure password hashes for the user seeder.
 * Run this script to get the proper password_hash() values to use in user_seeder.sql
 *
 * Usage:
 * php database_seeders/generate_password_hashes.php
 */

echo "=================================================================\n";
echo "Password Hash Generator for Montera User Seeder\n";
echo "=================================================================\n\n";

// Define users and their passwords
$users = [
    'admin' => 'Admin123!@#',
    'marketing' => 'Marketing123!@#',
    'operations' => 'Operations123!@#'
];

echo "Generating password hashes...\n\n";

foreach ($users as $username => $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    echo "User: {$username}\n";
    echo "Password: {$password}\n";
    echo "Hash: {$hash}\n";
    echo str_repeat("-", 65) . "\n\n";
}

echo "=================================================================\n";
echo "Copy the hashes above and replace them in user_seeder.sql\n";
echo "=================================================================\n\n";

// Also generate SQL UPDATE statements for easy copy-paste
echo "SQL UPDATE Statements (for updating existing seeder):\n\n";

$user_id = 1;
foreach ($users as $username => $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    echo "-- User: {$username} (ID: {$user_id})\n";
    echo "UPDATE `user` SET `password` = '{$hash}' WHERE `id` = {$user_id};\n\n";
    $user_id++;
}

echo "=================================================================\n";
echo "Password Verification Test\n";
echo "=================================================================\n\n";

// Test verification
foreach ($users as $username => $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $verify = password_verify($password, $hash);

    echo "User: {$username} - Verification: " . ($verify ? "✓ SUCCESS" : "✗ FAILED") . "\n";
}

echo "\n=================================================================\n";
echo "Done!\n";
echo "=================================================================\n";
