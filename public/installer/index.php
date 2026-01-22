<?php

declare(strict_types=1);

require dirname(__DIR__) . '/../vendor/autoload.php';

use App\Core\Database;
use App\Core\Migrator;
use App\Core\Seeder;

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbHost = trim($_POST['db_host'] ?? '');
    $dbPort = trim($_POST['db_port'] ?? '3306');
    $dbName = trim($_POST['db_name'] ?? '');
    $dbUser = trim($_POST['db_user'] ?? '');
    $dbPass = trim($_POST['db_pass'] ?? '');
    $adminName = trim($_POST['admin_name'] ?? '');
    $adminEmail = trim($_POST['admin_email'] ?? '');
    $adminPassword = trim($_POST['admin_password'] ?? '');
    $brandName = trim($_POST['brand_name'] ?? 'Jamilsoft');

    if ($dbHost === '' || $dbName === '' || $dbUser === '' || $adminName === '' || $adminEmail === '' || $adminPassword === '') {
        $errors[] = 'Please fill in all required fields.';
    }

    if ($errors === []) {
        $config = [
            'driver' => 'mysql',
            'host' => $dbHost,
            'port' => $dbPort,
            'database' => $dbName,
            'username' => $dbUser,
            'password' => $dbPass,
            'charset' => 'utf8mb4',
        ];

        try {
            $pdo = Database::connect($config);
            $migrator = new Migrator($pdo);
            $migrator->run(dirname(__DIR__, 2) . '/database/migrations');

            $seeder = new Seeder($pdo);
            $seeder->run(dirname(__DIR__, 2) . '/database/seeders');

            $pdo->prepare('INSERT INTO organizations (name) VALUES (:name)')->execute(['name' => $brandName]);
            $orgId = (int) $pdo->lastInsertId();

            $pdo->prepare('INSERT INTO users (organization_id, name, email, password) VALUES (:org, :name, :email, :password)')->execute([
                'org' => $orgId,
                'name' => $adminName,
                'email' => $adminEmail,
                'password' => password_hash($adminPassword, PASSWORD_DEFAULT),
            ]);

            $envContents = implode("\n", [
                'APP_NAME=Maryax',
                'APP_ENV=production',
                'APP_DEBUG=false',
                'APP_URL=' . ($_POST['app_url'] ?? 'http://localhost'),
                'APP_TIMEZONE=UTC',
                'APP_SESSION=maryax_session',
                '',
                'DB_HOST=' . $dbHost,
                'DB_PORT=' . $dbPort,
                'DB_DATABASE=' . $dbName,
                'DB_USERNAME=' . $dbUser,
                'DB_PASSWORD=' . $dbPass,
                '',
                'BRAND_NAME=' . $brandName,
                'BRAND_TAGLINE=' . ($_POST['brand_tagline'] ?? 'Technology & Business Solutions'),
                'BRAND_LOGO_URL=' . ($_POST['brand_logo'] ?? 'https://jamilsoft.com.ng/assets/images/icon.png'),
                'BRAND_FAVICON_URL=' . ($_POST['brand_favicon'] ?? 'https://jamilsoft.com.ng/assets/images/icon.png'),
                'BRAND_PRIMARY_COLOR=' . ($_POST['brand_primary'] ?? '#1d4ed8'),
                'BRAND_SECONDARY_COLOR=' . ($_POST['brand_secondary'] ?? '#0f172a'),
                'BRAND_FOOTER_TEXT=' . ($_POST['brand_footer'] ?? 'Powered by Jamilsoft Technologies'),
                '',
            ]);

            file_put_contents(dirname(__DIR__, 2) . '/.env', $envContents);
            $success = true;
        } catch (Throwable $exception) {
            $errors[] = 'Installation failed: ' . $exception->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maryax Installer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100">
<div class="max-w-3xl mx-auto p-8">
    <div class="bg-white shadow-lg rounded-xl p-6">
        <h1 class="text-2xl font-semibold mb-2">Maryax ERP Installer</h1>
        <p class="text-sm text-slate-500 mb-6">Complete the setup to generate your configuration and bootstrap the database.</p>
        <?php if ($success): ?>
            <div class="bg-green-50 text-green-700 p-4 rounded mb-4">
                Installation complete. You can now <a class="underline" href="/login">sign in</a>.
            </div>
        <?php endif; ?>
        <?php if ($errors): ?>
            <div class="bg-red-50 text-red-700 p-4 rounded mb-4">
                <?= htmlspecialchars(implode(' ', $errors)) ?>
            </div>
        <?php endif; ?>
        <form method="post" class="space-y-6">
            <div>
                <h2 class="text-lg font-semibold">Database</h2>
                <div class="grid md:grid-cols-2 gap-4 mt-3">
                    <input type="text" name="db_host" placeholder="DB Host" class="border p-2 rounded" required>
                    <input type="text" name="db_port" placeholder="DB Port" class="border p-2 rounded" value="3306" required>
                    <input type="text" name="db_name" placeholder="DB Name" class="border p-2 rounded" required>
                    <input type="text" name="db_user" placeholder="DB User" class="border p-2 rounded" required>
                    <input type="password" name="db_pass" placeholder="DB Password" class="border p-2 rounded">
                    <input type="text" name="app_url" placeholder="App URL" class="border p-2 rounded" value="http://localhost">
                </div>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Admin Account</h2>
                <div class="grid md:grid-cols-2 gap-4 mt-3">
                    <input type="text" name="admin_name" placeholder="Admin Name" class="border p-2 rounded" required>
                    <input type="email" name="admin_email" placeholder="Admin Email" class="border p-2 rounded" required>
                    <input type="password" name="admin_password" placeholder="Admin Password" class="border p-2 rounded" required>
                </div>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Branding</h2>
                <div class="grid md:grid-cols-2 gap-4 mt-3">
                    <input type="text" name="brand_name" placeholder="Brand Name" class="border p-2 rounded" value="Jamilsoft">
                    <input type="text" name="brand_tagline" placeholder="Brand Tagline" class="border p-2 rounded" value="Technology & Business Solutions">
                    <input type="text" name="brand_logo" placeholder="Brand Logo URL" class="border p-2 rounded" value="https://jamilsoft.com.ng/assets/images/icon.png">
                    <input type="text" name="brand_favicon" placeholder="Brand Favicon URL" class="border p-2 rounded" value="https://jamilsoft.com.ng/assets/images/icon.png">
                    <input type="text" name="brand_primary" placeholder="Primary Color" class="border p-2 rounded" value="#1d4ed8">
                    <input type="text" name="brand_secondary" placeholder="Secondary Color" class="border p-2 rounded" value="#0f172a">
                    <input type="text" name="brand_footer" placeholder="Footer Text" class="border p-2 rounded" value="Powered by Jamilsoft Technologies">
                </div>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Install Now</button>
        </form>
    </div>
</div>
</body>
</html>
