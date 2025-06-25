<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HealthController extends Controller
{
    /**
     * Get application health status.
     */
    public function health()
    {
        $startTime = defined('LARAVEL_START') ? LARAVEL_START : microtime(true);
        $uptime = microtime(true) - $startTime;

        // Get app version from composer.json
        $composerPath = base_path('composer.json');
        $version = '1.0.0'; // default version

        if (file_exists($composerPath)) {
            $composer = json_decode(file_get_contents($composerPath), true);
            $version = $composer['version'] ?? '1.0.0';
        }

        return $this->successResponse([
            'app_name' => config('app.name', 'TableSheet Backend'),
            'version' => $version,
            'uptime' => round($uptime, 2),
            'status' => 'healthy',
            'timestamp' => now()->toISOString(),
            'environment' => config('app.env'),
            'debug' => config('app.debug')
        ], 'Application is healthy');
    }
}
