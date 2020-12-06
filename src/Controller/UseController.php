<?php


namespace bitms\Consul\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

interface UseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     *
     */
    public function addRegistration(Request $request):JsonResponse;

    public function dropRegistration(Request $request):JsonResponse;

    public function checkIn(Request $request):JsonResponse;
}