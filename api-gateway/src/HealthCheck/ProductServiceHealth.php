<?php

namespace App\HealthCheck;

use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProductServiceHealth implements HealthCheckInterface
{

    public function __construct(private HttpClientInterface $httpClient, private string $url)
    {
    }

    public function check(): array
    {
        $start = microtime(true);

        try {
            $response = $this->httpClient->request('GET',$this->url . '/health',[
                'timeout' => 5,
            ]);

            $time = round((microtime(true) - $start) * 1000,2);

            if ($response->getStatusCode() === 200){
                $data = $response->toArray();
                return [
                    'status' => $data['status'] ?? 'unknown',
                    'time' => $time
                ];
            }

            return [
                'status' => 'unhealthy',
                'time' => $time,
                'error' => 'Bad HTTP Status'
            ];

        }catch (ExceptionInterface $exception){
            return [
                'status' => 'unhealthy',
                'time' => round((microtime(true) - $start) * 1000, 2),
                'error' => $exception->getMessage()
            ];
        }
    }

    public function getServiceName(): string
    {
        return 'Product-Service';
    }
}
