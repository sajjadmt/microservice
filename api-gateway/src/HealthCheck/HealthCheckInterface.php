<?php

namespace App\HealthCheck;

interface HealthCheckInterface
{
    public function check(): array;

    public function getServiceName(): string;

}
