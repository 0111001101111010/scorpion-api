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

        $note = $this->getDataFromRequest($request);
        return new JsonResponse(array("id" => $this->stingService->save($note)));

    }

    public function update($id, Request $request)
    {
        $note = $this->getDataFromRequest($request);
        $this->stingService->update($id, $note);
        return new JsonResponse($note);

    }

    public function delete($id)
    {

        return new JsonResponse($this->stingService->delete($id));

    }

    public function getDataFromRequest(Request $request)
    {
        return $note = array(
            "name" => $request->request->get("name"),
            "seq" => $request->request->get("seq"),
            "title" => $request->request->get("title"),
            "email" => $request->request->get("email"),
            "time" => date('Y-m-d H:i:s')
        );
    }
}

/**var Job = function Job(obj) {
  return {
    "title": obj.title,
    "input_seq":  obj.input_seq,
    "email": obj.email,
    "fasta_format": obj.fasta_format,
  };
};

var Status = function Status(job) {
  return {
    "job": job,
    "completed": false,
    "time": moment().format()
  };
};
**/
