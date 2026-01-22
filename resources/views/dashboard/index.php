<?php
/** @var array $branding */
ob_start();
?>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white border border-slate-200 rounded-xl p-6">
        <p class="text-sm text-slate-500">Total Sales</p>
        <p class="text-2xl font-semibold mt-2">₦0.00</p>
        <p class="text-xs text-slate-400 mt-1">Awaiting live data</p>
    </div>
    <div class="bg-white border border-slate-200 rounded-xl p-6">
        <p class="text-sm text-slate-500">Receivables</p>
        <p class="text-2xl font-semibold mt-2">₦0.00</p>
        <p class="text-xs text-slate-400 mt-1">No invoices issued</p>
    </div>
    <div class="bg-white border border-slate-200 rounded-xl p-6">
        <p class="text-sm text-slate-500">Inventory Health</p>
        <p class="text-2xl font-semibold mt-2">Stable</p>
        <p class="text-xs text-slate-400 mt-1">Configure low-stock alerts</p>
    </div>
</div>
<div class="mt-8 bg-white border border-slate-200 rounded-xl p-6">
    <h2 class="text-lg font-semibold mb-2">Getting Started</h2>
    <p class="text-sm text-slate-600">Complete setup tasks to unlock full ERP capabilities.</p>
    <ul class="mt-4 space-y-2 text-sm text-slate-600">
        <li class="flex items-center gap-2"><i class="fa-regular fa-circle-check text-brand-primary"></i> Add your company profile</li>
        <li class="flex items-center gap-2"><i class="fa-regular fa-circle-check text-brand-primary"></i> Configure tax and invoice numbering</li>
        <li class="flex items-center gap-2"><i class="fa-regular fa-circle-check text-brand-primary"></i> Invite team members and assign roles</li>
    </ul>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
