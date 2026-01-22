<?php
/** @var array $branding */
/** @var string $csrf */
$errors = $_SESSION['login_errors'] ?? [];
unset($_SESSION['login_errors']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($branding['brand_name']) ?> Login</title>
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
</head>
<body class="bg-slate-50 text-slate-900">
<div class="min-h-screen flex items-center justify-center p-6">
    <div class="bg-white shadow-xl rounded-xl w-full max-w-md p-8 space-y-6">
        <div class="flex items-center gap-3">
            <img src="<?= htmlspecialchars($branding['brand_logo_url']) ?>" alt="Logo" class="h-12 w-12 rounded">
            <div>
                <h1 class="text-xl font-semibold"><?= htmlspecialchars($branding['brand_name']) ?> ERP</h1>
                <p class="text-sm text-slate-500"><?= htmlspecialchars($branding['brand_tagline']) ?></p>
            </div>
        </div>
        <?php if ($errors): ?>
            <div class="bg-red-50 text-red-600 text-sm p-3 rounded">
                <?= htmlspecialchars(implode(' ', $errors)) ?>
            </div>
        <?php endif; ?>
        <form method="post" class="space-y-4">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
            <div>
                <label class="text-sm font-medium">Email</label>
                <input type="email" name="email" class="mt-1 w-full border border-slate-200 rounded px-3 py-2" required>
            </div>
            <div>
                <label class="text-sm font-medium">Password</label>
                <input type="password" name="password" class="mt-1 w-full border border-slate-200 rounded px-3 py-2" required>
            </div>
            <button type="submit" class="w-full bg-brand-primary text-white py-2 rounded font-semibold">Sign in</button>
        </form>
        <p class="text-xs text-slate-500">Need help? Contact your system administrator.</p>
    </div>
</div>
</body>
</html>
