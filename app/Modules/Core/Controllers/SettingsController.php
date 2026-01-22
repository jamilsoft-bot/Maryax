<?php

declare(strict_types=1);

namespace App\Modules\Core\Controllers;

use App\Core\Csrf;
use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Shared\BrandingService;
use App\Shared\View;
use PDO;

final class SettingsController
{
    public function __construct(private PDO $db, private BrandingService $brandingService)
    {
    }

    public function showBranding(): Response
    {
        $organizationId = Session::get('organization_id', 1);
        $branding = $this->brandingService->getBranding($this->db, $organizationId);

        return Response::html(View::render('settings/branding', [
            'branding' => $branding,
            'csrf' => Csrf::token(),
        ]));
    }

    public function updateBranding(Request $request): Response
    {
        $token = $request->input('csrf_token');
        if (!Csrf::verify($token)) {
            return Response::html('Invalid CSRF token.', 419);
        }

        $organizationId = Session::get('organization_id', 1);
        $data = [
            'brand_name' => $request->input('brand_name'),
            'brand_tagline' => $request->input('brand_tagline'),
            'brand_logo_url' => $request->input('brand_logo_url'),
            'brand_favicon_url' => $request->input('brand_favicon_url'),
            'brand_primary_color' => $request->input('brand_primary_color'),
            'brand_secondary_color' => $request->input('brand_secondary_color'),
            'footer_text' => $request->input('footer_text'),
        ];

        $this->brandingService->saveBranding($this->db, $organizationId, $data);
        Session::set('flash', 'Brand settings saved.');

        return Response::redirect('/settings/branding');
    }
}
