<?php

declare(strict_types=1);

return static function (PDO $db): void {
    $roles = [
        ['Admin', 'admin'],
        ['Manager', 'manager'],
        ['Accountant', 'accountant'],
        ['Sales', 'sales'],
        ['Inventory', 'inventory'],
        ['HR', 'hr'],
        ['Staff', 'staff'],
    ];

    $statement = $db->prepare('INSERT IGNORE INTO roles (name, slug) VALUES (:name, :slug)');
    foreach ($roles as $role) {
        $statement->execute(['name' => $role[0], 'slug' => $role[1]]);
    }

    $permissions = [
        ['View Dashboard', 'view_dashboard'],
        ['Manage Users', 'manage_users'],
        ['Manage Settings', 'manage_settings'],
        ['Manage CRM', 'manage_crm'],
        ['Manage Inventory', 'manage_inventory'],
        ['Manage Accounting', 'manage_accounting'],
        ['Manage HR', 'manage_hr'],
    ];

    $permStatement = $db->prepare('INSERT IGNORE INTO permissions (name, slug) VALUES (:name, :slug)');
    foreach ($permissions as $permission) {
        $permStatement->execute(['name' => $permission[0], 'slug' => $permission[1]]);
    }
};
