<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use App\Core\Auth;
use App\Core\Env;
use App\Core\Request;
use App\Core\Response;
use App\Core\Router;
use App\Core\Session;
use App\Modules\Core\Controllers\AuthController;
use App\Modules\Core\Controllers\DashboardController;
use App\Modules\Core\Controllers\SettingsController;
use App\Shared\BrandingService;
use App\Shared\Config;

if (!file_exists(dirname(__DIR__) . '/.env')) {
    Response::redirect('/installer')->send();
    exit;
}

Env::load(dirname(__DIR__));

$appConfig = Config::get('app');
Session::start($appConfig['session_name']);

$request = new Request();
$router = new Router();

$dbConfig = Config::get('database');
$pdo = App\Core\Database::connect($dbConfig);

$brandingService = new BrandingService();
$authController = new AuthController($pdo);
$dashboardController = new DashboardController($pdo, $brandingService);
$settingsController = new SettingsController($pdo, $brandingService);

$router->get('/login', static fn () => $authController->showLogin());
$router->post('/login', static fn (Request $req) => $authController->login($req));
$router->get('/logout', static fn () => $authController->logout());
$router->get('/', static fn (Request $req) => $dashboardController->index($req));
$router->get('/settings/branding', static fn () => $settingsController->showBranding());
$router->post('/settings/branding', static fn (Request $req) => $settingsController->updateBranding($req));

$response = $router->dispatch($request);

$auth = new Auth($pdo);
$path = $request->path();
if (!in_array($path, ['/login', '/logout'], true) && $auth->userId() === null) {
    $response = Response::redirect('/login');
}

$response->send();
