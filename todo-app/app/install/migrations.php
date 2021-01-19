<?php

use App\Database;

/**
 * Create DB tables
 *
 * @return void
 */
function createTables()
{
    /**
     * Tables' structure
     */
    $tablesStructures = [
        "CREATE TABLE IF NOT EXISTS `users` (
            `id` INT UNSIGNED NOT NULL,
            `email` TINYTEXT NOT NULL,
            `password` TINYTEXT NOT NULL,
            `secret` TINYTEXT NOT NULL,
            `username` TINYTEXT NOT NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

        "CREATE TABLE IF NOT EXISTS `todos` (
            `id` INT UNSIGNED NOT NULL,
            `user_id` INT UNSIGNED NOT NULL,
            `body` MEDIUMTEXT NOT NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
    ];


    foreach ($tablesStructures as $tablesStructure) {
        Database::query($tablesStructure);
    }


    /**
     * Prevent to create existed tables by commenting a command that call this function
     */
    $path_to_file = dirname(__DIR__) . '/app/routes.php';
    $file_contents = file_get_contents($path_to_file);
    $file_contents = str_replace("createTables();", "// createTables();", $file_contents);
    file_put_contents($path_to_file, $file_contents);
}
