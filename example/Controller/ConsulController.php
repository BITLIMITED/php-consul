<?php


namespace App\Controller;


use bitms\Consul\Controller\UseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ConsulController implements UseController
{
    public function addRegistration(Request $request): JsonResponse
    {
        return $this->response();
    }

    public function dropRegistration(Request $request): JsonResponse
    {
        return $this->response();
    }

    public function checkIn(Request $request): JsonResponse
    {
        return $this->response();
    }


    private function response():JsonResponse
    {
        return new JsonResponse();
    }

}