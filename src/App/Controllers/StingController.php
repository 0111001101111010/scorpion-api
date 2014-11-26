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

    function validSeq($value)
    {
      if (!preg_match('/[^ACDEFGHIKLMNPQRSTVWY]/', $value, $error)){
        return true;
      }
      else {
        return false;
      }
    }

    public function getAll()
    {
        return new JsonResponse($this->stingService->getAll());
    }

    public function save(Request $request)
    {

        $job = $this->getDataFromRequest($request);
        if (!$this->validate($job)){
          $error = array("general"=>"request has one or more incorrect or missing parameters");

          // check title condition
          if (empty($job["title"])) {
            $error["title"] = "empty title";
          }

          //do sequence parsing
          if (empty($job["seq"])) {
            $error["seq"] = "empty seq";
          }
          else if (!$this->validSeq($job["seq"])){
              $error["seq"] = "invalid characters in string.(Pass parameter 'sanitize': true to attempt cleanup, default is false. This will removed invalid characters and upcase where possible)";
          }
          else if ((strlen($job["seq"])<40)){
            $error["seq"] = "invalid characters length: >=40 required";
          }

          // check the name of the sequence
          if (empty($job["name"])) {
            $error["name"] = "empty name";
          }
          if (empty($job["email"])) {
            $error["email"] = "empty email";
          }

          return new JsonResponse(Array("error"=>$error));
        }
        else {
          //valid sequence
          $mySeq= buildSequence("ACDEFGHIKLMNPQRSTVWY", strlen($job["seq"])*3);
          $mySeqSize = buildSequence("5678", strlen($job["seq"])*3);
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
            "sanitize" => $request->request->get('sanitize'),
            "time" => date('Y-m-d H:i:s'),
        );
    }
    /**Checks if any parameters are blank quick check**/

    public function validate($job)
    {
      if ($job["sanitize"]===true) {
        $error["seq"] = "sanitization was tried";
        $error["prev"] = $job["seq"];
        $error["post"] = $job["seq"];

        //sanitize
        $job["seq"] = $job["seq"];
        echo $job["seq"];
      }
      else {
        $job["sanitize"]="";
      }
      return !in_array("",$job);
    }
}
