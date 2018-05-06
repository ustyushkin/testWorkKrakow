<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
   public $data;
   public $decodedData;

   public function IteratorExtJsResponse($jsonParams, $object,$property)
   {
       $returnArray = [];
       if (count($jsonParams)>1){
           foreach ($jsonParams as $array) {
               array_push($returnArray,call_user_func(array($object, $property), $array));
           }
       }
       else {
           //and one entry when one operation
           array_push($returnArray,call_user_func(array($object, $property), $jsonParams));
       }
       return $returnArray;
   }
   public function getInputData($request)
   {
       $this->data = $request->input('data');
       $this->decodedData = json_decode($this->data);
   }
}
