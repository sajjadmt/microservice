<?php

namespace App\Controller;

use App\HealthCheck\HealthAggregator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HealthCheckController extends AbstractController
{

    #[Route('/health')]
    public function check(HealthAggregator $aggregator): JsonResponse
    {
        $data = $aggregator->aggregate();
        $status = $data['status'] === 'healthy' ? 200 : 503;
        return $this->json($data, $status);
    }

}
