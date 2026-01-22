<?php

declare(strict_types=1);

namespace App\Shared;

use App\Core\Response;

abstract class BaseController
{
    protected function view(string $template, array $data = []): Response
    {
        return Response::html(View::render($template, $data));
    }
}
