<?php

declare(strict_types=1);

use function App\Shared\env;

return [
    'brand_name' => env('BRAND_NAME', 'Jamilsoft'),
    'brand_tagline' => env('BRAND_TAGLINE', 'Technology & Business Solutions'),
    'brand_logo_url' => env('BRAND_LOGO_URL', 'https://jamilsoft.com.ng/assets/images/icon.png'),
    'brand_favicon_url' => env('BRAND_FAVICON_URL', 'https://jamilsoft.com.ng/assets/images/icon.png'),
    'brand_primary_color' => env('BRAND_PRIMARY_COLOR', '#1d4ed8'),
    'brand_secondary_color' => env('BRAND_SECONDARY_COLOR', '#0f172a'),
    'footer_text' => env('BRAND_FOOTER_TEXT', 'Powered by Jamilsoft Technologies'),
];
