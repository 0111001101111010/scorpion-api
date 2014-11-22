<?php

namespace App\Controllers;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class StingController
{

    protected $stingService;

    public function __construct($service)
    {
        $this->stingService = $service;
    }

    public function getAll()
    {
        return new JsonResponse($this->stingService->getAll());
    }

    public function save(Request $request)
    {

        $job = $this->getDataFromRequest($request);
        return new JsonResponse(array("id" => $this->stingService->save($job)));

    }

    public function update($id, Request $request)
    {
        $job = $this->getDataFromRequest($request);
        $this->stingService->update($id, $job);
        return new JsonResponse($job);

    }

    public function delete($id)
    {

        return new JsonResponse($this->stingService->delete($id));

    }

    public function getDataFromRequest(Request $request)
    {
        return $job = array(
            "name" => $request->request->get("name"),
            "seq" => $request->request->get("seq"),
            "title" => $request->request->get("title"),
            "email" => $request->request->get("email"),
            "time" => date('Y-m-d H:i:s'),
            "pred_status" => false
        );
    }
}
