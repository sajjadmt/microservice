<?php

namespace App\HealthCheck;

use App\HealthCheck\HealthCheckInterface;

class ApiGatewayHealth implements HealthCheckInterface
{

    public function check(): array
    {
        return [
            'status' => 'healthy',
            'time' => 0
        ];
    }

    public function getServiceName(): string
    {
        return 'Api-Gateway';
    }
}
