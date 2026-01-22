<?php

declare(strict_types=1);

namespace App\Modules\Core\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Shared\BaseController;
use App\Shared\BrandingService;
use PDO;

final class DashboardController extends BaseController
{
    public function __construct(private PDO $db, private BrandingService $brandingService)
    {
    }

    public function index(Request $request): Response
    {
        $organizationId = Session::get('organization_id', 1);
        $branding = $this->brandingService->getBranding($this->db, $organizationId);

        return $this->view('dashboard/index', [
            'branding' => $branding,
        ]);
    }
}
