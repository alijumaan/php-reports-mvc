<?php

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\ReportController;
use App\Controllers\DashboardController;
use App\Routes\Router;

$router = new Router();

$router->get('/', [ReportController::class, 'index']);
$router->get('/reports', [ReportController::class, 'index']);
$router->get('/reports/show', [ReportController::class, 'show']);
$router->get('/reports/create', [ReportController::class, 'create']);
$router->post('/reports', [ReportController::class, 'store']);
$router->get('/reports/edit', [ReportController::class, 'edit']);
$router->post('/reports/update', [ReportController::class, 'update']);
$router->post('/reports/delete', [ReportController::class, 'destroy']);

$router->get('/login', [LoginController::class, 'loginForm']);
$router->post('/login', [LoginController::class, 'login']);
$router->post('/logout', [LoginController::class, 'logout']);

$router->get('/dashboard', [DashboardController::class, 'dashboard']);
$router->post('/dashboard/update-profile', [DashboardController::class, 'updateProfile']);

$router->resolve();