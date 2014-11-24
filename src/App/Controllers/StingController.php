<?php

namespace App\Controllers;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
include ("../src/App/Etc/SeqReponse.php");

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

        if (!$this->validate($job)){
          $error = array();
          if (empty($job["title"])) {
            $error["title"] = "empty title";
          }
          if (empty($job["seq"])) {
            $error["seq"] = "empty seq";
          }
          if (empty($job["name"])) {
            $error["name"] = "empty name";
          }
          if (empty($job["email"])) {
            $error["email"] = "empty email";
          }

          return new JsonResponse(Array("error:"=>$error));
          die();
        }
        else {
          //valid sequence
          $mySeq= buildSequence("ACDEFGHIKLMNPQRSTVWY", strlen($job["seq"]));
          $mySeqSize = buildSequence("5678", strlen($job["seq"]));
          $job["pred_seq"] = $mySeq;
          $job["pred_weights"] = $mySeqSize;
          $job["pred_status"]  = true;
          $job["pred_time"] = date('Y-m-d H:i:s');

          return new JsonResponse(array("id" => $this->stingService->save($job)));
        }
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
        );
    }
    public function validate($job)
    {
      return !in_array("",$job);
    }
}
