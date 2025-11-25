<?php

namespace App\HealthCheck;

class HealthAggregator
{

    /**
     * @param HealthCheckInterface[] $checkers
     */
    public function __construct(private iterable $checkers)
    {
    }

    public function aggregate(): array
    {

        $services = [];
        $allHealthy = true;

        foreach ($this->checkers as $checker){
            $result = $checker->check();
            if ($result['status'] !== 'healthy'){
                $allHealthy = false;
            }
            $services[$checker->getServiceName()] = $result;
        }

        return [
            'status' => $allHealthy ? 'healthy' : 'degraded',
            'timestamp' => (new \DateTime())->format('Y-m-d H:i:s'),
            'services' => $services,
        ];
    }

}
