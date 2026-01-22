<?php
/** @var array $branding */
/** @var string $content */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($branding['brand_name']) ?> ERP</title>
    <link rel="icon" href="<?= htmlspecialchars($branding['brand_favicon_url']) ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            primary: '<?= htmlspecialchars($branding['brand_primary_color']) ?>',
                            secondary: '<?= htmlspecialchars($branding['brand_secondary_color']) ?>'
                        }
                    }
                }
            }
        };
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-5oGg+0MyoH1s2eY4P3CIZdNaGZ6pSoS9xDojD+o1bE0j2Y7b5z0I6vYkKwlL4V1rVxqYk2S9J3MJmX9hJp7E1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-slate-50 text-slate-900">
<div class="min-h-screen flex">
    <aside class="hidden lg:flex flex-col w-64 bg-white border-r border-slate-200">
        <div class="p-6 border-b border-slate-200 flex items-center gap-3">
            <img src="<?= htmlspecialchars($branding['brand_logo_url']) ?>" alt="Logo" class="h-10 w-10 rounded">
            <div>
                <p class="font-semibold text-lg text-brand-secondary"><?= htmlspecialchars($branding['brand_name']) ?></p>
                <p class="text-sm text-slate-500">ERP Suite</p>
            </div>
        </div>
        <nav class="flex-1 p-4 space-y-2 text-sm">
            <a href="/" class="flex items-center gap-2 px-3 py-2 rounded bg-brand-primary text-white">
                <i class="fa-solid fa-chart-line"></i>
                Dashboard
            </a>
            <a href="/settings/branding" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-slate-100">
                <i class="fa-solid fa-palette"></i>
                Brand Settings
            </a>
            <a href="#" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-slate-100">
                <i class="fa-solid fa-users"></i>
                CRM & Sales
            </a>
            <a href="#" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-slate-100">
                <i class="fa-solid fa-boxes-stacked"></i>
                Inventory
            </a>
            <a href="#" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-slate-100">
                <i class="fa-solid fa-wallet"></i>
                Accounting
            </a>
            <a href="#" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-slate-100">
                <i class="fa-solid fa-user-tie"></i>
                HR & Payroll
            </a>
            <a href="#" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-slate-100">
                <i class="fa-solid fa-folder"></i>
                Documents
            </a>
        </nav>
    </aside>
    <div class="flex-1 flex flex-col">
        <header class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <button class="lg:hidden text-slate-600" aria-label="Open navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h1 class="text-xl font-semibold">Welcome back</h1>
            </div>
            <div class="flex items-center gap-4">
                <button class="text-slate-500" aria-label="Notifications">
                    <i class="fa-regular fa-bell"></i>
                </button>
                <a href="/logout" class="text-sm text-slate-600">Logout</a>
            </div>
        </header>
        <main class="flex-1 p-6">
            <?= $content ?>
        </main>
        <footer class="px-6 py-4 text-sm text-slate-500 border-t border-slate-200">
            <span><?= htmlspecialchars($branding['footer_text']) ?></span>
            <span class="float-right">&copy; <?= date('Y') ?> <?= htmlspecialchars($branding['brand_name']) ?></span>
        </footer>
    </div>
</div>
</body>
</html>
