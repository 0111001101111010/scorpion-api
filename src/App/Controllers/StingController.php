<?php

namespace App\Controllers;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Sting REST API End point
 *
 * A *description*, that can span multiple lines, to go _in-depth_ into the details of this element
 * and to provide some background information or textual references.
 *
 * @param string $myArgument With a *description* of this argument, these may also
 *    span multiple lines.
 *
 * @return void
 */
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
        $check = $this->validate($job)["evaluate"];
        $job = $this->validate($job)["newjob"];
        if (!($this->validate($job)["evaluate"])){
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

          return new JsonResponse(Array("error"=>$error, "submitted"=>$job));
        }
        else {
          //valid sequence
          $mySeq= $this->buildSequence("ACDEFGHIKLMNPQRSTVWY", strlen($job["seq"])*3);
          $mySeqSize = $this->buildSequence("5678", strlen($job["seq"])*3);
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

    public function getDataFromRequest(Request $payload)
    {
        return $job = array(
            "name" => $payload->request->get("name"),
            "seq" => $payload->request->get("seq"),
            "title" => $payload->request->get("title"),
            "email" => $payload->request->get("email"),
            "sanitize" => $payload->request->get('sanitize'),
            "time" => date('Y-m-d H:i:s'),
        );
    }
    /**Checks if any parameters are blank quick check**/

    public function validate($job)
    {
        //echo $job["seq"];
      if ($job["sanitize"] === "yes") {
        // $error["seq"] = "sanitization was tried";
        // $error["prev"] = $job["seq"];
        // $error["post"] = $job["seq"];
        //sanitize
        $job["seq"] = $this->clean($job["seq"]);
        //echo $job["seq"];
      }
      else {


        $job["sanitize"] = "";
      }

      return array("evaluate"=>!in_array("", $job), "newjob"=> $job);
    }

    public function clean($string)
    { //echo "cleaning";
      $pattern = '/[^ACDEFGHIKLMNPQRSTVWY]/';
      $cleaned = preg_replace($pattern, "", $string);
      //echo $cleaned;
      # code...
      return $cleaned;
    }

    public function buildSequence($valid_chars, $length)
    {
        // start with an empty random string
        $random_string = "";

        // count the number of chars in the valid chars string so we know how many choices we have
        $num_valid_chars = strlen($valid_chars);

        // repeat the steps until we've created a string of the right length
        for ($i = 0; $i < $length; $i++)
        {
            // pick a random number from 1 up to the number of valid chars
            $random_pick = mt_rand(1, $num_valid_chars);

            // take the random character out of the string of valid chars
            // subtract 1 from $random_pick because strings are indexed starting at 0, and we started picking at 1
            $random_char = $valid_chars[$random_pick-1];

            // add the randomly-chosen char onto the end of our string so far
            $random_string .= $random_char;
        }

        // return our finished random string
        return $random_string;
    }

}
