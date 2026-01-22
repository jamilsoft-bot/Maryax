<?php
/** @var array $branding */
/** @var string $csrf */
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
ob_start();
?>
<div class="max-w-3xl">
    <h2 class="text-xl font-semibold mb-2">Brand Settings</h2>
    <p class="text-sm text-slate-500 mb-4">Update your branding without code changes.</p>
    <?php if ($flash): ?>
        <div class="bg-green-50 text-green-700 p-3 rounded mb-4">
            <?= htmlspecialchars($flash) ?>
        </div>
    <?php endif; ?>
    <form method="post" class="space-y-4 bg-white border border-slate-200 rounded-xl p-6">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm font-medium">Brand Name</label>
                <input type="text" name="brand_name" value="<?= htmlspecialchars($branding['brand_name']) ?>" class="mt-1 w-full border border-slate-200 rounded px-3 py-2">
            </div>
            <div>
                <label class="text-sm font-medium">Tagline</label>
                <input type="text" name="brand_tagline" value="<?= htmlspecialchars($branding['brand_tagline']) ?>" class="mt-1 w-full border border-slate-200 rounded px-3 py-2">
            </div>
            <div>
                <label class="text-sm font-medium">Logo URL</label>
                <input type="text" name="brand_logo_url" value="<?= htmlspecialchars($branding['brand_logo_url']) ?>" class="mt-1 w-full border border-slate-200 rounded px-3 py-2">
            </div>
            <div>
                <label class="text-sm font-medium">Favicon URL</label>
                <input type="text" name="brand_favicon_url" value="<?= htmlspecialchars($branding['brand_favicon_url']) ?>" class="mt-1 w-full border border-slate-200 rounded px-3 py-2">
            </div>
            <div>
                <label class="text-sm font-medium">Primary Color</label>
                <input type="text" name="brand_primary_color" value="<?= htmlspecialchars($branding['brand_primary_color']) ?>" class="mt-1 w-full border border-slate-200 rounded px-3 py-2">
            </div>
            <div>
                <label class="text-sm font-medium">Secondary Color</label>
                <input type="text" name="brand_secondary_color" value="<?= htmlspecialchars($branding['brand_secondary_color']) ?>" class="mt-1 w-full border border-slate-200 rounded px-3 py-2">
            </div>
        </div>
        <div>
            <label class="text-sm font-medium">Footer Text</label>
            <input type="text" name="footer_text" value="<?= htmlspecialchars($branding['footer_text']) ?>" class="mt-1 w-full border border-slate-200 rounded px-3 py-2">
        </div>
        <button type="submit" class="bg-brand-primary text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
